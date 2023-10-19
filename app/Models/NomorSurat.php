<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NomorSurat extends Model
{
    use HasFactory;
    protected $table = 'nomor_surat';
    protected $hidden = ['id'];
    protected $fillable = ['uuid', 'id_jenis_surat', 'kode', 'urutan', 'bulan', 'tahun'];
}
