@extends('layout.print')
@section('title', $title)
@section('content')

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
@endsection