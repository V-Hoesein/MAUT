@extends('layout.app')
@section('title', $title)
@section('content')
<form action="{{ route('rel_alternatif.update', $alternatif) }}" method="post">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					{{show_error($errors)}}
					{{ csrf_field() }}
					{{ method_field('PUT') }}
					<div class="mb-3">
						<label>Kode alternatif <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="kode_alternatif" value="{{ old('kode_alternatif', $alternatif->kode_alternatif) }}" readonly>
					</div>
					<div class="mb-3">
						<label>Nama alternatif <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="nama_alternatif" value="{{ old('nama_alternatif', $alternatif->nama_alternatif) }}" readonly>
					</div>
					@foreach($nilais as $nilai)
					<div class="mb-3">
						<label> {{ $nilai->nama_kriteria }} </label>
						@if(isset($subkriteria[$nilai->kode_kriteria]))
						<select class="form-control" name="nilai[{{ $nilai->ID }}]">
							<?= get_subkriteria_option($nilai->kode_kriteria, $nilai->id_subkriteria) ?>
						</select>
						@else
						<input class="form-control" type="text" name="nilai[{{ $nilai->ID }}]" value="{{ old('nilai' . $nilai->ID, $nilai->id_subkriteria) }}">
						@endif
					</div>
					@endforeach
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
			<a class="btn btn-danger" href="{{ route('rel_alternatif.index')}}"><i class="fa fa-arrow-left"></i> Kembali</a>
		</div>
	</div>
</form>
@endsection