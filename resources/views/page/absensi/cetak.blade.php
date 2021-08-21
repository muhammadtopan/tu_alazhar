<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Data Absensi</title>
</head>
<body onload="print()">

    <?php 
        // header("Content-type: application/vnd-ms-excel");
        // header("Content-Disposition: attachment; filename=rekap-data-pegawai-".date('Y-m-d').".xls");
    ?>

    <div style="text-align: center">
        <h1>Rekap Data Abbsensi</h1>
        <h3>SD Islam Al-Azhar 32 Kota Padang</h3>
    </div>

    <table style="border-collapse: collapse">
        <tr>
            <th style="border: 1px solid black">No</th>
            <th style="border: 1px solid black">Nama Pegawai</th>
            <th style="border: 1px solid black">Tanggal</th>
            <th style="border: 1px solid black">Jam Masuk</th>
            <th style="border: 1px solid black">Jam Keluar</th>
            <th style="border: 1px solid black">Keterangan</th>
        </tr>
        @foreach($absensi as $no => $absen)
        <tr>
            <td style="border: 1px solid black; text-align: center;">{{ $no+1 }}</td>
            <td style="border: 1px solid black">{{ $absen->nama_peg }}</td>
            <td style="border: 1px solid black">{{ $absen->tanggal }}</td>
            <td style="border: 1px solid black">{{ $absen->jam_masuk }}</td>
            <td style="border: 1px solid black">{{ $absen->jam_selesai }}</td>
            <td style="border: 1px solid black">{{ $absen->keterangan }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>