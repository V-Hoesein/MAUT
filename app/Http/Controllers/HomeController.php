<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function show()
    {
        if (Auth::check()) {
            $title =  'Dashboard';
            $kriteria_count = Kriteria::count();
            $subkriteria_count = Subkriteria::count();
            $alternatif_count = Alternatif::count();
            return view('dashboard', compact('title', 'kriteria_count', 'subkriteria_count', 'alternatif_count'));
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
