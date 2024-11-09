@extends('layout.app')
@section('title', $title)
@section('content')
    {{ show_msg() }}
    <h4 class="card-title font-weight-bold text-primary mb-3">Nilai MIN dan MAX Variabel</h3>
        <div class="card card-primary card-outline">
            <div class="card-header d-flex justify-content-between">
                <div class="form-group">
                    <div class="btn-group" role="group">
                        <div class="form-group mr-1" {{ is_hidden('maut.create') }}>
                            <a class="btn btn-primary" href="{{ route('maut.create') }}"><i class="fa fa-plus"></i> Tambah</a>
                        </div>
                        <div class="form-group mr-1" {{ is_hidden('maut.cetak') }}>
                            <a class="btn btn-secondary" href="{{ route('maut.cetak') }}" target="_blank">
                                <span class="fa fa-print"></span> Cetak</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0 table-responsive">
                <table class="table table-bordered table-hover table-striped m-0">
                    <thead>
                        <th>No</th>
                        <th>Kelas</th>
                        <th>Mapel</th>
                        <th>Topik</th>
                        <th>Model Belajar</th>
                        <th>Variabel</th>
                        <th>Nilai MIN</th>
                        <th>Nilai MAX</th>
                    </thead>
                    @foreach ($rows['minMax'] as $index => $row)
                        <tr>
                            <td>
                                {{ $index + 1 }}
                            </td>
                            <td>{{ $row['kelas'] }}</td>
                            <td>{{ $row['mapel'] }}</td>
                            <td>{{ $row['topik'] }}</td>
                            <td>{{ $row['model'] }}</td>
                            <td>{{ $row['variabel'] }}</td>
                            <td>{{ $row['nilaiMIN'] }}</td>
                            <td>{{ $row['nilaiMAX'] }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

        <h4 class="card-title font-weight-bold text-primary mb-3 mt-3">Nilai Utility</h3>
            <div class="card card-primary card-outline">
                <div class="card-header d-flex justify-content-between">
                    <div class="form-group">
                        <div class="btn-group" role="group">
                            <div class="form-group mr-1" {{ is_hidden('maut.create') }}>
                                <a class="btn btn-primary" href="{{ route('maut.create') }}"><i class="fa fa-plus"></i>
                                    Tambah</a>
                            </div>
                            <div class="form-group mr-1" {{ is_hidden('maut.cetak') }}>
                                <a class="btn btn-secondary" href="{{ route('maut.cetak') }}" target="_blank">
                                    <span class="fa fa-print"></span> Cetak</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0 table-responsive">
                    <table class="table table-bordered table-hover table-striped m-0">
                        <thead>
                            <th>No</th>
                            <th>Kelas</th>
                            <th>Mapel</th>
                            {{-- <th>Guru</th> --}}
                            <th>Topik</th>
                            {{-- <th>Model Belajar</th> --}}
                            {{-- <th>Variabel</th> --}}
                            {{-- <th>Nama Siswa</th> --}}
                            {{-- <th>Nilai</th> --}}
                            {{-- <th>Normalisasi</th> --}}
                            {{-- <th>Utility</th> --}}
                        </thead>
                        @foreach ($rows['nilai'] as $index => $row)
                            <tr>
                                <td>
                                    {{ $index + 1 }}
                                </td>
                                <td>{{ $row['kelas'] }}</td>
                                <td>{{ $row['mapel'] }}</td>
                                {{-- <td>{{ $row['nama_guru'] }}</td> --}}
                                <td>{{ $row['topik'] }}</td>
                                {{-- <td>{{ $row['model_belajar'] }}</td> --}}
                                {{-- <td>{{ $row['variabel'] }}</td> --}}
                                {{-- <td>{{ $row['nama_siswa'] }}</td> --}}
                                {{-- <td>{{ $row['nilai'] }}</td> --}}
                                {{-- <td>{{ $row['nilai_normalized'] }} </td> --}}
                                {{-- <td>{{ $row['weighted_value'] }}</td> --}}
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        @endsection
