@extends('layout.print')
@section('title', $title)
@section('content')
<table class="table table-bordered table-hover table-striped m-0">
	<thead>
		<th>No</th>
		<th>Nama kriteria</th>
		<th>Bobot</th>
	</thead>
	<?php $no = 1 ?>
	@foreach($rows as $key => $row)
	<tr>
		<td>{{ $no++ }}</td>
		<td>{{ $row->nama }}</td>
		<td>{{ $row->bobot }}</td>
	</tr>
	@endforeach
</table>
@endsection
