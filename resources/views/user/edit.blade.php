@extends('layout.app')
@section('title', $title)
@section('content')
<form action="{{ route('user.update', $row) }}" method="post">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					{{show_error($errors)}}
					{{ csrf_field() }}
					{{ method_field('PUT') }}
					<div class="mb-3">
						<label>Nama user <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="nama_user" value="{{ old('nama_user', $row->nama_user) }}" />
					</div>
					<div class="mb-3">
						<label>Username <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="username" value="{{ old('username', $row->username) }}" />
					</div>
					<div class="mb-3">
						<label>Password <span class="text-danger">*</span></label>
						<input class="form-control" type="password" name="password" value="{{ old('password', $row->password) }}" />
					</div>
					<div class="mb-3">
						<label>Level <span class="text-danger">*</span></label>
						<select class="form-control" name="level">
							<?= get_level_option(old('level', $row->level)) ?>
						</select>
					</div>
					<div class="mb-3">
						<label>Status <span class="text-danger">*</span></label>
						<select class="form-control" name="status_user">
							<?= get_status_user_option(old('status_user', $row->status_user)) ?>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
			<a class="btn btn-danger" href="{{URL('user')}}"><i class="fa fa-arrow-left"></i> Kembali</a>
		</div>
	</div>
</form>
@endsection