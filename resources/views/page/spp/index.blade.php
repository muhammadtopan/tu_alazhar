@extends('layouts.app')

@section('content')
<?php
function tanggal_indonesia($tgl)
{

    $nama_bulan = array(
        1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
        "September", "Oktober", "November", "Desember"
    );
    $bulan = $nama_bulan[$tgl];
    $text = "";

    $text .= $bulan;
    return $text;
} ?>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">SPP</h4>
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
            <form class="form-horizontal" action="{{ url('exportSPP') }}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <div class="input-group">
                                <select name="kelas" id="kelas" class="form-control">
                                    @foreach($kelas as $no => $kls)
                                        <option value="{{ $kls->id_kelas }}">Kelas {{ $kls->nama_kelas.$kls->grup_kelas}}</option>
                                    @endforeach
                                </select>   
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kelas">Bulan</label>
                            <div class="input-group">
                                <input type="month" name="month" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center my-auto">
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
            <!-- <h5 class="card-title">
                <a href="{{ route('spp.create') }}" class="btn btn-cyan btn-sm"><i class="fa fa-plus"></i> Add</a>
            </h5> -->
            <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Bulan</th>
                            <th>Tanggal Bayar</th>
                            <th>Bukti</th>
                            <th>Status</th>
                            </tr>
                    </thead>
                    <tbody>
                        @foreach($spp as $no => $spp) 
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td>{{ $spp->nama_siswa }}</td>
                            <td>
                                <?php 
                                    echo tanggal_indonesia($spp->bulan_spp)
                                ?>                                
                                {{ $spp->tahun_spp }}
                            </td>
                            <td>{{ $spp->tgl_bayar }}</td>
                            <td>
                                <a onclick="tampilModal('{{ $spp->upload_bukti }}')">
                                    <img src="{{ asset('backend/img/bukti_spp/' . $spp->upload_bukti )}}" alt="homepage" class="light-logo" style="width: 10em;">
                                </a>
                            </td>
                            <td>
                                <label class="switch">
                                    <?php $cek = $spp->status ?>
                                    <input type="checkbox" class="cek_spp" id="cek_spp<?= $spp->id_spp ?>" value="<?= $spp->id_spp ?>" onchange="cekStatus(<?= $spp->id_spp ?>, this)" <?php echo ($cek == '1') ? "checked" : "" ?>>
                                    <span class="slider round"></span>
                                </label>
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
        $('#imgDetail').attr('src', '{{ asset("backend/img/bukti_spp") }}/' + foto);
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
<script>
    function cekStatus(id_spp, stok_checked) {
        if (stok_checked.checked) {
            axios.post("{{ url('spp/lunas') }}", {
                'id_spp': id_spp
            }).then(function(res) {
                var id = res.data
                toastr.info('Sukses.. Spp Lunas')
                // toastr.info('Sukses.. Barang Di Set Tidak Laku')
                // $(".cek_menipis").prop("checked", true);
            }).catch(function(err) {
                console.log(err)
                toastr.warning('ERROR..')
                // $(".cek_menipis").prop("checked", false);
            })
        } else {
            axios.post("{{ url('spp/utang') }}", {
                'id_spp': id_spp
            }).then(function(res) {
                var data = res.data
                toastr.warning('Belum Lunas')
                // toastr.info('Sukses.. Barang Di Set Laku')
            }).catch(function(err) {
                toastr.warning('ERROR..')
            })
        }
    }
</script>
@endsection
