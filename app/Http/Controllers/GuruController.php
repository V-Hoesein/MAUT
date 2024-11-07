<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class GuruController extends Controller
{
    public function cetak()
    {
        $data['title'] = 'Laporan Data Guru';
        $data['rows'] = DB::table('guru')->get();
        return view('guru.cetak', $data);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['title'] = 'Data Guru';
        $data['limit'] = 10;

        $data['rows'] = DB::table("guru")
            ->where('nama', 'like', '%' . $data['q'] . '%')
            ->orderBy('nama')
            ->paginate($data['limit'])
            ->withQueryString();

        return view("guru.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'Tambah Guru';
        $data['kelas'] = DB::table('kelas')->get();
        $data['mapel'] = DB::table('mapel')->get();
        return view('guru.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required|unique:guru',
            'kelas' => 'required',
            'mapel' => 'required',
        ], [
            'nama.required' => 'Nama guru harus diisi',

        ]);

        DB::table('guru')->insert([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'kelas' => $request->kelas,
            'mapel' => $request->mapel,
        ]);

        return redirect('guru')->with('message', 'Data berhasil ditambah!');
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
        $data['title'] = 'Ubah Guru';
        $data['row'] = DB::table('guru')->where('id', $id)->first();
        $data['kelas'] = DB::table('kelas')->get();
        $data['mapel'] = DB::table('mapel')->get();

        if (!$data['row']) {
            return redirect('guru')->with('error', 'Data guru tidak ditemukan!');
        }

        return view('guru.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $request->validate([
            'nama' => 'required|unique:guru,nama,' . $id, // Unique hanya jika nama berubah
            'nip' => 'required|unique:guru,nip,' . $id,   // Unique hanya jika nip berubah
            'kelas' => 'required',
            'mapel' => 'required',
        ], [
            'nama.required' => 'Nama guru harus diisi',
            'nama.unique' => 'Nama guru sudah ada, gunakan nama lain',
            'nip.required' => 'NIP harus diisi',
            'nip.unique' => 'NIP sudah ada, gunakan NIP lain',
            'kelas.required' => 'Kelas harus diisi',
            'mapel.required' => 'Mapel harus diisi',
        ]);

        // Update data guru pada database
        DB::table('guru')
            ->where('id', $id)
            ->update([
                'nama' => $request->nama,
                'nip' => $request->nip,
                'kelas' => $request->kelas,
                'mapel' => $request->mapel,
            ]);

        // Redirect kembali dengan pesan sukses
        return redirect('guru')->with('message', 'Data berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $guru = DB::table('guru')->where('id', $id)->first();

        if (!$guru) {
            return redirect('guru')->with('error', 'Data guru tidak ditemukan!');
        }

        DB::table('guru')->where('id', $id)->delete();

        return redirect('guru')->with('message', 'Data guru berhasil dihapus!');
    }
}
