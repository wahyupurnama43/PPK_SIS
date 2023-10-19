<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Ramsey\Uuid\Uuid;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/register';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username'     => ['required', 'string', 'max:255'],
            'no_hp'        => ['required', 'string', 'max:255'],
            'password'     => ['nullable', 'string', 'max:255', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        try {
            //code...

            $pengguna = User::create([
                'uuid'       => Uuid::uuid4(),
                'username'   => $data['username'],
                'no_hp'      => $data['no_hp'],
                'id_jabatan' => 2,
                'password'   => '',
                'status'     => 0
            ]);

            if ($pengguna) {
                return Redirect::route('login')->with('success', 'Registrasi berhasil! Silakan menunggu verifikasi dari Admin');
            } else {
                return Redirect::back()->with('error', 'Terjadi kesalahan saat melakukan registrasi. Mohon coba lagi.');
            }
        } catch (\Throwable $th) {
            return Redirect::back()->with('error', 'Mohon Maaf NIK Anda sudah terdaftar');
        }
    }
}
