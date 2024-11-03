<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_user', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('nama_user')->nullable();
            $table->string('username')->unique();
            $table->string('password')->nullable();
            $table->string('level')->nullable();
            $table->integer('status_user')->nullable();
            $table->timestamps();
        });

        DB::table('tb_user')->insert([[
            'nama_user' => 'Administrator',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'level' => 'Admin',
            'status_user' => 1,
        ], [
            'nama_user' => 'Manager',
            'username' => 'manager',
            'password' => Hash::make('manager'),
            'level' => 'Manager',
            'status_user' => 1,
        ]]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_user');
    }
};
