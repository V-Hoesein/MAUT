@extends('layout.app')
@section('title', $title)
@section('content')
{{ show_msg() }}
<div class="card mb-3">
    <div class="card-header">
        <strong class="card-title">
            <a href="#kriteria" data-toggle="collapse">Kriteria</a>
        </strong>
    </div>
    <div class="card-body p-0 table-responsive collapse" id="kriteria">
        <table class="table table-bordered table-hover table-striped m-0">
            <thead>
                <th>Kode</th>
                <th>Nama</th>
                <th>Atribut</th>
                <th>Bobot</th>
                <th>Normalisasi Bobot</th>
            </thead>
            @foreach($kriterias as $key => $val)
            <tr>
                <td>{{ $key }}</td>
                <td>{{ $val->nama_kriteria }}</td>
                <td>{{ $val->atribut }}</td>
                <td>{{ round($val->bobot, 4) }}</td>
                <td>{{ round($maut->bobot_normal[$key], 4) }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
        <strong class="card-title">
            <a href="#rel_alternatif" data-toggle="collapse">Data Alternatif</a>
        </strong>
    </div>
    <div class="card-body p-0 table-responsive collapse" id="rel_alternatif">
        <table class="table table-bordered table-hover table-striped m-0">
            <thead>
                <th>Kode</th>
                <th>Nama</th>
                @foreach($kriterias as $key => $val)
                <th>{{ $val->nama_kriteria }}</th>
                @endforeach
            </thead>
            @foreach($rel_alternatif as $key => $val)
            <tr>
                <td>{{ $key }}</td>
                <td>{{ $alternatifs[$key]->nama_alternatif }}</td>
                @foreach($val as $k => $v)
                <td>{{ $v }}</td>
                @endforeach
            </tr>
            @endforeach
        </table>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
        <strong class="card-title">
            <a href="#normal" data-toggle="collapse">Normalisasi</a>
        </strong>
    </div>
    <div class="card-body p-0 table-responsive collapse" id="normal">
        <table class="table table-bordered table-hover table-striped m-0">
            <thead>
                <th>Kode</th>
                @foreach($kriterias as $key => $val)
                <th>{{ $key }}</th>
                @endforeach
            </thead>
            @foreach($maut->normal as $key => $val)
            <tr>
                <td>{{ $key }}</td>
                @foreach($val as $k => $v)
                <td>{{ round($v, 4) }}</td>
                @endforeach
            </tr>
            @endforeach
        </table>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
        <strong class="card-title">
            <a href="#terbobot" data-toggle="collapse">Terbobot</a>
        </strong>
    </div>
    <div class="card-body p-0 table-responsive collapse" id="terbobot">
        <table class="table table-bordered table-hover table-striped m-0">
            <thead>
                <th>Kode</th>
                @foreach($kriterias as $key => $val)
                <th>{{ $key }}</th>
                @endforeach
            </thead>
            @foreach($maut->terbobot as $key => $val)
            <tr>
                <td>{{ $key }}</td>
                @foreach($val as $k => $v)
                <td>{{ round($v, 4) }}</td>
                @endforeach
            </tr>
            @endforeach
        </table>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
        <strong class="card-title">Perangkingan</strong>
    </div>
    <div class="card-body p-0 table-responsive">
        <table class="table table-bordered table-hover table-striped m-0">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Total</th>
                    <th>Hasil</th>
                </tr>
            </thead>
            @foreach($maut->rank as $key => $val)
            <tr>
                <td>{{ $val }}</td>
                <td>{{ $key }}</td>
                <td>{{ $alternatifs[$key]->nama_alternatif }}</td>
                <td>{{ round($maut->total[$key], 4) }}</td>
                <td>{{ $maut->hasil[$key] }}</td>
            </tr>
            @endforeach
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
        <a class="btn btn-secondary" href="{{ route('hitung.maut.cetak') }}" target="_blank"><span class="fa fa-print"></span> Cetak</a>
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