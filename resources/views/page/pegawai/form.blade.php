@extends('layouts.app')

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Pegawai</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
                        <!-- <li class="breadcrumb-item active" aria-current="page"></li> -->
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="card">

        <form class="form-horizontal" action="{{ route($url, $pegawai->id ?? null) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($pegawai))
            @method('put')
            @endif
            <div class="card-body">
                <h4 class="card-title text-center">Pegawai</h4>
                <hr>
                <div class="form-group">
                    <label>NIP</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('nip') {{ 'is-invalid' }} @enderror" name="nip" value="{{ old('nip') ?? $pegawai->nip ?? '' }}">
                        
                        @error('nip')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('nama_peg') {{ 'is-invalid' }} @enderror" name="nama_peg" value="{{ old('nama_peg') ?? $pegawai->nama_peg ?? '' }}">
                        
                        @error('nama_peg')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('nama_peg') {{ 'is-invalid' }} @enderror" name="nama_peg" value="{{ old('nama_peg') ?? $pegawai->nama_peg ?? '' }}">
                        
                        @error('nama_peg')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Jabatan</label>
                    <select name="jabatan_id" id="jabatan_id"
                        class="form-control @error('jabatan_id') {{ 'is-invalid' }} @enderror">
                        <option value="">-Pilih-</option>
                        @foreach($jabatan as $no => $jabatan)
                            <option value="{{ $jabatan->id_jabatan }}">
                            {{ $jabatan->nama_jabatan }}</option>
                        @endforeach
                    </select>
                    @if(isset($pegawai))
                    <script>
                        document.getElementById('jabatan_id').value =
                            '<?php echo $pegawai->jabatan_id ?>'
                    </script>
                    @endif
                    @error('jabatan_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <div class="input-group">
                        <input type="email" class="form-control @error('Email') {{ 'is-invalid' }} @enderror" name="Email" value="{{ old('Email') ?? $pegawai->Email ?? '' }}">
                        
                        @error('Email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>No Telpon</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('no_tlp') {{ 'is-invalid' }} @enderror" name="no_tlp" value="{{ old('no_tlp') ?? $pegawai->no_tlp ?? '' }}">
                        
                        @error('no_tlp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('alamat') {{ 'is-invalid' }} @enderror" name="alamat" value="{{ old('alamat') ?? $pegawai->alamat ?? '' }}">
                        
                        @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Tanggal Masuk</label>
                    <div class="input-group">
                        <input type="date" class="form-control @error('tgl_masuk') {{ 'is-invalid' }} @enderror" name="tgl_masuk" value="{{ old('tgl_masuk') ?? $pegawai->tgl_masuk ?? '' }}">
                        
                        @error('tgl_masuk')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Tempat Lahir</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('tmp_lahir') {{ 'is-invalid' }} @enderror" name="tmp_lahir" value="{{ old('tmp_lahir') ?? $pegawai->tmp_lahir ?? '' }}">
                        
                        @error('tmp_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Agama</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('agama') {{ 'is-invalid' }} @enderror" name="agama" value="{{ old('agama') ?? $pegawai->agama ?? '' }}">
                        
                        @error('agama')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <div class="input-group">
                        <select name="gender" id="gender"
                            class="form-control @error('gender') {{ 'is-invalid' }} @enderror">
                            <option value="">-Pilih-</option>
                            <option {{ (old('gender') == 'Pria' ? 'selected':'') }} value="Pria">
                                Pria</option>
                            <option {{ (old('gender') == 'Wanita' ? 'selected':'') }}
                                value="Wanita">Wanita</option>
                        </select>
                        @if(isset($pegawai))
                        <script>
                            document.getElementById('gender').value =
                                '<?php echo $pegawai->gender ?>'
                        </script>
                        @endif
                        @error('gender')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Pendidikan</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('pendidikan') {{ 'is-invalid' }} @enderror" name="pendidikan" value="{{ old('pendidikan') ?? $pegawai->pendidikan ?? '' }}">
                        
                        @error('pendidikan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Foto Pegawai</label>
                    <div class="input-group">
                        <input type="file" class="form-control @error('foto') {{ 'is-invalid' }} @enderror" name="foto" value="{{ old('foto') ?? '' }}">
                        @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="border-top">
                <div class="card-body">
                    <button type="submit" class="btn btn-info">Save</button>
                    <button class="btn btn-warning" type="button" onclick="window.history.back()">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection