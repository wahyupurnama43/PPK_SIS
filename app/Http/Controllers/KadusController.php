<?php

namespace App\Http\Controllers;

use App\Models\Kadus;
use App\Models\Keluarga;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\KadusRequest;
use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class KadusController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = Kadus::select('*')->with('jabatan')->get();
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $btn =
                        '<button type="button" class="btn edit btn btn-primary btn-sm update" data-url="' .
                        route('kadus.show', $row->uuid) .
                        '" data-send="' .
                        route('kadus.update', $row->uuid) .
                        '" data-toggle="modal" data-target="#editWilayah">
                    Edit
                </button>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-url="' .
                        route('kadus.destroy', $row->uuid) .
                        '"  data-id="' . $row->uuid .
                        '" class="btn btn-danger btn-sm deletePost">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        $jabatan = Jabatan::where('nama', '!=', 'admin')->where('nama', '!=', 'Admin')->get();
        return view('pages.kadus.kadus', compact('jabatan'));
    }

    public function store(KadusRequest $request)
    {
        $jb        = Jabatan::where('uuid', $request->jabatan)->first();
        $kadus     = $request->kadus;
        $jabatan   = $jb->id;
        // $jabatan   = $request->jabatan;
        $dusun     = strtolower($request->dusun);
        $desa      = strtolower($request->desa);
        $kecamatan = strtolower($request->kecamatan);

        try {

            $kadus = Kadus::create([
                'uuid'        => Str::uuid(),
                'id_pengguna' => Auth::id(),
                'nama'        => $kadus,
                'dusun'       => $dusun,
                'desa'        => $desa,
                'id_jabatan'  => $jabatan,
                'kecamatan'   => $kecamatan,
            ]);

            if ($kadus) {
                return redirect()->route('kadus.index')->with('success', 'Berhasil Ditambahkan');
            } else {
                return redirect()->route('kadus.index')->with('error', 'Mohon Hubungi Admin');
            }
        } catch (\Throwable $e) {
            return redirect()->route('kadus.index')->with('error', $e->errorInfo[2]);;
        }
    }

    public function show($id)
    {
        $kadus = Kadus::where('uuid', $id)->with('jabatan')->first();
        return response()->json($kadus);
    }

    public function update(KadusRequest $request, $id)
    {
        $jb        = Jabatan::where('uuid', $request->jabatan)->first();
        $nama      = $request->kadus;
        $jabatan   = $jb->id;
        $dusun     = strtolower($request->dusun);
        $desa      = strtolower($request->desa);
        $kecamatan = strtolower($request->kecamatan);

        try {
            $kadus             = Kadus::where('uuid', $id)->first();
            $kadus->nama       = $nama;
            $kadus->dusun      = $dusun;
            $kadus->desa       = $desa;
            $kadus->id_jabatan = $jabatan;
            $kadus->kecamatan  = $kecamatan;
            $kadus->save();

            return redirect()->route('kadus.index')->with('success', 'Berhasil Diupdate');
        } catch (\Throwable $e) {
            dd($e);
            return redirect()->route('kadus.index')->with('error', $e->errorInfo[2]);
        }
    }

    public function destroy($id)
    {
        try {
            Kadus::where('uuid', $id)->delete();
            return response()->json([
                'success' => true
            ]);
        } catch (\Throwable $e) {
            return redirect()->route('kadus.index')->with('error', $e->errorInfo[2]);
        }
    }
}
