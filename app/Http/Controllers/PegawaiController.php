<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pegawai_Model;
use App\Jabatan_Model;
use DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class PegawaiController extends Controller
{
    public function index()
    {
        $jabatan = DB::table('tb_jabatan')->get();

        $pegawai = DB::table('tb_pegawai')
                ->join('tb_jabatan', 'tb_jabatan.id_jabatan', '=', 'tb_pegawai.jabatan_id')
                ->select('tb_pegawai.*', 'tb_jabatan.nama_jabatan')
                ->get();

        return view(
            'page/pegawai/index',
            [
                'pegawai' => $pegawai,
                'jabatans' => $jabatan,
            ]
        );
    }
    public function create()
    {
        $jabatan = Jabatan_Model::all();
        return view(
            'page/pegawai/form',
            [   
                'url' => 'pegawai.store',
                'jabatan' => $jabatan
            ]
        );
    }
    public function store(Request $request, Pegawai_Model $pegawai)
    {
        $validator = Validator::make($request->all(), [
            'nip'         => 'required',
            'nama_peg'         => 'required',
            'jabatan_id'         => 'required',
            'Email'         => 'required|email|unique:tb_pegawai,Email',
            'no_tlp'         => 'required|numeric',
            'alamat'         => 'required',
            'tgl_masuk'         => 'required',
            'tmp_lahir'         => 'required',
            'agama'         => 'required',
            'gender'         => 'required',
            'pendidikan'         => 'required',
            'foto'         => 'required|mimes:jpg,jpeg,png,bmp',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('pegawai.create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $foto = $request->file('foto'); 
            $filename = time() . "." . $foto->getClientOriginalExtension(); 
            $foto->move('backend/img/pegawai/', $filename);

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
            $pegawai->foto = $filename;
            $pegawai->save();

            return redirect()
                ->route('pegawai')
                ->with('message', 'Data berhasil ditambahkan');
        }
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

    public function exportExcel(Request $request){
        if ($request->jabatan == "0") {
            $pegawai = DB::table('tb_pegawai')
                        ->join('tb_jabatan', 'tb_pegawai.jabatan_id', '=', 'tb_jabatan.id_jabatan')
                        ->get();
        }elseif ($request->jabatan == "123") {
            $pegawai = DB::table('tb_pegawai')
                        ->join('tb_jabatan', 'tb_pegawai.jabatan_id', '=', 'tb_jabatan.id_jabatan')
                        ->where("jabatan_id", "!=", "3")
                        ->get();
        }elseif ($request->jabatan == "3") {
            $pegawai = DB::table('tb_pegawai')
                        ->join('tb_jabatan', 'tb_pegawai.jabatan_id', '=', 'tb_jabatan.id_jabatan')
                        ->where("jabatan_id", "=", "3")
                        ->get();
        }else{
            return redirect()->back()->withErrors('message', 'bukan pilihan yang disediakan');
        }
        return view(
            'page/pegawai/cetak',
            [
                'pegawai' => $pegawai,  
            ]
        );
    }
}
