<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class VariabelController extends Controller
{
    public function cetak()
    {
        $data['title'] = 'Laporan Data Variabel';
        $data['rows'] = DB::table('variabel')->get();
        return view('variabel.cetak', $data);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['title'] = 'Data Variabel';
        $data['limit'] = 10;

        $data['rows'] = DB::table("variabel")
            ->where('nama', 'like', '%' . $data['q'] . '%')
            ->orderBy('nama')
            ->paginate($data['limit'])
            ->withQueryString();

        return view("variabel.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'Tambah Variabel';
        return view('variabel.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:variabel,nama',
            'bobot' => 'required',
        ], [
            'nama.required' => 'Nama variabel harus diisi',
            'nama.unique' => 'Nama variabel harus unik',
            'bobot.required' => 'Bobot harus diisi',
        ]);

        DB::table('variabel')->insert([
            'nama' => $request->nama,
            'bobot' => $request->bobot,
        ]);

        return redirect('variabel')->with('message', 'Data berhasil ditambah!');
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
        $data['title'] = 'Ubah Variabel';
        $data['row'] = DB::table('variabel')->where('id', $id)->first();

        if (!$data['row']) {
            return redirect('variabel')->with('error', 'Data variabel tidak ditemukan!');
        }

        return view('variabel.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $request->validate([
            'nama' => 'required|unique:variabel,nama,' . $id, // Unique hanya jika nama berubah
            'bobot' => 'required',
        ], [
            'nama.required' => 'Nama variabel harus diisi',
            'nama.unique' => 'Nama variabel sudah ada, gunakan nama lain',
            'bobot.required' => 'Bobot harus diisi',
        ]);

        // Update data variabel pada database
        DB::table('variabel')
            ->where('id', $id)
            ->update([
                'nama' => $request->nama,
                'bobot' => $request->bobot,
            ]);

        // Redirect kembali dengan pesan sukses
        return redirect('variabel')->with('message', 'Data berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $variabel = DB::table('variabel')->where('id', $id)->first();

        if (!$variabel) {
            return redirect('variabel')->with('error', 'Data variabel tidak ditemukan!');
        }

        DB::table('variabel')->where('id', $id)->delete();

        return redirect('variabel')->with('message', 'Data variabel berhasil dihapus!');
    }
}
