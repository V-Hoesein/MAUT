@extends('layout.app')
@section('title', $title)
@section('content')
<form action="{{ URL('kriteria') }}" method="POST">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					{{ show_error($errors) }}
					{{ csrf_field() }}
					<div class="mb-3">
						<label>Nama kriteria <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="nama" value="{{ old('nama') }}" />
					</div>
					<div class="mb-3">
						<label>Bobot <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="bobot" value="{{ old('bobot') }}" />
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
			<a class="btn btn-danger" href="{{ route('kriteria.index') }}"><i class="fa fa-arrow-left"></i> Kembali</a>
		</div>
	</div>
</form>
@endsection
