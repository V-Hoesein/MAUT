@extends('layout.app')
@section('title', $title)
@section('content')
<form action="{{ URL('topik') }}" method="POST">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					{{ show_error($errors) }}
					{{ csrf_field() }}
					<div class="mb-3">
						<label>Topik pembelajaran <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="nama" value="{{ old('nama') }}" />
					</div>
					<div class="mb-3">
                        <label>Mapel <span class="text-danger">*</span></label>
                        <select class="form-control" name="nama_mapel">
                            <option value="">Pilih Mapel</option>
                            @foreach($mapel as $mpl)
                                <option value="{{ $mpl->nama }}" {{ old('nama_mapel') == $mpl->nama ? 'selected' : '' }}>
                                    {{ $mpl->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
			<a class="btn btn-danger" href="{{ route('topik.index') }}"><i class="fa fa-arrow-left"></i> Kembali</a>
		</div>
	</div>
</form>
@endsection
