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
                ->leftJoin('tb_kelas', 'tb_kelas.id_kelas', '=', 'tb_siswa.id_kelas')
                ->select('tb_siswa.*', 'tb_kelas.nama_kelas', 'tb_kelas.grup_kelas')
                ->get();
        return view(
            'page/siswa/index',
            [
                'siswa' => $siswa
            ]
        );
    }
    
    public function verified()
    {
        $kelas = Kelas_Model::get();
        $siswa = DB::table('tb_siswa')
                ->leftJoin('tb_kelas', 'tb_kelas.id_kelas', '=', 'tb_siswa.id_kelas')
                ->select('tb_siswa.*', 'tb_kelas.nama_kelas', 'tb_kelas.grup_kelas')
                ->where('tb_siswa.status_daftar', '1')
                ->get();
        return view(
            'page/siswa/verified_student',
            [
                'siswa' => $siswa,
                'kelas' => $kelas,
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
            'nisn'         => 'required|numeric|unique:tb_siswa,nis',
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
            if ($request->hasFile('foto_siswa')) {
                $foto = $request->file('foto_siswa'); 
                $filename = time() . "." . $foto->getClientOriginalExtension(); 
                $foto->move('backend/img/siswa/', $filename);
            }else{
                $filename = "siswa.png";
            }
            $thn = $request->input('nis');
            $row = DB::table('tb_siswa')
                    ->where('ta', $thn)
                    ->count();
            $order = sprintf("%03s", $row+1);
            $nis = strval($thn).strval($order);

            $siswa->nama_siswa = $request->input('nama_siswa');
            $siswa->ta = $request->input('nis');
            $siswa->nis = $nis;
            $siswa->nisn = $request->input('nisn');
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
            'nisn'         => 'required|numeric|unique:tb_siswa,nis',
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
                // cek dulu apakah gambar bukan gambar defaut
                if($siswa->foto_siswa != 'siswa.png'){
                    // cari nama foto lama lalu hapus 
                    unlink('backend/img/siswa/' . $siswa->foto_siswa); 
                }
                $foto = $request->file('foto_siswa'); 
                $filename = time() . "." . $foto->getClientOriginalExtension(); 
                $foto->move('backend/img/siswa/', $filename); 
                $siswa->foto_siswa = $filename; 
            }            
            $siswa->nama_siswa = $request->input('nama_siswa');
            $siswa->nis = $request->input('nis');
            $siswa->nisn = $request->input('nisn');
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
        // cek dulu apakah gambar bukan gambar defaut
        if($siswa->foto_siswa != 'siswa.png'){
            // cari nama foto lama lalu hapus 
            unlink('backend/img/siswa/' . $siswa->foto_siswa); 
        }
        $siswa->forceDelete();
        
        return redirect()
            ->route('siswa')
            ->with('message', 'Data berhasil dihapus');
    }

    public function terdaftar(Request $request)
    {
        // dd($request->all());=

        DB::table('tb_user')
            ->insert([
                'username' => $request->nama_siswa,
                'password' => Hash::make(12345),
                'id_s' => $request->id_siswa,
                'level' => '6'
            ]);

        $siswa = DB::table('tb_siswa')
            ->where('id_siswa', $request->id_siswa)
            ->update(['status_daftar' => 1]);
            
        
        return json_encode($siswa);


    }

    public function tdk_terdaftar(Request $request)
    {
        DB::table('tb_user')
            ->where('id_s', '=', $request->id_siswa) 
            ->where('level', '=', 6) 
            ->delete();

        $siswa = DB::table('tb_siswa')
            ->where('id_siswa', $request->id_siswa)
            ->update(['status_daftar' => 0]);


        return json_encode($siswa);
    }

    public function exportExcel(Request $request)
    {
        $kelas = DB::table('tb_kelas')->get();
        if ($request->kelas == "0") {
            $data['siswa'] =  DB::table('tb_siswa')
                        ->join('tb_kelas', 'tb_siswa.id_kelas', '=', 'tb_kelas.id_kelas')
                        ->get();

            $data['rekap'] = 'semua';

            return view('page/siswa/cetak', $data);
        }
        elseif ($request->kelas == "jumlah") {
            $data['siswa'] = DB::table('tb_siswa')
                        ->join("tb_kelas", "tb_siswa.id_kelas", "=", "tb_kelas.id_kelas")
                        ->select(
                            'tb_siswa.id_kelas', 
                            'tb_kelas.*',
                            DB::raw('COUNT(CASE WHEN gender_siswa="Pria" THEN 1  END) As Male'),
                            DB::raw('COUNT(CASE WHEN gender_siswa="Wanita" THEN 1  END) As Female'),
                            )
                        ->where('tb_siswa.status_daftar',  '1')
                        ->groupBy('tb_siswa.id_kelas')
                        ->get();

            $data['rekap'] = 'jml'; 
            return view('page/siswa/cetak', $data);
        }
        else{
            $data['siswa'] =  DB::table('tb_siswa')
                        ->join('tb_kelas', 'tb_siswa.id_kelas', '=', 'tb_kelas.id_kelas')
                        ->where("tb_siswa.status_daftar", "=", '1')
                        ->where("tb_siswa.id_kelas", "=", $request->kelas)
                        ->get();
            // dd($siswa);
            $data['rekap'] = ''; 
            return view('page/siswa/cetak', $data);
        }
    }
}