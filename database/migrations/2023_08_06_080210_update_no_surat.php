<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('nomor_surat', function (Blueprint $table) {
            $table->string('id_jenis_surat')->after('uuid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nomor_surat', function (Blueprint $table) {
            $table->dropColumn('id_jenis_surat');
        });
    }
};
