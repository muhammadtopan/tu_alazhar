<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Absensi_Model;
use App\Pegawai_Model;
use App\JamAjar_Model;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AbsensiController extends Controller
{
    public function index()
    {
        $absensi = DB::table('tb_absensi')
                ->join('tb_pegawai', 'tb_pegawai.id', '=', 'tb_absensi.id_pegawai')
                ->join('tb_jam_ajar', 'tb_jam_ajar.id_jam', '=', 'tb_absensi.jam_ke')
                ->select('tb_absensi.*', 'tb_pegawai.nama_peg',
                        'tb_jam_ajar.jam_awal')
                ->get();
        // dd($absensi);
        return view(
            'page/absensi/index',
            [
                'absensi' => $absensi
            ]
        );
    }
    public function create()
    {
        $pegawai = Pegawai_Model::all();
        $jam_ajar = JamAjar_Model::all();
        return view(
            'page/absensi/form',
            [
                'url' => 'absensi.store',
                'pegawai' => $pegawai,
                'jam_ajar' => $jam_ajar
            ]
        );
    }
    public function store(Request $request, Absensi_Model $absensi)
    {
        $validator = Validator::make($request->all(), [
            'nama_peg'         => 'required',
            'jam_ke'         => 'required',
            'tanggal'         => 'required',
            'jam_masuk'         => 'required',
            'jam_selesai'         => 'required',
            'alamat'         => 'required',
            'keterangan'         => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('absensi.create')
                ->withErrors($validator)
                ->withInput();
        } else {

            $absensi->id_pegawai = $request->input('nama_peg');
            $absensi->jam_ke = $request->input('jam_ke');
            $absensi->tanggal = $request->input('tanggal');
            $absensi->jam_masuk = $request->input('jam_masuk');
            $absensi->jam_selesai = $request->input('jam_selesai');
            $absensi->alamat = $request->input('nama_peg');
            $absensi->keterangan = $request->input('keterangan');
            $absensi->save();

            return redirect()
                ->route('absensi')
                ->with('message', 'Data berhasil ditambahkan');
        }
    }

    public function destroy(Absensi_Model $jabatan)
    {
        $jabatan->forceDelete();
        return redirect()
            ->route('jabatan')
            ->with('message', 'Data berhasil dihapus');
    }

    public function exportAbsen(Request $request)
    {
        // dd($request);
        $data['absensi']  = DB::table('tb_absensi')
                ->join('tb_pegawai', 'tb_pegawai.id', '=', 'tb_absensi.id_pegawai')
                ->join('tb_jam_ajar', 'tb_jam_ajar.id_jam', '=', 'tb_absensi.jam_ke')
                ->whereBetween('tanggal', [$request->tglAwal, $request->tglAkhir])
                ->select('tb_absensi.*', 'tb_pegawai.nama_peg',
                        'tb_jam_ajar.jam_awal')
                ->get();
        return view('page/absensi/cetak', $data);
    }
}
