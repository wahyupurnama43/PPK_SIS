<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penduduk', function (Blueprint $table) {
            $table->string('nik')->primary();;
            $table->string('no_kk');
            $table->string('no_akta_kawin');
            $table->integer('id_pekerjaan');
            $table->string('nama_lengkap');
            $table->char('jenis_kelamin', 1);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('agama');
            $table->string('golongan_darah');
            $table->string('pendidikan');
            $table->string('status_dalam_keluarga');
            $table->string('status_kawin');
            $table->string('no_akta_lahir');
            $table->string('nama_lengkap_ayah');
            $table->string('nama_lengkap_ibu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduk');
    }
};
