@extends('layout.app')
@section('title', $title)
@section('content')
    <form action="{{ route('nilai.store') }}" method="POST">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        {{ show_error($errors) }}
                        {{ csrf_field() }}

                        <!-- NIS -->
                        <div class="mb-3">
                            <label>NIS / Siswa<span class="text-danger">*</span></label>
                            <select class="form-control" name="nis">
                                <option value="">Pilih Siswa</option>
                                @foreach ($nis as $n)
                                    <option value="{{ $n->nis }}" {{ old('nis') == $n->nis ? 'selected' : '' }}>
                                        {{ $n->nis }} - {{ $n->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Kelas -->
                        <div class="mb-3">
                            <label>Kelas <span class="text-danger">*</span></label>
                            <select class="form-control" name="kelas">
                                <option value="">Pilih Kelas</option>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->nama }}" {{ old('kelas') == $k->nama ? 'selected' : '' }}>
                                        {{ $k->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Mapel -->
                        <div class="mb-3">
                            <label>Mapel <span class="text-danger">*</span></label>
                            <select class="form-control" name="mapel">
                                <option value="">Pilih Mapel</option>
                                @foreach ($mapel as $m)
                                    <option value="{{ $m->nama }}" {{ old('mapel') == $m->nama ? 'selected' : '' }}>
                                        {{ $m->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- NIP Guru -->
                        <div class="mb-3">
                            <label>Guru <span class="text-danger">*</span></label>
                            <select class="form-control" name="nip_guru">
                                <option value="">Pilih Guru</option>
                                @foreach ($nip_guru as $g)
                                    <option value="{{ $g->nip }}" {{ old('nip_guru') == $g->nip ? 'selected' : '' }}>
                                        {{ $g->nip }} - {{ $g->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Topik -->
                        <div class="mb-3">
                            <label>Topik <span class="text-danger">*</span></label>
                            <select class="form-control" name="topik">
                                <option value="">Pilih Topik</option>
                                @foreach ($topik as $t)
                                    <option value="{{ $t->nama }}" {{ old('topik') == $t->nama ? 'selected' : '' }}>
                                        {{ $t->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Model Belajar -->
                        <div class="mb-3">
                            <label>Model Belajar <span class="text-danger">*</span></label>
                            <select class="form-control" name="model_belajar">
                                <option value="">Pilih Model Belajar</option>
                                @foreach ($model_belajar as $mb)
                                    <option value="{{ $mb }}"
                                        {{ old('model_belajar') == $mb ? 'selected' : '' }}>
                                        {{ strtoupper($mb) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <!-- Variabel -->
                        <div class="mb-3">
                            <label>Variabel <span class="text-danger">*</span></label>
                            <select class="form-control" name="variabel">
                                <option value="">Pilih Variabel</option>
                                @foreach ($variabel as $v)
                                    <option value="{{ $v->nama }}" {{ old('variabel') == $v->nama ? 'selected' : '' }}>
                                        {{ $v->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Nilai -->
                        <div class="mb-3">
                            <label>Nilai <span class="text-danger">*</span></label>
                            <input class="form-control" type="number" name="nilai" value="{{ old('nilai') }}" />
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
