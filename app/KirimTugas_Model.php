<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class KirimTugas_Model extends Model
{
    use SoftDeletes;
    protected $table = "tb_kirim_tugas";
    protected $primaryKey = 'id_kirim_tugas';
    protected $fillable = [
        'id_tugas',
        'id_user',
        'tgl_kirim_tugas',
        'file_tugas',
        'ket_tugas'
    ];
}
