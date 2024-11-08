<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function show()
    {
        if (Auth::check()) {
            $title = 'Dashboard';
            $kelas = DB::table('kelas')->count();
            $guru = DB::table('guru')->count();
            $alternatif = DB::table('siswa')->count();
            $mapel = DB::table('mapel')->count();
            return view('dashboard', compact(
                'title',
                'kelas',
                'guru',
                'alternatif',
                'mapel'
            ));
        } else {
            $title = 'Selamat Datang';
            return view('home', compact('title'));
        }
    }
    public function tentang()
    {

        $title = 'Tentang';
        return view('tentang', compact('title'));
    }
}
