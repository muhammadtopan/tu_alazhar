<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Pelajaran_Model extends Model
{
    use SoftDeletes;
    protected $table = "tb_pelajaran";
    protected $primaryKey = 'id_pelajaran';
    protected $fillable = [
        'nama_pelajaran'
    ];
}
