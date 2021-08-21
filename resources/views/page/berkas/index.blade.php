@extends('layouts.app')

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Berkas</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kartu Keluarga</th>
                            <th>Akte Kelahiran</th>
                            <th>Lapor</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($berkas as $no => $bks)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td class="text-center">
                                <i class="fa fa-eye" data-toggle="modal" data-target="#exampleModalCenter" onclick="openImg(`{{asset('backend/img/berkas/' . $bks->berkas_kk)}}`)"></i>
                            </td>
                            <td class="text-center">
                                <i class="fa fa-eye" data-toggle="modal" data-target="#exampleModalCenter" onclick="openImg(`{{asset('backend/img/berkas/' . $bks->berkas_akte)}}`)"></i>
                            </td>
                            <td class="text-center">
                                <i class="fa fa-eye" data-toggle="modal" data-target="#exampleModalCenter" onclick="openImg(`{{asset('backend/img/berkas/' . $bks->berkas_lapor)}}`)"></i>
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
        <div class="modal-content">
            <div class="modal-body">
                <div class="p-20 text-center">
                    <img id="modalImg" src="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openImg(e) {
        console.log(e);
        $('#modalImg').attr('src', e);
    }
</script>

@endsection
