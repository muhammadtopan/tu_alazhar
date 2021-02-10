<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Jabatan_Model extends Model
{
    use SoftDeletes;
    protected $table = "tb_jabatan";
    protected $primaryKey = 'id_jabatan';
    protected $fillable = [
        'nama_jabatan'
    ];
}
