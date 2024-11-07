<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class MapelController extends Controller
{
    public function cetak()
    {
        $data['title'] = 'Laporan Data mapel';
        $data['rows'] = DB::table('mapel')->get();
        return view('mapel.cetak', $data);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['title'] = 'Data Mapel';
        $data['limit'] = 10;

        $data['rows'] = DB::table("mapel")
            ->where('nama', 'like', '%' . $data['q'] . '%')
            ->orderBy('nama')
            ->paginate($data['limit'])
            ->withQueryString();

        return view("mapel.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'Tambah Mapel';
        return view('mapel.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:mapel',
        ], [
            'nama.unique' => 'Nama mapel harus unik',
            'nama.required' => 'Nama mapel harus diisi',
        ]);

        DB::table('mapel')->insert([
            'nama' => $request->nama,
        ]);

        return redirect('mapel')->with('message', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['row'] = DB::table('mapel')->where('id', $id)->first();
        $data['mapel'] = DB::table('mapel')->get();
        $data['title'] = 'Ubah Mapel';

        if (!$data['row']) {
            return redirect('mapel')->with('error', 'Data mapel tidak ditemukan!');
        }

        return view('mapel.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|unique:mapel',
        ], [
            'nama.required' => 'nama harus diisi',
            'nama.unique' => 'nama harus unik',
        ]);

        DB::table('mapel')
            ->where('id', $id)
            ->update([
                'nama' => $request->nama,
            ]);

        return redirect('mapel')->with('message', 'Data berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mapel = DB::table('mapel')->where('id', $id)->first();

        if (!$mapel) {
            return redirect('mapel')->with('error', 'Data mapel tidak ditemukan!');
        }

        DB::table('mapel')->where('id', $id)->delete();

        return redirect('mapel')->with('message', 'Data mapel berhasil dihapus!');
    }
}
