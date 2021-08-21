<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SPP_Model;
use App\Siswa_Model;
use App\Kelas_Model;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class SppController extends Controller
{
    public function index()
    {
        $kelas = Kelas_Model::get();
        $spp = DB::table('tb_spp')
                ->join('tb_siswa', 'tb_siswa.id_siswa', '=', 'tb_spp.id_siswa')
                ->get();

        return view(
            'page/spp/index',
            [
                'kelas' => $kelas,
                'spp' => $spp,
            ]
        );
    }
    public function create()
    {
        $siswa = Siswa_Model::all();
        return view(
            'page/spp/form',
            [   
                'url' => 'spp.store',
                'siswa' => $siswa
            ]
        );
    }

    public function edit(Pegawai_Model $pegawai)
    {
        $jabatan = Jabatan_Model::all();
        return view(
            'page/pegawai/form',
            [
                'pegawai' => $pegawai,
                'jabatan' => $jabatan,
                'url' => 'pegawai.update',
            ]
        );
    }

    public function update(Request $request, Pegawai_Model $pegawai)
    {
        $validator = Validator::make($request->all(),[
            'nip'         => 'required',
            'nama_peg'         => 'required',
            'jabatan_id'         => 'required',
            'Email'         => 'required|email',
            'no_tlp'         => 'required|numeric',
            'alamat'         => 'required',
            'tgl_masuk'         => 'required',
            'tmp_lahir'         => 'required',
            'agama'         => 'required',
            'gender'         => 'required',
            'pendidikan'         => 'required',
            'foto'         => 'mimes:jpg,jpeg,png,bmp',
        ]);

        if($validator->fails()){
            return redirect()
                ->route('pegawai.update', $pegawai->pegawai_id)
                ->withErrors($validator)
                ->withInput();
        }else{
            // cek apakah user kirim gambar lagi/tidak 
            if ($request->hasFile('foto')) {
                // cari nama foto lama lalu hapus 
                unlink('backend/img/pegawai/' . $pegawai->foto); 
                $foto = $request->file('foto'); $filename = time() . "." . $foto->getClientOriginalExtension(); 
                $foto->move('backend/img/pegawai/', $filename); $pegawai->foto = $filename; 
            }
            $pegawai->nip = $request->input('nip');
            $pegawai->nama_peg = $request->input('nama_peg');
            $pegawai->jabatan_id = $request->input('jabatan_id');
            $pegawai->Email = $request->input('Email');
            $pegawai->no_tlp = $request->input('no_tlp');
            $pegawai->alamat = $request->input('alamat');
            $pegawai->tgl_masuk = $request->input('tgl_masuk');
            $pegawai->tmp_lahir = $request->input('tmp_lahir');
            $pegawai->agama = $request->input('agama');
            $pegawai->gender = $request->input('gender');
            $pegawai->pendidikan = $request->input('pendidikan');
            $pegawai->save();

            return redirect()
                ->route('pegawai')
                ->with('message', 'Data berhasil diedit');
        }
    }

    public function destroy(Pegawai_Model $pegawai)
    {
        $pegawai_file = $pegawai->foto; 
        unlink('backend/img/pegawai/' . $pegawai_file); 
        $pegawai->forceDelete();
        
        return redirect()
            ->route('pegawai')
            ->with('message', 'Data berhasil dihapus');
    }

    public function utang(Request $request)
    {
        $spp = DB::table('tb_spp')
            ->where('id_spp', $request->id_spp)
            ->update(['status' => 0]);
        return json_encode($spp);
    }

    public function lunas(Request $request)
    {
        $spp = DB::table('tb_spp')
            ->where('id_spp', $request->id_spp)
            ->update(['status' => 1]);
        return json_encode($spp);
    }

    public function exportSPP(Request $request)
    {
        // dd($request);
        $data['spp'] = DB::table('tb_spp')
                ->join('tb_siswa', 'tb_siswa.id_siswa', '=', 'tb_spp.id_siswa')
                ->join('tb_kelas', 'tb_siswa.id_kelas', '=', 'tb_kelas.id_kelas')
                ->where('tb_siswa.id_kelas', $request->kelas)
                ->get();
        return view('page/spp/cetak', $data);
    }
}

