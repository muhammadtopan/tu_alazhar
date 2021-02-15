<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\JamAjar_Model;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class JamAjarController extends Controller
{
    public function index()
    {
        $jam_ajar = JamAjar_Model::all();
        return view(
            'page/jam_ajar/index',
            [
                'jam_ajar' => $jam_ajar
            ]
        );
    }
    public function create()
    {
        return view(
            'page/jam_ajar/form',
            [
                'url' => 'jam_ajar.store'
            ]
        );
    }
    public function store(Request $request, JamAjar_Model $jam_ajar)
    {
        $validator = Validator::make($request->all(), [
            'jam_awal'         => 'required',
            'jam_akhir'         => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('jam_ajar.create')
                ->withErrors($validator)
                ->withInput();
        } else {

            $jam_ajar->jam_awal = $request->input('jam_awal');
            $jam_ajar->jam_akhir = $request->input('jam_akhir');
            $jam_ajar->save();

            return redirect()
                ->route('jam_ajar')
                ->with('message', 'Data berhasil ditambahkan');
        }
    }

    public function edit(JamAjar_Model $jam_ajar)
    {
        return view(
            'page/jam_ajar/form',
            [
                'jam_ajar' => $jam_ajar,
                'url' => 'jam_ajar.update',
            ]
        );
    }

    public function update(Request $request, JamAjar_Model $jam_ajar)
    {
        $validator = Validator::make($request->all(),[
            'jam_awal'         => 'required',
            'jam_akhir'         => 'required',
        ]);

        if($validator->fails()){
            return redirect()
                ->route('jam_ajar.update', $jam_ajar->id_jam)
                ->withErrors($validator)
                ->withInput();
        }else{

            $jam_ajar->jam_awal = $request->input('jam_awal');
            $jam_ajar->jam_akhir = $request->input('jam_akhir');
            $jam_ajar->save();

            return redirect()
                ->route('jam_ajar')
                ->with('message', 'Data berhasil diedit');
        }
    }

    public function destroy(JamAjar_Model $jam_ajar)
    {
        $jam_ajar->forceDelete();
        return redirect()
            ->route('jam_ajar')
            ->with('message', 'Data berhasil dihapus');
    }

    public function getJam($id)
    {
        // dd($id);
        $jamAjar = DB::table('tb_jam_ajar')->where('id_jam', $id)->first();

        return json_encode($jamAjar);
    }
}