<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class JamAjar_Model extends Model
{
    use SoftDeletes;
    protected $table = "tb_jam_ajar";
    protected $primaryKey = 'id_jam';
    protected $fillable = [
        'jam_awal',
        'jam_akhir'
    ];
}
