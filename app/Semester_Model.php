<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester_Model extends Model
{
    protected $table = "tb_semester";
    protected $primaryKey = 'id_semester';
    protected $fillable = [
        'semester'
    ];
}
