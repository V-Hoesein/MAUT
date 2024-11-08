<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class NilaiController extends Controller
{
    public function cetak()
    {
        $data['title'] = 'Laporan Data Nilai';

        $data['rows'] = DB::table('nilai as n')
            ->join('siswa as s', 'n.nis', '=', 's.nis')
            ->join('guru as g', 'n.nip_guru', '=', 'g.nip')
            ->select(
                'n.*',
                's.nama as nama_siswa',
                'g.nama as nama_guru'
            )
            ->orderBy('n.nis')
            ->get();

        return view('nilai.cetak', $data);
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
        $data['title'] = 'Data Nilai';
        $data['limit'] = 10;

        $data['rows'] = DB::table('nilai as n')
            ->join('siswa as s', 'n.nis', '=', 's.nis')
            ->join('guru as g', 'n.nip_guru', '=', 'g.nip')
            ->select('n.*', 's.nama as nama_siswa', 'g.nama as nama_guru', 's.kelas as kelas_siswa')
            ->where('s.nama', 'like', '%' . $data['q'] . '%')
            ->orderBy('n.nis')
            ->paginate($data['limit'])
            ->withQueryString();

        return view('nilai.index', $data);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Tambah Nilai';
        $data['kelas'] = DB::table('kelas')->get();
        $data['nis'] = DB::table('siswa')->get();
        $data['mapel'] = DB::table('mapel')->get();
        $data['nip_guru'] = DB::table('guru')->get();
        $data['topik'] = DB::table('topik')->get();
        $data['model_belajar'] = ['pbl', 'pjbl', 'ctl', 'ibl', 'dl'];
        $data['variabel'] = DB::table('variabel')->get();

        return view('nilai.create', $data);
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
            'nis' => 'required|exists:siswa,nis', // Pastikan NIS ada di tabel siswa
            'mapel' => 'required|exists:mapel,nama',
            'nip_guru' => 'required|exists:guru,nip',
            'topik' => 'required|exists:topik,nama',
            'model_belajar' => 'required|in:pbl,pjbl,ctl,ibl,dl',
            'variabel' => 'required|exists:variabel,nama',
            'nilai' => 'required|numeric|min:0|max:100',
        ], [
            'nis.required' => 'NIS harus diisi',
            'nis.exists' => 'NIS tidak ditemukan di data siswa',
            'mapel.required' => 'Mata pelajaran harus diisi',
            'mapel.exists' => 'Mata pelajaran tidak ditemukan',
            'nip_guru.required' => 'NIP Guru harus diisi',
            'nip_guru.exists' => 'NIP Guru tidak ditemukan',
            'topik.required' => 'Topik harus diisi',
            'topik.exists' => 'Topik tidak ditemukan',
            'model_belajar.required' => 'Model belajar harus dipilih',
            'model_belajar.in' => 'Model belajar tidak valid',
            'variabel.required' => 'Variabel harus dipilih',
            'variabel.exists' => 'Variabel tidak ditemukan',
            'nilai.required' => 'Nilai harus diisi',
            'nilai.numeric' => 'Nilai harus berupa angka',
            'nilai.min' => 'Nilai minimal adalah 0',
            'nilai.max' => 'Nilai maksimal adalah 100',
        ]);

        // Simpan data ke database
        DB::table('nilai')->insert([
            'nis' => $request->nis,
            'mapel' => $request->mapel,
            'nip_guru' => $request->nip_guru,
            'topik' => $request->topik,
            'model_belajar' => $request->model_belajar,
            'variabel' => $request->variabel,
            'nilai' => $request->nilai,
        ]);

        // Redirect dengan pesan sukses
        return redirect('nilai')->with('message', 'Data berhasil ditambah!');
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function show(Request $nilai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Fetch the specific record along with related data
        $data['title'] = 'Edit Nilai';
        $data['row'] = DB::table('nilai')->where('id', $id)->first();

        // Check if the record exists
        if (!$data['row']) {
            return redirect('nilai')->with('error', 'Data nilai tidak ditemukan!');
        }

        // Fetch additional data for form options
        $data['kelas'] = DB::table('kelas')->get();
        $data['nis'] = DB::table('siswa')->get();
        $data['mapel'] = DB::table('mapel')->get();
        $data['nip_guru'] = DB::table('guru')->get();
        $data['topik'] = DB::table('topik')->get();
        $data['model_belajar'] = ['pbl', 'pjbl', 'ctl', 'ibl', 'dl'];
        $data['variabel'] = DB::table('variabel')->get();

        // Load the edit view with data
        return view('nilai.edit', $data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate input data
        $request->validate([
            'nis' => 'required|exists:siswa,nis',
            'mapel' => 'required|exists:mapel,nama',
            'nip_guru' => 'required|exists:guru,nip',
            'topik' => 'required|exists:topik,nama',
            'model_belajar' => 'required|in:pbl,pjbl,ctl,ibl,dl',
            'variabel' => 'required|exists:variabel,nama',
            'nilai' => 'required|numeric|min:0|max:100',
        ], [
            'nis.required' => 'NIS harus diisi',
            'nis.exists' => 'NIS tidak ditemukan di data siswa',
            'mapel.required' => 'Mata pelajaran harus diisi',
            'mapel.exists' => 'Mata pelajaran tidak ditemukan',
            'nip_guru.required' => 'NIP Guru harus diisi',
            'nip_guru.exists' => 'NIP Guru tidak ditemukan',
            'topik.required' => 'Topik harus diisi',
            'topik.exists' => 'Topik tidak ditemukan',
            'model_belajar.required' => 'Model belajar harus dipilih',
            'model_belajar.in' => 'Model belajar tidak valid',
            'variabel.required' => 'Variabel harus dipilih',
            'variabel.exists' => 'Variabel tidak ditemukan',
            'nilai.required' => 'Nilai harus diisi',
            'nilai.numeric' => 'Nilai harus berupa angka',
            'nilai.min' => 'Nilai minimal adalah 0',
            'nilai.max' => 'Nilai maksimal adalah 100',
        ]);

        // Update the record in the database
        DB::table('nilai')
            ->where('id', $id)
            ->update([
                'nis' => $request->nis,
                'mapel' => $request->mapel,
                'nip_guru' => $request->nip_guru,
                'topik' => $request->topik,
                'model_belajar' => $request->model_belajar,
                'variabel' => $request->variabel,
                'nilai' => $request->nilai,
            ]);

        // Redirect with a success message
        return redirect('nilai')->with('message', 'Data berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */

    public function destroy($nis)
    {
        // Mengambil data nilai berdasarkan nis
        $nilai = DB::table('nilai')->where('nis', $nis)->first();

        // Pastikan data nilai ditemukan
        if (!$nilai) {
            return redirect('nilai')->with('error', 'Data nilai tnisak ditemukan!');
        }

        // Menghapus data dari tabel nilai
        DB::table('nilai')->where('nis', $nis)->delete();

        // Redirect kembali dengan pesan sukses
        return redirect('nilai')->with('message', 'Data nilai berhasil dihapus!');
    }

}
