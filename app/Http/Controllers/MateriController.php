<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Materi_Model;
use App\Pelajaran_Model;
use App\Kelas_Model;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class MateriController extends Controller
{
    public function index()
    {
        $materi = DB::table('tb_materi')
                ->join('tb_pelajaran', 'tb_pelajaran.id_pelajaran', '=', 'tb_materi.id_pelajaran')
                ->join('tb_kelas', 'tb_kelas.id_kelas', '=', 'tb_materi.id_kelas')
                ->select('tb_materi.*', 'tb_pelajaran.nama_pelajaran as nama_pelajaran2', 
                        'tb_kelas.nama_kelas', 'tb_kelas.grup_kelas')
                ->get();
        $judul = DB::table('tb_materi')->select('tb_materi.nama_pelajaran');
        return view(
            'page/materi/index',
            [
                'materi' => $materi
            ]
        );
    }
    public function create()
    {
        $pelajaran = Pelajaran_Model::all();
        $kelas = Kelas_Model::all();
        return view(
            'page/materi/form',
            [
                'url' => 'materi.store',
                'pelajaran' => $pelajaran,
                'kelas' => $kelas
            ]
        );
    }
    public function store(Request $request, Materi_Model $materi)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'id_pelajaran'          => 'required',
            'id_kelas'              => 'required',
            'nama_pelajaran'        => 'required',
            'materi_pelajaran'      => 'mimes:pdf',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('materi.create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $file_materi = $request->file('materi_pelajaran'); 
            $filename = time() . "." . $file_materi->getClientOriginalExtension(); 
            $file_materi->move('backend/file/materi/', $filename);

            $materi->id_pelajaran = $request->input('id_pelajaran');
            $materi->id_kelas = $request->input('id_kelas');
            $materi->nama_pelajaran = $request->input('nama_pelajaran');
            $materi->materi_pelajaran = $filename;
            $materi->save();

            return redirect()
                ->route('materi')
                ->with('message', 'Data berhasil ditambahkan');
        }
    }

    public function edit(Materi_Model $materi)
    {
        $pelajaran = Pelajaran_Model::all();
        $kelas = Kelas_Model::all();
        return view(
            'page/materi/form',
            [
                'url' => 'materi.update',
                'kelas' => $kelas,
                'pelajaran' => $pelajaran,
                'materi' => $materi
            ]
        );
    }

    public function update(Request $request, Materi_Model $materi)
    {
        $validator = Validator::make($request->all(),[
            'id_pelajaran'          => 'required',
            'id_kelas'              => 'required',
            'nama_pelajaran'        => 'required',
            'materi_pelajaran'      => 'mimes:pdf',
        ]);

        if($validator->fails()){
            return redirect()
                ->route('materi.update', $materi->id_materi)
                ->withErrors($validator)
                ->withInput();
        }else{
            if ($request->hasFile('materi_pelajaran')) {
                // cari nama foto lama lalu hapus 
                unlink('backend/file/materi/' . $materi->materi_pelajaran); 
                $file_materi = $request->file('materi_pelajaran'); 
                $filename = time() . "." . $file_materi->getClientOriginalExtension(); 
                $file_materi->move('backend/file/materi/', $filename); 
                $materi->materi_pelajaran = $filename; 
            }
            $materi->id_pelajaran = $request->input('id_pelajaran');
            $materi->id_kelas = $request->input('id_kelas');
            $materi->nama_pelajaran = $request->input('nama_pelajaran');
            $materi->materi_pelajaran = $filename;
            $materi->save();

            return redirect()
                ->route('materi')
                ->with('message', 'Data berhasil diedit');
        }
    }

    public function destroy(Materi_Model $materi)
    {
        $materi_pelajaran = $materi->materi_pelajaran; 
        unlink('backend/file/materi/' . $materi_pelajaran);         
        $materi->forceDelete();
        return redirect()
            ->route('materi')
            ->with('message', 'Data berhasil dihapus');
    }
}
