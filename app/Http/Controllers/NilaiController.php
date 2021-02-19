<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Nilai_Model;
use App\Siswa_Model;
use App\Pelajaran_Model;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class NilaiController extends Controller
{
    public function index()
    {
        $nilai = DB::table('tb_nilai')
                ->join('tb_siswa', 'tb_siswa.id_siswa', '=', 'tb_nilai.id_siswa')
                ->join('tb_pelajaran', 'tb_pelajaran.id_pelajaran', '=', 'tb_nilai.id_pelajaran')
                ->select('tb_nilai.*', 'tb_siswa.nama_siswa', 
                        'tb_pelajaran.nama_pelajaran')
                ->get();
        return view(
            'page/nilai/index',
            [
                'nilai' => $nilai
            ]
        );
    }
    public function create()
    {
        $siswa = Siswa_Model::all();
        $pelajaran = Pelajaran_Model::all();
        return view(
            'page/nilai/form',
            [
                'url' => 'nilai.store',
                'siswa' => $siswa,
                'pelajaran' => $pelajaran
            ]
        );
    }
    public function store(Request $request, Nilai_Model $nilai)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'id_siswa'              => 'required',
            'id_pelajaran'          => 'required',
            'nilai'        => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('nilai.create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $nilai->id_siswa = $request->input('id_siswa');
            $nilai->id_pelajaran = $request->input('id_pelajaran');
            $nilai->nilai = $request->input('nilai');
            $nilai->save();

            return redirect()
                ->route('nilai')
                ->with('message', 'Data berhasil ditambahkan');
        }
    }

    public function edit(Nilai_Model $nilai)
    {
        $siswa = Siswa_Model::all();
        $pelajaran = Pelajaran_Model::all();
        return view(
            'page/nilai/form',
            [
                'url' => 'nilai.update',
                'siswa' => $siswa,
                'pelajaran' => $pelajaran,
                'nilai' => $nilai
            ]
        );
    }

    public function update(Request $request, Nilai_Model $nilai)
    {
        $validator = Validator::make($request->all(),[
            'id_siswa'              => 'required',
            'id_pelajaran'          => 'required',
            'nilai'                 => 'required',
        ]);

        if($validator->fails()){
            return redirect()
                ->route('nilai.update', $nilai->id_nilai)
                ->withErrors($validator)
                ->withInput();
        }else{
            $nilai->id_siswa = $request->input('id_siswa');
            $nilai->id_pelajaran = $request->input('id_pelajaran');
            $nilai->nilai = $request->input('nilai');
            $nilai->save();

            return redirect()
                ->route('nilai')
                ->with('message', 'Data berhasil diedit');
        }
    }

    public function destroy(Nilai_Model $nilai)
    {        
        $nilai->forceDelete();
        return redirect()
            ->route('nilai')
            ->with('message', 'Data berhasil dihapus');
    }
}

