<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Data Siswa</title>
</head>
<body onload="print()">
    <div style="text-align: center">
        <h1>Rekap Data Siswa</h1>
        <h3>SD Islam Al-Azhar 32 Kota Padang</h3>
    </div>
@php 
    if($rekap == 'semua'){
@endphp
<h4>Seluruh Data Siswa</h4>
    <table style="border-collapse: collapse">
        <tr>
            <th style="border: 1px solid black">No</th>
            <th style="border: 1px solid black">NIS</th>
            <th style="border: 1px solid black">NISN</th>
            <th style="border: 1px solid black">Nama Lengkap Siswa</th>
            <th style="border: 1px solid black">Jenis Kelamin</th>
            <th style="border: 1px solid black">Tempat Lahir</th>
            <th style="border: 1px solid black">Tanggal Lahir</th>
            <th style="border: 1px solid black">Kelas</th>
            <th style="border: 1px solid black">Alamat</th>
            <th style="border: 1px solid black">Nomor Telpon</th>
            <th style="border: 1px solid black">Status Masuk</th>
        </tr>
        @foreach($siswa as $no => $ssw)
        <tr>
            <td style="border: 1px solid black; text-align: center;">{{ $no+1 }}</td>
            <td style="border: 1px solid black">{{ $ssw->nis }}</td>
            <td style="border: 1px solid black">{{ $ssw->nisn }}</td>
            <td style="border: 1px solid black">{{ $ssw->nama_siswa }}</td>
            <td style="border: 1px solid black">{{ $ssw->gender_siswa }}</td>
            <td style="border: 1px solid black">{{ $ssw->tempat_lahir_siswa }}</td>
            <td style="border: 1px solid black">{{ $ssw->tanggal_lahir_siswa }}</td>
            <td style="border: 1px solid black">{{ $ssw->nama_kelas.$ssw->grup_kelas }}</td>
            <td style="border: 1px solid black">{{ $ssw->alamat_siswa }}</td>
            <td style="border: 1px solid black">{{ $ssw->nohp_siswa }}</td>
            <td style="border: 1px solid black">{{ $ssw->status_daftar == '1' ? 'Terdaftar' : 'Belum Terdaftar' }}</td>
        </tr>
        @endforeach
    </table>
@php 
    }elseif($rekap == 'jml'){
@endphp
<h4>Jumlah Data Siswa</h4>
    <table style="border-collapse: collapse">
        <tr>
            <th rowspan="2" style="border: 1px solid black">No</th>
            <th rowspan="2" style="border: 1px solid black">Kelas</th>
            <th colspan="2" style="border: 1px solid black; text-align: center;">Jumlah Siswa</th>
        </tr>
        <tr>
            <th style="border: 1px solid black">L</th>
            <th style="border: 1px solid black">P</th>
        </tr>
        @foreach($siswa as $no => $ssw)
        <tr>
            <td style="border: 1px solid black; text-align: center;">{{ $no+1 }}</td>
            <td style="border: 1px solid black">{{ $ssw->nama_kelas.$ssw->grup_kelas }}</td>
            <td style="border: 1px solid black">{{ $ssw->Male }}</td>
            <td style="border: 1px solid black">{{ $ssw->Female }}</td>
        </tr>
        @endforeach
    </table>
@php 
    }else{
@endphp
<h4>Kelas <?= $siswa[0]->nama_kelas.$siswa[0]->grup_kelas ?></h4>
    <table style="border-collapse: collapse">
        <tr>
            <th style="border: 1px solid black">No</th>
            <th style="border: 1px solid black">NIS</th>
            <th style="border: 1px solid black">NISN</th>
            <th style="border: 1px solid black">Nama Lengkap Siswa</th>
            <th style="border: 1px solid black">Jenis Kelamin</th>
        </tr>
        @foreach($siswa as $no => $ssw)
        <tr>
            <td style="border: 1px solid black; text-align: center;">{{ $no+1 }}</td>
            <td style="border: 1px solid black">{{ $ssw->nis }}</td>
            <td style="border: 1px solid black">{{ $ssw->nisn }}</td>
            <td style="border: 1px solid black">{{ $ssw->nama_siswa }}</td>
            <td style="border: 1px solid black">{{ $ssw->gender_siswa }}</td>
        </tr>
        @endforeach
    </table>
@php 
    }
@endphp
</body>
</html>