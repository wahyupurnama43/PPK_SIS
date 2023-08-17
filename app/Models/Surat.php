<?php

namespace App\Models;

use App\Models\Keluarga;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'id_perbekel',
        'keperluan',
        'deskripsi',
        'pendukung',
        'verifikasi_staf',
        'verifikasi_kadus',
        'barcode',
        'pdf'
    ];

    public function penduduk(): HasOne
    {
        return $this->hasOne(Penduduk::class, 'nik', 'nik');
    }

    public function no_surat(): HasOne
    {
        return $this->hasOne(NomorSurat::class, 'id', 'id_nomor_surat');
    }

    public function jenis_surat(): HasOne
    {
        return $this->hasOne(JenisSurat::class, 'id', 'id_jenis_surat');
    }

    public function kadus(): HasOne
    {
        return $this->hasOne(Kadus::class, 'id', 'id_kadus');
    }
}
