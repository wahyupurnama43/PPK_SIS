<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

        if (!in_array(Auth()->user()->id_jabatan, [1, 3, 4, 5, 6])) {
            $penduduk = Penduduk::where('nik', Auth::user()->username)->first();
        } else {
            $penduduk = true;
        }
        if ($penduduk)
            return view('dashboard.index');
        else
            return redirect()->route('home.index');
    }
}
