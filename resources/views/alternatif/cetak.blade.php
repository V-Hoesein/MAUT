@extends('layout.print')
@section('title', $title)
@section('content')
<table class="table table-bordered table-hover table-striped m-0">
	<thead>
		<th>No</th>
		<th>NIS</th>
		<th>Nama</th>
		<th>Kelas</th>
	</thead>
	<?php $no = 1 ?>
	@foreach($rows as $key => $row)
	<tr>
		<td>{{ $no++ }}</td>
		<td>{{ $row->nis }}</td>
		<td>{{ $row->nama }}</td>
		<td>{{ $row->kelas }}</td>
	</tr>
	@endforeach
</table>
@endsection
