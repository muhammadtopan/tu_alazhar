<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class JadwalPelajaran_Model extends Model
{
    use SoftDeletes;
    protected $table = "tb_jadwal_pelajaran";
    protected $primaryKey = 'id_jadwal_pelajaran';
    protected $fillable = [
        'id_jam_ajar',
        'id_kelas',
        'id_pelajaran',
        'id_guru',
        'id_hari'
    ];
}
