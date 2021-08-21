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

<div class="container-fluid" style="min-height: auto; padding-bottom: 0px">
    <div class="card">
        <div class="card-body">
            <form class="form-horizontal" action="{{ url('exportExcelSiswa') }}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="hidden" name="kelas" value="0">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 text-center">
                        <button class="btn btn-cyan" type="submit">Cetak Laporan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
    
    <div class="alert alert-success" style="display:none" id="message">
        <strong>{{ session()->get('message') }}</strong>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
    
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{ route('siswa.create') }}" class="btn btn-cyan btn-sm"><i class="fa fa-plus"></i> Add</a>
            </h5>
            <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama Siswa</th>
                            <th>NIS</th>
                            <th>NISN</th>
                            <th>Gender</th>
                            <th>Nomor Telpon</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Kelas</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswa as $no => $siswa)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td><img src="{{ asset('backend/img/siswa/' . $siswa->foto_siswa )}}" alt="homepage" class="light-logo" style="width: 10em;"></td>
                            <td>{{ $siswa->nama_siswa }}</td>
                            <td>{{ $siswa->nis }}</td>
                            <td>{{ $siswa->nisn }}</td>
                            <td>{{ $siswa->gender_siswa }}</td>
                            <td>{{ $siswa->nohp_siswa }}</td>
                            <td>{{ $siswa->tempat_lahir_siswa }}</td>
                            <td>{{ $siswa->tanggal_lahir_siswa }}</td>
                            <td>{{ $siswa->alamat_siswa }}</td>
                            <td>{{ $siswa->nama_kelas }} {{ $siswa->grup_kelas }}</td>
                            <td>
                                <label class="switch">
                                    <?php $cek = $siswa->status_daftar ?>
                                    <input type="checkbox" class="status_siswa" id="status_siswa<?= $siswa->id_siswa ?>" value="<?= $siswa->id_siswa ?>" onchange="cekStatus(<?= $siswa->id_siswa ?>, this, '<?= $siswa->nama_siswa ?>')" <?php echo ($cek == '1') ? "checked" : "" ?>>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <a href="{{ route('siswa.edit', $siswa->id_siswa) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Update</a>
                                <button type="button" class="btn btn-danger btn-sm" onclick="mHapus('{{ route('siswa.delete', $siswa->id_siswa) }}')"><i class="fa fa-trash"></i> Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- modal hapus -->
<div class="modal fade" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" id="formDelete">
                <div class="modal-body">
                    @csrf
                    @method('delete')
                    Yakin Hapus Data ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // untuk hapus data
    function mHapus(url) {
        $('#ModalHapus').modal()
        $('#formDelete').attr('action', url);
    }
</script>

@if (session()->has('message'))
<script>
    $('#message').show();
    setInterval(function(){
        $('#message').hide();
    }, 5000);
</script>
@endif
<script>
    function cekStatus(id_siswa, status_checked, nama_siswa) {
        if (status_checked.checked) {
            axios.post("{{ url('siswa/terdaftar') }}", {
                'id_siswa': id_siswa,
                'nama_siswa': nama_siswa,
            }).then(function(res) {
                var id = res.data
                toastr.info('Sukses.. Siswa Terdaftar')
                // toastr.info('Sukses.. Barang Di Set Tidak Laku')
                // $(".cek_menipis").prop("checked", true);
            }).catch(function(err) {
                console.log(err)
                toastr.warning('ERROR..')
                // $(".cek_menipis").prop("checked", false);
            })
        } else {
            axios.post("{{ url('siswa/tdk_terdaftar') }}", {
                'id_siswa': id_siswa
            }).then(function(res) {
                var data = res.data
                toastr.warning('Siswa Belum Terdaftar')
                // toastr.info('Sukses.. Barang Di Set Laku')
            }).catch(function(err) {
                toastr.warning('ERROR..')
            })
        }
    }
</script>
@endsection
