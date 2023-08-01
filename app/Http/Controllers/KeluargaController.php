<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\KeluargaRequest;

class KeluargaController extends Controller
{
    public function index()
    {

        if (request()->ajax()) {
            return DataTables::of(Keluarga::select('nama_kepala_keluarga', DB::raw('CONCAT(alamat, ", ", dusun, ", ", desa, ", ", kecamatan) as fullAlamat'), 'uuid', 'no_kk'))
                ->addColumn('action', function ($row) {
                    $btn =
                        '<button type="button" class="btn edit btn btn-primary btn-sm update" data-url="' .
                        route('keluarga.show', $row->uuid) .
                        '" data-send="' .
                        route('keluarga.update', $row->uuid) .
                        '" data-toggle="modal" data-target="#editWilayah">
                    Edit
                </button>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-url="' .
                        route('keluarga.destroy', $row->uuid) .
                        '"  data-id="' . $row->uuid .
                        '" class="btn btn-danger btn-sm deletePost">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('pages.kepalaKeluarga.kepalaKeluarga');
    }

    public function store(KeluargaRequest $request)
    {
        $kk                   = $request->kk;
        $nama_kepala_keluarga = Str::title($request->nama_kepala_keluarga);
        $alamat               = Str::title($request->alamat);
        $dusun                = Str::title($request->dusun);
        $desa                 = Str::title($request->desa);
        $kecamatan            = Str::title($request->kecamatan);

        try {
            $keluarga = Keluarga::create([
                'uuid'                 => Str::uuid(),
                'id_pengguna'          => Auth::id(),
                'no_kk'                => $kk,
                'nama_kepala_keluarga' => strtolower($nama_kepala_keluarga),
                'dusun'                => $dusun,
                'desa'                 => $desa,
                'kecamatan'            => $kecamatan,
                'alamat'               => $alamat,
            ]);
            if ($keluarga) {
                return redirect()->route('keluarga.index')->with('success', 'Berhasil Ditambahkan');
            } else {
                return redirect()->route('keluarga.index')->with('error', 'Mohon Hubungi Admin');
            }
        } catch (\Throwable $e) {
            return redirect()->route('keluarga.index')->with('error', $e->errorInfo[2]);;
        }
    }

    public function show($id)
    {
        $keluarga = Keluarga::where('uuid', $id)->first();
        return response()->json($keluarga);
    }

    public function update(KeluargaRequest $request, $id)
    {
        try {
            $keluarga                       = Keluarga::where('uuid', $id)->first();
            $keluarga->no_kk                = $request->kk;
            $keluarga->nama_kepala_keluarga = Str::title($request->nama_kepala_keluarga);
            $keluarga->alamat               = Str::title($request->alamat);
            $keluarga->dusun                = Str::title($request->dusun);
            $keluarga->desa                 = Str::title($request->desa);
            $keluarga->kecamatan            = Str::title($request->kecamatan);
            $keluarga->save();

            return redirect()->route('keluarga.index')->with('success', 'Berhasil Diupdate');
        } catch (\Throwable $e) {
            return redirect()->route('keluarga.index')->with('error', $e->errorInfo[2]);;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            Keluarga::where('uuid', $id)->delete();
            return response()->json([
                'success' => true
            ]);
        } catch (\Throwable $e) {
            return redirect()->route('keluarga.index')->with('error', $e->errorInfo[2]);;
        }
    }
}
