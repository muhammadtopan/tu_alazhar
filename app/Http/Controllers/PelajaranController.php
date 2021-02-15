<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pelajaran_Model;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class PelajaranController extends Controller
{
    public function index()
    {
        $pelajaran = Pelajaran_Model::all();
        return view(
            'page/pelajaran/index',
            [
                'pelajaran' => $pelajaran
            ]
        );
    }
    public function create()
    {
        return view(
            'page/pelajaran/form',
            [
                'url' => 'pelajaran.store'
            ]
        );
    }
    public function store(Request $request, Pelajaran_Model $pelajaran)
    {
        $validator = Validator::make($request->all(), [
            'nama_pelajaran'         => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('pelajaran.create')
                ->withErrors($validator)
                ->withInput();
        } else {

            $pelajaran->nama_pelajaran = $request->input('nama_pelajaran');
            $pelajaran->save();

            return redirect()
                ->route('pelajaran')
                ->with('message', 'Data berhasil ditambahkan');
        }
    }

    public function edit(Pelajaran_Model $pelajaran)
    {
        return view(
            'page/pelajaran/form',
            [
                'pelajaran' => $pelajaran,
                'url' => 'pelajaran.update',
            ]
        );
    }

    public function update(Request $request, Pelajaran_Model $pelajaran)
    {
        $validator = Validator::make($request->all(),[
            'nama_pelajaran'         => 'required'
        ]);

        if($validator->fails()){
            return redirect()
                ->route('pelajaran.update', $pelajaran->id_pelajaran)
                ->withErrors($validator)     
                ->withInput();
        }else{

            $pelajaran->nama_pelajaran = $request->input('nama_pelajaran');
            $pelajaran->save();

            return redirect()
                ->route('pelajaran')
                ->with('message', 'Data berhasil diedit');
        }
    }

    public function destroy(Pelajaran_Model $pelajaran)
    {
        $pelajaran->forceDelete();
        return redirect()
            ->route('pelajaran')
            ->with('message', 'Data berhasil dihapus');
    }
}

