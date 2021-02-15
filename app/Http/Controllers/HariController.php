<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Hari_Model;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class HariController extends Controller
{
    public function index()
    {
        $hari = Hari_Model::all();
        return view(
            'page/hari/index',
            [
                'hari' => $hari
            ]
        );
    }
    public function create()
    {
        return view(
            'page/hari/form',
            [
                'url' => 'hari.store'
            ]
        );
    }
    public function store(Request $request, Hari_Model $hari)
    {
        $validator = Validator::make($request->all(), [
            'hari'         => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('hari.create')
                ->withErrors($validator)
                ->withInput();
        } else {

            $hari->hari = $request->input('hari');
            $hari->save();

            return redirect()
                ->route('hari')
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

    public function update(Request $request, Hari_Model $hari)
    {
        $validator = Validator::make($request->all(),[
            'hari'         => 'required',
        ]);

        if($validator->fails()){
            return redirect()
                ->route('hari.update', $hari->id_hari)
                ->withErrors($validator)
                ->withInput();
        }else{

            $hari->hari = $request->input('hari');
            $hari->save();

            return redirect()
                ->route('hari')
                ->with('message', 'Data berhasil diedit');
        }
    }

    public function destroy(Hari_Model $hari)
    {
        $hari->forceDelete();
        return redirect()
            ->route('hari')
            ->with('message', 'Data berhasil dihapus');
    }
}