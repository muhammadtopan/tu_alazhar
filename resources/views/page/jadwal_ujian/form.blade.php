@extends('layouts.app')

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Jadwal Ujian</h4>
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

        <form class="form-horizontal" action="{{ route($url, $jadwal_ujian->id_jadwal_ujian ?? null) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($jadwal_ujian))
            @method('put')
            @endif
            <div class="card-body">
                <h4 class="card-title text-center">Jadwal Ujian</h4>
                <hr>
                <div class="form-group">
                    <label>Hari</label>
                    <select name="hari_jadwal" id="hari_jadwal"
                        class="form-control @error('hari_jadwal') {{ 'is-invalid' }} @enderror">
                        <option value="">-Pilih-</option>
                        @foreach($hari as $no => $hari)
                            <option value="{{ $hari->id_hari }}">
                            {{ $hari->hari }}</option>
                        @endforeach
                    </select>
                    @if(isset($jadwal_ujian))
                    <script>
                        document.getElementById('hari_jadwal').value =
                            '<?php echo $jadwal_ujian->hari_jadwal ?>'
                    </script>
                    @endif
                    @error('hari_jadwal')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="form-group  col-md-6">
                        <label>Jadwal Awal</label>
                        <select name="jam_awal" id="jam_awal"
                            class="form-control @error('jam_awal') {{ 'is-invalid' }} @enderror">
                            <option value="">-Pilih-</option>
                            @foreach($jam_awal as $no => $jam_awal)
                                <option value="{{ $jam_awal->id_jam}}">
                                {{ $jam_awal->jam_awal }}</option>
                            @endforeach 
                        </select>
                        @if(isset($jadwal_ujian))
                        <script>
                            document.getElementById('jam_awal').value =
                                '<?php echo $jadwal_ujian->id_jam_ajar   ?>'
                        </script>
                        @endif
                        @error('jam_awal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6" >
                        <label>Jam Akhir</label>
                        <input type="text" id="jam_akhir" class="form-control" readonly>
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
                        @if(isset($jadwal_ujian))
                        <script>
                            document.getElementById('id_kelas').value =
                                '<?php echo $jadwal_ujian->id_kelas ?>'
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
                    <label>Nama Guru</label>
                    <select name="nama_peg" id="nama_peg"
                        class="form-control @error('nama_peg') {{ 'is-invalid' }} @enderror">
                        <option value="">-Pilih-</option>
                        @foreach($pegawai as $no => $pegawai)
                            <option value="{{ $pegawai->id }}">
                            {{ $pegawai->nama_peg }}</option>
                        @endforeach 
                    </select>
                    @if(isset($jadwal_ujian))
                    <script>
                        document.getElementById('nama_peg').value =
                            '<?php echo $jadwal_ujian->id_pegawai ?>'
                    </script>
                    @endif
                    @error('nama_peg')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Mata Pelajaran</label>
                    <select name="nama_pelajaran" id="nama_pelajaran"
                        class="form-control @error('nama_pelajaran') {{ 'is-invalid' }} @enderror">
                        <option value="">-Pilih-</option>
                        @foreach($pelajaran as $no => $pelajaran)
                            <option value="{{ $pelajaran->id_pelajaran }}">
                            {{ $pelajaran->nama_pelajaran }}</option>
                        @endforeach 
                    </select>
                    @if(isset($jadwal_ujian))
                    <script>
                        document.getElementById('nama_pelajaran').value =
                            '<?php echo $jadwal_ujian->id_pelajaran ?>'
                    </script>
                    @endif
                    @error('nama_pelajaran')
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

<!-- jam ajar -->
<script>
    $('#jam_awal').change(function(e) {
        e.preventDefault();
        var id_jam = $(this).val();
        axios.get("{{ url('jam_ajar/get') }}/" + id_jam)
            .then(function(res) {
                var hasil = res.data
                console.log(hasil);
                $('#jam_akhir').val(hasil.jam_akhir);
            }).catch(function(err) {
                console.log(err)
            })
        });
    </script>

@if(isset($jadwal_ujian))
    <script>
        $(document).ready(function () {
            var jam_awal = '<?php echo $jadwal_ujian->id_jam_ajar ?>';
            axios.get("{{ url('jam_ajar/get') }}/" + jam_awal)
                .then(function(res) {
                    var hasil = res.data
                    console.log(hasil);
                    $('#jam_akhir').val(hasil.jam_akhir);
                }).catch(function(err) {
                    console.log(err)
                })
        });
        
    </script>
@endif

<!-- kelas -->
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

@if(isset($jadwal_ujian))
    <script>
        $(document).ready(function () {
            var id_kelas = '<?php echo $jadwal_ujian->id_kelas ?>';
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