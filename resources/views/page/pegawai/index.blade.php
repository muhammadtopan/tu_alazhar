@extends('layouts.app')

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Pegawai</h4>
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
            <form class="form-horizontal" action="{{ url('exportExcel') }}" method="post" enctype="multipart/form-data">
            @csrf
                <label>Status Pegawai</label>
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <div class="input-group">
                                <select name="jabatan" id="jabatan" class="form-control">
                                    <option value="0">Semua</option>
                                    <option value="123">Karyawan</option>
                                    <option value="3">Guru</option>
                                </select>
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
    @if(session()->has('message'))
    <div class="alert alert-success">
        <strong>{{ session()->get('message') }}</strong>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
    @endif
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{ route('pegawai.create') }}" class="btn btn-cyan btn-sm"><i class="fa fa-plus"></i> Add</a>
            </h5>
            <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama Pegawai</th>
                            <th>Jabatan</th>
                            <th>Email</th>
                            <th>Nomor Telpon</th>
                            <th>Alamat</th>
                            <th>Tanggal Masuk</th>
                            <th>Tempat Lahir</th>
                            <th>Agama</th>
                            <th>Gender</th>
                            <th>Pendidikan</th>
                            <th>Foto</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pegawai as $no => $pegawai)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td>{{ $pegawai->nama_peg }}</td>
                            <td>{{ $pegawai->nama_jabatan }}</td>
                            <td>{{ $pegawai->nip }}</td>
                            <td>{{ $pegawai->Email }}</td>
                            <td>{{ $pegawai->no_tlp }}</td>
                            <td>{{ $pegawai->alamat }}</td>
                            <td>{{ $pegawai->tgl_masuk }}</td>
                            <td>{{ $pegawai->tmp_lahir }}</td>
                            <td>{{ $pegawai->agama }}</td>
                            <td>{{ $pegawai->gender }}</td>
                            <td>{{ $pegawai->pendidikan }}</td>
                            <td><img src="{{ asset('backend/img/pegawai/' . $pegawai->foto )}}" alt="homepage" class="light-logo" style="width: 10em;"></td>
                            <td>
                                <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Update</a>
                                <button type="button" class="btn btn-danger btn-sm" onclick="mHapus('{{ route('pegawai.delete', $pegawai->id) }}')"><i class="fa fa-trash"></i> Delete</button>
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

@endsection
