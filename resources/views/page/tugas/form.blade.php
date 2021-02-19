    @extends('layouts.app')

    @section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Tugas</h4>
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
            <form class="form-horizontal" action="{{ route($url, $tugas->id_tugas ?? null) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($tugas))
                @method('put')
                @endif
                <div class="card-body">
                    <h4 class="card-title text-center">Tugas</h4>
                    <hr>
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
                        @if(isset($tugas))
                        <script>
                            document.getElementById('id_pelajaran').value =
                                '<?php echo $tugas->id_pelajaran ?>'
                        </script>
                        @endif
                        @error('id_pelajaran')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
                            @if(isset($tugas))
                            <script>
                                document.getElementById('id_kelas').value =
                                    '<?php echo $tugas->id_kelas ?>'
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
                        <label>Judul Tugas</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('judul_tugas') {{ 'is-invalid' }} @enderror" name="judul_tugas" value="{{ old('judul_tugas') ?? $tugas->judul_tugas ?? ' ' }}">
                            @error('judul_tugas')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Tugas</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('isi_tugas') {{ 'is-invalid' }} @enderror" name="isi_tugas" value="{{ old('isi_tugas') ?? $tugas->isi_tugas ?? ' ' }}">
                            @error('isi_tugas')
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
                        <label>Deatline Tugas</label>
                        <div class="input-group">
                            <input type="date" class="form-control @error('deadline_tugas') {{ 'is-invalid' }} @enderror" name="deadline_tugas" value="{{ old('deadline_tugas') ?? $tugas->deadline_tugas ?? ' ' }}">
                            @error('deadline_tugas')
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

    @if(isset($tugas))
        <script>
            $(document).ready(function () {
                var id_kelas = '<?php echo $tugas->id_kelas ?>';
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