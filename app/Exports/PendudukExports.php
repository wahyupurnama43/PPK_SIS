<?php

namespace App\Exports;

use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PendudukExports implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $penduduk = Penduduk::select('nik', 'keluarga.no_kk as kk', 'akta_kawin.no_akta_kawin as aktaKawin', 'nama_lengkap', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'agama', 'golongan_darah', 'pendidikan', 'pekerjaan', 'status_dalam_keluarga', 'status_kawin', 'no_akta_lahir', 'nama_lengkap_ayah', 'nama_lengkap_ibu', "keluarga.nama_kepala_keluarga", "keluarga.alamat", "keluarga.dusun", "keluarga.desa", "keluarga.kecamatan")
            ->leftjoin('keluarga', 'keluarga.id', '=', 'penduduk.no_kk')
            ->leftjoin('akta_kawin', 'akta_kawin.id', '=', 'penduduk.no_akta_kawin')
            ->leftjoin('pekerjaan', 'pekerjaan.id', '=', 'penduduk.id_pekerjaan')
            ->get();

        foreach ($penduduk as $row) {
            if ($row->agama == "H") {
                $row->agama = "Hindu";
            } else if ($row->agama == "I") {
                $row->agama = "Islam";
            } else if ($row->agama == "P") {
                $row->agama = "Protestan";
            } else if ($row->agama == "KA") {
                $row->agama = "Katolik";
            } else if ($row->agama == "B") {
                $row->agama = "Budha";
            } else if ($row->agama == "Kh") {
                $row->agama = "Khonghucu";
            }
            $row->nik = "'" . $row->nik;
            $row->kk = "'" . $row->kk;
        }
        return $penduduk;
    }

    public function columnFormats(): array
    {
        return [
            // F is the column
            'F' => '0'
        ];
    }

    public function headings(): array
    {
        return [
            "Nik", "NO KK", "Akta Kawin", "Nama Lengkap", "Jenis Kelamin", "Tempat Lahir", "Tanggal Lahir", "Agama", "Golongan Darah", "Pendidikan", "Pekerjaan", "Status Dalam Keluarga", "Status Kawin", "No Akta Lahir", "Nama Lengkap Ayah", "Nama Lengkap Ibu", "Nama Kepala Keluarga", "Alamat",    "Dusun",    "Desa",    "Kecamatan"
        ];
    }
}
