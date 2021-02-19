    @extends('layouts.app')

    @section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Nilai</h4>
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
            <form class="form-horizontal" action="{{ route($url, $nilai->id_nilai ?? null) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($nilai))
                @method('put')
                @endif
                <div class="card-body">
                    <h4 class="card-title text-center">Nilai</h4>
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
                        @if(isset($nilai))
                        <script>
                            document.getElementById('id_siswa').value =
                                '<?php echo $nilai->id_siswa ?>'
                        </script>
                        @endif
                        @error('id_siswa')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Mata Pelajaran</label>
                        <select name="id_pelajaran" id="id_pelajaran"
                            class="form-control @error('id_pelajaran') {{ 'is-invalid' }} @enderror">
                            <option value="">-Pilih-</option>
                            @foreach($pelajaran as $no => $pelajaran)
                                <option value="{{ $pelajaran->id_pelajaran }}">
                                {{ $pelajaran->nama_pelajaran }}</option>
                            @endforeach 
                        </select>
                        @if(isset($nilai))
                        <script>
                            document.getElementById('id_pelajaran').value =
                                '<?php echo $nilai->id_pelajaran ?>'
                        </script>
                        @endif
                        @error('id_pelajaran')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Nilai</label>
                        <div class="input-group">
                            <input type="number" class="form-control @error('nilai') {{ 'is-invalid' }} @enderror" name="nilai" value="{{ old('nilai') ?? $nilai->nilai ?? '' }}">
                            @error('nilai')
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