<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Svg\Tag\Rect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*')->with('jabatan')->orderBy('id_jabatan', 'asc')->get();
            return DataTables::of($data)
                ->addColumn('status', function ($row) {
                    if ($row->status === 2) {
                        return '<span class="badge badge-danger">
                        Di Tolak
                        </span>';
                    } elseif ($row->status === 1) {
                        return '<span class="badge badge-success">
                        Verifikasi Berhasil
                        </span>';
                    } else {
                        return '<span class="badge badge-warning">
                        Pending
                        </span>';
                    }
                })
                ->addColumn('phone', function ($row) {
                    return '<a target="_blank" href="https://api.whatsapp.com/send?phone=' . $row->no_hp . '" class="">' . $row->no_hp . '</a>';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<button type="button" class="btn edit btn btn-primary btn-sm update" data-url="' .
                        route('pengguna.show', $row->uuid) .
                        '" data-send="' .
                        route('pengguna.update', $row->uuid) .
                        '" data-toggle="modal" data-target="#editWilayah">
                    Edit
                    </button>';

                    $btn .= ' <a href="javascript:void(0)" data-url="' .
                        route('pengguna.destroy', $row->uuid) .
                        '"  data-id="' . $row->uuid .
                        '" class="btn btn-danger btn-sm deletePost">Delete</a>';

                    if ($row->status === 0) {
                        $btn .= ' <button type="button" class="btn btn-success btn-sm verif" style="display: none; data-url="' . $row->uuid . '">Verifikasi</button>';
                    }

                    return $btn;
                })
                ->rawColumns(['status', 'action', 'phone'])
                ->addIndexColumn()
                ->make(true);
        }

        $jabatan = Jabatan::all();
        return view('pages.pengguna.pengguna', compact('jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $jabatan_input = Jabatan::select('id')->where('uuid', $request->jabatan)->first();
        $jabatan       = $jabatan_input->id;
        $username      = Str::title($request->username);
        $no_hp         = $request->no_hp;
        $password      = $request->password;
        $status        = $request->status;

        $passwordHash = $password ? Hash::make($password) : null;

        try {
            $pengguna = User::create([
                'uuid'       => Str::uuid(),
                'id_jabatan' => $jabatan,
                'username'   => $username,
                'no_hp'      => $no_hp,
                'password'   => $passwordHash,
                'status'     => $status,
            ]);

            if ($pengguna) {
                Auth::login($pengguna);
                return Redirect::route('login')->with('success', 'Registrasi berhasil! Silakan menunggu verifikasi dari Admin');
            } else {
                return Redirect::back()->with('error', 'Terjadi kesalahan saat melakukan registrasi. Mohon coba lagi.');
            }
        } catch (\Throwable $e) {
            return redirect()->route('pengguna.index')->with('error', $e->errorInfo[2]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pengguna = User::where('uuid', $id)->with('jabatan')->first();
        return response()->json($pengguna);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pengguna = User::where('uuid', $id)->first();
        $validated = $request->validate([
            "username" => "required",
            "jabatan"  => "required",
            "no_hp"    => "required",
            "status"   => "required",
        ]);

        if ($request->password !== null) {

            $validated = $request->validate([
                "password"  => "required|min:5",
            ]);

            $password  = Hash::make($request->password);
        } else {
            $password =  $pengguna->password;
        }

        $jb        = Jabatan::where('uuid', $request->jabatan)->first();
        $jabatan   = $jb->id;
        $no_hp     = $request->no_hp;
        $username  = $request->username;
        $status    = $request->status;

        try {
            $pengguna->username   = $username;
            $pengguna->id_jabatan = $jabatan;
            $pengguna->no_hp      = $no_hp;
            $pengguna->password   = $password;
            $pengguna->status     = $status;
            $pengguna->save();

            return redirect()->route('pengguna.index')->with('success', 'Berhasil Diupdate');
        } catch (\Throwable $e) {
            return redirect()->route('pengguna.index')->with('error', $e->errorInfo[2]);
        }
    }

    public function verif(Request $request, $uuid)
    {

        $pengguna = User::where('uuid', $uuid)->first();
        $pengguna->status = 1;

        $cek = $pengguna->save();
        if ($cek) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            User::where('uuid', $id)->delete();
            return response()->json([
                'success' => true
            ]);
        } catch (\Throwable $e) {
            return redirect()->route('pengguna.index')->with('error', $e->errorInfo[2]);;
        }
    }
}
