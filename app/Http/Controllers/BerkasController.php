<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class BerkasController extends Controller
{
    public function index()
    {
        $data['berkas'] = DB::table('tb_berkas')->get();
        return view('page/berkas/index', $data);
    }
}
