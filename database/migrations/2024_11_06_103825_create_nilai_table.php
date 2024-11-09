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
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->string('nis');
            $table->foreign('nis')->references('nis')->on('siswa')->onDelete('cascade')->onUpdate('cascade');
            $table->string('mapel');
            $table->foreign('mapel')->references('nama')->on('mapel')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nip_guru');
            $table->foreign('nip_guru')->references('nip')->on('guru')->onDelete('cascade')->onUpdate('cascade');
            $table->string('topik');
            $table->foreign('topik')->references('nama')->on('topik')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('model_belajar', ['pbl', 'ctl', 'pjbl', 'dl', 'ibl']);
            $table->string('variabel');
            $table->foreign('variabel')->references('nama')->on('variabel')->onDelete('cascade')->onUpdate('cascade');
            $table->double('nilai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};
