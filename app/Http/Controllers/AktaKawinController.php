<?php

namespace App\Http\Controllers;

use App\Models\Wilayah;
use App\Models\AktaKawin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AktaKawinRequest;

class AktaKawinController extends Controller
{
    /**
     * 
     * Display a listing of the resource.
     */
    public function index()
    {

        if (request()->ajax()) {
            return DataTables::of(AktaKawin::select('*'))
                ->addColumn('action', function ($row) {
                    $btn =
                        '<button type="button" class="btn edit btn btn-primary btn-sm update" data-url="' .
                        route('akta-kawin.show', $row->uuid) .
                        '" data-send="' .
                        route('akta-kawin.update', $row->uuid) .
                        '" data-toggle="modal" data-target="#editWilayah">
                    Edit
                </button>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-url="' .
                        route('akta-kawin.destroy', $row->uuid) .
                        '"  data-id="' . $row->uuid .
                        '" class="btn btn-danger btn-sm deletePost">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }


        return view('pages.aktaKawin.aktaKawin');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AktaKawinRequest $request)
    {
        $aktaKawin   = $request->aktaKawin;
        try {

            $return = AktaKawin::create([
                'uuid'          => Str::uuid(),
                'id_pengguna'   => Auth::id(),
                'no_akta_kawin' => $aktaKawin
            ]);

            if ($return) {
                return redirect()->route('akta-kawin.index')->with('success', 'Berhasil Ditambahkan');
            } else {
                return redirect()->route('akta-kawin.index')->with('error', 'Mohon Hubungi Admin');
            }
        } catch (\Throwable $e) {
            return redirect()->route('akta-kawin.index')->with('error', $e->errorInfo[2]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $aktaKawin = AktaKawin::where('uuid', $id)->first();
        return response()->json($aktaKawin);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $aktaKawin                = AktaKawin::where('uuid', $id)->first();
            $aktaKawin->no_akta_kawin = $request->aktaKawin;
            $aktaKawin->save();

            return redirect()->route('akta-kawin.index')->with('success', 'Berhasil Diupdate');
        } catch (\Throwable $e) {
            return redirect()->route('akta-kawin.index')->with('error', $e->errorInfo[2]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $wilayah = AktaKawin::where('uuid', $id)->delete();
            return response()->json([
                'success' => true
            ]);
        } catch (\Throwable $e) {
            return redirect()->route('akta-kawin.index')->with('error', $e->errorInfo[2]);
        }
    }
}
