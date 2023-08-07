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
        Schema::create('surat', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('nik');
            $table->integer('id_nomor_surat');
            $table->integer('id_jenis_surat');
            $table->integer('id_kadus');
            $table->string('keperluan');
            $table->string('deskripsi');
            $table->string('pendukung');
            $table->boolean('verifikasi_staf')->nullable();
            $table->boolean('verifikasi_kadus')->nullable();
            $table->string('barcode');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat');
    }
};
