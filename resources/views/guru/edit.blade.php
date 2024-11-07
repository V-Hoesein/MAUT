@extends('layout.app')
@section('title', $title)
@section('content')
    <form action="{{ route('mapel.update', $row->id) }}" method="POST">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        {{ show_error($errors) }}
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="mb-3">
                            <label>Nama <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="nama" value="{{ old('nama', $row->nama) }}" />
                        </div>
                        <div class="mb-3">
                            <label>NIP <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="nip" value="{{ old('nip', $row->nip) }}" />
                        </div>
                        <div class="mb-3">
                            <label>Kelas <span class="text-danger">*</span></label>
                            <select class="form-control" name="kelas">
                                <option value="">Pilih kelas</option>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->nama }}" {{ old('kelas', $row->kelas) == $k->nama ? 'selected' : '' }}>
                                        {{ $k->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Mapel <span class="text-danger">*</span></label>
                            <select class="form-control" name="mapel">
                                <option value="">Pilih Mapel</option>
                                @foreach ($mapel as $m)
                                    <option value="{{ $m->nama }}" {{ old('mapel', $row->mapel) == $m->nama ? 'selected' : '' }}>
                                        {{ $m->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                <a class="btn btn-danger" href="{{ route('guru.index') }}"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </form>
@endsection
