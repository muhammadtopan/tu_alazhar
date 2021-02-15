<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Siswa_Model;
use App\Kelas_Model;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = DB::table('tb_siswa')
                ->join('tb_kelas', 'tb_kelas.id_kelas', '=', 'tb_siswa.id_kelas')
                ->select('tb_siswa.*', 'tb_kelas.nama_kelas', 'tb_kelas.grup_kelas')
                ->get();

        return view(
            'page/siswa/index',
            [
                'siswa' => $siswa
            ]
        );
    }
    public function create()
    {
        $kelas = Kelas_Model::all();
        return view(
            'page/siswa/form',
            [   
                'url' => 'siswa.store',
                'kelas' => $kelas
            ]
        );
    }
    public function store(Request $request, Siswa_Model $siswa)
    {
        $validator = Validator::make($request->all(), [
            'nama_siswa'         => 'required',
            'gender_siswa'         => 'required',
            'nohp_siswa'         => 'required',
            'tempat_lahir_siswa'         => 'required',
            'tanggal_lahir_siswa'         => 'required',
            'alamat_siswa'         => 'required',
            'foto_siswa'         => 'mimes:jpg,jpeg,png,bmp',
            'id_kelas'         => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('siswa.create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $foto = $request->file('foto_siswa'); 
            $filename = time() . "." . $foto->getClientOriginalExtension(); 
            $foto->move('backend/img/siswa/', $filename);

            $siswa->nama_siswa = $request->input('nama_siswa');
            $siswa->gender_siswa = $request->input('gender_siswa');
            $siswa->nohp_siswa = $request->input('nohp_siswa');
            $siswa->tempat_lahir_siswa = $request->input('tempat_lahir_siswa');
            $siswa->tanggal_lahir_siswa = $request->input('tanggal_lahir_siswa');
            $siswa->alamat_siswa = $request->input('alamat_siswa');
            $siswa->status_daftar = 0;
            $siswa->id_kelas = $request->input('id_kelas');
            $siswa->foto_siswa = $filename;
            $siswa->save();

            return redirect()
                ->route('siswa')
                ->with('message', 'Data berhasil ditambahkan');
        }
    }

    public function edit(Siswa_Model $siswa)
    {
        $kelas = Kelas_Model::all();
        return view(
            'page/siswa/form',
            [
                'siswa' => $siswa,
                'kelas' => $kelas,
                'url' => 'siswa.update',
            ]
        );
    }

    public function update(Request $request, Siswa_Model $siswa)
    {
        $validator = Validator::make($request->all(),[
            'nama_siswa'         => 'required',
            'gender_siswa'         => 'required',
            'nohp_siswa'         => 'required',
            'tempat_lahir_siswa'         => 'required',
            'tanggal_lahir_siswa'         => 'required',
            'alamat_siswa'         => 'required',
            'foto_siswa'         => 'mimes:jpg,jpeg,png,bmp',
            'id_kelas'         => 'required'
        ]);

        if($validator->fails()){
            return redirect()
                ->route('siswa.update', $siswa->id_siswa)
                ->withErrors($validator)
                ->withInput();
        }else{
            // cek apakah user kirim gambar lagi/tidak 
            if ($request->hasFile('foto_siswa')) {
                // cari nama foto lama lalu hapus 
                unlink('backend/img/siswa/' . $siswa->foto_siswa); 
                $foto = $request->file('foto_siswa'); 
                $filename = time() . "." . $foto->getClientOriginalExtension(); 
                $foto->move('backend/img/siswa/', $filename); 
                $siswa->foto_siswa = $filename; 
            }
            $siswa->nama_siswa = $request->input('nama_siswa');
            $siswa->gender_siswa = $request->input('gender_siswa');
            $siswa->nohp_siswa = $request->input('nohp_siswa');
            $siswa->tempat_lahir_siswa = $request->input('tempat_lahir_siswa');
            $siswa->tanggal_lahir_siswa = $request->input('tanggal_lahir_siswa');
            $siswa->alamat_siswa = $request->input('alamat_siswa');
            $siswa->status_daftar = 0;
            $siswa->id_kelas = $request->input('id_kelas');
            $siswa->save();

            return redirect()
                ->route('siswa')
                ->with('message', 'Data berhasil diedit');
        }
    }

    public function destroy(Siswa_Model $siswa)
    {
        $siswa_file = $siswa->foto_siswa; 
        unlink('backend/img/siswa/' . $siswa_file); 
        $siswa->forceDelete();
        
        return redirect()
            ->route('siswa')
            ->with('message', 'Data berhasil dihapus');
    }


    
}