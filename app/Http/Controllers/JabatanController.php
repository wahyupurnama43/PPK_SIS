<?php

namespace App\Http\Controllers;

use App\Models\Wilayah;
use App\Models\Jabatan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\JabatanRequest;

class JabatanController extends Controller
{
    /**
     * 
     * Display a listing of the resource.
     */
    public function index()
    {

        if (request()->ajax()) {
            return DataTables::of(Jabatan::select('*'))
                ->addColumn('action', function ($row) {
                    $btn =
                        '<button type="button" class="btn edit btn btn-primary btn-sm update" data-url="' .
                        route('jabatan.show', $row->uuid) .
                        '" data-send="' .
                        route('jabatan.update', $row->uuid) .
                        '" data-toggle="modal" data-target="#editWilayah">
                    Edit
                </button>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-url="' .
                        route('jabatan.destroy', $row->uuid) .
                        '"  data-id="' . $row->uuid .
                        '" class="btn btn-danger btn-sm deletePost">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }


        return view('pages.jabatan.jabatan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JabatanRequest $request)
    {
        $jabatan   = $request->jabatan;
        try {

            $return = Jabatan::create([
                'uuid'          => Str::uuid(),
                'id_pengguna'   => Auth::id(),
                'nama'          => Str::title($jabatan)
            ]);

            if ($return) {
                return redirect()->route('jabatan.index')->with('success', 'Berhasil Ditambahkan');
            } else {
                return redirect()->route('jabatan.index')->with('error', 'Mohon Hubungi Admin');
            }
        } catch (\Throwable $e) {
            return redirect()->route('jabatan.index')->with('error', $e->errorInfo[2]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $jabatan = Jabatan::where('uuid', $id)->first();
        return response()->json($jabatan);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $jabatan               = Jabatan::where('uuid', $id)->first();
            $jabatan->nama         = $request->jabatan;
            $jabatan->save();

            return redirect()->route('jabatan.index')->with('success', 'Berhasil Diupdate');
        } catch (\Throwable $e) {
            return redirect()->route('jabatan.index')->with('error', $e->errorInfo[2]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $jabatan = Jabatan::where('uuid', $id)->delete();
            return response()->json([
                'success' => true
            ]);
        } catch (\Throwable $e) {
            return redirect()->route('jabatan.index')->with('error', $e->errorInfo[2]);
        }
    }
}
