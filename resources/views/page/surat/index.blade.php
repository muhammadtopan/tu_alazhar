@extends('layouts.app')

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Data Surat </h4>
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
            <form class="form-horizontal" action="{{ url('exportSurat') }}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Pilih Tanggal</label>
                            <div class="input-group">
                                <input type="date" class="form-control" name="tglAwal" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Pilih Tanggal</label>
                            <div class="input-group">
                                <input type="date" class="form-control" name="tglAkhir" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Jenis Surat</label>
                            <select name="surat_jenis" class="form-control">
                                    <option value="semua">Semua</option>
                                    <option value="masuk">Masuk</option>
                                    <option value="keluar">Keluar</option>
                            </select>
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
                <a href="{{ route('surat.create') }}" class="btn btn-cyan btn-sm"><i class="fa fa-plus"></i> Add</a>
            </h5>
            <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Surat</th>
                            <th>No Surat</th>
                            <th>Tanggal Surat</th>
                            <th>Tujuan Surat</th>
                            <th>Surat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($surats as $no => $surat)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td><b>{{ $surat->surat_jenis }} </b></td>
                            <td>{{ $surat->surat_nomor }}</td>
                            <td>{{ $surat->surat_tanggal }}</td>
                            <td>{{ $surat->surat_tujuan }}</td>
                            <td class="text-center">
                                <i class="fa fa-eye" data-toggle="modal" data-target="#exampleModalCenter" onclick="openPdf(`{{asset('backend/file/surat/' . $surat->surat_file)}}`)"></i>
                            </td>
                            <td class="text-center">
                                    <a href="{{ route('surat.edit', $surat->surat_id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Update</a>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="mHapus('{{ route('surat.delete', $surat->surat_id) }}')"><i class="fa fa-trash"></i> Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg"  role="document">
        <div class="modal-content" style="height:100vh">
            <div class="modal-body">
                <!-- <iframe id="pdfModal" src="" title="" ></iframe> -->
                <!-- <object id="pdfModal" data="" type="application/pdf" width="100%" height="100%">
                    <embed id="pdfModal2" src="" type="application/pdf" width="100%" height="100%"/>
                </object> -->
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

<script>
    function openPdf(e) {
        $('#pdfModal').attr('data', e);
        $('#pdfModal2').attr('src', e);
    }
</script>

<script>
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
</script>


@endsection
