<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jabatan_Model;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class JabatanController extends Controller
{
    public function index()
    {
        $jabatan = Jabatan_Model::all();
        return view(
            'page/jabatan/index',
            [
                'jabatan' => $jabatan
            ]
        );
    }
    public function create()
    {
        return view(
            'page/jabatan/form',
            [
                'url' => 'jabatan.store'
            ]
        );
    }
    public function store(Request $request, Jabatan_Model $jabatan)
    {
        $validator = Validator::make($request->all(), [
            'nama_jabatan'         => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('jabatan.create')
                ->withErrors($validator)
                ->withInput();
        } else {

            $jabatan->nama_jabatan = $request->input('nama_jabatan');
            $jabatan->save();

            return redirect()
                ->route('jabatan')
                ->with('message', 'Data berhasil ditambahkan');
        }
    }

    public function edit(Jabatan_Model $jabatan)
    {
        return view(
            'page/jabatan/form',
            [
                'jabatan' => $jabatan,
                'url' => 'jabatan.update',
            ]
        );
    }

    public function update(Request $request, Jabatan_Model $jabatan)
    {
        $validator = Validator::make($request->all(),[
            'nama_jabatan'         => 'required',
        ]);

        if($validator->fails()){
            return redirect()
                ->route('jabatan.update', $jabatan->id_jabatan)
                ->withErrors($validator)
                ->withInput();
        }else{

            $jabatan->nama_jabatan = $request->input('nama_jabatan');
            $jabatan->save();

            return redirect()
                ->route('jabatan')
                ->with('message', 'Data berhasil diedit');
        }
    }

    public function destroy(Jabatan_Model $jabatan)
    {
        $jabatan->forceDelete();
        return redirect()
            ->route('jabatan')
            ->with('message', 'Data berhasil dihapus');
    }
}

