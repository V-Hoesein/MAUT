@extends('layout.print')
@section('title', $title)
@section('content')
<table class="table table-bordered table-hover table-striped m-0">
    <thead>
        <th>No</th>
        <th>Nama user</th>
        <th>Username</th>
        <th>Level</th>
        <th>Status</th>
    </thead>
    @foreach($rows as $key => $row)
    <tr>
        <td>{{ $no++ }}</td>
        <td>{{ $row->nama_user }}</td>
        <td>{{ $row->username }}</td>
        <td>{{ $row->level }}</td>
        <td>{{ $row->status_user ? 'Aktif' : 'NonAktif' }}</td>
    </tr>
    @endforeach
</table>
@endsection