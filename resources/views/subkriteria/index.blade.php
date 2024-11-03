@extends('layout.app')
@section('title', $title)
@section('content')
{{ show_msg() }}
@foreach($data as $key => $val)
<div class="card mb-3">
	<div class="card-header">
		<strong>{{ $kriterias[$key]->nama_kriteria }}</strong>

		<div class="float-right">
			<a class="btn btn-sm btn-primary" href="{{ route('subkriteria.create', ['kode_kriteria' => $key]) }}"><i class="fa fa-plus"></i> Tambah</a>
		</div>
	</div>
	<div class="card-body p-0 table-responsive">
		<table class="table table-bordered table-hover table-striped m-0">
			<thead>
				<th>No</th>
				<th>Nama</th>
				<th>Bobot</th>
				<th>Aksi</th>
			</thead>
			@foreach($val as $k => $v)
			<tr>
				<td>{{ $k + 1 }}</td>
				<td>{{ $v->nama_subkriteria }}</td>
				<td>{{ round($v->bobot_subkriteria, 4) }}</td>
				<td>
					<a class="btn btn-sm btn-info" href="{{ route('subkriteria.edit', $v) }}" {{ is_hidden('subkriteria.edit') }}><i class="fa fa-edit"></i> Ubah</a>
					<form action="{{ route('subkriteria.destroy', $v) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Hapus Data?')" {{ is_hidden('subkriteria.destroy') }}>
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
						<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</button>
					</form>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
</div>
@endforeach
@endsection