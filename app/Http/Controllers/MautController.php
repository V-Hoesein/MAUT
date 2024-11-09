<?php

namespace App\Http\Controllers;

use App\MAUT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MautController extends Controller
{
    // public function cetak()
    // {
    //     $data['title'] = 'Laporan Data Kriteria';
    //     $data['rows'] = DB::table('variabel')->get();
    //     return view('kriteria.cetak', $data);
    // }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['title'] = 'Perhitungan MAUT';
        $data['limit'] = 10;


        $maut = new MAUT();
        $data['rows'] = $maut->calculate();


        // var_dump($data); die();

        return view('maut.index', $data);
    }
}
