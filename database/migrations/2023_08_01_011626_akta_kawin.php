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
        Schema::create('akta_kawin', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->integer('id_pengguna');
            $table->string('no_akta_kawin')->unique();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akta_kawin');
    }
};
