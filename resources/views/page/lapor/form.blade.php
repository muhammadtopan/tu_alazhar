@extends('layouts.app')

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Rapor</h4>
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

        <form class="form-horizontal" action="{{ route($url, $lapor->id_lapor ?? null) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($lapor))
            @method('put')
            @endif
            <div class="card-body">
                <h4 class="card-title text-center">Rapor</h4>
                <hr>
                <div class="form-group">
                    <label>Siswa</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('nama_siswa') {{ 'is-invalid' }} @enderror" name="nama_siswa" value="{{ old('nama_siswa') ?? $lapor->nama_siswa ?? '' }}">
                        @error('nama_siswa')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group  col-md-6">
                        <label>Kelas</label>
                        <select name="id_kelas" id="id_kelas"
                            class="form-control @error('id_kelas') {{ 'is-invalid' }} @enderror">
                            <option value="">-Pilih-</option>
                            @foreach($kelas as $no => $kelas)
                                <option value="{{ $kelas->id_kelas }}">
                                {{ $kelas->nama_kelas }}</option>
                            @endforeach 
                        </select>
                        @if(isset($lapor))
                        <script>
                            document.getElementById('id_kelas').value =
                                '<?php echo $lapor->id_kelas ?>'
                        </script>
                        @endif
                        @error('id_kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6" >
                        <label>Grup Kelas</label>
                        <input type="text" id="grup_kelas" class="form-control" readonly>
                    </div>  
                </div>
                <div class="form-group">
                    <label>File</label>
                    <div class="input-group">
                        <input type="file" class="form-control @error('file') {{ 'is-invalid' }} @enderror" name="file" value="{{ old('file') ?? '' }}">
                        @error('file')
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

    <script>
        $('#id_kelas').change(function(e) {
            e.preventDefault();
            var id_kelas = $(this).val();
            axios.get("{{ url('kelas/get') }}/" + id_kelas)
                .then(function(res) {
                    var hasil = res.data
                    console.log(hasil);
                    $('#grup_kelas').val(hasil.grup_kelas);
                }).catch(function(err) {
                    console.log(err)
                })
        });
    </script>

    @if(isset($lapor))
        <script>
            $(document).ready(function () {
                var id_kelas = '<?php echo $siswa->id_kelas ?>';
                axios.get("{{ url('kelas/get') }}/" + id_kelas)
                    .then(function(res) {
                        var hasil = res.data
                        console.log(hasil);
                        $('#grup_kelas').val(hasil.grup_kelas);
                    }).catch(function(err) {
                        console.log(err)
                    })
            });
            
        </script>
    @endif
@endsection