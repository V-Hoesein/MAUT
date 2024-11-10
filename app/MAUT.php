<?php
namespace App;

use Illuminate\Support\Facades\DB;

class MAUT
{
    public function calculate(): array
    {
        $kelas = $this->fetchData('kelas');
        $mapel = $this->fetchData('mapel');
        $topik = $this->fetchData('topik');
        $model = ['pbl', 'pjbl', 'ctl', 'ibl', 'dl'];
        $variabel = $this->fetchData('variabel');

        $queryBuilder = $this->buildQueryKeys($kelas, $mapel, $topik, $model, $variabel);
        $minMax = $this->calculateMinMaxValues($queryBuilder);
        $nilai = $this->normalizeValues($minMax, $variabel);
        $totalMAUT = $this->calculateTotalMAUT($nilai);

        // Use calculateAverageByModelBelajar to get averages and max values
        $averageMAUT = $this->calculateAverageByModelBelajar($totalMAUT);

        // Optional: Sort averages by 'average_value' in descending order
        usort($averageMAUT['averages'], function ($a, $b) {
            return $b['average_value'] <=> $a['average_value'];
        });

        return [
            'minMax' => $minMax,
            'nilai' => $nilai,
            'totalMAUT' => $totalMAUT,
            'averageMAUT' => $averageMAUT,
        ];
    }

    /**
     * Calculate average values by model and identify the highest model per mapel.
     */
    private function calculateAverageByModelBelajar($data)
    {
        $averages = [];
        $maxValuesByMapel = [];

        foreach ($data as $values) {
            $mapel = $values['mapel'];
            $modelBelajar = $values['model_belajar'];
            $totalWeightedValue = $values['total_weighted_value'];

            $uniqueKey = $mapel . '_' . $modelBelajar;

            if (!isset($averages[$uniqueKey])) {
                $averages[$uniqueKey] = [
                    'mapel' => $mapel,
                    'model_belajar' => $modelBelajar,
                    'total_value' => 0,
                    'count' => 0,
                ];
            }

            $averages[$uniqueKey]['total_value'] += $totalWeightedValue;
            $averages[$uniqueKey]['count']++;
        }

        $results = [];
        foreach ($averages as $values) {
            $average = $values['total_value'] / $values['count'];
            $results[] = [
                'mapel' => $values['mapel'],
                'model_belajar' => $values['model_belajar'],
                'total_value' => $values['total_value'],
                'count' => $values['count'],
                'average_value' => $average,
            ];

            // Track the highest average value for each mapel
            if (!isset($maxValuesByMapel[$values['mapel']]) || $average > $maxValuesByMapel[$values['mapel']]['average_value']) {
                $maxValuesByMapel[$values['mapel']] = [
                    'model_belajar' => $values['model_belajar'],
                    'average_value' => $average,
                ];
            }
        }

        return [
            'averages' => $results,
            'maxValuesByMapel' => $maxValuesByMapel,
        ];
    }


    private function fetchData(string $table): array
    {
        return array_map(fn($item) => (array) $item, DB::table($table)->get()->toArray());
    }

    private function buildQueryKeys(array $kelas, array $mapel, array $topik, array $model, array $variabel): array
    {
        $queryBuilder = [];

        foreach ($kelas as $kls) {
            foreach ($mapel as $mpl) {
                foreach ($topik as $tpk) {
                    foreach ($model as $mdl) {
                        foreach ($variabel as $vrb) {
                            $key = "{$kls['nama']}_{$mpl['nama']}_{$tpk['nama']}_{$mdl}_{$vrb['nama']}";
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

        return array_values($queryBuilder);
    }

    private function calculateMinMaxValues(array $queryBuilder): array
    {
        $minMax = [];

        foreach ($queryBuilder as $value) {
            $dataMIN = $this->fetchMinMaxData($value, 'asc');
            $dataMAX = $this->fetchMinMaxData($value, 'desc');

            if ($dataMIN && $dataMAX) {
                $minMax[] = [
                    'mapel' => $dataMIN->mapel,
                    'topik' => $dataMIN->topik,
                    'model' => $dataMIN->model_belajar,
                    'variabel' => $dataMIN->variabel,
                    'kelas' => $dataMIN->kelas,
                    'nilaiMIN' => $dataMIN->nilai,
                    'nilaiMAX' => $dataMAX->nilai
                ];
            }
        }

        return $minMax;
    }

    private function fetchMinMaxData(array $value, string $order): ?object
    {
        return DB::table('nilai as n')
            ->select('n.*', DB::raw('n.nilai * 0.01 as nilai'), 's.nama', 's.kelas', 'g.nama as guru')
            ->join('siswa as s', 'n.nis', '=', 's.nis')
            ->join('guru as g', 'n.nip_guru', '=', 'g.nip')
            ->where('s.kelas', $value['kelas'])
            ->where('n.mapel', $value['mapel'])
            ->where('n.topik', $value['topik'])
            ->where('n.model_belajar', $value['model'])
            ->where('n.variabel', $value['variabel'])
            ->orderBy('n.nilai', $order)
            ->limit(1)
            ->first();
    }

    private function normalizeValues(array $minMax, array $variabel): array
    {
        $nilai = json_decode(json_encode(
            DB::table('nilai as n')
                ->select('s.kelas', 'n.mapel', 'g.nama as nama_guru', 'n.topik', 'n.model_belajar', 'n.variabel', 's.nama as nama_siswa', DB::raw('n.nilai * 0.01 as nilai'))
                ->join('siswa as s', 'n.nis', '=', 's.nis')
                ->join('guru as g', 'n.nip_guru', '=', 'g.nip')
                ->get()
        ), true);

        foreach ($nilai as &$entry) {
            $this->applyNormalization($entry, $minMax);
            $this->applyWeighting($entry, $variabel);
        }

        return $nilai;
    }

    private function applyNormalization(array &$entry, array $minMax): void
    {
        foreach ($minMax as $range) {
            if ($this->isMatchingRange($entry, $range)) {
                $entry['nilai_normalized'] = $this->normalizeValue($entry['nilai'], $range['nilaiMIN'], $range['nilaiMAX']);
                break;
            }
        }
    }

    private function isMatchingRange(array $entry, array $range): bool
    {
        return (
            $entry['kelas'] === $range['kelas'] &&
            $entry['mapel'] === $range['mapel'] &&
            $entry['topik'] === $range['topik'] &&
            $entry['model_belajar'] === $range['model'] &&
            $entry['variabel'] === $range['variabel']
        );
    }

    private function normalizeValue(float $nilai, float $nilaiMIN, float $nilaiMAX): float
    {
        return $nilaiMAX != $nilaiMIN ? ($nilai - $nilaiMIN) / ($nilaiMAX - $nilaiMIN) : 0;
    }

    private function applyWeighting(array &$entry, array $variabel): void
    {
        foreach ($variabel as $vrb) {
            if ($entry['variabel'] === $vrb['nama']) {
                $entry['weighted_value'] = $entry['nilai_normalized'] * $vrb['bobot'];
                break;
            }
        }
    }

    private function calculateTotalMAUT(array $nilai): array
    {
        $totalMAUT = [];

        foreach ($nilai as $entry) {
            $key = "{$entry['kelas']}_{$entry['mapel']}_{$entry['topik']}_{$entry['model_belajar']}";

            if (!isset($totalMAUT[$key])) {
                $totalMAUT[$key] = [
                    'kelas' => $entry['kelas'],
                    'mapel' => $entry['mapel'],
                    'topik' => $entry['topik'],
                    'model_belajar' => $entry['model_belajar'],
                    'total_weighted_value' => 0
                ];
            }

            $totalMAUT[$key]['total_weighted_value'] += $entry['weighted_value'];
        }

        return $totalMAUT;
    }

    private function calculateAverageMAUT(array $totalMAUT): array
    {
        $averageMAUT = [];

        foreach ($totalMAUT as $entry) {
            $model = $entry['model_belajar'];

            if (!isset($averageMAUT[$model])) {
                $averageMAUT[$model] = [
                    'model_belajar' => $model,
                    'total_value' => 0,
                    'count' => 0
                ];
            }

            $averageMAUT[$model]['total_value'] += $entry['total_weighted_value'];
            $averageMAUT[$model]['count'] += 1;
        }

        foreach ($averageMAUT as &$entry) {
            $entry['average_value'] = $entry['total_value'] / $entry['count'];
        }

        usort($averageMAUT, fn($a, $b) => $b['average_value'] <=> $a['average_value']);

        return $averageMAUT;
    }
}
