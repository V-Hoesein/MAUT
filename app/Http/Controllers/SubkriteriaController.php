<?php

namespace App\Http\Controllers;

use App\Models\Subkriteria;
use Illuminate\Http\Request;

class SubkriteriaController extends Controller
{
    public function cetak()
    {
        $data['title'] = 'Laporan Data Subkriteria';
        $data['rows'] = Subkriteria::leftJoin('tb_kriteria', 'tb_kriteria.kode_kriteria', '=', 'tb_subkriteria.kode_kriteria')
            ->orderBy('tb_subkriteria.kode_kriteria')
            ->orderBy('bobot_subkriteria')
            ->get();
        return view('subkriteria.cetak', $data);
    }

    public function index(Request $request)
    {
        $title = 'Data Subkriteria';
        $rows = Subkriteria::orderBy('tb_subkriteria.kode_kriteria')
            ->orderBy('bobot_subkriteria')->get();

        $data = [];
        $kriterias = [];
        foreach (get_kriteria() as $row) {
            $data[$row->kode_kriteria] = [];
            $kriterias[$row->kode_kriteria] = $row;
        }

        foreach ($rows as $row) {
            $data[$row->kode_kriteria][] = $row;
        }

        return view('subkriteria.index', compact('title', 'data', 'kriterias'));
    }

    public function create(Request $request)
    {
        $data['title'] = 'Tambah Subkriteria';
        $data['kode_kriteria'] = $request->query('kode_kriteria');
        return view('subkriteria.create', $data);
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
            'nama_subkriteria' => 'required',
            'kode_kriteria' => 'required',
            'bobot_subkriteria' => 'required',
        ], [
            'nama_subkriteria.required' => 'Nama subkriteria harus diisi',
            'kode_kriteria.required' => 'Kriteria harus diisi',
            'bobot_subkriteria.required' => 'Bobot harus diisi',
        ]);
        $subkriteria = new Subkriteria($request->all());
        $subkriteria->save();
        return redirect('subkriteria')->with('message', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subkriteria  $subkriteria
     * @return \Illuminate\Http\Response
     */
    public function show(Subkriteria $subkriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subkriteria  $subkriteria
     * @return \Illuminate\Http\Response
     */
    public function edit(string $subkriteria)
    {
        $subkriteria = Subkriteria::findOrFail($subkriteria);
        $data['row'] = $subkriteria;
        $data['title'] = 'Ubah Subkriteria';
        return view('subkriteria.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subkriteria  $subkriteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $subkriteria)
    {
        $request->validate([
            'nama_subkriteria' => 'required',
            'kode_kriteria' => 'required',
            'bobot_subkriteria' => 'required',
        ], [
            'nama_subkriteria.required' => 'Nama subkriteria harus diisi',
            'kode_kriteria.required' => 'Kriteria harus diisi',
            'bobot_subkriteria.required' => 'Bobot harus diisi',
        ]);
        $subkriteria = Subkriteria::findOrFail($subkriteria);
        $subkriteria->nama_subkriteria = $request->nama_subkriteria;
        $subkriteria->kode_kriteria = $request->kode_kriteria;
        $subkriteria->bobot_subkriteria = $request->bobot_subkriteria;
        $subkriteria->save();
        return redirect('subkriteria')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subkriteria  $subkriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $subkriteria)
    {
        $subkriteria = Subkriteria::findOrFail($subkriteria);
        $subkriteria->delete();
        return redirect('subkriteria')->with('message', 'Data berhasil dihapus!');
    }
}
