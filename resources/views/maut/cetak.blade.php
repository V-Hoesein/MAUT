@extends('layout.print')
@section('title', $title)
@section('content')
    <h3>{{ $title }}</h3>
    <table class="table table-bordered table-hover table-striped m-0">
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Mapel</th>
                <th>NIP Guru</th>
                <th>Nama Guru</th>
                <th>Topik</th>
                <th>Model Belajar</th>
                <th>Variabel</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $key => $row)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $row->nis }}</td>
                    <td>{{ $row->nama_siswa }}</td>
                    <td>{{ $row->mapel }}</td>
                    <td>{{ $row->nip_guru }}</td>
                    <td>{{ $row->nama_guru }}</td>
                    <td>{{ $row->topik }}</td>
                    <td>{{ strtoupper($row->model_belajar) }}</td>
                    <td>{{ $row->variabel }}</td>
                    <td>{{ $row->nilai }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
