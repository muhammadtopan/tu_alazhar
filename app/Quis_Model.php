<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;

class Quis_Model extends Model
{
    use SoftDeletes;
    protected $table = "tb_quis";
    protected $primaryKey = 'id_quis';
    protected $fillable = [
        'id_kelas',
        'id_pelajaran',
        'soal',
        'pil_a',
        'pil_b',
        'pil_c',
        'pil_d',
        'kunci'
    ];
}
