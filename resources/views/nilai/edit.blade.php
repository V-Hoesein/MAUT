@extends('layout.app')
@section('title', $title)
@section('content')
    <form action="{{ route('nilai.update', $row->id) }}" method="POST">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        {{ show_error($errors) }}
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <!-- NIS (Student ID) Field -->
                        <div class="mb-3">
                            <label>NIS <span class="text-danger">*</span></label>
                            <select class="form-control" name="nis">
                                <option value="">Pilih NIS</option>
                                @foreach($nis as $siswa)
                                    <option value="{{ $siswa->nis }}" {{ old('nis', $row->nis) == $siswa->nis ? 'selected' : '' }}>
                                        {{ $siswa->nis }} - {{ $siswa->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Mapel (Subject) Field -->
                        <div class="mb-3">
                            <label>Mapel <span class="text-danger">*</span></label>
                            <select class="form-control" name="mapel">
                                <option value="">Pilih Mapel</option>
                                @foreach($mapel as $m)
                                    <option value="{{ $m->nama }}" {{ old('mapel', $row->mapel) == $m->nama ? 'selected' : '' }}>
                                        {{ $m->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- NIP Guru (Teacher ID) Field -->
                        <div class="mb-3">
                            <label>NIP Guru <span class="text-danger">*</span></label>
                            <select class="form-control" name="nip_guru">
                                <option value="">Pilih Guru</option>
                                @foreach($nip_guru as $guru)
                                    <option value="{{ $guru->nip }}" {{ old('nip_guru', $row->nip_guru) == $guru->nip ? 'selected' : '' }}>
                                        {{ $guru->nip }} - {{ $guru->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Topik (Topic) Field -->
                        <div class="mb-3">
                            <label>Topik <span class="text-danger">*</span></label>
                            <select class="form-control" name="topik">
                                <option value="">Pilih Topik</option>
                                @foreach($topik as $t)
                                    <option value="{{ $t->nama }}" {{ old('topik', $row->topik) == $t->nama ? 'selected' : '' }}>
                                        {{ $t->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Model Belajar (Learning Model) Field -->
                        <div class="mb-3">
                            <label>Model Belajar <span class="text-danger">*</span></label>
                            <select class="form-control" name="model_belajar">
                                <option value="">Pilih Model Belajar</option>
                                @foreach($model_belajar as $model)
                                    <option value="{{ $model }}" {{ old('model_belajar', $row->model_belajar) == $model ? 'selected' : '' }}>
                                        {{ strtoupper($model) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Variabel (Variable) Field -->
                        <div class="mb-3">
                            <label>Variabel <span class="text-danger">*</span></label>
                            <select class="form-control" name="variabel">
                                <option value="">Pilih Variabel</option>
                                @foreach($variabel as $v)
                                    <option value="{{ $v->nama }}" {{ old('variabel', $row->variabel) == $v->nama ? 'selected' : '' }}>
                                        {{ $v->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Nilai (Score) Field -->
                        <div class="mb-3">
                            <label>Nilai <span class="text-danger">*</span></label>
                            <input class="form-control" type="number" name="nilai" value="{{ old('nilai', $row->nilai) }}" min="0" max="100" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                <a class="btn btn-danger" href="{{ route('nilai.index') }}"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </form>
@endsection
