<?php

namespace App;

use Illuminate\Support\Facades\DB;

class MAUT
{
    public function calculate(): array
    {
        $kelas = array_map(fn($kelas) => (array) $kelas, DB::table('kelas')->get()->toArray());
        $mapel = array_map(fn($mapel) => (array) $mapel, DB::table('mapel')->get()->toArray());
        $topik = array_map(fn($topik) => (array) $topik, DB::table('topik')->get()->toArray());
        $model = ['pbl', 'pjbl', 'ctl', 'ibl', 'dl'];
        $variabel = array_map(fn($variabel) => (array) $variabel, DB::table('variabel')->get()->toArray());

        $queryBuilder = [];

        foreach ($kelas as $kls) {

            foreach ($mapel as $mpl) {
                foreach ($topik as $tpk) {
                    foreach ($model as $mdl) {
                        foreach ($variabel as $vrb) {

                            // Create a unique key based on the values to prevent duplicates
                            $key = "{$kls['nama']}_{$mpl['nama']}_{$tpk['nama']}_{$mdl}_{$vrb['nama']}";

                            // Only add if the key doesn't already exist
                            if (!isset($queryBuilder[$key])) {
                                $queryBuilder[$key] = [
                                    'kelas' => $kls['nama'],
                                    'mapel' => $mpl['nama'],
                                    'topik' => $tpk['nama'],
                                    'model' => $mdl,
                                    'variabel' => $vrb['nama'],
                                ];
                            }
                        }
                    }
                }
            }
        }

        $queryBuilder = array_values($queryBuilder);
        // var_dump($queryBuilder);

        $minMax = [];

        foreach ($queryBuilder as $key => $value) {
            $dataMIN = DB::table('nilai as n')
                ->select('n.*', DB::raw('n.nilai * 0.01 as nilai'), 's.nama', 's.kelas', 'g.nama as guru')
                ->join('siswa as s', 'n.nis', '=', 's.nis')
                ->join('guru as g', 'n.nip_guru', '=', 'g.nip')
                ->where('s.kelas', $value['kelas'])
                ->where('n.mapel', $value['mapel'])
                ->where('n.topik', $value['topik'])
                ->where('n.model_belajar', $value['model'])
                ->where('n.variabel', $value['variabel'])
                ->orderBy('n.nilai', 'asc')
                ->limit(1)
                ->first();

            $dataMAX = DB::table('nilai as n')
                ->select('n.*', DB::raw('n.nilai * 0.01 as nilai'), 's.nama', 's.kelas', 'g.nama as guru')
                ->join('siswa as s', 'n.nis', '=', 's.nis')
                ->join('guru as g', 'n.nip_guru', '=', 'g.nip')
                ->where('s.kelas', $value['kelas'])
                ->where('n.mapel', $value['mapel'])
                ->where('n.topik', $value['topik'])
                ->where('n.model_belajar', $value['model'])
                ->where('n.variabel', $value['variabel'])
                ->orderBy('n.nilai', 'desc')
                ->limit(1)
                ->first();

            if ($dataMIN && $dataMAX) {
                $found = [
                    'mapel' => $dataMIN->mapel,
                    'topik' => $dataMIN->topik,
                    'model' => $dataMIN->model_belajar,
                    'variabel' => $dataMIN->variabel,
                    'kelas' => $dataMIN->kelas,
                    'nilaiMIN' => $dataMIN->nilai,
                    'nilaiMAX' => $dataMAX->nilai
                ];

                $minMax[] = $found;
            }
        }

        var_dump($minMax);

        die;

        return $queryBuilder;
    }

}
