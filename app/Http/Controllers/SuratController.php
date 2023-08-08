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
                    } else if ($row->verifikasi_staf === 1) {
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
                    return '<a href="' . Storage::url($row->pdf) . '" target="_blank" class="btn edit btn btn-primary btn-sm update mb-2">
                            PDF
                        </a>';
                })
                ->addColumn('verifikasi_kadus', function ($row) {
                    if ($row->verifikasi_kadus === 0) {
                        return '<span class="badge badge-danger">
                        Di Tolak
                        </span>';
                    } else if ($row->verifikasi_kadus === 1) {
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
                        $btn = $btn .
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
                    if (($row->verifikasi_staf !== 0 && $row->verifikasi_staf !== 1) && ($row->verifikasi_kadus !== 0  && $row->verifikasi_kadus !== 1)) {
                        $btn =
                            $btn . '<a href="' .
                            route('surat.verif', [$row->uuid, 'tolak']) .
                            '" class="btn edit btn btn-danger btn-sm update mb-2 mx-1">
                            Tolak
                        </a>';
                    } else if ($row->verifikasi_kadus === 1 || $row->verifikasi_staf === 1) {
                        $btn =
                            $btn . '<a href="' .
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
        return view('pages.surat.Adminlist');
    }

    public function surat(Request $request, $slug)
    {
        $jenis_surat    = JenisSurat::where('slug', $slug)->first();
        $id_jenis_surat = $jenis_surat->id;
        $pendukung      = '';
        $host           = request()->getHttpHost();
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
        $count     = $cek_nomor + 1;
        $nomor     = str_pad($count, 2, '0', STR_PAD_LEFT);
        $array_bln = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        $bulan     = $array_bln[date('n')];

        $nik = '1807245108910003';
        // get data penduduk

        $penduduk = Penduduk::where('nik', $nik)->first();
        $kadus    = Kadus::where('dusun', 'like', '%' . $penduduk->keluarga->dusun . '%')
            ->where('desa', 'like', '%' . $penduduk->keluarga->desa . '%')
            ->first();

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
            'id_kadus'       => $kadus->id,
            'keperluan'      => $request->keperluan,
            'deskripsi'      => $deskripsi,
            'pendukung'      => $pendukung,
            'barcode'        => $qrname,
            'pdf'            => $pdfName,
        ]);

        $pdf = PDF::loadview('pages.surat.sku', compact('penduduk', 'kadus', 'no_surat', 'nik', 'surat', 'host'));
        Storage::put($pdfName, $pdf->output());
        // return view('pages.surat.sku');
        return redirect()->route('surat.list')->with('success', 'Berhasil Membuat Surat');
    }

    public function list()
    {
        $nik   = '1807245108910003';
        $surat = Surat::where('nik', $nik)->get();
        return view('pages.surat.list', compact('surat'));
    }

    public function verif($id, $aktor)
    {
        $surat = Surat::where("uuid", $id)->first();

        if ($aktor === 'kadus') {
            $surat->verifikasi_kadus = '1';
        } else if ($aktor === 'staf') {
            $surat->verifikasi_staf = '1';
        } else {
            $surat->verifikasi_staf  = '0';
            $surat->verifikasi_kadus = '0';
        }

        $cek = $surat->save();
        if ($cek) {
            return redirect()->route('surat.Adminlist')->with('success', 'Berhasil Verifikasi');
        } else {
            return redirect()->route('surat.Adminlist')->with('error', 'Mohon Hubungi Admin');
        }
    }

    // public function preview($slug)
    // {
    //     $keperluan      = 'asdas';
    //     $jenis_surat    = JenisSurat::where('slug', $slug)->first();
    //     $id_jenis_surat = $jenis_surat->id;
    //     $pendukung      = '';
    //     $host           = request()->getHttpHost();
    //     // note
    //     // sku = 1
    //     // skm = 2
    //     // skd = 3
    //     // sktm = 4
    //     // sk =5
    //     if ($id_jenis_surat === 1) {
    //         $deskripsi = "Sesuai dengan pernyataan orang tersebut diatas bahwa memang benar yang bersangkutan mempunyai usaha  yang berlokasi di wilayah keja kami di dan masih memerlukan Bantuan Modal dengan agunan sebagai berikut :";
    //     } else {
    //         dd('tidak');
    //     }
    //     $tahun     = date('Y');
    //     $cek_nomor = NomorSurat::where('id_jenis_surat', $id_jenis_surat)->where('tahun', $tahun)->count();
    //     $count     = ($cek_nomor + 1);
    //     $nomor     = str_pad($count, 2, "0", STR_PAD_LEFT);
    //     $array_bln = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
    //     $bulan     = $array_bln[date('n')];
    //     $no_surat = '';
    //     $surat = 'preview';

    //     $nik = '1807245108910003';
    //     // get data penduduk
    //     $penduduk = Penduduk::where('nik', $nik)->first();
    //     $kadus    = Kadus::where('dusun', 'like',  '%' . $penduduk->keluarga->dusun . '%')->where('desa', 'like',  '%' . $penduduk->keluarga->desa . '%')->first();

    //     $pdf = PDF::loadview('pages.surat.sku', compact('penduduk', 'kadus', 'no_surat', 'nik', 'surat', 'host'));
    //     return $pdf->stream('tes.pdf');
    //     exit();
    // }
}
