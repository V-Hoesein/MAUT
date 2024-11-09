<?php

namespace App\Http\Controllers;

use App\MAUT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MautController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['title'] = 'Perhitungan MAUT';
        $data['limit'] = 10;

        $nilai = DB::table('nilai as n')
            ->join('siswa as s', 'n.nis', '=', 's.nis')
            ->select('n.*', 's.nama as nama_siswa', 's.kelas as kelas_siswa')
            ->orderBy('n.nis')
            ->get();

        $kelas = DB::table('kelas')->get();
        $mapel = DB::table('mapel')->get();
        $topik = DB::table('topik')->get();
        $kriteria = DB::table('variabel')->get();
        $model = ['pbl', 'pjbl', 'ctl', 'ibl', 'dl'];

        $maut = new MAUT();
        $score = $maut->calculate();


        return view('nilai.index', $data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
