<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TopikController extends Controller
{
    public function cetak()
    {
        $data['title'] = 'Laporan Data Topik';
        $data['rows'] = DB::table('topik')->get();
        return view('topik.cetak', $data);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['title'] = 'Data Topik';
        $data['limit'] = 10;

        $data['rows'] = DB::table("topik")
            ->where('nama', 'like', '%' . $data['q'] . '%')
            ->orderBy('nama')
            ->paginate($data['limit'])
            ->withQueryString();

        return view("topik.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'Tambah Topik';
        $data['mapel'] = DB::table('mapel')->get();
        return view('topik.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:topik',
            'nama_mapel' => 'required',
        ], [
            'nama.required' => 'Nama topik harus diisi',
            'nama.unique' => 'Nama topik harus unik',
            'nama_mapel.required' => 'Mapel harus diisi',
        ]);

        DB::table('topik')->insert([
            'nama' => $request->input('nama'),
            'nama_mapel' => $request->input('nama_mapel'),
        ]);

        return redirect('topik')->with('message', 'Data berhasil ditambah!');
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
        $data['title'] = 'Ubah Topik';
        $data['row'] = DB::table('topik')->where('id', $id)->first();
        $data['mapel'] = DB::table('mapel')->get();

        if (!$data['row']) {
            return redirect('topik')->with('error', 'Data topik tidak ditemukan!');
        }

        return view('topik.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $request->validate([
            'nama' => 'required|unique:topik,nama,' . $id, // Unique hanya jika nama berubah
            'nama_mapel' => 'required',
        ], [
            'nama.required' => 'Nama topik harus diisi',
            'nama.unique' => 'Nama topik harus unik',
            'nama_mapel.required' => 'Mapel harus diisi',
        ]);


        // Update data topik pada database
        DB::table('topik')
            ->where('id', $id)
            ->update([
                'nama' => $request->input('nama'),
                'nama_mapel' => $request->input('nama_mapel'),
            ]);

        // Redirect kembali dengan pesan sukses
        return redirect('topik')->with('message', 'Data berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $topik = DB::table('topik')->where('id', $id)->first();

        if (!$topik) {
            return redirect('topik')->with('error', 'Data topik tidak ditemukan!');
        }

        DB::table('topik')->where('id', $id)->delete();

        return redirect('topik')->with('message', 'Data topik berhasil dihapus!');
    }
}
