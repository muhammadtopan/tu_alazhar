<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;

class Materi_Model extends Model
{
    use SoftDeletes;
    protected $table = "tb_materi";
    protected $primaryKey = 'id_materi';
    protected $fillable = [
        'id_pelajaran',
        'id_kelas',
        'materi_pelajaran',
        'nama_pelajaran'
    ];
}
