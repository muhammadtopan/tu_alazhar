@extends('layouts.app')

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Absensi</h4>
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

        <form class="form-horizontal" action="{{ route($url, $absensi->id_absen ?? null) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($absensi))
            @method('put')
            @endif
            <div class="card-body">
                <h4 class="card-title text-center">Absensi</h4>
                <hr>
                <div class="form-group">
                    <label>Nama Pegawai</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('nama_peg') {{ 'is-invalid' }} @enderror" name="nama_peg" value="{{ old('nama_peg') ?? $absensi->nama_peg ?? '' }}">
                        @error('nama_peg')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Jadwal</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('jam_ke') {{ 'is-invalid' }} @enderror" name="jam_ke" value="{{ old('jam_ke') ?? $absensi->jam_ke ?? '' }}">
                        @error('jam_ke')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Tanggal</label>
                    <div class="input-group">
                        <input type="date" class="form-control @error('tanggal') {{ 'is-invalid' }} @enderror" name="tanggal" value="{{ old('tanggal') ?? $absensi->tanggal ?? '' }}">
                        @error('tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Jam Masuk</label>
                    <div class="input-group">
                        <input type="time" class="form-control @error('jam_masuk') {{ 'is-invalid' }} @enderror" name="jam_masuk" value="{{ old('jam_masuk') ?? $absensi->jam_masuk ?? '' }}">
                        @error('jam_masuk')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Jam Keluar</label>
                    <div class="input-group">
                        <input type="time" class="form-control @error('jam_selesai') {{ 'is-invalid' }} @enderror" name="jam_selesai" value="{{ old('jam_selesai') ?? $absensi->jam_selesai ?? '' }}">
                        @error('jam_selesai')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('alamat') {{ 'is-invalid' }} @enderror" name="alamat" value="{{ old('alamat') ?? $absensi->alamat ?? '' }}">
                        @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('keterangan') {{ 'is-invalid' }} @enderror" name="keterangan" value="{{ old('keterangan') ?? $absensi->keterangan ?? '' }}">
                        @error('keterangan')
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