<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;

class Lapor_Model extends Model
{
    use SoftDeletes;
    protected $table = "tb_lapor";
    protected $primaryKey = 'id_lapor';
    protected $fillable = [
        'id_siswa',
        'id_kelas',
        'file'
    ];
}
