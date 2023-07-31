<?php

namespace App\Http\Controllers;

use App\Models\wilayah;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreWilayahRequest;

class WilayahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if (request()->ajax()) {
            return DataTables::of(Wilayah::select('*'))
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editPost">Edit</a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deletePost">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('pages.wilayah.wilayah');
    }

    public function getWilayah()
    {
        $wilayah = Wilayah::all();
        return response()->json($wilayah);
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
    public function store(StoreWilayahRequest $request)
    {
        $nama   = $request->nama;
        $alamat = $request->alamat;
        $lat    = $request->lat;
        $long   = $request->long;
        $info   = $request->info;
        $name   = $request->file('img')->getClientOriginalName();
        $path   = $request->file('img')->store('public/upload/wilayah');

        try {
            $wilayah = Wilayah::create([
                'uuid'        => Str::uuid(),
                'id_pengguna' => Auth::id(),
                'nama'        => $nama,
                'info'        => $info,
                'alamat'      => $alamat,
                'lat'         => $lat,
                'long'        => $long,
                'img'         => $name
            ]);
            if ($wilayah) {
                return redirect()->route('wilayah.index');
            } else {
                dd('error');
            }
        } catch (\Throwable $e) {
            dd($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(wilayah $wilayah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(wilayah $wilayah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, wilayah $wilayah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(wilayah $wilayah)
    {
        //
    }
}
