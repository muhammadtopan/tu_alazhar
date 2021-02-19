<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kelas_Model;
use App\Semester_Model;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas_Model::all();
        return view(
            'page/kelas/index',
            [
                'kelas' => $kelas
            ]
        );
    }
    public function create()
    {
        return view(
            'page/kelas/form',
            [
                'url' => 'kelas.store',
            ]
        );
    }
    public function store(Request $request, Kelas_Model $kelas)
    {
        $validator = Validator::make($request->all(), [
            'nama_kelas'         => 'required',
            'grup_kelas'         => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('kelas.create')
                ->withErrors($validator)
                ->withInput();
        } else {

            $kelas->nama_kelas = $request->input('nama_kelas');
            $kelas->grup_kelas = $request->input('grup_kelas');
            $kelas->save();

            return redirect()
                ->route('kelas')
                ->with('message', 'Data berhasil ditambahkan');
        }
    }

    public function edit(Kelas_Model $kelas)
    {
        return view(
            'page/kelas/form',
            [
                'kelas' => $kelas,
                'url' => 'kelas.update',
            ]
        );
    }

    public function update(Request $request, Kelas_Model $kelas)
    {
        $validator = Validator::make($request->all(),[
            'nama_kelas'         => 'required',
            'grup_kelas'         => 'required'
        ]);

        if($validator->fails()){
            return redirect()
                ->route('kelas.update', $kelas->id_kelas)
                ->withErrors($validator)
                ->withInput();
        }else{

            $kelas->nama_kelas = $request->input('nama_kelas');
            $kelas->grup_kelas = $request->input('grup_kelas');
            $kelas->save();

            return redirect()
                ->route('kelas')
                ->with('message', 'Data berhasil diedit');
        }
    }

    public function destroy(Kelas_Model $kelas)
    {
        $kelas->forceDelete();
        return redirect()
            ->route('kelas')
            ->with('message', 'Data berhasil dihapus');
    }

    // api

    public function getKelas($id)
    {
        // dd($id);
        $kelas = DB::table('tb_kelas')->where('id_kelas', '=', $id)->first();

        return json_encode($kelas);
    }
}
