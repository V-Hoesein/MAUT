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
        Schema::create('tb_mapel', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nilai');
            $table->string('alternatif_kode');
            $table->foreign('alternatif_kode')->references('kode_alternatif')->on('tb_alternatif')->onDelete('cascade')->onUpdate('cascade');
            $table->string('kriteria_kode');
            $table->foreign('kriteria_kode')->references('kode_kriteria')->on('tb_kriteria')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_mapel');
    }
};
