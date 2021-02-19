<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Izin_Model;
use App\Siswa_Model;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class IzinController extends Controller
{
    public function index()
    {
        $izin = DB::table('tb_izin')
                ->join('tb_siswa', 'tb_siswa.id_siswa', '=', 'tb_izin.id_siswa')
                ->select('tb_izin.*', 'tb_siswa.nama_siswa')
                ->get();
        return view(
            'page/izin/index',
            [
                'izin' => $izin
            ]
        );
    }
    public function create()
    {
        $siswa = Siswa_Model::all();
        return view(
            'page/izin/form',
            [
                'url' => 'izin.store',
                'siswa' => $siswa
            ]
        );
    }
    public function store(Request $request, Izin_Model $izin)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'id_siswa'          => 'required',
            'keterangan_izin'   => 'required',
            'tgl_izin'          => 'required',
            'foto_izin'         => 'mimes:jpg,jpeg,png,bmp'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('izin.create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $file = $request->file('foto_izin'); 
            $filename = time() . "." . $file->getClientOriginalExtension(); 
            $file->move('backend/img/izin/', $filename);

            $izin->id_siswa = $request->input('id_siswa');
            $izin->keterangan_izin = $request->input('keterangan_izin');
            $izin->tgl_izin = $request->input('tgl_izin');
            $izin->foto_izin = $filename;
            $izin->save();

            return redirect()
                ->route('izin')
                ->with('message', 'Data berhasil ditambahkan');
        }
    }

    public function edit(Izin_Model $izin)
    {
        $siswa = Siswa_Model::all();
        return view(
            'page/izin/form',
            [
                'url' => 'izin.update',
                'siswa' => $siswa,
                'izin' => $izin
            ]
        );
    }

    public function update(Request $request, Izin_Model $izin)
    {
        $validator = Validator::make($request->all(),[
            'id_siswa'          => 'required',
            'keterangan_izin'   => 'required',
            'tgl_izin'          => 'required',
            'foto_izin'         => 'mimes:jpg,jpeg,png,bmp'
        ]);

        if($validator->fails()){
            return redirect()
                ->route('izin.update', $izin->id_izin)
                ->withErrors($validator)
                ->withInput();
        }else{
            if ($request->hasFile('foto_izin')) {
                // cari nama foto lama lalu hapus 
                unlink('backend/img/izin/' . $izin->foto_izin); 
                $file = $request->file('foto_izin'); 
                $filename = time() . "." . $file->getClientOriginalExtension(); 
                $file->move('backend/img/izin/', $filename); 
                $izin->foto_izin = $filename; 
            }
            $izin->id_siswa = $request->input('id_siswa');
            $izin->keterangan_izin = $request->input('keterangan_izin');
            $izin->tgl_izin = $request->input('tgl_izin');
            $izin->save();

            return redirect()
                ->route('izin')
                ->with('message', 'Data berhasil diedit');
        }
    }

    public function destroy(Izin_Model $izin)
    {
        $foto_izin = $izin->foto_izin; 
        unlink('backend/img/izin/' . $foto_izin);         
        $izin->forceDelete();
        return redirect()
            ->route('izin')
            ->with('message', 'Data berhasil dihapus');
    }
}
