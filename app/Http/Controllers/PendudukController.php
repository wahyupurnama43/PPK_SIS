<?php

namespace App\Http\Controllers;

use App\Models\Wilayah;
use App\Models\Keluarga;
use App\Models\Penduduk;
use App\Models\AktaKawin;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PendudukController extends Controller
{
    public function index()
    {

        if (request()->ajax()) {
            return DataTables::of(Penduduk::select('nik', 'no_kk', 'no_akta_lahir', 'nama_lengkap', 'jenis_kelamin', DB::raw("CONCAT('tempat_lahir', ', ', 'tanggal_lahir')", 'pendidikan')))
                ->addColumn('action', function ($row) {
                    $btn =
                        '<button type="button" class="btn edit btn btn-primary btn-sm update" data-url="' .
                        route('penduduk.show', $row->uuid) .
                        '" data-send="' .
                        route('penduduk.update', $row->uuid) .
                        '" data-toggle="modal" data-target="#editWilayah">
                    Edit
                </button>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-url="' .
                        route('penduduk.destroy', $row->uuid) .
                        '"  data-id="' . $row->uuid .
                        '" class="btn btn-danger btn-sm deletePost">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        $pekerjaan = Pekerjaan::all();

        return view('pages.penduduk.penduduk', compact('pekerjaan'));
    }

    public function store(Request $request)
    {
        dd($request->all());
    }

    public function getKK(Request $request)
    {
        $nik = $request->term['term'];
        $penduduk =  Keluarga::select('no_kk', 'uuid')->where('no_kk', 'LIKE', '%' . $nik . '%',)->get();
        $response = array();
        foreach ($penduduk as $p) {
            $response[] = array(
                "id"   => $p->uuid,
                "text" => $p->no_kk
            );
        }
        return response()->json($response);
    }

    public function getAktaKawin(Request $request)
    {
        $nik = $request->term['term'];
        $penduduk =  AktaKawin::select('no_akta_kawin', 'uuid')->where('no_akta_kawin', 'LIKE', '%' . $nik . '%',)->get();
        $response = array();
        foreach ($penduduk as $p) {
            $response[] = array(
                "id"   => $p->uuid,
                "text" => $p->no_akta_kawin
            );
        }
        return response()->json($response);
    }
}
