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
        Schema::create('tb_alternatif', function (Blueprint $table) {
            $table->string('kode_alternatif')->index()->unique();
            $table->string('nama_alternatif');
            $table->string('kelas'); // Ensure compatible type with `tb_kelas.kode_kelas`
            $table->foreign('kelas')
                ->references('kode_kelas')
                ->on('tb_kelas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_alternatif');
    }
};
