<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Rel_Alternatif;
use Illuminate\Http\Request;

class Rel_AlternatifController extends Controller
{

    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['title'] = 'Nilai Alternatif';
        $data['limit'] = 10;
        $data['rows'] = Alternatif::where('nama_alternatif', 'like', '%' . $data['q'] . '%')
            ->orderBy('kode_alternatif')
            ->paginate($data['limit'])->withQueryString();
        $data['rel_alternatif'] = get_rel_alternatif();
        $data['subkriteria'] = get_subkriteria();
        $data['kriteria_subkriteria'] = get_kriteria_subkriteria();
        $data['kriterias'] = get_kriteria();
        return view('rel_alternatif.index', $data);
    }

    public function edit(string $alternatif)
    {
        $data['alternatif'] = Alternatif::findOrFail($alternatif);
        $data['nilais'] = get_results("SELECT * FROM tb_rel_alternatif r INNER JOIN tb_kriteria k ON k.kode_kriteria=r.kode_kriteria WHERE kode_alternatif='$alternatif'");
        $data['title'] = 'Ubah Nilai Alternatif';
        $data['subkriteria'] = get_kriteria_subkriteria();
        return view('rel_alternatif.edit', $data);
    }

    public function update(Request $request, Rel_Alternatif $rel_Alternatif)
    {
        $request->validate([
            'nilai.*' => 'required',
        ], [
            'nilai.*.required' => 'Nilai :attribute harus diisi',
        ]);
        foreach ($request->nilai as $key => $val) {
            $rel_alternatif = Rel_Alternatif::find($key);
            $rel_alternatif->id_subkriteria = $val;
            $rel_alternatif->save();
        }
        return redirect('rel_alternatif')->with('message', 'Data berhasil diubah!');
    }
}
