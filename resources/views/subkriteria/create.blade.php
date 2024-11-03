@extends('layout.app')
@section('title', $title)
@section('content')
<form action="{{ route('subkriteria.store') }}" method="POST">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					{{ show_error($errors) }}
					{{ csrf_field() }}
					<div class="mb-3">
						<label>Kriteria <span class="text-danger">*</span></label>
						<select class="form-control" name="kode_kriteria">
							<?= get_kriteria_option(old('kode_kriteria', $kode_kriteria)) ?>
						</select>
					</div>
					<div class="mb-3">
						<label>Nama <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="nama_subkriteria" value="{{ old('nama_subkriteria') }}" />
					</div>
					<div class="mb-3">
						<label>Bobot <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="bobot_subkriteria" value="{{ old('bobot_subkriteria') }}" />
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
			<a class="btn btn-danger" href="{{ route('subkriteria.index') }}"><i class="fa fa-arrow-left"></i> Kembali</a>
		</div>
	</div>
</form>
@endsection