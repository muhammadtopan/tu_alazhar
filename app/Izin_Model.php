<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Izin_Model extends Model
{
    use SoftDeletes;
    protected $table = "tb_izin";
    protected $primaryKey = 'id_izin';
    protected $fillable = [
        'id_siswa',
        'keterangan_izin',
        'tgl_izin',
        'foto_izin'
    ];
}
