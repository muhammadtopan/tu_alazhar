<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Hari_Model extends Model
{
    use SoftDeletes;
    protected $table = "tb_hari";
    protected $primaryKey = 'id_hari';
    protected $fillable = [
        'hari'
    ];
}