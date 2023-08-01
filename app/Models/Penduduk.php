<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;
    protected $table = 'penduduk';
    protected $hidden = ['id'];
    protected $fillable = [
        'nik',
        'no_kk',
        'no_akta_kawin',
        'id_pekerjaan',
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'golongan_darah',
        'pendidikan',
        'status_dalam_keluarga',
        'status_kawin',
        'no_akta_lahir',
        'nama_lengkap_ayah',
        'nama_lengkap_ibu'
    ];
}
