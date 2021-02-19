    @extends('layouts.app')

    @section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Kirim Tugas</h4>
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
            <form class="form-horizontal" action="{{ route($url, $kirim_tugas->id_kirim_tugas ?? null) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($kirim_tugas))
                @method('put')
                @endif
                <div class="card-body">
                    <h4 class="card-title text-center">Kirim Tugas</h4>
                    <hr>
                    <div class="form-group">
                        <label>Judul Tugas</label>
                        <select name="id_tugas" id="id_tugas"
                            class="form-control @error('id_tugas') {{ 'is-invalid' }} @enderror">
                            <option value="">-Pilih-</option>
                            @foreach($tugas as $no => $tugas)
                                <option value="{{ $tugas->id_tugas }}">
                                {{ $tugas->judul_tugas }}</option>
                            @endforeach 
                        </select>
                        @if(isset($kirim_tugas))
                        <script>
                            document.getElementById('id_tugas').value =
                                '<?php echo $kirim_tugas->id_tugas ?>'
                        </script>
                        @endif
                        @error('id_tugas')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Nama Siswa</label>
                        <select name="id_user" id="id_user"
                            class="form-control @error('id_user') {{ 'is-invalid' }} @enderror">
                            <option value="">-Pilih-</option>
                            @foreach($siswa as $no => $siswa)
                                <option value="{{ $siswa->id_siswa }}">
                                {{ $siswa->nama_siswa }}</option>
                            @endforeach 
                        </select>
                        @if(isset($kirim_tugas))
                        <script>
                            document.getElementById('id_user').value =
                                '<?php echo $kirim_tugas->id_user ?>'
                        </script>
                        @endif
                        @error('id_user')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label>Tanggal Kirim</label>
                        <div class="input-group">
                            <input type="date" class="form-control @error('tgl_kirim_tugas') {{ 'is-invalid' }} @enderror" name="tgl_kirim_tugas" value="{{ old('tgl_kirim_tugas') ?? $materi->tgl_kirim_tugas ?? $kirim_tugas->tgl_kirim_tugas }}">
                            @error('tgl_kirim_tugas')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>File Tugas</label>
                        <div class="input-group">
                            <input type="file" class="form-control @error('file_tugas') {{ 'is-invalid' }} @enderror" name="file_tugas" value="{{ old('file_tugas') ?? '' }}">
                            @error('file_tugas')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('ket_tugas') {{ 'is-invalid' }} @enderror" name="ket_tugas" value="{{ old('ket_tugas') ?? $materi->ket_tugas ?? $kirim_tugas->ket_tugas }}">
                            @error('ket_tugas')
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

    @if(isset($materi))
        <script>
            $(document).ready(function () {
                var id_kelas = '<?php echo $materi->id_kelas ?>';
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