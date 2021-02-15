<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Lapor_Model;
use App\Siswa_Model;
use App\Kelas_Model;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class LaporController extends Controller
{
    public function index()
    {
        $lapor = DB::table('tb_lapor')
                ->join('tb_siswa', 'tb_siswa.id_siswa', '=', 'tb_lapor.id_siswa')
                ->join('tb_kelas', 'tb_kelas.id_kelas', '=', 'tb_lapor.id_kelas')
                ->select('tb_lapor.*', 'tb_siswa.nama_siswa', 'tb_kelas.nama_kelas', 'tb_kelas.grup_kelas')
                ->get();

        return view(
            'page/lapor/index',
            [
                'lapor' => $lapor
            ]
        );
    }
    public function create()
    {
        $siswa = Siswa_Model::all();
        $kelas = Kelas_Model::all();
        return view(
            'page/lapor/form',
            [
                'url' => 'lapor.store',
                'siswa' => $siswa,
                'kelas' => $kelas
            ]
        );
    }
    public function store(Request $request, Lapor_Model $lapor)
    {
        $validator = Validator::make($request->all(), [
            'nama_siswa'         => 'required',
            'id_kelas'         => 'required',
            'file'               => 'mimes:pdf'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('lapor.create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $file = $request->file('file'); 
            $filename = time() . "." . $file->getClientOriginalExtension(); 
            $file->move('backend/file/lapor/', $filename);

            $lapor->id_siswa = $request->input('nama_siswa');
            $lapor->id_kelas = $request->input('id_kelas');
            $lapor->file = $filename;
            
            $lapor->save();

            return redirect()
                ->route('lapor')
                ->with('message', 'Data berhasil ditambahkan');
        }
    }

    public function edit(Hari_Model $hari)
    {
        return view(
            'page/hari/form',
            [
                'hari' => $hari,
                'url' => 'hari.update',
            ]
        );
    }

    public function destroy(Lapor_Model $lapor)
    {
        $file_pdf = $lapor->file; 
        unlink('backend/file/lapor/' . $file_pdf); 
        
        $lapor->forceDelete();
        return redirect()
            ->route('lapor')
            ->with('message', 'Data berhasil dihapus');
    }
}
