@extends('layouts.app')

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Surat</h4>
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
        <form class="form-horizontal" action="{{ route($url, $surat->surat_id ?? null) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($surat))
                @method('put')
            @endif
            <div class="card-body">
                <h4 class="card-title text-center">Surat</h4>
                <hr>
                <div class="form-group">
                    <label>Jenis Surat</label>
                    <select name="surat_jenis" id="surat_jenis"
                            class="form-control @error('surat_jenis') {{ 'is-invalid' }} @enderror">
                            <option value="">-Pilih-</option>
                            <option value="masuk">Masuk</option>
                            <option value="keluar">Keluar</option>
                    </select>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label>Nomor Surat</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('surat_nomor') {{ 'is-invalid' }} @enderror" name="surat_nomor" value="{{ old('surat_nomor') ?? $surat->surat_nomor ?? '' }}">
                            @error('surat_nomor')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label>Tanggal Surat</label>
                        <div class="input-group">
                            <input type="date" class="form-control @error('surat_tanggal') {{ 'is-invalid' }} @enderror" name="surat_tanggal" value="{{ old('surat_tanggal') ?? $surat->surat_tanggal ?? '' }}">
                            @error('surat_tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Tujuan Surat</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('surat_tujuan') {{ 'is-invalid' }} @enderror" name="surat_tujuan" value="{{ old('surat_tujuan') ?? $surat->surat_tujuan ?? '' }}">
                        @error('surat_tujuan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Keterangan Surat</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('surat_ket') {{ 'is-invalid' }} @enderror" name="surat_ket" value="{{ old('surat_ket') ?? $surat->surat_ket ?? '' }}">
                        @error('surat_ket')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>File Surat</label>
                    <div class="input-group">
                        <input type="file" class="form-control @error('surat_file') {{ 'is-invalid' }} @enderror" name="surat_file" value="{{ old('surat_file') ?? $surat->surat_file ?? '' }}">
                        @error('surat_file')
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