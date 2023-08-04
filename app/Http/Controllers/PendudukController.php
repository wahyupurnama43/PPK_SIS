<?php

namespace App\Http\Controllers;

use App\Models\Wilayah;
use App\Models\Keluarga;
use App\Models\Penduduk;
use App\Models\AktaKawin;
use App\Models\Pekerjaan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\PendudukRequest;

class PendudukController extends Controller
{
    public function index()
    {

        if (request()->ajax()) {
            return DataTables::of(Penduduk::select('nik', 'no_kk', 'no_akta_lahir', 'nama_lengkap', 'jenis_kelamin', 'pendidikan', DB::raw("CONCAT(tempat_lahir, ', ', DATE_FORMAT(tanggal_lahir, '%d-%m-%Y'))  as infolahir")))
                ->addColumn('action', function ($row) {
                    $btn =
                        '<a href="' . route('penduduk.show', $row->nik) . '" class="btn edit btn btn-primary btn-sm update" >
                    Detail
                </a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-url="' .
                        route('penduduk.destroy', $row->nik) .
                        '"  data-id="' . $row->nik .
                        '" class="btn btn-danger btn-sm deletePost">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        $pekerjaan = Pekerjaan::all();
        $pendidikan = DB::table('penduduk')
            ->select(DB::raw('DISTINCT(pendidikan) as pendidikan'))
            ->get();
        return view('pages.penduduk.penduduk', compact('pekerjaan', 'pendidikan'));
    }

    public function store(PendudukRequest $request)
    {
        $kk_input              = Keluarga::select('id')->where('uuid', Str::title($request->kk))->first();
        $aktaKawin_input       = AktaKawin::select('id')->where('uuid', Str::title($request->aktaKawin))->first();
        $pekerjaan_input       = Pekerjaan::select('id')->where('uuid', Str::title($request->pekerjaan))->first();
        $kk                    = $kk_input->id;
        $aktaKawin             = $aktaKawin_input->id;
        $pekerjaan             = $pekerjaan_input->id;
        $nik                   = Str::title($request->nik);
        $no_akta_lahir         = Str::title($request->no_akta_lahir);
        $nama_lengkap_ayah     = Str::title($request->nama_lengkap_ayah);
        $nama_lengkap_ibu      = Str::title($request->nama_lengkap_ibu);
        $nama_lengkap          = Str::title($request->nama_lengkap);
        $jenis_kelamin         = Str::title($request->jenis_kelamin);
        $tempat_lahir          = Str::title($request->tempat_lahir);
        $tanggal_lahir         = Str::title($request->tanggal_lahir);
        $agama                 = Str::title($request->agama);
        $golongan_darah        = Str::title($request->golongan_darah);
        $pendidikan            = Str::title($request->pendidikan);
        $status_dalam_keluarga = Str::title($request->status_dalam_keluarga);
        $status_kawin          = Str::title($request->status_kawin);

        try {
            $penduduk = Penduduk::create([
                'nik'                   => $nik,
                'no_akta_lahir'         => $no_akta_lahir,
                'nama_lengkap_ayah'     => $nama_lengkap_ayah,
                'nama_lengkap_ibu'      => $nama_lengkap_ibu,
                'no_kk'                 => $kk,
                'nama_lengkap'          => $nama_lengkap,
                'jenis_kelamin'         => $jenis_kelamin,
                'tempat_lahir'          => $tempat_lahir,
                'tanggal_lahir'         => $tanggal_lahir,
                'agama'                 => $agama,
                'golongan_darah'        => $golongan_darah,
                'pendidikan'            => $pendidikan,
                'status_dalam_keluarga' => $status_dalam_keluarga,
                'status_kawin'          => $status_kawin,
                'no_akta_kawin'         => $aktaKawin,
                'id_pekerjaan'          => $pekerjaan,
            ]);

            if ($penduduk) {
                return redirect()->route('penduduk.index')->with('success', 'Berhasil Ditambahkan');
            } else {
                return redirect()->route('penduduk.index')->with('error', 'Mohon Hubungi Admin');
            }
        } catch (\Throwable $e) {
            return redirect()->route('penduduk.index')->with('error', $e->errorInfo[2]);;
        }
    }

    public function show($id)
    {
        $pekerjaan = Pekerjaan::all();
        $penduduk =  Penduduk::where('nik', $id)->first();
        return view('pages.penduduk.detail', compact('penduduk', 'pekerjaan'));
    }

    public function getKK(Request $request)
    {
        $nik      = $request->term['term'];
        $penduduk = Keluarga::select('no_kk', 'uuid')->where('no_kk', 'LIKE', '%' . $nik . '%',)->get();
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
        $nik      = $request->term['term'];
        $penduduk = AktaKawin::select('no_akta_kawin', 'uuid')->where('no_akta_kawin', 'LIKE', '%' . $nik . '%',)->get();
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
