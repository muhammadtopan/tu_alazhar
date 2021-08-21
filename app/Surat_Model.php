<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Surat_Model extends Model
{
    use SoftDeletes;
    protected $table = "tb_surat";
    protected $primaryKey = 'surat_id';
    protected $fillable = [
        'surat_jenis',
        'surat_nomor',
        'surat_tanggal',
        'surat_tujuan',
        'surat_ket',
        'surat_file',
    ];
}
