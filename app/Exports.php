<?php
namespace App\Exports;
use App\Pegawai_Model;
use Maatwebsite\Excel\Concerns\FromCollection;
class PostExport implements FromCollection
{
    public function collection()
    {
        return Pegawai_Model::all();
    }
}