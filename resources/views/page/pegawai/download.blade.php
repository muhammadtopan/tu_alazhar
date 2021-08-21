
@extends('layouts.app')

@section('content')


<?php 
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=rekap-data-pegawai-".date('Y-m-d').".xls");
?>

<div class="row">
    <div class="col-12 text-center">
        <h3 class="text-center">Rekap Data Pegawai</h3>
        <h4>SD Islam Al-Azhar 32 Kota Padang</h4>
    </div>
</div>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">NIK</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Jabatan</th>
                        <th class="text-center">Jenis Kelamin</th>
                        <th class="text-center">Tempat Lahir</th>
                        <th class="text-center">TMT Sekolah</th>
                        <th class="text-center">Agama</th>
                        <th class="text-center">Alamat</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Nomor Telpon</th>
                        <th class="text-center">Pendidikan</th>
                    </tr>
                    @foreach($pegawai as $no => $pgw)
                    <tr>
                        <td class="text-center">{{ $no+1 }}</td>
                        <td>{{ $pgw->nip }}</td>
                        <td>{{ $pgw->nama_peg }}</td>
                        <td>{{ $pgw->nama_jabatan }}</td>
                        <td>{{ $pgw->gender }}</td>
                        <td>{{ $pgw->tmp_lahir }}</td>
                        <td>{{ $pgw->tgl_masuk }}</td>
                        <td>{{ $pgw->agama }}</td>
                        <td>{{ $pgw->alamat }}</td>
                        <td>{{ $pgw->Email }}</td>
                        <td>{{ $pgw->no_tlp }}</td>
                        <td>{{ $pgw->pendidikan }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>


@endsection