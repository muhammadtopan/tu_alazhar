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
    
    <div class="alert alert-success" style="display:none" id="message">
        <strong>{{ session()->get('message') }}</strong>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
    
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{ route('izin.create') }}" class="btn btn-cyan btn-sm"><i class="fa fa-plus"></i> Add</a>
            </h5>
            <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Keterangan Izin</th>
                            <th>Tanggal Izin</th>
                            <th>Bukti Izin</th>
                            <th>Action</th1>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($izin as $no => $izin)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td>{{ $izin->nama_siswa }}</td>
                            <td>{{ $izin->keterangan_izin }}</td>
                            <td>{{ $izin->tgl_izin }}</td>
                            <td>
                                <a onclick="tampilModal('{{ $izin->foto_izin }}')">
                                    <img src="{{ asset('backend/img/izin/' . $izin->foto_izin )}}" alt="homepage" class="light-logo" style="width: 10em;">
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('izin.edit', $izin->id_izin) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Update</a>
                                <button type="button" class="btn btn-danger btn-sm" onclick="mHapus('{{ route('izin.delete', $izin->id_izin) }}')"><i class="fa fa-trash"></i> Delete</button>
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

<!-- modal foto -->
<div class="modal fade" id="tampilModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="" id="imgDetail" alt="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    // untuk hapus data
    function mHapus(url) {
        $('#ModalHapus').modal()
        $('#formDelete').attr('action', url);
    }
    function tampilModal(foto) {
        console.log(foto);
        $('#imgDetail').attr('src', '{{ asset("backend/img/izin") }}/' + foto);
        $('#tampilModal').modal()
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
@endsection
