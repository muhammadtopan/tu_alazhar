    @extends('layouts.app')

    @section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Izin</h4>
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
            <form class="form-horizontal" action="{{ route($url, $izin->id_izin ?? null) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($izin))
                @method('put')
                @endif
                <div class="card-body">
                    <h4 class="card-title text-center">Izin</h4>
                    <hr>
                    <div class="form-group">
                        <label>Nama Siswa</label>
                        <select name="id_siswa" id="id_siswa"
                            class="form-control @error('id_siswa') {{ 'is-invalid' }} @enderror">
                            <option value="">-Pilih-</option>
                            @foreach($siswa as $no => $siswa)
                                <option value="{{ $siswa->id_siswa }}">
                                {{ $siswa->nama_siswa }}</option>
                            @endforeach 
                        </select>
                        @if(isset($izin))
                        <script>
                            document.getElementById('id_siswa').value =
                                '<?php echo $izin->id_siswa ?>'
                        </script>
                        @endif
                        @error('id_siswa')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label>Tanggal Izin</label>
                        <div class="input-group">
                            <input type="date" class="form-control @error('tgl_izin') {{ 'is-invalid' }} @enderror" name="tgl_izin" value="{{ old('tgl_izin') ?? $izin->tgl_izin ?? '' }}">
                            @error('tgl_izin')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Keterangan Izin</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('keterangan_izin') {{ 'is-invalid' }} @enderror" name="keterangan_izin" value="{{ old('keterangan_izin') ?? $izin->keterangan_izin ?? '' }}">
                            @error('keterangan_izin')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Bukti Izin</label>
                        <div class="input-group">
                            <input type="file" class="form-control @error('foto_izin') {{ 'is-invalid' }} @enderror" name="foto_izin" value="{{ old('foto_izin') ?? '' }}">
                            @error('foto_izin')
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