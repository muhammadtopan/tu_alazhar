<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class JadwalUjian_Model extends Model
{
    use SoftDeletes;
    protected $table = "tb_jadwal_ujian";
    protected $primaryKey = 'id_jadwal_ujian';
    protected $fillable = [
        'id_jam_ajar',
        'id_kelas',
        'id_pelajaran',
        'id_guru',
        'hari_jadwal'
    ];
}
