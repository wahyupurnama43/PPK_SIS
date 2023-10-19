<?php

namespace App\Http\Controllers;

use App\Mail\SuratMail;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index()
    {
        $mailData = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp.'
        ];

        Mail::to('wahyupurnamadev@gmail.com')->send(new SuratMail($mailData));

        dd("Email is sent successfully.");
    }
}
