<?php

namespace App\Imports;

use App\Models\Keluarga;
use App\Models\Penduduk;
use App\Models\AktaKawin;
use App\Models\Pekerjaan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
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
        $nik          = str_replace(["'", chr(1), "‘"], "", $row['0']);
        $rowkk        = str_replace(["'", chr(1)], "", $row['1']);
        $dataPenduduk = Penduduk::where('nik', $nik)->first();
        $kk           = Keluarga::select('id')->where('no_kk', $rowkk)->first();
        $aktaKawin    = AktaKawin::select('id')->where('no_akta_kawin', $row['2'])->first();
        $pekerjaan    = Pekerjaan::select('id')->where('pekerjaan', Str::title(($row['10'])))->first();

        if (Str::title($row[7]) == "Hindu") {
            $row[7] = "H";
        } else if (Str::title($row[7]) == "Islam") {
            $row[7] = "I";
        } else if (Str::title($row[7]) == "Protestan") {
            $row[7] = "P";
        } else if (Str::title($row[7]) == "Katolik") {
            $row[7] = "KA";
        } else if (Str::title($row[7]) == "Budha") {
            $row[7] = "B";
        } else if (Str::title($row[7]) == "Khonghucu") {
            $row[7] = "Kh";
        }
        if ($aktaKawin === null && $row[2] !== null) {
            $aktaKawin = AktaKawin::create([
                'uuid'          => (string) Str::uuid(),
                'id_pengguna'   => Auth::user()->id,
                'no_akta_kawin' => $row['2'],
            ]);
        }

        if ($kk === null && $row[11] !== null) {
            $kk = Keluarga::create([
                'uuid'                 => (string) Str::uuid(),
                'no_kk'                => $rowkk,
                'id_pengguna'          => Auth::user()->id,
                'nama_kepala_keluarga' => Str::title($row[16]),
                'alamat'               => Str::title($row[17]),
                'dusun'                => Str::title($row[18]),
                'desa'                 => Str::title($row[19]),
                'kecamatan'            => Str::title($row[20]),
            ]);
        }

        if ($dataPenduduk) {
            // Jika data sudah ada, update data yang ada
            $dataPenduduk->update([
                "nik"                   => $nik,
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
            if (Str::title($row[4]) == 'Laki-Laki') {
                $row[4] = 'L';
            } else
            if (Str::title($row[4]) == 'Perempuan') {
                $row[4] = 'P';
            } else {
                $row[4] = '';
            }

            $timestamp = Date::excelToTimestamp($row[6]);
            $row[6] = date('Y/m/d', $timestamp);

            // Jika data belum ada, buat data baru
            $penduduk = Penduduk::create([
                "nik"                   => $nik,
                "no_kk"                 => $kk ? $kk->id : '',
                "no_akta_kawin"         => $aktaKawin ? $aktaKawin->id : '',
                "id_pekerjaan"          => $pekerjaan ? $pekerjaan->id  : '',
                "nama_lengkap"          => Str::title($row[3]),
                "jenis_kelamin"         => Str::title($row[4]),
                "tempat_lahir"          => Str::title($row[5]),
                "tanggal_lahir"         => Str::title($row[6]),
                "agama"                 => Str::title($row[7]) ? Str::title($row[7])  : '',
                "golongan_darah"        => Str::title($row[8]),
                "pendidikan"            => Str::title($row[9]),
                "status_dalam_keluarga" => Str::title($row[11]),
                "status_kawin"          => Str::title($row[12]),
                "no_akta_lahir"         => Str::title($row[13]) ? Str::title($row[13]) : '',
                "nama_lengkap_ayah"     => Str::title($row[14]) ? Str::title($row[14]) : '',
                "nama_lengkap_ibu"      => Str::title($row[15]) ? Str::title($row[15]) : '',
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
