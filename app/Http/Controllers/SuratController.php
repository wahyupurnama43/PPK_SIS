<?php

namespace App\Http\Controllers;

use App\Models\Kadus;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Elibyy\TCPDF\Facades\TCPDF;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SuratController extends Controller
{

    public function index()
    {
        return view('pages.surat.surat');
    }

    public function surat()
    {
        // $data = Kadus::all();
        // QrCode::generate('Welcome to Makitweb', public_path('images/qrcode.svg'));
        // $pdf = PDF::loadview('pages.surat.sku', ['data' => $data]);
        // Storage::put('public/pdf/name.pdf', $pdf->output());
        // return $pdf->stream();

        return view('pages.surat.sku');
    }
}
