<?php

namespace App\Http\Controllers;

use App\Models\Kadus;
use App\Models\Surat;
use App\Mail\SuratMail;
use App\Models\Jabatan;
use App\Models\Penduduk;
use App\Models\JenisSurat;
use App\Models\NomorSurat;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
            ->where('verifikasi_perbekel', null)
            ->where('verifikasi_perbekel', null)
            ->orderBy('created_at', 'DESC')
            ->get();
        return response()->json($surat);
    }

    // FOR USER

    public function surat(Request $request, $slug)
    {
        $jenis_surat    = JenisSurat::where('slug', $slug)->first();
        $id_jenis_surat = $jenis_surat->id;
        $pendukung      = '';
        $host           = request()->getHttpHost();
        $nik            = Auth::user()->username;

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
        } elseif ($id_jenis_surat === 2 || $id_jenis_surat === 4 || $id_jenis_surat === 3) {
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

            $exDusun = explode('Br. Dinas ', $penduduk->keluarga->dusun);
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
            $pendukung = $request->judul;
            $deskripsi = $request->deskripsi;
            $jb_perbekel = Jabatan::select('*')->where('nama', '=', 'perbekel desa')->first();
            $perbekel    = Kadus::with('jabatan')->where('id_jabatan', $jb_perbekel->id)->first();
            if (!$perbekel) {
                return redirect()->route('surat.index')->with('error', 'Perbekel Tidak Tersedia Pada Wilayah ' . $penduduk->keluarga->dusun . ' Hubungi Kantor Desa');
            }

            $id_perbekel = $perbekel->id;

            // get jabatan kelian dinas
            $jb_kb            = Jabatan::select('*')->where('nama', '=', 'kelian banjar dinas')->first();

            $exDusun = explode('Br. Dinas ', $penduduk->keluarga->dusun);
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

        $pdfName = 'public/pdf/' . rand(0, 99) . $nomor . $nik . '.pdf';

        $qrname = 'images/qrcode/' . date('m-y-d') . $nomor . $nik . '.svg';

        QrCode::generate($host . Storage::url($pdfName), public_path($qrname));

        $surat = Surat::create([
            'uuid'           => Str::uuid(),
            'nik'            => $nik,
            'id_nomor_surat' => $no_surat->id,
            'id_jenis_surat' => $id_jenis_surat,
            'id_kadus'       => $id_kelian_banjar,
            'id_perbekel'    => $id_perbekel,
            'keperluan'      => $request->keperluan,
            'deskripsi'      => $deskripsi,
            'pendukung'      => $pendukung,
            'barcode'        => $qrname,
            'pdf'            => $pdfName
        ]);

        if ($surat) {
            $mailData = [
                'title' => 'Surat dari ' . $penduduk->nama_lengkap,
                'body' => 'Terdapat Surat keperluan untuk' . $request->keperluan
            ];

            Mail::to('wahyupurnamadev@gmail.com')->send(new SuratMail($mailData));
        }

        return redirect()->route('surat.list')->with('success', 'Berhasil Membuat Surat');
    }

    public function list()
    {
        if (in_array(Auth::user()->id_jabatan, [1, 3, 4])) {
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
            if (Auth()->user()->id_jabatan === 4) {
                $kadus = Kadus::select('id')->where('id_pengguna', Auth()->user()->id)->first();

                $data = Surat::select('*')
                    ->with(['penduduk', 'no_surat', 'jenis_surat', 'kadus'])
                    ->where('id_kadus', $kadus->id)
                    ->orderBy('created_at', 'desc')
                    ->get()
                    ->map(function ($d) {
                        $d->dusun = Str::title($d->penduduk->keluarga->dusun);
                        return $d;
                    });
            } else {
                $data = Surat::select('*')
                    ->with(['penduduk', 'no_surat', 'jenis_surat', 'kadus'])
                    ->orderBy('created_at', 'desc')
                    ->get()
                    ->map(function ($d) {
                        $d->dusun = Str::title($d->penduduk->keluarga->dusun);
                        return $d;
                    });
            }
            return DataTables::of($data)
                ->addColumn('verifikasi_kadus', function ($row) {
                    if ($row->verifikasi_kadus === 0) {
                        return '<span class="badge badge-danger">
                        Di Tolak
                        </span>';
                    } elseif ($row->verifikasi_kadus > 0 && $row->verifikasi_kadus !== null) {
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
                    if ($row->verifikasi_kadus !== null && $row->verifikasi_perbekel !== null)
                        return '<a href="' .
                            Storage::url($row->pdf) .
                            '" target="_blank" class="btn edit btn btn-primary btn-sm update mb-2">
                            PDF
                        </a>';
                })
                ->addColumn('verifikasi_perbekel', function ($row) {
                    if ($row->verifikasi_perbekel === 0) {
                        return '<span class="badge badge-danger">
                        Di Tolak
                        </span>';
                    } elseif ($row->verifikasi_perbekel > 0 && $row->verifikasi_perbekel !== null) {
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

                    // untuk staf,sekre,perbekel
                    if (in_array(Auth()->user()->id_jabatan, [1, 3, 5, 6])) {
                        if ($row->verifikasi_perbekel !== 0 && $row->verifikasi_perbekel === null) {
                            $btn =
                                $btn .
                                '<a href="' .
                                route('surat.verif', [$row->uuid, 'staf']) .
                                '" class="btn edit btn btn-primary btn-sm update mb-2 mx-1">
                                        Verifikasi Perbekel/staf
                                    </a>';
                        }
                    }

                    // untuk kelian banjar
                    if (in_array(Auth()->user()->id_jabatan, [4])) {
                        if ($row->id_jenis_surat !== 1)
                            if ($row->verifikasi_kadus !== 0 && $row->verifikasi_kadus === null) {
                                $btn =
                                    $btn .
                                    '<a href="' .
                                    route('surat.verif', [$row->uuid, 'kadus']) .
                                    '" class="btn edit btn btn-primary btn-sm update mb-2 mx-1">
                                    Verifikasi Kadus
                                </a>';
                            }
                    }

                    if ($row->verifikasi_perbekel !== 0  && $row->verifikasi_kadus !== 0) {
                        $btn =
                            $btn .
                            '<a href="' .
                            route('surat.verif', [$row->uuid, 'tolak']) .
                            '" class="btn edit btn btn-danger btn-sm update mb-2 mx-1">
                            Tolak
                        </a>';
                    } elseif ($row->verifikasi_perbekel === 1 || $row->verifikasi_kadus === 1) {
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
                ->rawColumns(['action', 'verifikasi_kadus', 'verifikasi_perbekel', 'preview'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('pages.surat.admin.adminList');
    }

    public function verif($id, $aktor)
    {
        $surat = Surat::where('uuid', $id)->first();
        if ($aktor === 'kadus') {
            $surat->verifikasi_kadus = Auth::user()->id;
        } elseif ($aktor === 'staf') {
            $surat->verifikasi_perbekel = Auth::user()->id;
            if ($surat->id_jenis_surat === 1) {
                $surat->verifikasi_kadus = Auth::user()->id;
            }
        } else {
            $surat->verifikasi_perbekel = '0';
            $surat->verifikasi_kadus = '0';
        }
        $cek = $surat->save();
        if (($surat->verifikasi_perbekel !== null && $surat->verifikasi_perbekel !== '0') && ($surat->verifikasi_kadus !== null && $surat->verifikasi_kadus !== '0')) {
            $id_jenis_surat = $surat->id_jenis_surat;
            $penduduk       = Penduduk::where('nik', $surat->nik)->first();
            $no_surat       = NomorSurat::where('id', $surat->id_nomor_surat)->first();
            $nik            = $surat->nik;
            $host           = request()->getHttpHost();
            if ($id_jenis_surat === 1) {
                // get jabatan perbekel
                $jb_perbekel      = Jabatan::select('*')->where('nama', '=', 'perbekel desa')->first();
                $perbekel         = Kadus::with('jabatan')->where('id_jabatan', $jb_perbekel->id)->first();
                if (!$perbekel) {
                    return redirect()->route('surat.index')->with('error', 'Perbekel Tidak Tersedia Pada Wilayah ' . $penduduk->keluarga->dusun . ' Hubungi Kantor Desa');
                }
                $id_perbekel      = $perbekel->id;
                $id_kelian_banjar = null;
            } elseif ($id_jenis_surat === 2 || $id_jenis_surat === 4 || $id_jenis_surat === 3 || $id_jenis_surat === 5) {
                // get jabatan perbekel
                $jb_perbekel = Jabatan::select('*')->where('nama', '=', 'perbekel desa')->first();
                $perbekel    = Kadus::with('jabatan')->where('id_jabatan', $jb_perbekel->id)->first();
                if (!$perbekel) {
                    return redirect()->route('surat.index')->with('error', 'Perbekel Tidak Tersedia Pada Wilayah ' . $penduduk->keluarga->dusun . ' Hubungi Kantor Desa');
                }

                $id_perbekel = $perbekel->id;

                // get jabatan kelian dinas
                $jb_kb            = Jabatan::select('*')->where('nama', '=', 'kelian banjar dinas')->first();

                $exDusun = explode('Br. Dinas ', $penduduk->keluarga->dusun);
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
                dd('hubungi developers dan berikan alur errornya');
            }

            $pdfName = $surat->pdf;
            if ($id_jenis_surat === 1) {
                $pdf = PDF::loadview('pages.surat.sku', compact('penduduk', 'perbekel', 'no_surat', 'nik', 'surat', 'host'));
                $pdf->setPaper(array(0, 0, 609.4488, 935.433), 'portrait');
                // return $pdf->stream('dompdf_out.pdf');
                Storage::put($pdfName, $pdf->output());
            } else if ($id_jenis_surat === 2) {
                $pdf = PDF::loadview('pages.surat.skm', compact('penduduk', 'perbekel', 'kelian_banjar', 'no_surat', 'nik', 'surat', 'host'));
                // return $pdf->stream('dompdf_out.pdf');
                Storage::put($pdfName, $pdf->output());
            } else if ($id_jenis_surat === 4) {
                $pdf = PDF::loadview('pages.surat.sktm', compact('penduduk', 'perbekel', 'kelian_banjar', 'no_surat', 'nik', 'surat', 'host'));
                // return $pdf->stream('dompdf_out.pdf');
                Storage::put($pdfName, $pdf->output());
            } else if ($id_jenis_surat === 3) {
                $pdf = PDF::loadview('pages.surat.skd', compact('penduduk', 'perbekel', 'kelian_banjar', 'no_surat', 'nik', 'surat', 'host'));
                // return $pdf->stream('dompdf_out.pdf');
                Storage::put($pdfName, $pdf->output());
            } else if ($id_jenis_surat === 5) {
                $pdf = PDF::loadview('pages.surat.skk', compact('penduduk', 'perbekel', 'kelian_banjar', 'no_surat', 'nik', 'surat', 'host'));
                // return $pdf->stream('dompdf_out.pdf');
                Storage::put($pdfName, $pdf->output());
            }



            return redirect()->back()->with('success', 'Surat Berhasil Di Buat');
        } else {
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
    }

    public function suratAdmin()
    {
        return view('pages.surat.admin.adminCreate');
    }

    public function storeSuratAdmin(Request $request, $slug)
    {
        $jenis_surat    = JenisSurat::where('slug', $slug)->first();
        $id_jenis_surat = $jenis_surat->id;
        $pendukung      = '';
        $host           = request()->getHttpHost();
        $nik            = $request->nik_pembuat;

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
        } elseif ($id_jenis_surat === 2 || $id_jenis_surat === 4 || $id_jenis_surat === 3) {
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

            $exDusun = explode('Br. Dinas ', $penduduk->keluarga->dusun);
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
            $pendukung = $request->judul;
            $deskripsi = $request->deskripsi;
            $jb_perbekel = Jabatan::select('*')->where('nama', '=', 'perbekel desa')->first();
            $perbekel    = Kadus::with('jabatan')->where('id_jabatan', $jb_perbekel->id)->first();
            if (!$perbekel) {
                return redirect()->route('surat.index')->with('error', 'Perbekel Tidak Tersedia Pada Wilayah ' . $penduduk->keluarga->dusun . ' Hubungi Kantor Desa');
            }

            $id_perbekel = $perbekel->id;

            // get jabatan kelian dinas
            $jb_kb            = Jabatan::select('*')->where('nama', '=', 'kelian banjar dinas')->first();

            $exDusun = explode('Br. Dinas ', $penduduk->keluarga->dusun);
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

        $pdfName = 'public/pdf/' . rand(0, 99) . $nomor . $nik . '.pdf';

        $qrname = 'images/qrcode/' . date('m-y-d') . $nomor . $nik . '.svg';

        QrCode::generate($host . Storage::url($pdfName), public_path($qrname));

        $surat = Surat::create([
            'uuid'           => Str::uuid(),
            'nik'            => $nik,
            'id_nomor_surat' => $no_surat->id,
            'id_jenis_surat' => $id_jenis_surat,
            'id_kadus'       => $id_kelian_banjar,
            'id_perbekel'    => $id_perbekel,
            'keperluan'      => $request->keperluan,
            'deskripsi'      => $deskripsi,
            'pendukung'      => $pendukung,
            'barcode'        => $qrname,
            'pdf'            => $pdfName
        ]);

        if ($surat) {
            $mailData = [
                'title' => 'Surat dari ' . $penduduk->nama_lengkap,
                'body' => 'Terdapat Surat keperluan untuk ' . $request->keperluan
            ];

            Mail::to('wahyupurnamadev@gmail.com')->send(new SuratMail($mailData));
        }

        return redirect()->route('admin.suratAdmin')->with('success', 'Berhasil Membuat Surat');
    }
}
