@extends('layout.print')
@section('title', $title)
@section('content')
<table class="table table-bordered table-hover table-striped m-0">
	<thead>
		<th>No</th>
		<th>Nama</th>
		<th>NIP</th>
		<th>Kelas</th>
		<th>Mapel</th>
	</thead>
	<?php $no = 1 ?>
	@foreach($rows as $key => $row)
	<tr>
		<td>{{ $no++ }}</td>
		<td>{{ $row->nama }}</td>
		<td>{{ $row->nip }}</td>
		<td>{{ $row->kelas }}</td>
		<td>{{ $row->mapel }}</td>
	</tr>
	@endforeach
</table>
@endsection
