<?php

namespace App\Http\Controllers;

use App\Models\Wilayah;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreWilayahRequest;
use App\Http\Requests\UpdateWilayahRequest;
use Illuminate\Support\Facades\Storage;

class WilayahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            return DataTables::of(Wilayah::select('*'))
                ->addColumn('action', function ($row) {
                    $btn =
                        '<button type="button" class="btn edit btn btn-primary btn-sm update" data-url="' .
                        route('wilayah.show', $row->uuid) .
                        '" data-send="' .
                        route('wilayah.update', $row->uuid) .
                        '" data-toggle="modal" data-target="#editWilayah">
                    Edit
                </button>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-url="' .
                        route('wilayah.destroy', $row->uuid) .
                        '"  data-id="' . $row->uuid .
                        '" class="btn btn-danger btn-sm deletePost">Delete</a>';
                    return $btn;
                })
                ->addColumn("gambar", function ($row) {
                    $imgs = json_decode($row->img);
                    $gambar = '';
                    foreach ($imgs as $img) {
                        $gambar = $gambar . "<img src='" . Storage::url('public/upload/wilayah/' . $img) . "' width='80px' style='margin:20px 0;' /> ";
                    }
                    return $gambar;
                })
                ->rawColumns(['action', "gambar"])
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

    public function getDetailWilayah($id)
    {
        $wilayah = Wilayah::where('uuid', $id)->first();
        return view('pages.detailsHome.details', compact('wilayah'));
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
        $name   = [];
        foreach ($request->file('img') as $img) {
            $file_name = $img->hashName();
            $name[]    = $file_name;
            $path      = $img->storeAs('public/upload/wilayah', $file_name);
        }

        $imgfull = json_encode($name);
        try {
            $wilayah = Wilayah::create([
                'uuid'        => Str::uuid(),
                'id_pengguna' => Auth::id(),
                'nama'        => $nama,
                'info'        => $info,
                'alamat'      => $alamat,
                'lat'         => $lat,
                'long'        => $long,
                'img'         => $imgfull,
            ]);
            if ($wilayah) {
                return redirect()->route('wilayah.index')->with('success', 'Berhasil Ditambahkan');
            } else {
                return redirect()->route('wilayah.index')->with('error', 'Mohon Hubungi Admin');
            }
        } catch (\Throwable $e) {
            return redirect()->route('wilayah.index')->with('error', $e->message);;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $wilayah = Wilayah::where('uuid', $id)->first();
        return response()->json($wilayah);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWilayahRequest $request, $id)
    {
        try {
            // dd($request->file('img'));


            $wilayah         = Wilayah::where('uuid', $id)->first();

            if ($request->file('img')) {
                $gambar = json_decode($wilayah->img);
                foreach ($request->file('img') as $key => $img) {
                    foreach ($gambar as $keys => $gmb) {
                        if ($key === $keys) {
                            $file_name = $img->hashName();
                            $path      = $img->storeAs('public/upload/wilayah', $file_name);
                            $gambar[$key] = $file_name;
                        }
                    }
                }
            } else {
                $gambar = json_decode($wilayah->img);
            }

            $imgfull = json_encode($gambar);

            $wilayah->nama   = $request->nama;
            $wilayah->alamat = $request->alamat;
            $wilayah->lat    = $request->lat;
            $wilayah->long   = $request->long;
            $wilayah->info   = $request->info;
            $wilayah->img    = $imgfull;
            $wilayah->save();

            return redirect()->route('wilayah.index')->with('success', 'Berhasil Diupdate');
        } catch (\Throwable $e) {
            return redirect()->route('wilayah.index')->with('error', $e->errorInfo[2]);;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $wilayah = Wilayah::where('uuid', $id)->delete();
            return response()->json([
                'success' => true
            ]);
        } catch (\Throwable $e) {
            return redirect()->route('wilayah.index')->with('error', $e->errorInfo[2]);;
        }
    }
}
