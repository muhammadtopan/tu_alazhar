<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;

class Nilai_Model extends Model
{
    use SoftDeletes;
    protected $table = "tb_nilai";
    protected $primaryKey = 'id_nilai';
    protected $fillable = [
        'id_siswa',
        'id_pelajaran',
        'nilai'
    ];
}
