@extends('layout.app')
@section('title', $title)
@section('content')

<div class="card mb-3">
    <div class="card-header">
        <strong>
            <a href="#c_bobot_normal" data-toggle="collapse">Data Nilai</a>
        </strong>
    </div>
    <div class="table-responsive collapse" id="c_bobot_normal">
        <table class="table table-bordered table-hover table-striped m-0">
            <thead class="nw">
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <?php foreach ($kriterias as $key => $val) : ?>
                        <th><?= $val->nama_kriteria ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <?php
            foreach ($rel_alternatif as $key => $val) : ?>
                <tr>
                    <td><?= $key ?></td>
                    <td class="nw"><?= $alternatifs[$key]->nama_alternatif ?></td>
                    <?php foreach ($val as $k => $v) : ?>
                        <td><?= $v ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach; ?>
            <tfoot>
                <tr>
                    <td colspan="2">Bobot</td>
                    <?php foreach ($waspas->bobot_normal as $k => $v) : ?>
                        <td><?= round($v, 4) ?></td>
                    <?php endforeach ?>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<div class="card mb-3">
    <div class="card-header">
        <strong>
            <a href="#c_normal" data-toggle="collapse">NORMALISASI MATRIKS (MAX)</a>
        </strong>
    </div>
    <div class="table-responsive collapse" id="c_normal">
        <table class="table table-bordered table-hover table-striped m-0">
            <thead class="nw">
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <?php foreach ($kriterias as $key => $val) : ?>
                        <th><?= $val->nama_kriteria ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <?php foreach ($waspas->normal as $key => $val) : ?>
                <tr>
                    <td><?= $key ?></td>
                    <td class="nw"><?= $alternatifs[$key]->nama_alternatif ?></td>
                    <?php foreach ($val as $k => $v) : ?>
                        <td><?= round($v, 4) ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<div class="card mb-3">
    <div class="card-header">
        <strong>
            <a href="#c_terbobot" data-toggle="collapse">Terbobot : TEKNIK WSM (Qi1)</a>
        </strong>
    </div>
    <div class="table-responsive collapse" id="c_terbobot">
        <table class="table table-bordered table-hover table-striped m-0">
            <thead class="nw">
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <?php foreach ($kriterias as $key => $val) : ?>
                        <th><?= $val->nama_kriteria ?></th>
                    <?php endforeach ?>
                    <th>Qi1</th>
                </tr>
            </thead>
            <?php foreach ($waspas->terbobot as $key => $val) : ?>
                <tr>
                    <td><?= $key ?></td>
                    <td class="nw"><?= $alternatifs[$key]->nama_alternatif ?></td>
                    <?php foreach ($val as $k => $v) : ?>
                        <td><?= round($v, 4) ?></td>
                    <?php endforeach ?>
                    <td><?= round($waspas->q1[$key], 4) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<div class="card mb-3">
    <div class="card-header">
        <strong>
            <a href="#c_pangkat" data-toggle="collapse">Pangkat : TEKNIK WPM (Qi2)</a>
        </strong>
    </div>
    <div class="table-responsive collapse" id="c_pangkat">
        <table class="table table-bordered table-hover table-striped m-0">
            <thead class="nw">
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <?php foreach ($kriterias as $key => $val) : ?>
                        <th><?= $val->nama_kriteria ?></th>
                    <?php endforeach ?>
                    <th>Qi2</th>
                </tr>
            </thead>
            <?php foreach ($waspas->pangkat as $key => $val) : ?>
                <tr>
                    <td><?= $key ?></td>
                    <td class="nw"><?= $alternatifs[$key]->nama_alternatif ?></td>
                    <?php foreach ($val as $k => $v) : ?>
                        <td><?= round($v, 4) ?></td>
                    <?php endforeach ?>
                    <td><?= round($waspas->q2[$key], 4) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<div class="card mb-3">
    <div class="card-header">
        <strong>
            <a href="#c7" data-toggle="collapse">NILAI KEPENTINGAN RELATIF</a>
        </strong>
    </div>
    <div class="table-responsive collapse show" id="c7">
        <table class="table table-bordered table-hover table-striped m-0">
            <thead class="nw">
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Total Lambda: <?= $waspas->lambda ?></th>
                    <th>Rank</th>
                    <th>Hasil</th>
                </tr>
            </thead>
            <?php foreach ($waspas->rank as $key => $val) : ?>
                <tr>
                    <td><?= $key ?></td>
                    <td class="nw"><?= $alternatifs[$key]->nama_alternatif ?></td>
                    <td><?= round($waspas->total[$key], 4) ?></td>
                    <td><?= $waspas->rank[$key] ?></td>
                    <td>{{ $waspas->hasil[$key] }}</td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <div class="card-body">
        <script src="{{asset('js/highcharts.js')}}"></script>
        <script src="{{asset('js/modules/exporting.js')}}"></script>
        <script src="{{asset('js/modules/export-data.js')}}"></script>
        <script src="{{asset('js/modules/accessibility.js')}}"></script>

        <figure class="highcharts-figure">
            <div id="container"></div>
        </figure>
    </div>
    <div class="card-footer">
        <a class="btn btn-secondary" href="{{ route('hitung.waspas.cetak') }}" target="_blank"><span class="fa fa-print"></span> Cetak</a>
    </div>
</div>
<script>
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Hasil Perangkingan'
        },
        subtitle: {
            //text: 'Source: WorldClimate.com'
        },
        xAxis: {
            categories: <?= json_encode($categories) ?>,
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.4f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: <?= json_encode($series) ?>
    });
</script>
@endsection