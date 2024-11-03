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
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $kriteria_count }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-tag fa-2x text-gray-300"></i>
                    </div>
                </div>
                <div class="pt-3" {{ is_hidden('kriteria.index') }}>
                    <a href="{{ route('kriteria.index') }}">Selengkapnya &raquo;</a>
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
                            Data Alternatif
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $alternatif_count }}</div>
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
                            Hasil Akhir
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">MAUT</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-tag fa-2x text-gray-300"></i>
                    </div>
                </div>
                <div class="pt-3" {{ is_hidden('hitung.hasil') }}>
                    <a href="{{ route('hitung.hasil') }}">Selengkapnya &raquo;</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection