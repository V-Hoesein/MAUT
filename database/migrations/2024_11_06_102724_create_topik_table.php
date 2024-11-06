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
        Schema::create('topik', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique()->index();
            $table->string('nama_mapel');
            $table->foreign('nama_mapel')->references('nama')->on('mapel')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topik');
    }
};
