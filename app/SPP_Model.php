<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SPP_Model extends Model
{
    use SoftDeletes;
    protected $table = "tb_spp";
    protected $primaryKey = 'id_spp';
    protected $fillable = [
        'id_siswa',
        'tgl_bayar',
        'bulan_spp',
        'tahun_spp',
        'upload_bukti',
        'status'
    ];
}
