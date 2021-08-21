    @extends('layouts.app')
    @section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Siswa</h4>
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

            <form class="form-horizontal" action="{{ route($url, $siswa->id_siswa ?? null) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($siswa))
                @method('put')
                @endif
                <div class="card-body">
                    <h4 class="card-title text-center">Siswa</h4>
                    <hr>
                    <div class="form-group">
                        <label>Nama Siswa</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('nama_siswa') {{ 'is-invalid' }} @enderror" name="nama_siswa" value="{{ old('nama_siswa') ?? $siswa->nama_siswa ?? '' }}">
                            
                            @error('nama_siswa')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <input type="hidden" id="nisauto" name="nis">
                    <div class="form-group">
                        <label>NISN</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('nisn') {{ 'is-invalid' }} @enderror" name="nisn" value="{{ old('nisn') ?? $siswa->nisn ?? '' }}">
                            
                            @error('nisn')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <div class="input-group">
                            <select name="gender_siswa" id="gender_siswa"
                                class="form-control @error('gender_siswa') {{ 'is-invalid' }} @enderror">
                                <option value="">-Pilih-</option>
                                <option {{ (old('gender_siswa') == 'Pria' ? 'selected':'') }} value="Pria">
                                    Pria</option>
                                <option {{ (old('gender_siswa') == 'Wanita' ? 'selected':'') }}
                                    value="Wanita">Wanita</option>
                            </select>
                            @if(isset($siswa))
                            <script>
                                document.getElementById('gender_siswa').value =
                                    '<?php echo $siswa->gender_siswa ?>'
                            </script>
                            @endif
                            @error('gender_siswa')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <div class="input-group">
                            <input type="number" class="form-control @error('nohp_siswa') {{ 'is-invalid' }} @enderror" name="nohp_siswa" value="{{ old('nohp_siswa') ?? $siswa->nohp_siswa ?? '' }}">
                            
                            @error('nohp_siswa')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('tempat_lahir_siswa') {{ 'is-invalid' }} @enderror" name="tempat_lahir_siswa" value="{{ old('tempat_lahir_siswa') ?? $siswa->tempat_lahir_siswa ?? '' }}">
                            
                            @error('tempat_lahir_siswa')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Tanggal Lahir</label>
                        <div class="input-group">
                            <input type="date" class="form-control @error('tanggal_lahir_siswa') {{ 'is-invalid' }} @enderror" name="tanggal_lahir_siswa" value="{{ old('tanggal_lahir_siswa') ?? $siswa->tanggal_lahir_siswa ?? '' }}">
                            
                            @error('tanggal_lahir_siswa')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('alamat_siswa') {{ 'is-invalid' }} @enderror" name="alamat_siswa" value="{{ old('alamat_siswa') ?? $siswa->alamat_siswa ?? '' }}">
                            
                            @error('alamat_siswa')
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
                                    <option value="{{ old('id_kelas') ?? $kelas->id_kelas ?? '' }}">
                                    {{ $kelas->nama_kelas }}</option>
                                @endforeach 
                            </select>
                            @if(isset($siswa))
                            <script>
                                document.getElementById('id_kelas').value =
                                    '<?php echo $siswa->id_kelas ?>'
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
                        <label>Foto Siswa</label>
                        <div class="input-group">
                            <input type="file" class="form-control @error('foto_siswa') {{ 'is-invalid' }} @enderror" name="foto_siswa" value="{{ old('foto_siswa') ?? '' }}">
                            @error('foto_siswa')
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

    @if(isset($siswa))
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
        <script>
            let thn = new Date().getFullYear().toString();         
            let sub = thn.substring(2,4);
            let next = parseInt(sub)+1;
            let mix = sub + next;
            $("#nisauto").val(mix);
        </script>
    @endsection