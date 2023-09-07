<?php

namespace App\Imports;

use App\Models\AktaKawin;
use App\Models\Keluarga;
use App\Models\Pekerjaan;
use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportPenduduk implements ToModel, WithStartRow
{
    protected $startRow = 2;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Cari data berdasarkan kriteria tertentu, misalnya ID atau kolom unik
        $dataPenduduk = Penduduk::where('nik', $row['0'])->first();
        $kk           = Keluarga::select('id')->where('no_kk', $row['1'])->first();
        $aktaKawin    = AktaKawin::select('id')->where('no_akta_kawin', $row['2'])->first();
        $pekerjaan    = Pekerjaan::select('id')->where('pekerjaan', $row['10'])->first();

        if ($row[7] == "Hindu") {
            $row[7] = "H";
        } else if ($row[7] == "Islam") {
            $row[7] = "I";
        } else if ($row[7] == "Protestan") {
            $row[7] = "P";
        } else if ($row[7] == "Katolik") {
            $row[7] = "KA";
        } else if ($row[7] == "Budha") {
            $row[7] = "B";
        } else if ($row[7] == "Khonghucu") {
            $row[7] = "Kh";
        }

        if ($dataPenduduk) {
            // Jika data sudah ada, update data yang ada
            $dataPenduduk->update([
                "nik"                   => $row[0],
                "no_kk"                 => $kk ? $kk->id : $dataPenduduk->no_kk,
                "no_akta_kawin"         => $aktaKawin ? $aktaKawin->id : $dataPenduduk->no_akta_kawin,
                "id_pekerjaan"          => $pekerjaan ? $pekerjaan->id  : $dataPenduduk->id_pekerjaan,
                "nama_lengkap"          => $row[3],
                "jenis_kelamin"         => $row[4],
                "tempat_lahir"          => $row[5],
                "tanggal_lahir"         => $row[6],
                "agama"                 => $row[7] ? $row[7]  : $dataPenduduk->agama,
                "golongan_darah"        => $row[8],
                "pendidikan"            => $row[9],
                "status_dalam_keluarga" => $row[11],
                "status_kawin"          => $row[12],
                "no_akta_lahir"         => $row[13] ? $row[13] : $dataPenduduk->no_akta_lahir,
                "nama_lengkap_ayah"     => $row[14] ? $row[14] : $dataPenduduk->nama_lengkap_ayah,
                "nama_lengkap_ibu"      => $row[15] ? $row[15] : $dataPenduduk->nama_lengkap_ibu,
            ]);
            $dataPenduduk->save();
        } else {
            // Jika data belum ada, buat data baru
            Penduduk::create([
                "nik"                   => $row[0],
                "no_kk"                 => $kk ? $kk->id : '',
                "no_akta_kawin"         => $aktaKawin ? $aktaKawin->id : '',
                "id_pekerjaan"          => $pekerjaan ? $pekerjaan->id  : '',
                "nama_lengkap"          => $row[3],
                "jenis_kelamin"         => $row[4],
                "tempat_lahir"          => $row[5],
                "tanggal_lahir"         => $row[6],
                "agama"                 => $row[7] ? $row[7]  : '',
                "golongan_darah"        => $row[8],
                "pendidikan"            => $row[9],
                "status_dalam_keluarga" => $row[11],
                "status_kawin"          => $row[12],
                "no_akta_lahir"         => $row[13] ? $row[13] : '',
                "nama_lengkap_ayah"     => $row[14] ? $row[14] : '',
                "nama_lengkap_ibu"      => $row[15] ? $row[15] : '',
            ]);
        }

        // return new Penduduk([
        //     //
        // ]);
    }

    public function startRow(): int
    {
        return $this->startRow;
    }
}
