<?php

use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\HitungController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth', 'level'])->group(
    function () {

        Route::get('/alternatif/cetak', [AlternatifController::class, 'cetak'])->name('alternatif.cetak');
        Route::resource('/alternatif', AlternatifController::class);

        Route::get('/kriteria/cetak', [KriteriaController::class, 'cetak'])->name('kriteria.cetak');
        Route::resource('/kriteria', KriteriaController::class);

        Route::get('/kelas/cetak', [KelasController::class, 'cetak'])->name('kelas.cetak');
        Route::resource('/kelas', KelasController::class);

        Route::get('/mapel/cetak', [MapelController::class, 'cetak'])->name('mapel.cetak');
        Route::resource('/mapel', MapelController::class);

        Route::get('/guru/cetak', [GuruController::class, 'cetak'])->name('guru.cetak');
        Route::resource('/guru', GuruController::class);

        Route::get('/hitung/maut', [HitungController::class, 'maut'])->name('hitung.maut');
        Route::get('/hitung/maut/cetak', [HitungController::class, 'maut_cetak'])->name('hitung.maut.cetak');

        Route::get('/hitung/hasil', [HitungController::class, 'hasil'])->name('hitung.hasil');
        Route::get('/hitung/hasil/cetak', [HitungController::class, 'hasil_cetak'])->name('hitung.hasil.cetak');

        Route::get('/user/profil', [UserController::class, 'profil'])->name('user.profil');
        Route::post('/user/profil', [UserController::class, 'profilUpdate'])->name('user.profil.update');
        Route::get('/user/password', [UserController::class, 'password'])->name('user.password');
        Route::post('/user/password', [UserController::class, 'passwordUpdate'])->name('user.password.update');
        Route::get('/user/logout', [UserController::class, 'logout'])->name('user.logout');
        Route::get('/user/cetak', [UserController::class, 'cetak'])->name('user.cetak');
        Route::resource('user', UserController::class);
    }
);
Route::get('/login', [UserController::class, 'loginForm'])->name('login');
Route::post('/login', [UserController::class, 'loginAction'])->name('login.action');
Route::get('/', [HomeController::class, 'show'])->name('home');
Route::get('/tentang', [HomeController::class, 'tentang'])->name('tentang');
