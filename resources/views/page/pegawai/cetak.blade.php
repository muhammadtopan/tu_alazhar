<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Data Pegawai</title>
</head>
<body onload="print()">

    <?php 
        // header("Content-type: application/vnd-ms-excel");
        // header("Content-Disposition: attachment; filename=rekap-data-pegawai-".date('Y-m-d').".xls");
    ?>

<table style="border-collapse: collapse">
    <tr>
        <th colspan="12" style="text-align: center; ">
            <h3>Rekap Data Pegawai</h3>
        </th>
    </tr>
    <tr>
        <th colspan="12" style="text-align: center; ">
            <h4>SD Islam Al-Azhar 32 Kota Padang</h4>
        </th>
    </tr>
        <tr>
            <th style="border: 1px solid black">No</th>
            <th style="border: 1px solid black">NIK</th>
            <th style="border: 1px solid black">Nama</th>
            <th style="border: 1px solid black">Jabatan</th>
            <th style="border: 1px solid black">Jenis Kelamin</th>
            <th style="border: 1px solid black">Tempat Lahir</th>
            <th style="border: 1px solid black">TMT Sekolah</th>
            <th style="border: 1px solid black">Agama</th>
            <th style="border: 1px solid black">Alamat</th>
            <th style="border: 1px solid black">Email</th>
            <th style="border: 1px solid black">Nomor Telpon</th>
            <th style="border: 1px solid black">Pendidikan</th>
        </tr>
        @foreach($pegawai as $no => $pgw)
        <tr>
            <td style="border: 1px solid black; text-align: center;">{{ $no+1 }}</td>
            <td style="border: 1px solid black">{{ $pgw->nip }}</td>
            <td style="border: 1px solid black">{{ $pgw->nama_peg }}</td>
            <td style="border: 1px solid black">{{ $pgw->nama_jabatan }}</td>
            <td style="border: 1px solid black">{{ $pgw->gender }}</td>
            <td style="border: 1px solid black">{{ $pgw->tmp_lahir }}</td>
            <td style="border: 1px solid black">{{ $pgw->tgl_masuk }}</td>
            <td style="border: 1px solid black">{{ $pgw->agama }}</td>
            <td style="border: 1px solid black">{{ $pgw->alamat }}</td>
            <td style="border: 1px solid black">{{ $pgw->Email }}</td>
            <td style="border: 1px solid black">{{ $pgw->no_tlp }}</td>
            <td style="border: 1px solid black">{{ $pgw->pendidikan }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>