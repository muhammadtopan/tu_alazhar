@extends('layouts.app')

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Kelas</h4>
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

        <form class="form-horizontal" action="{{ route($url, $kelas->id_kelas ?? null) }}" method="POST" enctype="multipart/form-data"> 
            @csrf
            @if(isset($kelas))
            @method('put')
            @endif
            <div class="card-body">
                <h4 class="card-title text-center">Kelas</h4>
                <hr>
                <div class="form-group">
                    <label>Kelas</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('nama_kelas') {{ 'is-invalid' }} @enderror" name="nama_kelas" value="{{ old('nama_kelas') ?? $kelas->nama_kelas ?? '' }}">
                        @error('nama_kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Rombel</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('grup_kelas') {{ 'is-invalid' }} @enderror" name="grup_kelas" value="{{ old('grup_kelas') ?? $kelas->grup_kelas ?? '' }}">
                        @error('grup_kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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