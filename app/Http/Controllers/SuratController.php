<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Surat_Model;
use DB;
use Illuminate\Support\Facades\Validator;

class SuratController extends Controller
{
    public function index()
    {
        $surats  = DB::table('tb_surat')->get();
        
        return view(
            'page/surat/index',
            [
                'surats' => $surats
                ]
            );
        }
    public function create()
    {
        return view(
            'page/surat/form',
            [
                'url' => 'surat.store',
            ]
        );
    }
    public function store(Request $request, Surat_Model $surat)
    {
        $validator = Validator::make($request->all(), [
            'surat_jenis'          => 'required',
            'surat_nomor'          => 'required|unique:tb_surat,surat_nomor',
            'surat_tanggal'        => 'required',
            'surat_tujuan'         => 'required',
            'surat_ket'         => 'required',
            'surat_file'           => 'mimes:pdf'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('surat.create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $surat->surat_jenis = $request->input('surat_jenis');
            $surat->surat_nomor = $request->input('surat_nomor');
            $surat->surat_tanggal = $request->input('surat_tanggal');
            $surat->surat_tujuan = $request->input('surat_tujuan');
            $surat->surat_ket = $request->input('surat_ket');
            
            $file = $request->file('surat_file'); 
            $filename = time() . "." . $file->getClientOriginalExtension(); 
            $file->move('backend/file/surat/', $filename);
            
            $surat->surat_file = $filename;
            
            $surat->save();

            return redirect()
                ->route('surat')
                ->with('message', 'Data berhasil ditambahkan');
        }
    }

    public function edit(Surat_Model $surat)
    {
        return view(
            'page/surat/form',
            [
                'surat' => $surat,
                'url' => 'surat.update',
            ]
        );
    }

    public function update(Request $request, Surat_Model $surat)
    {
        $validator = Validator::make($request->all(),[
            'surat_jenis'          => 'required',
            // 'surat_nomor'          => 'required|unique:tb_surat,surat_nomor',
            'surat_tanggal'        => 'required',
            'surat_tujuan'         => 'required',
            'surat_ket'         => 'required',
        ]);

        if($validator->fails()){
            return redirect()
                ->route('surat.update', $surat->surat_id)
                ->withErrors($validator)
                ->withInput();
        }else{
            // cek apakah user kirim gambar lagi/tidak 
            if ($request->hasFile('surat_file')) {
                unlink('backend/file/surat/' . $surat->surat_file); 
                $file = $request->file('surat_file'); 
                $filename = time() . "." . $file->getClientOriginalExtension(); 
                $file->move('backend/file/surat/', $filename); 
                $surat->surat_file = $filename; 
            }
            $surat->surat_jenis = $request->input('surat_jenis');
            $surat->surat_nomor = $request->input('surat_nomor');
            $surat->surat_tanggal = $request->input('surat_tanggal');
            $surat->surat_tujuan = $request->input('surat_tujuan');
            $surat->surat_ket = $request->input('surat_ket');
            $surat->save();

            return redirect()
                ->route('surat')
                ->with('message', 'Data berhasil diedit');
        }
    }

    public function destroy(Surat_Model $surat)
    {
        $file_pdf = $surat->surat_file; 
        unlink('backend/file/surat/' . $file_pdf); 
        
        $surat->forceDelete();
        return redirect()
            ->route('surat')
            ->with('message', 'Data berhasil dihapus');
    }

    public function exportSurat(Request $request)
    {
        // dd($request);
        if ($request->surat_jenis == "semua") {
            $data['surat'] = DB::table('tb_surat')
                        ->whereBetween('surat_tanggal', [$request->tglAwal, $request->tglAkhir])
                        ->get();
            // dd($surat);
        }
        else{
            $surat = DB::table('tb_surat')
                        ->whereBetween('surat_tanggal', [$request->tglAwal, $request->tglAkhir])
                        ->where('surat_jenis', '=', $request->surat_jenis)
                        ->get();
            // dd($surat);
        }
        return view('page/surat/cetak', $data);
    }
}