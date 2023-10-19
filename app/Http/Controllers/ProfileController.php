<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Penduduk;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $pekerjaan  = Pekerjaan::all();
        $penduduk   = Penduduk::where('nik', Auth::user()->username)->first();
        $pendidikan = DB::table('penduduk')
            ->select(DB::raw('DISTINCT(pendidikan) as pendidikan'))
            ->get();
        return view('pages.profile.profile', compact('pekerjaan', 'penduduk', 'pendidikan'));
    }

    public function update(Request $request)
    {

        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required|min:5',
        ]);

        $user =  User::where('username', $request->username)->first();
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back()->with('success', 'Berhasil Update Password : ' . $request->password);
    }
}
