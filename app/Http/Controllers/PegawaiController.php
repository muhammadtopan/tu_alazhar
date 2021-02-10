<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Guru_Model;
use App\Sekolah_Model;
use DB;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = DB::table('tb_pegawai')
                ->join('tb_jabatan', 'tb_jabatan.id_jabatan', '=', 'tb_pegawai.jabatan_id')
                ->select('tb_pegawai.*', 'tb_jabatan.nama_jabatan')
                ->get();

        return view(
            'page/pegawai/index',
            [
                'pegawai' => $pegawai
            ]
        );
    }
    public function create()
    {
        $sekolah = Sekolah_Model::all();
        return view(
            'page/guru/form',
            [
                'url' => 'guru.store',
                'sekolah' => $sekolah
            ]
        );
    }
    public function store(Request $request, Guru_Model $guru)
    {
        $validator = Validator::make($request->all(), [
            'sekolah_id'         => 'required',
            'guru_nama'         => 'required',
            'guru_tgl_lahir'         => 'required',
            'guru_jekel'         => 'required',
            'guru_email'         => 'required|email|unique:tb_guru,guru_email',
            'guru_notelp'         => 'required|numeric',
            'guru_alamat'         => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('guru.create')
                ->withErrors($validator)
                ->withInput();
        } else {
    
            $guru->sekolah_id = $request->input('sekolah_id');
            $guru->guru_nama = $request->input('guru_nama');
            $guru->guru_tgl_lahir = $request->input('guru_tgl_lahir');
            $guru->guru_jekel = $request->input('guru_jekel');
            $guru->guru_email = $request->input('guru_email');
            $guru->guru_notelp = $request->input('guru_notelp');
            $guru->guru_alamat = $request->input('guru_alamat');
            $guru->save();

            return redirect()
                ->route('guru')
                ->with('message', 'Data berhasil ditambahkan');
        }
    }

    public function edit(Guru_Model $guru)
    {
        $sekolah = Sekolah_Model::all();
        return view(
            'page/guru/form',
            [
                'guru' => $guru,
                'sekolah' => $sekolah,
                'url' => 'guru.update',
            ]
        );
    }

    public function update(Request $request, Guru_Model $guru)
    {
        $validator = Validator::make($request->all(),[
            'sekolah_id'        => 'required',
            'guru_nama'         => 'required',
            'guru_tgl_lahir'    => 'required',
            'guru_jekel'        => 'required',
            'guru_email'        => 'required|email',
            'guru_notelp'       => 'required|numeric',
            'guru_alamat'       => 'required',
        ]);

        if($validator->fails()){
            return redirect()
                ->route('guru.update', $guru->guru_id)
                ->withErrors($validator)
                ->withInput();
        }else{

            $guru->sekolah_id = $request->input('sekolah_id');
            $guru->guru_nama = $request->input('guru_nama');
            $guru->guru_tgl_lahir = $request->input('guru_tgl_lahir');
            $guru->guru_jekel = $request->input('guru_jekel');
            $guru->guru_email = $request->input('guru_email');
            $guru->guru_notelp = $request->input('guru_notelp');
            $guru->guru_alamat = $request->input('guru_alamat');
            $guru->save();

            return redirect()
                ->route('guru')
                ->with('message', 'Data berhasil diedit');
        }
    }

    public function destroy(Guru_Model $guru)
    {
        $guru->forceDelete();
        return redirect()
            ->route('guru')
            ->with('message', 'Data berhasil dihapus');
    }
}
