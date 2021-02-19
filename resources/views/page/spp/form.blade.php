    @extends('layouts.app')

    @section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">SPP</h4>
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

            <form class="form-horizontal" action="{{ route($url, $spp->id_spp ?? null) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($spp))
                @method('put')
                @endif
                <div class="card-body">
                    <h4 class="card-title text-center">SPP</h4>
                    <hr>
                    <div class="form-group">
                        <label>Nama Siswa</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('nama_siswa') {{ 'is-invalid' }} @enderror" name="nama_siswa" value="{{ old('nama_siswa') ?? $spp->nama_siswa ?? '' }}">
                            
                            @error('nama_siswa')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Bulan</label>
                        <div class="input-group">
                            <input type="month" class="form-control @error('bulan_spp') {{ 'is-invalid' }} @enderror" name="bulan_spp" value="{{ old('bulan_spp') ?? $spp->bulan_spp ?? '' }}">
                            
                            @error('bulan_spp')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Tanggal Bayar</label>
                        <div class="input-group">
                            <input type="date" class="form-control @error('tgl_bayar') {{ 'is-invalid' }} @enderror" name="tgl_bayar" value="{{ old('tgl_bayar') ?? $spp->tgl_bayar ?? '' }}">
                            
                            @error('tgl_bayar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- <div class="form-group">
                        <label>Foto Siswa</label>
                        <div class="input-group">
                            <input type="file" class="form-control @error('foto_siswa') {{ 'is-invalid' }} @enderror" name="foto_siswa" value="{{ old('foto_siswa') ?? '' }}">
                            @error('foto_siswa')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> -->
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