<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Siswa_Model extends Model
{
    use SoftDeletes;
    protected $table = "tb_siswa";
    protected $primaryKey = 'id_siswa';
    protected $fillable = [
        'nama_siswa',
        'gender_siswa',
        'nohp_siswa',
        'tempat_lahir_siswa',
        'tanggal_lahir_siswa',
        'alamat_siswa',
        'foto_siswa',
        'status_daftar',
        'id_kelas',
    ];
}
