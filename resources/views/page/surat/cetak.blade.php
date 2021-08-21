<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Surat</title>
</head>
<body onload="print()">

    <?php 
        // header("Content-type: application/vnd-ms-excel");
        // header("Content-Disposition: attachment; filename=rekap-data-pegawai-".date('Y-m-d').".xls");
    ?>

    <div style="text-align: center">
        <h1>Rekap Data Mutasi Surat</h1>
        <h3>SD Islam Al-Azhar 32 Kota Padang</h3>
    </div>

    <table style="border-collapse: collapse">
        <tr>
            <th style="border: 1px solid black">No</th>
            <th style="border: 1px solid black">Nomor Surat</th>
            <th style="border: 1px solid black">Tanggal Surat</th>
            <th style="border: 1px solid black">Dari/Tujuan</th>
            <th style="border: 1px solid black">Keterangan Surat</th>
        </tr>
        @foreach($surat as $no => $srt)
        <tr>
            <td style="border: 1px solid black; text-align: center;">{{ $no+1 }}</td>
            <td style="border: 1px solid black">{{ $srt->surat_nomor }}</td>
            <td style="border: 1px solid black">{{ $srt->surat_tanggal }}</td>
            <td style="border: 1px solid black">{{ $srt->surat_tujuan }}</td>
            <td style="border: 1px solid black">{{ $srt->surat_ket }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>