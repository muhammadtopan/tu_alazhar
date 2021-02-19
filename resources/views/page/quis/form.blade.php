    @extends('layouts.app')

    @section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Quiz</h4>
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
            <form class="form-horizontal" action="{{ route($url, $quis->id_quis ?? null) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($quis))
                @method('put')
                @endif
                <div class="card-body">
                    <h4 class="card-title text-center">Quiz</h4>
                    <hr>
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
                            @if(isset($quis))
                            <script>
                                document.getElementById('id_kelas').value =
                                    '<?php echo $quis->id_kelas ?>'
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
                        <label>Mata Pelajaran</label>
                        <select name="id_pelajaran" id="id_pelajaran"
                            class="form-control @error('id_pelajaran') {{ 'is-invalid' }} @enderror">
                            <option value="">-Pilih-</option>
                            @foreach($pelajaran as $no => $pelajaran)
                                <option value="{{ $pelajaran->id_pelajaran }}">
                                {{ $pelajaran->nama_pelajaran }}</option>
                            @endforeach 
                        </select>
                        @if(isset($quis))
                        <script>
                            document.getElementById('id_pelajaran').value =
                                '<?php echo $quis->id_pelajaran ?>'
                        </script>
                        @endif
                        @error('id_pelajaran')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Soal</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('soal') {{ 'is-invalid' }} @enderror" name="soal" value="{{ old('soal') ?? $quis->soal ?? '' }}">
                            @error('soal')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jawaban A</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('pil_a') {{ 'is-invalid' }} @enderror" name="pil_a" value="{{ old('pil_a') ?? $quis->pil_a ?? '' }}">
                            @error('pil_a')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jawaban B</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('pil_b') {{ 'is-invalid' }} @enderror" name="pil_b" value="{{ old('pil_b') ?? $quis->pil_b ?? '' }}">
                            @error('pil_b')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jawaban C</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('pil_c') {{ 'is-invalid' }} @enderror" name="pil_c" value="{{ old('pil_c') ?? $quis->pil_c ?? '' }}">
                            @error('pil_c')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jawaban D</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('pil_d') {{ 'is-invalid' }} @enderror" name="pil_d" value="{{ old('pil_d') ?? $quis->pil_d ?? '' }}">
                            @error('pil_d')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kunci Jawaban</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('kunci') {{ 'is-invalid' }} @enderror" name="kunci" value="{{ old('kunci') ?? $quis->kunci ?? '' }}">
                            @error('kunci')
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

    @if(isset($quis))
        <script>
            $(document).ready(function () {
                var id_kelas = '<?php echo $quis->id_kelas ?>';
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