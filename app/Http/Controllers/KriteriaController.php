<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function cetak()
    {
        $data['title'] = 'Laporan Data Kriteria';
        $data['rows'] = DB::table('variabel')->get();
        return view('kriteria.cetak', $data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $data['q'] = $request->input('q', '');
        $data['title'] = 'Data Kriteria';
        $data['limit'] = 10;

        $data['rows'] = DB::table("variabel")
            ->where('nama', 'like', '%' . $data['q'] . '%')
            ->orderBy('nama')
            ->paginate($data['limit'])
            ->withQueryString();

        return view("kriteria.index", $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Tambah Kriteria';
        return view('kriteria.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:variabel',
            'bobot' => 'required',
        ], [
            'nama.required' => 'Nama kriteria harus diisi',
            'bobot.required' => 'Bobot harus diisi',
        ]);

        DB::table('variabel')->insert([
            'nama' => $request->nama,
            'bobot' => $request->bobot,
        ]);

        return redirect('kriteria')->with('message', 'Data berhasil ditambah!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function show(Kriteria $kriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['row'] = DB::table('variabel')->where('id', $id)->first();
        $data['title'] = 'Ubah kriteria';

        if (!$data['row']) {
            return redirect('kriteria')->with('error', 'Data siswa tidak ditemukan!');
        }

        return view('kriteria.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'bobot' => 'required',
        ], [
            'nama.required' => 'Nama harus diisi',
            'bobot.required' => 'Kelas harus diisi',
        ]);

        DB::table('variabel')
            ->where('id', $id)
            ->update([
                'bobot' => $request->bobot,
                'nama' => $request->nama,
            ]);

        return redirect('kriteria')->with('message', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Mengambil data kriteria berdasarkan id
        $variabel = DB::table('variabel')->where('id', $id)->first();

        // Pastikan data variabel ditemukan
        if (!$variabel) {
            return redirect('variabel')->with('error', 'Data variabel tidak ditemukan!');
        }

        // Menghapus data terkait dari tabel relasi (misalnya tabel lain yang terkait dengan variabel)
        DB::table('variabel')->where('id', $variabel->id)->delete();

        // Menghapus data dari tabel variabel
        DB::table('variabel')->where('id', $id)->delete();

        // Redirect kembali dengan pesan sukses
        return redirect('kriteria')->with('message', 'Data variabel berhasil dihapus!');
    }
}
