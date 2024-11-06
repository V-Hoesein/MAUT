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
            $table->string('nama_siswa');
            $table->foreign('nama_siswa')->references('nis')->on('siswa')->onDelete('cascade')->onUpdate('cascade');
            $table->string('mapel');
            $table->foreign('mapel')->references('nama')->on('mapel')->onDelete('cascade')->onUpdate('cascade');
            $table->string('topik');
            $table->foreign('topik')->references('nama')->on('topik')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('model', ['pbl', 'ctl', 'pjbl', 'dl', 'ibl']); // Change to enum to match learning_model
            $table->foreign('model')->references('learning_model')->on('model')->onDelete('cascade')->onUpdate('cascade');
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
