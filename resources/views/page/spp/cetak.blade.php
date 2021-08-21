<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap SPP</title>

    <style>
        p{
            margin: unset;
        }
    </style>
</head>
<body onload="print()">
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

    <div style="text-align: center">
        <h1>Rekap Data SPP</h1>
        <h3>SD Islam Al-Azhar 32 Kota Padang</h3>
    </div>


    <div>
        <p>Bulan : <?=  tanggal_indonesia($spp[0]->bulan_spp)  ?></p>
        <p>Tahun : {{ $spp[0]->tahun_spp }}</p>
        <p>Kelas : {{ $spp[0]->nama_kelas.$spp[0]->grup_kelas }}</p>
    </div>

    <table style="border-collapse: collapse">
        <tr>
            <th style="border: 1px solid black">No</th>
            <th style="border: 1px solid black">Nama Siswa</th>
            <th style="border: 1px solid black">Tanggal</th>
            <th style="border: 1px solid black">Status</th>
        </tr>
        @foreach($spp as $no => $s)
        <tr>
            <td style="border: 1px solid black; text-align: center;">{{ $no+1 }}</td>
            <td style="border: 1px solid black">{{ $s->nama_siswa }}</td>
            <td style="border: 1px solid black">{{ $s->tgl_bayar }}</td>
            <td style="border: 1px solid black">{{ $s->status != '0' ? 'Sudah Bayar' : 'Belum Bayar' }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>