<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Quis_Model;
use App\Kelas_Model;
use App\Pelajaran_Model;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class QuisController extends Controller
{
    public function index()
    {
        $quis = DB::table('tb_quis')
                ->join('tb_pelajaran', 'tb_pelajaran.id_pelajaran', '=', 'tb_quis.id_pelajaran')
                ->join('tb_kelas', 'tb_kelas.id_kelas', '=', 'tb_quis.id_kelas')
                ->select('tb_quis.*', 'tb_pelajaran.nama_pelajaran', 
                        'tb_kelas.nama_kelas', 'tb_kelas.grup_kelas')
                ->get();

        return view(
            'page/quis/index',
            [
                'quis' => $quis
            ]
        );
    }
    public function create()
    {
        $pelajaran = Pelajaran_Model::all();
        $kelas = Kelas_Model::all();
        return view(
            'page/quis/form',
            [
                'url' => 'quis.store',
                'pelajaran' => $pelajaran,
                'kelas' => $kelas
            ]
        );
    }
    public function store(Request $request, Quis_Model $quis)
    {
        $validator = Validator::make($request->all(), [
            'id_kelas'     => 'required',
            'id_pelajaran' => 'required',
            'soal'         => 'required',
            'pil_a'        => 'required',
            'pil_b'        => 'required',
            'pil_c'        => 'required',
            'pil_d'        => 'required',
            'kunci'        => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('quis.create')
                ->withErrors($validator)
                ->withInput();
        } else {

            $quis->id_kelas = $request->input('id_kelas');
            $quis->id_pelajaran = $request->input('id_pelajaran');
            $quis->soal = $request->input('soal');
            $quis->pil_a = $request->input('pil_a');
            $quis->pil_b = $request->input('pil_b');
            $quis->pil_c = $request->input('pil_c');
            $quis->pil_d = $request->input('pil_d');
            $quis->kunci = $request->input('kunci');
            $quis->save();

            return redirect()
                ->route('quis')
                ->with('message', 'Data berhasil ditambahkan');
        }
    }

    public function edit(Quis_Model $quis)
    {
        $pelajaran = Pelajaran_Model::all();
        $kelas = Kelas_Model::all();
        return view(
            'page/quis/form',
            [
                'url' => 'quis.edit',
                'quis' => $quis,
                'pelajaran' => $pelajaran,
                'kelas' => $kelas
            ]
        );
    }

    public function update(Request $request, Quis_Model $quis)
    {
        $validator = Validator::make($request->all(),[
            'id_kelas'     => 'required',
            'id_pelajaran' => 'required',
            'soal'         => 'required',
            'pil_a'        => 'required',
            'pil_b'        => 'required',
            'pil_c'        => 'required',
            'pil_d'        => 'required',
            'kunci'        => 'required',
        ]);

        if($validator->fails()){
            return redirect()
                ->route('quis.update', $quis->id_quis)
                ->withErrors($validator)
                ->withInput();
        }else{

            $quis->id_kelas = $request->input('id_kelas');
            $quis->id_pelajaran = $request->input('id_pelajaran');
            $quis->soal = $request->input('soal');
            $quis->pil_a = $request->input('pil_a');
            $quis->pil_b = $request->input('pil_b');
            $quis->pil_c = $request->input('pil_c');
            $quis->pil_d = $request->input('pil_d');
            $quis->kunci = $request->input('kunci');
            $quis->save();

            return redirect()
                ->route('quis')
                ->with('message', 'Data berhasil diedit');
        }
    }

    public function destroy(Quis_Model $quis)
    {
        $quis->forceDelete();
        return redirect()
            ->route('quis')
            ->with('message', 'Data berhasil dihapus');
    }
}