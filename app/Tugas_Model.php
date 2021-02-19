<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;

class Tugas_Model extends Model
{
    use SoftDeletes;
    protected $table = "tb_tugas";
    protected $primaryKey = 'id_tugas';
    protected $fillable = [
        'id_pelajaran',
        'id_kelas',
        'judul_tugas',
        'isi_tugas',
        'file_tugas',
        'deadline_tugas',
    ];
}
