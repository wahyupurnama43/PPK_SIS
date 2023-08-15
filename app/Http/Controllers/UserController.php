<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $data = User::select('*')->with('jabatan')->get();
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $btn =
                        '<button type="button" class="btn edit btn btn-primary btn-sm update" data-url="' .
                        route('pengguna.show', $row->uuid) .
                        '" data-send="' .
                        route('pengguna.update', $row->uuid) .
                        '" data-toggle="modal" data-target="#editWilayah">
                    Edit
                </button>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-url="' .
                        route('pengguna.destroy', $row->uuid) .
                        '"  data-id="' . $row->uuid .
                        '" class="btn btn-danger btn-sm deletePost">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
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
        $jabatan_input = Jabatan::select('id')->where('uuid', $request->id_jabatan)->first();
        $jabatan       = $jabatan_input->id;
        $username      = Str::title($request->username);
        $password      = $request->password;

        try {
            $pengguna = User::create([
                'uuid'                 => Str::uuid(),
                'id_jabatan'           => $jabatan,
                'username'             => $username,
                'password'             => Hash::make($password),
            ]);
            if ($pengguna) {
                return redirect()->route('pengguna.index')->with('success', 'Berhasil Ditambahkan');
            } else {
                return redirect()->route('pengguna.index')->with('error', 'Mohon Hubungi Admin');
            }
        } catch (\Throwable $e) {
            return redirect()->route('pengguna.index')->with('error', $e->errorInfo[2]);;
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
    public function update(UserRequest $request, string $id)
    {
        $jb        = Jabatan::where('uuid', $request->jabatan)->first();
        $username  = $request->username;
        $jabatan   = $jb->id;
        $password  = Hash::make($request->password);

        try {
            $pengguna             = User::where('uuid', $id)->first();
            $pengguna->username   = $username;
            $pengguna->id_jabatan = $jabatan;
            $pengguna->password   = $password;
            $pengguna->save();
            dd($pengguna);

            return redirect()->route('penggguna.index')->with('success', 'Berhasil Diupdate');
        } catch (\Throwable $e) {
            dd($e);
            return redirect()->route('penggguna.index')->with('error', $e->errorInfo[2]);
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
