<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class jenis_surat extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Surat Keterangan Usaha',
            'Surat Keterangan Miskin',
            'Surat Domisili',
            'Surat Keterangan Tidak Mampu',
            'Surat Keterangan',
        ];

        foreach ($data as $d) {
            DB::table('jenis_surat')->insert([
                'uuid' => Str::uuid(),
                'nama' => $d,
                'slug' => Str::slug($d),
            ]);
        }
    }
}
