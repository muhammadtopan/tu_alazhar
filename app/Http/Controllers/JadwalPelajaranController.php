<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\JadwalPelajaran_Model;
use App\JamAjar_Model;
use App\Kelas_Model;
use App\Pelajaran_Model;
use App\Pegawai_Model;
use App\Hari_Model;
use DB;
use Illuminate\Support\Facades\Validator;

class JadwalPelajaranController extends Controller
{
    public function index()
    {
        $jadwal_pelajaran = DB::table('tb_jadwal_pelajaran')
                ->leftjoin('tb_jam_ajar', 'tb_jam_ajar.id_jam', '=', 'tb_jadwal_pelajaran.id_jam_ajar')
                ->leftjoin('tb_kelas', 'tb_kelas.id_kelas', '=', 'tb_jadwal_pelajaran.id_kelas')
                ->leftjoin('tb_pelajaran', 'tb_pelajaran.id_pelajaran', '=', 'tb_jadwal_pelajaran.id_pelajaran')
                ->leftjoin('tb_pegawai', 'tb_pegawai.id', '=', 'tb_jadwal_pelajaran.id_pegawai')
                ->leftjoin('tb_hari', 'tb_hari.id_hari', '=', 'tb_jadwal_pelajaran.id_hari')
                ->select('tb_jadwal_pelajaran.*', 'tb_jam_ajar.jam_awal','tb_jam_ajar.jam_akhir',
                        'tb_kelas.nama_kelas', 'tb_kelas.grup_kelas',
                        'tb_pelajaran.nama_pelajaran',
                        'tb_pegawai.nama_peg',
                        'tb_hari.hari')
                ->get();
        // dd($jadwal_pelajaran);
        return view(
            'page/jadwal_pelajaran/index',
            [
                'jadwal_pelajaran' => $jadwal_pelajaran
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
            'page/jadwal_pelajaran/form',
            [   
                'url' => 'jadwal_pelajaran.store',
                'hari' => $hari,
                'jam_awal' => $jam_ajar,
                'kelas' => $kelas,
                'pelajaran' => $pelajaran,
                'pegawai' => $pegawai,
            ]
        );
    }

    public function store(Request $request, JadwalPelajaran_Model $jadwal_pelajaran)
    {
        $validator = Validator::make($request->all(), [
            'id_hari'          => 'required',
            'jam_awal'         => 'required',
            'id_kelas'         => 'required',
            'nama_peg'         => 'required',
            'nama_pelajaran'   => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('jadwal_pelajaran.create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $jadwal_pelajaran->id_hari = $request->input('id_hari');
            $jadwal_pelajaran->id_jam_ajar = $request->input('jam_awal');
            $jadwal_pelajaran->id_kelas = $request->input('id_kelas');
            $jadwal_pelajaran->id_pelajaran = $request->input('nama_pelajaran');
            $jadwal_pelajaran->id_pegawai = $request->input('nama_peg');
            $jadwal_pelajaran->save();

            return redirect()
                ->route('jadwal_pelajaran')
                ->with('message', 'Data berhasil ditambahkan');
        }
    }

    public function edit(JadwalPelajaran_Model $jadwal_pelajaran)
    {
        $hari = Hari_Model::all();
        $jam_ajar = JamAjar_Model::all();
        $kelas = Kelas_Model::all();
        $pegawai = DB::table('tb_pegawai')->where('jabatan_id','=', '3')->get();
        $pelajaran = Pelajaran_Model::all();

        return view(
            'page/jadwal_pelajaran/form',
            [
                'jadwal_pelajaran' => $jadwal_pelajaran,    
                'hari' => $hari,
                'jam_awal' => $jam_ajar,
                'kelas' => $kelas,
                'pegawai' => $pegawai,
                'pelajaran' => $pelajaran,
                'url' => 'jadwal_pelajaran.update',
                ]
        );
    }

    public function update(Request $request, JadwalPelajaran_Model $jadwal_pelajaran)
    {
        
        $validator = Validator::make($request->all(), [
            'id_hari'         => 'required',
            'jam_awal'         => 'required',
            'id_kelas'         => 'required',
            'nama_peg'         => 'required',
            'nama_pelajaran'         => 'required',
        ]);

        if($validator->fails()){
            return redirect()
                ->route('jadwal_pelajaran.update', $jadwal_pelajaran->id_jadwal_pelajaran)
                ->withErrors($validator)
                ->withInput();
        }else{
            
            $jadwal_pelajaran->id_hari = $request->input('id_hari');
            $jadwal_pelajaran->id_jam_ajar = $request->input('jam_awal');
            $jadwal_pelajaran->id_kelas = $request->input('id_kelas');
            $jadwal_pelajaran->id_pelajaran = $request->input('nama_pelajaran');
            $jadwal_pelajaran->id_pegawai = $request->input('nama_peg');
            $jadwal_pelajaran->save();

            return redirect()
                ->route('jadwal_pelajaran')
                ->with('message', 'Data berhasil diedit');
        }
    }

    public function destroy(JadwalPelajaran_Model $jadwal_pelajaran)
    {
        $jadwal_pelajaran->forceDelete();
        
        return redirect()
            ->route('jadwal_pelajaran')
            ->with('message', 'Data berhasil dihapus');
    }
}
