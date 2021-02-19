<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\KirimTugas_Model;
use App\Tugas_Model;
use App\Siswa_Model;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class KirimTugasController extends Controller
{
    public function index()
    {
        $kirim_tugas = DB::table('tb_kirim_tugas')
                ->join('tb_tugas', 'tb_tugas.id_tugas', '=', 'tb_kirim_tugas.id_tugas')
                ->join('tb_siswa', 'tb_siswa.id_siswa', '=', 'tb_kirim_tugas.id_user')
                ->select('tb_kirim_tugas.*', 'tb_tugas.judul_tugas', 
                        'tb_siswa.nama_siswa')
                ->get();
        return view(
            'page/kirim_tugas/index',
            [
                'kirim_tugas' => $kirim_tugas
            ]
        );
    }
    public function create()
    {
        $tugas = Tugas_Model::all();
        $siswa = Siswa_Model::all();
        return view(
            'page/kirim_tugas/form',
            [
                'url' => 'kirim_tugas.store',
                'tugas' => $tugas,
                'siswa' => $siswa
            ]
        );
    }
    public function store(Request $request, KirimTugas_Model $kirim_tugas)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'id_tugas'        => 'required',
            'id_user'         => 'required',
            'tgl_kirim_tugas' => 'required',
            'file_tugas'      => 'mimes:pdf',
            'ket_tugas'       => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('kirim_tugas.create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $file = $request->file('file_tugas'); 
            $filename = time() . "." . $file->getClientOriginalExtension(); 
            $file->move('backend/file/kirim_tugas/', $filename);

            $kirim_tugas->id_tugas = $request->input('id_tugas');
            $kirim_tugas->id_user = $request->input('id_user');
            $kirim_tugas->tgl_kirim_tugas = $request->input('tgl_kirim_tugas');
            $kirim_tugas->file_tugas = $filename;
            $kirim_tugas->ket_tugas = $request->input('ket_tugas');
            $kirim_tugas->save();

            return redirect()
                ->route('kirim_tugas')
                ->with('message', 'Data berhasil ditambahkan');
        }
    }

    public function edit(KirimTugas_Model $kirim_tugas)
    {
        $tugas = Tugas_Model::all();
        $siswa = Siswa_Model::all();
        return view(
            'page/kirim_tugas/form',
            [
                'url' => 'kirim_tugas.update',
                'tugas' => $tugas,
                'siswa' => $siswa,
                'kirim_tugas' => $kirim_tugas
            ]
        );
    }

    public function update(Request $request, KirimTugas_Model $kirim_tugas)
    {
        $validator = Validator::make($request->all(),[
            'id_tugas'        => 'required',
            'id_user'         => 'required',
            'tgl_kirim_tugas' => 'required',
            'file_tugas'      => 'mimes:pdf',
            'ket_tugas'       => 'required'
        ]);

        if($validator->fails()){
            return redirect()
                ->route('kirim_tugas.update', $kirim_tugas->id_kirim_tugas)
                ->withErrors($validator)
                ->withInput();
        }else{
            if ($request->hasFile('file_tugas')) {
                // cari nama foto lama lalu hapus 
                unlink('backend/file/kirim_tugas/' . $kirim_tugas->file_tugas); 
                $file = $request->file('file_tugas'); 
                $filename = time() . "." . $file->getClientOriginalExtension(); 
                $file->move('backend/file/kirim_tugas/', $filename); 
                $kirim_tugas->file_tugas = $filename; 
            }
            $kirim_tugas->id_tugas = $request->input('id_tugas');
            $kirim_tugas->id_user = $request->input('id_user');
            $kirim_tugas->tgl_kirim_tugas = $request->input('tgl_kirim_tugas');
            $kirim_tugas->file_tugas = $filename;
            $kirim_tugas->ket_tugas = $request->input('ket_tugas');
            $kirim_tugas->save();

            return redirect()
                ->route('kirim_tugas')
                ->with('message', 'Data berhasil diedit');
        }
    }

    public function destroy(KirimTugas_Model $kirim_tugas)
    {
        $file_tugas = $kirim_tugas->file_tugas; 
        unlink('backend/file/kirim_tugas/' . $file_tugas);         
        $kirim_tugas->forceDelete();
        return redirect()
            ->route('kirim_tugas')
            ->with('message', 'Data berhasil dihapus');
    }
}
