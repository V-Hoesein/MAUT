<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\MAUT;
use App\WASPAS;
use Illuminate\Http\Request;

class HitungController extends Controller
{
    function waspas()
    {
        $rel_alternatif = get_rel_nilai();
        $kriteria = Kriteria::all();
        $atribut = array();
        $bobot = array();
        foreach ($kriteria as $row) {
            $atribut[$row->kode_kriteria] = $row->atribut;
            $bobot[$row->kode_kriteria] = $row->bobot;
            $kriterias[$row->kode_kriteria] = $row;
        }
        $waspas = new WASPAS($rel_alternatif, $bobot, $atribut);
        $categories = [];
        $series[0] = [
            'name' => 'Total',
            'data' => [],
        ];
        foreach ($waspas->total as $key => $val) {
            $alternatif = Alternatif::find($key);
            $alternatif->waspas_total = $val;
            $alternatif->waspas_rank = $waspas->rank[$key];
            $alternatif->waspas_hasil = $waspas->hasil[$key];
            $alternatif->save();
            $categories[$key] = $alternatif->nama_alternatif;
            $series[0]['data'][$key] = $val * 1;
        }
        $categories = array_values($categories);
        $series[0]['data'] = array_values($series[0]['data']);
        $alternatifs = get_alternatif();
        $title = 'Perhitungan WASPAS';

        return view('hitung.waspas', compact('title', 'kriterias', 'waspas', 'rel_alternatif', 'alternatifs', 'categories', 'series'));
    }

    function maut()
    {
        $rel_alternatif = get_rel_nilai();
        $kriteria = Kriteria::all();
        $atribut = array();
        $bobot = array();
        foreach ($kriteria as $row) {
            $atribut[$row->kode_kriteria] = $row->atribut;
            $bobot[$row->kode_kriteria] = $row->bobot;
            $kriterias[$row->kode_kriteria] = $row;
        }
        $maut = new MAUT($rel_alternatif, $atribut, $bobot);
        $categories = [];
        $series[0] = [
            'name' => 'Total',
            'data' => [],
        ];
        foreach ($maut->total as $key => $val) {
            $alternatif = Alternatif::find($key);
            $alternatif->maut_total = $val;
            $alternatif->maut_rank = $maut->rank[$key];
            $alternatif->maut_hasil = $maut->hasil[$key];
            $alternatif->save();
            $categories[$key] = $alternatif->nama_alternatif;
            $series[0]['data'][$key] = $val * 1;
        }
        $categories = array_values($categories);
        $series[0]['data'] = array_values($series[0]['data']);
        $alternatifs = get_alternatif();
        $title = 'Perhitungan MAUT';

        return view('hitung.maut', compact('title', 'kriterias', 'maut', 'rel_alternatif', 'alternatifs', 'categories', 'series'));
    }

    function maut_cetak()
    {
        $data['title'] = 'Laporan Hasil Perhitungan MAUT';
        $data['rows'] = Alternatif::orderBy('maut_rank')->get();
        return view('hitung.maut_cetak', $data);
    }

    function waspas_cetak()
    {
        $data['title'] = 'Laporan Hasil Perhitungan WASPAS';
        $data['rows'] = Alternatif::orderBy('waspas_rank')->get();
        return view('hitung.waspas_cetak', $data);
    }

    function hasil(Request $request)
    {
        $data['title'] = 'Hasil Perhitungan';
        $data['q'] = $request->input('q');
        $data['no'] = 1;
        $data['rows'] = Alternatif::orderBy('kode_alternatif')
            ->where('nama_alternatif', 'like', '%' . $data['q'] . '%')->get();
        return view('hitung.hasil', $data);
    }


    function hasil_cetak(Request $request)
    {
        $data['title'] = 'Laporan Hasil Perhitungan';
        $data['q'] = $request->input('q');
        $data['no'] = 1;
        $data['rows'] = Alternatif::orderBy('kode_alternatif')
            ->where('nama_alternatif', 'like', '%' . $data['q'] . '%')->get();
        return view('hitung.hasil_cetak', $data);
    }
}
