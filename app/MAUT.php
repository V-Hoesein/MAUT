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
                            $key = "{$kls['nama']}_{$mpl['nama']}_{$tpk['nama']}_{$mdl}_{$vrb['nama']}";
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

        $utilities = [];

        $nilai = json_decode(json_encode(
            DB::table('nilai as n')
                ->select('s.kelas', 'n.mapel', 'g.nama as nama_guru', 'n.topik', 'n.model_belajar', 'n.variabel', 's.nama as nama_siswa', DB::raw('n.nilai * 0.01 as nilai'))
                ->join('siswa as s', 'n.nis', '=', 's.nis')
                ->join('guru as g', 'n.nip_guru', '=', 'g.nip')
                ->get()
        ), true);

        foreach ($nilai as &$entry) {
            foreach ($minMax as $range) {
                if (
                    $entry['kelas'] === $range['kelas'] &&
                    $entry['mapel'] === $range['mapel'] &&
                    $entry['topik'] === $range['topik'] &&
                    $entry['model_belajar'] === $range['model'] &&
                    $entry['variabel'] === $range['variabel']
                ) {
                    $nilaiMIN = $range['nilaiMIN'];
                    $nilaiMAX = $range['nilaiMAX'];

                    if ($nilaiMAX != $nilaiMIN) {
                        $entry['nilai_normalized'] = ($entry['nilai'] - $nilaiMIN) / ($nilaiMAX - $nilaiMIN);
                    } else {
                        $entry['nilai_normalized'] = 0;
                    }
                    break;
                }
            }

            foreach ($variabel as $vrb) {
                if ($entry['variabel'] === $vrb['nama']) {
                    $entry['weighted_value'] = $entry['nilai_normalized'] * $vrb['bobot'];
                    break;
                }
            }
        }

        // Menghitung nilai total MAUT untuk setiap kombinasi kelas, mapel, dan topik
        $totalMAUT = [];

        foreach ($nilai as $entry) {
            $key = "{$entry['kelas']}_{$entry['mapel']}_{$entry['topik']}";

            if (!isset($totalMAUT[$key])) {
                $totalMAUT[$key] = [
                    'kelas' => $entry['kelas'],
                    'mapel' => $entry['mapel'],
                    'topik' => $entry['topik'],
                    'total_weighted_value' => 0
                ];
            }

            $totalMAUT[$key]['total_weighted_value'] += $entry['weighted_value'];
        }

        $totalMAUT = array_values($totalMAUT);

        var_dump($totalMAUT);

        die;

        return $queryBuilder;
    }
}
