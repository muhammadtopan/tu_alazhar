<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Berkas_Model extends Model
{
    use SoftDeletes;
    protected $table = "tb_berkas";
    protected $primaryKey = 'id_berkas';
    protected $fillable = [
        'id_siwa',
        'berkas_kk',
        'berkas_akte',
        'berkas_lapor',
    ];
}
