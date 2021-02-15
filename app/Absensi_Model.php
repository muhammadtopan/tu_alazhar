<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Absensi_Model extends Model
{
    use SoftDeletes;
    protected $table = "tb_absensi";
    protected $primaryKey = 'id_absen';
    protected $fillable = [
        'id_pegawai',
        'jam_ke',
        'tanggal',
        'jam_masuk',
        'jam_selesai',
        'alamat',
        'keterangan',
    ];
}
