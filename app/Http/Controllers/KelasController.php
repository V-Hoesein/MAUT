<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class KelasController extends Controller
{
    public function cetak()
    {
        $data['title'] = 'Laporan Data keelas';
        $data['rows'] = DB::table('kelas')->get();
        return view('kelas.cetak', $data);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['title'] = 'Data Kelas';
        $data['limit'] = 10;

        $data['rows'] = DB::table("kelas")
            ->where('nama', 'like', '%' . $data['q'] . '%')
            ->orderBy('nama')
            ->paginate($data['limit'])
            ->withQueryString();

        return view("kelas.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'Tambah Kelas';
        return view('kelas.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:kelas',
        ], [
            'nama.unique' => 'Nama kelas harus unik',
            'nama.required' => 'Nama keals harus diisi',
        ]);

        DB::table('kelas')->insert([
            'nama' => $request->nama,
        ]);

        return redirect('kelas')->with('message', 'Data berhasil ditambah!');
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
        $data['row'] = DB::table('kelas')->where('id', $id)->first();
        $data['kelas'] = DB::table('kelas')->get();
        $data['title'] = 'Ubah Kelas';

        if (!$data['row']) {
            return redirect('kelas')->with('error', 'Data kelas tidak ditemukan!');
        }

        return view('kelas.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|unique:kelas',
        ], [
            'nama.required' => 'nama harus diisi',
            'nama.unique' => 'nama harus unik',
        ]);

        DB::table('kelas')
            ->where('id', $id)
            ->update([
                'nama' => $request->nama,
            ]);

        return redirect('kelas')->with('message', 'Data berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kelas = DB::table('kelas')->where('id', $id)->first();

        if (!$kelas) {
            return redirect('kelas')->with('error', 'Data kelas tidak ditemukan!');
        }

        DB::table('kelas')->where('id', $id)->delete();

        return redirect('kelas')->with('message', 'Data kelas berhasil dihapus!');
    }
}
