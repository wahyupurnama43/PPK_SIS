<?php

namespace App\Http\Controllers;

use App\Models\Kadus;
use App\Models\Surat;
use App\Models\Penduduk;
use App\Models\JenisSurat;
use App\Models\NomorSurat;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Elibyy\TCPDF\Facades\TCPDF;
use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SuratController extends Controller
{
    public function index()
    {
        return view('pages.surat.surat');
    }

    public function notify()
    {
        $surat = Surat::select('created_at', 'nik', 'id_jenis_surat')
            ->with([
                'penduduk' => function ($d) {
                    $d->select('nik', 'nama_lengkap');
                },
                'jenis_surat' => function ($js) {
                    $js->select('id', 'nama');
                },
            ])
            ->where('verifikasi_staf', null)
            ->where('verifikasi_kadus', null)
            ->orderBy('created_at', 'DESC')
            ->get();
        return response()->json($surat);
    }

    // FOR USER

    public function surat(Request $request, $slug)
    {
        $jenis_surat = JenisSurat::where('slug', $slug)->first();
        $id_jenis_surat = $jenis_surat->id;
        $pendukung = '';
        $host = request()->getHttpHost();
        $nik = Auth::user()->username;

        // get data penduduk
        $penduduk = Penduduk::where('nik', $nik)->first();

        // note
        // sku = 1
        // skm = 2
        // skd = 3
        // sktm = 4
        // sk =5
        if ($id_jenis_surat === 1) {
            $ex        = explode('$i', $jenis_surat->deskripsi);
            $deskripsi = $ex[0] . $request->nama_usaha . $ex[1] . $request->lokasi_usaha . $ex[2];
            // get jabatan perbekel
            $jb_perbekel      = Jabatan::select('*')->where('nama', '=', 'perbekel desa')->first();
            // $exDusun = explode('br. ', $penduduk->keluarga->dusun);
            $perbekel         = Kadus::with('jabatan')->where('id_jabatan', $jb_perbekel->id)->first();
            if (!$perbekel) {
                return redirect()->route('surat.index')->with('error', 'Perbekel Tidak Tersedia Pada Wilayah ' . $penduduk->keluarga->dusun . ' Hubungi Kantor Desa');
            }
            $id_perbekel      = $perbekel->id;
            $id_kelian_banjar = null;
        } elseif ($id_jenis_surat === 2) {
            $ex        = explode('$i', $jenis_surat->deskripsi);
            $deskripsi = $ex[0];
            $pendukung = json_encode($request->nik);
            // get jabatan perbekel
            $jb_perbekel = Jabatan::select('*')->where('nama', '=', 'perbekel desa')->first();
            $perbekel    = Kadus::with('jabatan')->where('id_jabatan', $jb_perbekel->id)->first();
            if (!$perbekel) {
                return redirect()->route('surat.index')->with('error', 'Perbekel Tidak Tersedia Pada Wilayah ' . $penduduk->keluarga->dusun . ' Hubungi Kantor Desa');
            }

            $id_perbekel = $perbekel->id;

            // get jabatan kelian dinas
            $jb_kb            = Jabatan::select('*')->where('nama', '=', 'kelian banjar dinas')->first();

            $exDusun = explode('br. ', $penduduk->keluarga->dusun);
            if (count($exDusun) > 1) {
                $dusunNew = $exDusun[1];
            } else {
                $dusunNew = $exDusun[0];
            }

            $kelian_banjar    = Kadus::with('jabatan')->where('id_jabatan', $jb_kb->id)->where('dusun', $dusunNew)->where('desa', strtolower($penduduk->keluarga->desa))->first();
            // cek apakah kelian banjar ada
            if (!$kelian_banjar) {
                return redirect()->route('surat.index')->with('error', 'Kelian Banjar Tidak Tersedia Pada Wilayah ' . $penduduk->keluarga->dusun . ' Hubungi Kantor Desa');
            }

            $id_kelian_banjar = $kelian_banjar->id;
        } else {
            dd('tidak');
        }

        $tahun     = date('Y');
        $cek_nomor = NomorSurat::where('id_jenis_surat', $id_jenis_surat)->where('tahun', $tahun)->count();
        $count     = $cek_nomor + 1;
        $nomor     = str_pad($count, 2, '0', STR_PAD_LEFT);
        $array_bln = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        $bulan     = $array_bln[date('n')];

        // insert no surat
        $no_surat = NomorSurat::create([
            'uuid'           => Str::uuid(),
            'id_jenis_surat' => $id_jenis_surat,
            'kode'           => '145',
            'urutan'         => $nomor,
            'bulan'          => $bulan,
            'tahun'          => $tahun,
        ]);

        $pdfName = 'public/pdf/' . date('m-y-d') . $nomor . $nik . '.pdf';

        $qrname = 'images/qrcode/' . date('m-y-d') . $nomor . $nik . '.svg';

        QrCode::generate($host . Storage::url($pdfName), public_path($qrname));

        $surat = Surat::create([
            'uuid'           => Str::uuid(),
            'nik'            => $nik,
            'id_nomor_surat' => $no_surat->id,
            'id_jenis_surat' => $id_jenis_surat,
            'id_kadus'       => $id_perbekel,
            'id_staf'        => $id_kelian_banjar,
            'keperluan'      => $request->keperluan,
            'deskripsi'      => $deskripsi,
            'pendukung'      => $pendukung,
            'barcode'        => $qrname,
            'pdf'            => $pdfName,
        ]);

        if ($id_jenis_surat === 1) {
            $pdf = PDF::loadview('pages.surat.sku', compact('penduduk', 'perbekel', 'no_surat', 'nik', 'surat', 'host'));
            // return $pdf->stream('dompdf_out.pdf');
            Storage::put($pdfName, $pdf->output());
        } else if ($id_jenis_surat === 2) {
            $pdf = PDF::loadview('pages.surat.skm', compact('penduduk', 'perbekel', 'kelian_banjar', 'no_surat', 'nik', 'surat', 'host'));
            // return $pdf->stream('dompdf_out.pdf');
            Storage::put($pdfName, $pdf->output());
        }


        // return view('pages.surat.sku');
        return redirect()->route('surat.list')->with('success', 'Berhasil Membuat Surat');
    }

    public function list()
    {
        if (Auth::user()->id_jabatan === 1) {
            $surats = Surat::orderBy('created_at', 'DESC')->paginate(9);
        } else {
            $nik = Auth::user()->username;
            $surats = Surat::where('nik', $nik)
                ->orderBy('created_at', 'DESC')
                ->paginate(9);
        }
        return view('pages.surat.list', compact('surats'));
    }

    // FOR ADMIN

    public function Adminlist()
    {
        if (request()->ajax()) {
            $data = Surat::select('*')
                ->with(['penduduk', 'no_surat', 'jenis_surat', 'kadus'])
                ->orderBy('created_at', 'desc')
                ->get();
            return DataTables::of($data)
                ->addColumn('verifikasi_staf', function ($row) {
                    if ($row->verifikasi_staf === 0) {
                        return '<span class="badge badge-danger">
                        Di Tolak
                        </span>';
                    } elseif ($row->verifikasi_staf === 1) {
                        return '<span class="badge badge-success">
                        Verifikasi Berhasil
                        </span>';
                    } else {
                        return '<span class="badge badge-danger">
                        Belum Verifikasi
                        </span>';
                    }
                })
                ->addColumn('preview', function ($row) {
                    return '<a href="' .
                        Storage::url($row->pdf) .
                        '" target="_blank" class="btn edit btn btn-primary btn-sm update mb-2">
                            PDF
                        </a>';
                })
                ->addColumn('verifikasi_kadus', function ($row) {
                    if ($row->verifikasi_kadus === 0) {
                        return '<span class="badge badge-danger">
                        Di Tolak
                        </span>';
                    } elseif ($row->verifikasi_kadus === 1) {
                        return '<span class="badge badge-success">
                        Verifikasi Berhasil
                        </span>';
                    } else {
                        return '<span class="badge badge-danger">
                        Belum Verifikasi
                        </span>';
                    }
                })
                ->addColumn('nomor_surat', function ($row) {
                    return $row->no_surat->kode . '/' . $row->no_surat->urutan . '/' . $row->no_surat->bulan . '/' . $row->no_surat->tahun;
                })
                ->addColumn('action', function ($row) {
                    $btn = '';
                    if ($row->verifikasi_kadus !== 1 && $row->verifikasi_kadus !== 0) {
                        $btn =
                            $btn .
                            '<a href="' .
                            route('surat.verif', [$row->uuid, 'kadus']) .
                            '" class="btn edit btn btn-primary btn-sm update mb-2 mx-1">
                            Verifikasi Kadus
                        </a>';
                    }

                    if ($row->verifikasi_staf !== 1 && $row->verifikasi_staf !== 0) {
                        $btn =
                            $btn .
                            '<a href="' .
                            route('surat.verif', [$row->uuid, 'staf']) .
                            '" class="btn edit btn btn-primary btn-sm update mb-2 mx-1">
                            Verifikasi Staf
                        </a>';
                    }
                    if ($row->verifikasi_staf !== 0 && $row->verifikasi_staf !== 1 && ($row->verifikasi_kadus !== 0 && $row->verifikasi_kadus !== 1)) {
                        $btn =
                            $btn .
                            '<a href="' .
                            route('surat.verif', [$row->uuid, 'tolak']) .
                            '" class="btn edit btn btn-danger btn-sm update mb-2 mx-1">
                            Tolak
                        </a>';
                    } elseif ($row->verifikasi_kadus === 1 || $row->verifikasi_staf === 1) {
                        $btn =
                            $btn .
                            '<a href="' .
                            route('surat.verif', [$row->uuid, 'tolak']) .
                            '" class="btn edit btn btn-danger btn-sm update mb-2 mx-1">
                                Tolak
                            </a>';
                    }
                    return $btn;
                })
                ->rawColumns(['action', 'verifikasi_staf', 'verifikasi_kadus', 'preview'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('pages.surat.admin.adminList');
    }

    public function verif($id, $aktor)
    {
        $surat = Surat::where('uuid', $id)->first();

        if ($aktor === 'kadus') {
            $surat->verifikasi_kadus = '1';
        } elseif ($aktor === 'staf') {
            $surat->verifikasi_staf = '1';
        } else {
            $surat->verifikasi_staf = '0';
            $surat->verifikasi_kadus = '0';
        }

        $cek = $surat->save();
        if ($cek) {
            return redirect()
                ->route('surat.Adminlist')
                ->with('success', 'Berhasil Verifikasi');
        } else {
            return redirect()
                ->route('surat.Adminlist')
                ->with('error', 'Mohon Hubungi Admin');
        }
    }

    public function suratAdmin()
    {
        return view('pages.surat.admin.adminCreate');
    }

    public function storeSuratAdmin(Request $request, $slug)
    {
        $jenis_surat = JenisSurat::where('slug', $slug)->first();
        $id_jenis_surat = $jenis_surat->id;
        $pendukung = '';
        $host = request()->getHttpHost();
        // note
        // sku = 1
        // skm = 2
        // skd = 3
        // sktm = 4
        // sk =5
        if ($id_jenis_surat === 1) {
            $deskripsi = 'Sesuai dengan pernyataan orang tersebut diatas bahwa memang benar yang bersangkutan mempunyai usaha ' . $request->nama_usaha . ' yang berlokasi di wilayah keja kami di ' . $request->lokasi_usaha . ' dan masih memerlukan Bantuan Modal dengan agunan sebagai berikut :';
        } else {
            dd('tidak');
        }
        $tahun = date('Y');
        $cek_nomor = NomorSurat::where('id_jenis_surat', $id_jenis_surat)
            ->where('tahun', $tahun)
            ->count();
        $count = $cek_nomor + 1;
        $nomor = str_pad($count, 2, '0', STR_PAD_LEFT);
        $array_bln = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        $bulan = $array_bln[date('n')];

        $nik = $request->nik;
        // get data penduduk

        $penduduk = Penduduk::where('nik', $nik)->first();
        $kadus = Kadus::where('dusun', 'like', '%' . $penduduk->keluarga->dusun . '%')
            ->where('desa', 'like', '%' . $penduduk->keluarga->desa . '%')
            ->first();

        // insert no surat
        $no_surat = NomorSurat::create([
            'uuid' => Str::uuid(),
            'id_jenis_surat' => $id_jenis_surat,
            'kode' => '145',
            'urutan' => $nomor,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ]);
        $pdfName = 'public/pdf/' . date('m-y-d') . $nomor . $nik . '.pdf';

        $qrname = 'images/qrcode/' . date('m-y-d') . $nomor . $nik . '.svg';

        QrCode::generate($host . Storage::url($pdfName), public_path($qrname));

        $surat = Surat::create([
            'uuid' => Str::uuid(),
            'nik' => $nik,
            'id_nomor_surat' => $no_surat->id,
            'id_jenis_surat' => $id_jenis_surat,
            'id_kadus' => $kadus->id,
            'keperluan' => $request->keperluan,
            'deskripsi' => $deskripsi,
            'pendukung' => $pendukung,
            'barcode' => $qrname,
            'pdf' => $pdfName,
        ]);

        $pdf = PDF::loadview('pages.surat.sku', compact('penduduk', 'kadus', 'no_surat', 'nik', 'surat', 'host'));
        Storage::put($pdfName, $pdf->output());
        // return view('pages.surat.sku');
        return redirect()
            ->route('surat.list')
            ->with('success', 'Berhasil Membuat Surat');
    }
}
