@extends('layout.app')
@section('title', $title)
@section('content')
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body pb-1">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Data Kriteria
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $kelas }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tag fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="pt-3" {{ is_hidden('kelas.index') }}>
                        <a href="{{ route('kelas.index') }}">Selengkapnya &raquo;</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body pb-1">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Data Guru
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $guru }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="pt-3" {{ is_hidden('guru.index') }}>
                        <a href="{{ route('guru.index') }}">Selengkapnya &raquo;</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body pb-1">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Data Siswa
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $alternatif }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="pt-3" {{ is_hidden('alternatif.index') }}>
                        <a href="{{ route('alternatif.index') }}">Selengkapnya &raquo;</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body pb-1">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Data Mapel
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $mapel }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tag fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="pt-3" {{ is_hidden('mapel.index') }}>
                        <a href="{{ route('mapel.index') }}">Selengkapnya &raquo;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
