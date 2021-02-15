@extends('layouts.app')

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Hari</h4>
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

        <form class="form-horizontal" action="{{ route($url, $hari->id_hari ?? null) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($hari))
            @method('put')
            @endif
            <div class="card-body">
                <h4 class="card-title text-center">Hari</h4>
                <hr>
                <div class="form-group">
                    <label>Hari</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('hari') {{ 'is-invalid' }} @enderror" name="hari" value="{{ old('hari') ?? $hari->hari ?? '' }}">
                        @error('hari')
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