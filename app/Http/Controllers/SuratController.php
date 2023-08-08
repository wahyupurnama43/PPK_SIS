<?php

namespace App\Http\Controllers;

use App\Models\Kadus;
use App\Models\Surat;
use App\Models\JenisSurat;
use App\Models\NomorSurat;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Elibyy\TCPDF\Facades\TCPDF;
use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SuratController extends Controller
{

    public function index()
    {
        $prev = 0;
        return view('pages.surat.surat', compact('prev'));
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
            $deskripsi = "Sesuai dengan pernyataan orang tersebut diatas bahwa memang benar yang bersangkutan mempunyai usaha " . $request->nama_usaha . " yang berlokasi di wilayah keja kami di " . $request->lokasi_usaha . " dan masih memerlukan Bantuan Modal dengan agunan sebagai berikut :";
        } else {
            dd('tidak');
        }
        $tahun     = date('Y');
        $cek_nomor = NomorSurat::where('id_jenis_surat', $id_jenis_surat)->where('tahun', $tahun)->count();
        $count     = ($cek_nomor + 1);
        $nomor     = str_pad($count, 2, "0", STR_PAD_LEFT);
        $array_bln = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $bulan     = $array_bln[date('n')];

        $nik = '1807245108910003';
        // get data penduduk

        $penduduk = Penduduk::where('nik', $nik)->first();
        $kadus    = Kadus::where('dusun', 'like',  '%' . $penduduk->keluarga->dusun . '%')->where('desa', 'like',  '%' . $penduduk->keluarga->desa . '%')->first();

        // insert no surat
        $no_surat = NomorSurat::create([
            'uuid'           => Str::uuid(),
            'id_jenis_surat' => $id_jenis_surat,
            'kode'           => '145',
            'urutan'         => $nomor,
            'bulan'          => $bulan,
            'tahun'          => $tahun
        ]);
        $pdfName = 'public/pdf/' . date('m-y-d') . $nomor . $nik . '.pdf';

        $qrname = 'images/qrcode/' . date('m-y-d') . $nomor . $nik . '.svg';

        QrCode::generate($host . Storage::url($pdfName), public_path($qrname));

        $surat = Surat::create([
            'uuid'             => Str::uuid(),
            'nik'              => $nik,
            'id_nomor_surat'   => $no_surat->id,
            'id_jenis_surat'   => $id_jenis_surat,
            'id_kadus'         => $kadus->id,
            'keperluan'        => $request->keperluan,
            'deskripsi'        => $deskripsi,
            'pendukung'        => $pendukung,
            'barcode'          => $qrname,
        ]);

        $pdf = PDF::loadview('pages.surat.sku', compact('penduduk', 'kadus', 'no_surat', 'nik', 'surat', 'host'));
        Storage::put($pdfName, $pdf->output());
        return $pdf->download(date('m-y-d') . $nomor . $nik . '.pdf');

        // return view('pages.surat.sku');
    }

    public function preview($slug)
    {
        $keperluan      = 'asdas';
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
            $deskripsi = "Sesuai dengan pernyataan orang tersebut diatas bahwa memang benar yang bersangkutan mempunyai usaha  yang berlokasi di wilayah keja kami di dan masih memerlukan Bantuan Modal dengan agunan sebagai berikut :";
        } else {
            dd('tidak');
        }
        $tahun     = date('Y');
        $cek_nomor = NomorSurat::where('id_jenis_surat', $id_jenis_surat)->where('tahun', $tahun)->count();
        $count     = ($cek_nomor + 1);
        $nomor     = str_pad($count, 2, "0", STR_PAD_LEFT);
        $array_bln = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $bulan     = $array_bln[date('n')];
        $no_surat = '';
        $surat = 'preview';

        $nik = '1807245108910003';
        // get data penduduk
        $penduduk = Penduduk::where('nik', $nik)->first();
        $kadus    = Kadus::where('dusun', 'like',  '%' . $penduduk->keluarga->dusun . '%')->where('desa', 'like',  '%' . $penduduk->keluarga->desa . '%')->first();

        $pdf = PDF::loadview('pages.surat.sku', compact('penduduk', 'kadus', 'no_surat', 'nik', 'surat', 'host'));
        return $pdf->stream('tes.pdf');
        exit();
    }
}
