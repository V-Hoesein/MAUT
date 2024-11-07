<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    public function cetak()
    {
        $data['title'] = 'Laporan Data Alternatif';
        $data['rows'] = DB::table('siswa')->get();
        return view('alternatif.cetak', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['title'] = 'Data Alternatif';
        $data['limit'] = 10;

        $data['rows'] = DB::table("siswa")
            ->where('nama', 'like', '%' . $data['q'] . '%')
            ->orderBy('nis')
            ->paginate($data['limit'])
            ->withQueryString();

        return view("alternatif.index", $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Tambah Alternatif';
        $data['kelas'] = DB::table('kelas')->get();
        return view('alternatif.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nis' => 'required|unique:siswa',
            'nama' => 'required',
            'kelas' => 'required',
        ], [
            'nis.required' => 'NIS harus diisi',
            'nis.unique' => 'NIS harus unik',
            'nama.required' => 'Nama siswa harus diisi',
            'kelas.required' => 'Kelas harus diisi',
        ]);

        // Menyimpan data ke tabel siswa menggunakan facade DB
        DB::table('siswa')->insert([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
        ]);

        // Redirect kembali ke halaman alternatif dengan pesan sukses
        return redirect('alternatif')->with('message', 'Data berhasil ditambah!');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alternatif  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function show(Request $alternatif)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alternatif  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Mengambil data siswa berdasarkan ID
        $data['row'] = DB::table('siswa')->where('id', $id)->first(); // Pastikan mengambil data berdasarkan ID
        $data['kelas'] = DB::table('kelas')->get(); // Mengambil data kelas untuk dropdown
        $data['title'] = 'Ubah Alternatif';

        // Pastikan data ditemukan, jika tidak redirect dengan pesan error
        if (!$data['row']) {
            return redirect('alternatif')->with('error', 'Data siswa tidak ditemukan!');
        }

        // Mengirim data ke view
        return view('alternatif.edit', $data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alternatif  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nis' => 'required|unique:siswa,nis,' . $id, // Pastikan NIS tetap unik, kecuali untuk data yang sedang diupdate
            'nama' => 'required', // Nama wajib diisi
            'kelas' => 'required', // Kelas wajib diisi
        ], [
            'nis.required' => 'NIS harus diisi',
            'nis.unique' => 'NIS harus unik',
            'nama.required' => 'Nama siswa harus diisi',
            'kelas.required' => 'Kelas harus diisi',
        ]);

        // Update data siswa dengan ID yang diberikan
        DB::table('siswa')
            ->where('id', $id) // Menentukan data yang akan diupdate berdasarkan ID
            ->update([
                'nis' => $request->nis, // Update NIS
                'nama' => $request->nama, // Update Nama
                'kelas' => $request->kelas, // Update Kelas
            ]);

        // Redirect kembali ke halaman alternatif dengan pesan sukses
        return redirect('alternatif')->with('message', 'Data berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alternatif  $alternatif
     * @return \Illuminate\Http\Response
     */

    public function destroy($nis)
    {
        // Mengambil data siswa berdasarkan nis
        $siswa = DB::table('siswa')->where('nis', $nis)->first();

        // Pastikan data siswa ditemukan
        if (!$siswa) {
            return redirect('siswa')->with('error', 'Data siswa tnisak ditemukan!');
        }

        // Menghapus data terkait dari tabel relasi (misalnya tabel lain yang terkait dengan siswa)
        DB::table('siswa')->where('nis', $siswa->nis)->delete();

        // Menghapus data dari tabel siswa
        DB::table('siswa')->where('nis', $nis)->delete();

        // Redirect kembali dengan pesan sukses
        return redirect('alternatif')->with('message', 'Data siswa berhasil dihapus!');
    }

}
