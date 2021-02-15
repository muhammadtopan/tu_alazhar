@extends('layouts.app')

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Jam Ajar</h4>
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

        <form class="form-horizontal" action="{{ route($url, $jam_ajar->id_jam ?? null) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($jam_ajar))
            @method('put')
            @endif
            <div class="card-body">
                <h4 class="card-title text-center">Jam Ajar</h4>
                <hr>
                <div class="form-group col-md-4">
                    <label>Jam Awal</label>
                    <div class="input-group">
                        <input type="time" class="form-control @error('jam_awal') {{ 'is-invalid' }} @enderror" name="jam_awal" value="{{ old('jam_awal') ?? $jam_ajar->jam_awal ?? '' }}">
                        @error('jam_awal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label>Jam Akhir</label>
                    <div class="input-group">
                        <input type="time" class="form-control @error('jam_akhir') {{ 'is-invalid' }} @enderror" name="jam_akhir" value="{{ old('jam_akhir') ?? $jam_ajar->jam_akhir ?? '' }}">
                        @error('jam_akhir')
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