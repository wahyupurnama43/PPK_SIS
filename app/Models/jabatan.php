<?php

namespace App\Models;

use App\Models\AktaKawin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jabatan extends Model
{
    use HasFactory;
    protected $table = 'jabatan';
    protected $hidden = ['id'];
    protected $fillable = [
        'uuid',
        'nama'
    ];

    public function kadus(): BelongsTo
    {
        return $this->BelongsTo(Kadus::class, 'id', 'id_jabatan');
    }
}
