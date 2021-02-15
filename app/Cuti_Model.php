<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Cuti_Model extends Model
{
    use SoftDeletes;
    protected $table = "tb_cuti";
    protected $primaryKey = 'id_cuti';
    protected $fillable = [
        'nip',
        'lama_cuti',
        'alasan_cuti',
        'tanggal_mulai',
        'tanggal_akhir'
    ];
}
