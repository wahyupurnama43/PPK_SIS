<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kadus;
use App\Models\Surat;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function __construct()
    {

        // check apakah terdapat nik pada penduduk?
        // $penduduk = Penduduk::where('nik', Auth::user()->username)->first();
        // dd(Auth::user());
    }

    public function index(Request $request)
    {

        // if (!in_array(Auth()->user()->id_jabatan, [1, 3, 4, 5, 6])) {
        //     $penduduk = Penduduk::where('nik', Auth::user()->username)->first();
        // } else {
        //     $penduduk = true;
        // }
        // if ($penduduk)
        //     return view('dashboard.index', [
        //         'permintaan_surat' => Surat::count(),
        //         'jumlah_penduduk' => Penduduk::count(),
        //         'surat_terverifikasi' => Surat::where('verifikasi_kadus', 1)
        //             ->where('verifikasi_perbekel', 1)
        //             ->count(),
        //         'jumlah_data_pegawai' => Kadus::count(),
        //     ]);
        // else
        //     return redirect()->route('home.index');

        if (!in_array(Auth()->user()->id_jabatan, [1, 3, 4, 5, 6])) {
            $nik = Auth::user()->username; // NIK dari pengguna yang sedang login
            $permintaan_surat = Surat::where('nik', $nik)->count();
            $surat_terverifikasi = Surat::where('nik', $nik)
                ->where('verifikasi_kadus', 1)
                ->where('verifikasi_perbekel', 1)
                ->count();
        } else {
            $permintaan_surat = Surat::count();
            $surat_terverifikasi = Surat::where('verifikasi_kadus', 1)
                ->where('verifikasi_perbekel', 1)
                ->count();
        }

        $jumlah_penduduk = Penduduk::count();
        $jumlah_data_pegawai = Kadus::count();

        return view('dashboard.index', [
            'permintaan_surat' => $permintaan_surat,
            'jumlah_penduduk' => $jumlah_penduduk,
            'surat_terverifikasi' => $surat_terverifikasi,
            'jumlah_data_pegawai' => $jumlah_data_pegawai,
        ]);
    }
}
