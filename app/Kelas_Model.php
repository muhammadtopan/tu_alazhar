<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Kelas_Model extends Model
{
    use SoftDeletes;
    protected $table = "tb_kelas";
    protected $primaryKey = 'id_kelas';
    protected $fillable = [
        'id_semester',
        'nama_kelas',
        'grup_kelas'
    ];
}
