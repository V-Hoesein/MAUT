@extends('layout.print')
@section('title', $title)
@section('content')
<table class="table table-bordered table-hover table-striped m-0">
    <thead>
        <th>Rank</th>
        <th>Kode</th>
        <th>Nama</th>
        <th>Total</th>
        <th>Hasil</th>
    </thead>
    @foreach($rows as $row)
    <tr>
        <td>{{ $row->maut_rank }}</td>
        <td>{{ $row->kode_alternatif }}</td>
        <td>{{ $row->nama_alternatif }}</td>
        <td>{{ round($row->maut_total, 4) }}</td>
        <td>{{ $row->maut_hasil }}</td>
    </tr>
    @endforeach
</table>
@endsection