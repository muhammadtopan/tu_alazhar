<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\JadwalUjian_Model;
use App\JamAjar_Model;
use App\Kelas_Model;
use App\Pelajaran_Model;
use App\Pegawai_Model;
use App\Hari_Model;
use DB;
use Illuminate\Support\Facades\Validator;

class JadwalUjianController extends Controller
{
    public function index()
    {
        $jadwal_ujian = DB::table('tb_jadwal_ujian')
                ->leftjoin('tb_jam_ajar', 'tb_jam_ajar.id_jam', '=', 'tb_jadwal_ujian.id_jam_ajar')
                ->leftjoin('tb_kelas', 'tb_kelas.id_kelas', '=', 'tb_jadwal_ujian.id_kelas')
                ->leftjoin('tb_pelajaran', 'tb_pelajaran.id_pelajaran', '=', 'tb_jadwal_ujian.id_pelajaran')
                ->leftjoin('tb_pegawai', 'tb_pegawai.id', '=', 'tb_jadwal_ujian.id_guru')
                ->leftjoin('tb_hari', 'tb_hari.id_hari', '=', 'tb_jadwal_ujian.hari_jadwal')
                ->select('tb_jadwal_ujian.*', 'tb_jam_ajar.jam_awal','tb_jam_ajar.jam_akhir',
                        'tb_kelas.nama_kelas', 'tb_kelas.grup_kelas',
                        'tb_pelajaran.nama_pelajaran',
                        'tb_pegawai.nama_peg',
                        'tb_hari.hari')
                ->get();
                
        return view(
            'page/jadwal_ujian/index',
            [
                'jadwal_ujian' => $jadwal_ujian
            ]
        );
    }

    public function create()
    {
        $hari = Hari_Model::all();
        $jam_ajar = JamAjar_Model::all();
        $kelas = Kelas_Model::all();
        $pelajaran = Pelajaran_Model::all();
        $pegawai = DB::table('tb_pegawai')->where('jabatan_id','=', '3')->get();
        return view(
            'page/jadwal_ujian/form',
            [
                'url' => 'jadwal_ujian.store',
                'hari' => $hari,
                'jam_awal' => $jam_ajar,
                'kelas' => $kelas,
                'pelajaran' => $pelajaran,
                'pegawai' => $pegawai,
            ]
        );
    }

    public function store(Request $request, JadwalUjian_Model $jadwal_ujian)
    {
        $validator = Validator::make($request->all(), [
            'hari_jadwal'      => 'required',
            'jam_awal'         => 'required',
            'id_kelas'         => 'required',
            'nama_peg'         => 'required',
            'nama_pelajaran'   => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('jadwal_ujian.create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $jadwal_ujian->hari_jadwal = $request->input('hari_jadwal');
            $jadwal_ujian->id_jam_ajar = $request->input('jam_awal');
            $jadwal_ujian->id_kelas = $request->input('id_kelas');
            $jadwal_ujian->id_pelajaran = $request->input('nama_pelajaran');
            $jadwal_ujian->id_guru = $request->input('nama_peg');
            $jadwal_ujian->save();

            return redirect()
                ->route('jadwal_ujian')
                ->with('message', 'Data berhasil ditambahkan');
        }
    }

    public function edit(JadwalUjian_Model $jadwal_ujian)
    {
        $hari = Hari_Model::all();
        $jam_ajar = JamAjar_Model::all();
        $kelas = Kelas_Model::all();
        $pegawai = DB::table('tb_pegawai')->where('jabatan_id','=', '3')->get();
        $pelajaran = Pelajaran_Model::all();

        return view(
            'page/jadwal_ujian/form',
            [
                'jadwal_ujian' => $jadwal_ujian,    
                'hari' => $hari,
                'jam_awal' => $jam_ajar,
                'kelas' => $kelas,
                'pegawai' => $pegawai,
                'pelajaran' => $pelajaran,
                'url' => 'jadwal_ujian.update',
                ]
        );
    }

    public function update(Request $request, JadwalUjian_Model $jadwal_ujian)
    {
        
        $validator = Validator::make($request->all(), [
            'hari_jadwal'      => 'required',
            'jam_awal'         => 'required',
            'id_kelas'         => 'required',
            'nama_peg'         => 'required',
            'nama_pelajaran'   => 'required',
        ]);

        if($validator->fails()){
            return redirect()
                ->route('jadwal_ujian.update', $jadwal_ujian->id_jadwal_ujian)
                ->withErrors($validator)
                ->withInput();
        }else{
            
            $jadwal_ujian->hari_jadwal = $request->input('hari_jadwal');
            $jadwal_ujian->id_jam_ajar = $request->input('jam_awal');
            $jadwal_ujian->id_kelas = $request->input('id_kelas');
            $jadwal_ujian->id_pelajaran = $request->input('nama_pelajaran');
            $jadwal_ujian->id_guru = $request->input('nama_peg');
            $jadwal_ujian->save();

            return redirect()
                ->route('jadwal_ujian')
                ->with('message', 'Data berhasil diedit');
        }
    }

    public function destroy(JadwalUjian_Model $jadwal_ujian)
    {
        $jadwal_ujian->forceDelete();
        
        return redirect()
            ->route('jadwal_ujian')
            ->with('message', 'Data berhasil dihapus');
    }
}

