@extends('layout.app')
@section('title', $title)
@section('content')
<form action="{{ route('rel_alternatif.import_action') }}" method="POST" enctype="multipart/form-data">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    {{ show_error($errors) }}
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label>File (*.xls, *.xlsx) <span class="text-danger">*</span></label>
                        <input class="form-control" type="file" name="file" />
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary"><i class="fa fa-save"></i> Import</button>
            <a class="btn btn-danger" href="{{ route('rel_alternatif.index') }}"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </div>
</form>
@endsection