<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Pegawai_Model extends Model
{
    use SoftDeletes;
    protected $table = "tb_pegawai";
    protected $primaryKey = 'id';
    protected $fillable = [
        'nip',
        'nama_peg',
        'Email',
        'no_tlp',
        'alamat',
        'tgl_masuk',
        'tmp_lahir',
        'agama',
        'gender',
        'pendidikan',
        'foto',
    ];
}
