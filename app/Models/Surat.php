<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Surat extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'surat';
    protected $hidden = ['id'];
    protected $fillable = [
        'uuid',
        'nik',
        'id_nomor_surat',
        'id_jenis_surat',
        'id_kadus',
        'keperluan',
        'deskripsi',
        'pendukung',
        'verifikasi_staf',
        'verifikasi_kadus',
        'barcode',
    ];
}
