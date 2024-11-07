@extends('layout.app')
@section('title', $title)
@section('content')
    <form action="{{ route('alternatif.store') }}" method="POST">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        {{ show_error($errors) }}
                        {{ csrf_field() }}
                        <div class="mb-3">
                            <label>NIS<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="nis" value="{{ old('nis') }}" />
                        </div>
                        <div class="mb-3">
                            <label>Nama Siswa <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="nama" value="{{ old('nama') }}" />
                        </div>
                        <div class="mb-3">
                            <label>Kelas <span class="text-danger">*</span></label>
                            <select class="form-control" name="kelas">
                                <option value="">Pilih Kelas</option>
                                @foreach($kelas as $k)
                                    <option value="{{ $k->nama }}" {{ old('kelas') == $k->nama ? 'selected' : '' }}>
                                        {{ $k->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                <a class="btn btn-danger" href="{{ route('alternatif.index') }}"><i class="fa fa-arrow-left"></i>
                    Kembali</a>
            </div>
        </div>
    </form>
@endsection
