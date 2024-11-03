@extends('layout.app')
@section('title', $title)
@section('content')
{{ show_msg() }}
<div class="card card-primary card-outline">
    <div class="card-header">
        <form class="form-inline">
            <div class="form-group mr-1">
                <input class="form-control" type="text" name="q" value="{{ $q }}" placeholder="Pencarian..." />
            </div>
            <div class="form-group mr-1">
                <button class="btn btn-success"><i class="fa fa-search"></i> Cari</button>
            </div>
            <div class="form-group mr-1" {{ is_hidden('hitung.hasil.cetak') }}>
                <a class="btn btn-secondary" href="{{ route('hitung.hasil.cetak') }}" target="_blank"><span class="fa fa-print"></span> Cetak</a>
            </div>
        </form>
    </div>
    <div class="card-body p-0 table-responsive">
        <table class="table table-bordered table-hover table-striped m-0">
            <thead>
                <th>No</th>
                <th>Kode</th>
                <th>Nama alternatif</th>
                <th>Keterangan</th>
                <th>Rank MAUT</th>
                <th>Total MAUT</th>
                <th>Hasil MAUT</th>
                <th>Rank WASPAS</th>
                <th>Total WASPAS</th>
                <th>Hasil WASPAS</th>
            </thead>
            @foreach($rows as $key => $row)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $row->kode_alternatif }}</td>
                <td>{{ $row->nama_alternatif }}</td>
                <td>{{ $row->keterangan }}</td>
                <td>{{ $row->maut_rank }}</td>
                <td>{{ round($row->maut_total, 4) }}</td>
                <td>{{ $row->maut_hasil }}</td>
                <td>{{ $row->waspas_rank }}</td>
                <td>{{ round($row->waspas_total, 4) }}</td>
                <td>{{ $row->waspas_hasil }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection