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
        Schema::create('kadus', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->integer('id_pengguna');
            $table->integer('id_jabatan');
            $table->string('nama');
            $table->string('dusun');
            $table->string('desa');
            $table->string('kecamatan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kadus');
    }
};
