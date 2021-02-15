<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User_Model;
use App\Jabatan_Model;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function index()
    {
        $user = DB::table('tb_user')
                    ->join('tb_jabatan', 'tb_jabatan.id_jabatan', '=', 'tb_user.level')
                    ->select('tb_user.username','tb_user.id_user', 'tb_jabatan.nama_jabatan')
                    ->get();
        
        return view(
            'page/user/index', 
            [
                'user' => $user
            ]
        );
    }
    public function create()
    {
        $jabatan = Jabatan_Model::all();
        return view(
            'page/user/form',
            [
                'url' => 'user.store',
                'jabatan' => $jabatan
            ]
        );
    }
    public function store(Request $request, User_Model $user)
    {
        $validator = Validator::make($request->all(), [
            'admin_name'         => 'required',
            'admin_email'         => 'required|email|unique:tb_admin,admin_email',
            'admin_password'         => 'required',
            'admin_notelp'         => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('admin.create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $password = $request->input('admin_password');
            $pwd = Hash::make($password);
    
            $admin->admin_name = $request->input('admin_name');
            $admin->admin_email = $request->input('admin_email');
            $admin->admin_notelp = $request->input('admin_notelp');
            $admin->admin_level = 'admin';
            $admin->admin_password = $pwd;
            $admin->save();

            return redirect()
                ->route('admin')
                ->with('message', 'Data berhasil ditambahkan');
        }
    }

    public function edit(User_Model $user)
    {
        return view(
            'page/user/form',
            [
                'user' => $user,
                'url' => 'user.update',
            ]
        );
    }

    public function update(Request $request, User_Model $user)
    {
        $validator = Validator::make($request->all(),[
            'username'         => 'required'
        ]);

        if($validator->fails()){
            return redirect()
                ->route('user.update', $user->user_id)
                ->withErrors($validator)
                ->withInput();
        }else{
            if ($request->input('password') != null) {
                $password = $request->input('password');
                $pwd = Hash::make($password);
                $admin->password = $pwd;
            }

            $admin->username = $request->input('username');
            $admin->save();

            return redirect()
                ->route('user')
                ->with('message', 'Data berhasil diedit');
        }
    }

    public function destroy(User_Model $user)
    {
        $user->forceDelete();
        return redirect()
            ->route('user')
            ->with('message', 'Data berhasil dihapus');
    }
}