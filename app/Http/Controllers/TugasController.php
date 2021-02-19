<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tugas_Model;
use App\Pelajaran_Model;
use App\Kelas_Model;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class TugasController extends Controller
{
    public function index()
    {
        $tugas = DB::table('tb_tugas')
                ->join('tb_pelajaran', 'tb_pelajaran.id_pelajaran', '=', 'tb_tugas.id_pelajaran')
                ->join('tb_kelas', 'tb_kelas.id_kelas', '=', 'tb_tugas.id_kelas')
                ->select('tb_tugas.*', 'tb_pelajaran.nama_pelajaran', 
                        'tb_kelas.nama_kelas', 'tb_kelas.grup_kelas')
                ->get();
        return view(
            'page/tugas/index',
            [
                'tugas' => $tugas
            ]
        );
    }
    public function create()
    {
        $pelajaran = Pelajaran_Model::all();
        $kelas = Kelas_Model::all();
        return view(
            'page/tugas/form',
            [
                'url' => 'tugas.store',
                'pelajaran' => $pelajaran,
                'kelas' => $kelas
            ]
        );
    }
    public function store(Request $request, Tugas_Model $tugas)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'id_pelajaran'          => 'required',
            'id_kelas'              => 'required',
            'judul_tugas'        => 'required',
            'isi_tugas'        => 'required',
            'file_tugas'      => 'mimes:pdf',
            'deadline_tugas'        => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('tugas.create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $file = $request->file('file_tugas'); 
            $filename = time() . "." . $file->getClientOriginalExtension(); 
            $file->move('backend/file/tugas/', $filename);

            $tugas->id_pelajaran = $request->input('id_pelajaran');
            $tugas->id_kelas = $request->input('id_kelas');
            $tugas->judul_tugas = $request->input('judul_tugas');
            $tugas->isi_tugas = $request->input('isi_tugas');
            $tugas->file_tugas = $filename;
            $tugas->deadline_tugas = $request->input('deadline_tugas');
            $tugas->save();

            return redirect()
                ->route('tugas')
                ->with('message', 'Data berhasil ditambahkan');
        }
    }

    public function edit(Tugas_Model $tugas)
    {
        $pelajaran = Pelajaran_Model::all();
        $kelas = Kelas_Model::all();
        return view(
            'page/tugas/form',
            [
                'url' => 'tugas.update',
                'kelas' => $kelas,
                'pelajaran' => $pelajaran,
                'tugas' => $tugas
            ]
        );
    }

    public function update(Request $request, Tugas_Model $tugas)
    {
        $validator = Validator::make($request->all(),[
            'id_pelajaran'          => 'required',
            'id_kelas'              => 'required',
            'judul_tugas'        => 'required',
            'isi_tugas'        => 'required',
            'file_tugas'      => 'mimes:pdf',
            'deadline_tugas'        => 'required'
        ]);

        if($validator->fails()){
            return redirect()
                ->route('tugas.update', $tugas->id_tugas)
                ->withErrors($validator)
                ->withInput();
        }else{
            if ($request->hasFile('file_tugas')) {
                // cari nama foto lama lalu hapus 
                unlink('backend/file/tugas/' . $tugas->file_tugas); 
                $file = $request->file('file_tugas');
                $filename = time() . "." . $file->getClientOriginalExtension(); 
                $file->move('backend/file/tugas/', $filename); 
                $tugas->file_tugas = $filename; 
            }
            $tugas->id_pelajaran = $request->input('id_pelajaran');
            $tugas->id_kelas = $request->input('id_kelas');
            $tugas->judul_tugas = $request->input('judul_tugas');
            $tugas->isi_tugas = $request->input('isi_tugas');
            $tugas->file_tugas = $filename;
            $tugas->deadline_tugas = $request->input('deadline_tugas');
            $tugas->save();

            return redirect()
                ->route('tugas')
                ->with('message', 'Data berhasil diedit');
        }
    }

    public function destroy(Tugas_Model $tugas)
    {
        $file = $tugas->file_tugas; 
        unlink('backend/file/tugas/' . $file);         
        $tugas->forceDelete();
        return redirect()   
            ->route('tugas')
            ->with('message', 'Data berhasil dihapus');
    }
}
