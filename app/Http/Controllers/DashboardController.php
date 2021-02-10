<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User_Model;
use App\Helper\JwtHelper;
use Illuminate\Support\Facades\Hash;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('auth/login');
    }

    public function loginAdmin(Request $request)
    {
        // cek data login
        $user = new User_Model();
        $data_user = $user->CheckLoginAdmin($request->input("username"), $request->input("password"));
        // dd($data_user);
        if ($data_user) {
            $token = JwtHelper::BuatToken($data_user);

            // masukan data login ke session
            $request->session()->put('username', $data_user->username);
            $request->session()->put('level', $data_user->level);
            $request->session()->put('id_user', $data_user->id_user);
            $request->session()->put('token', $token);
            // redirect ke halaman home
            return redirect('dashboard')->with("pesan", "Selamat Datang " . session('username'));
        } else {
            return back()->with("pesan", "Username atau Password Salah");
        }
    }

    public function register()
    {
        return view('auth/register');
    }

    public function registerAdmin(Request $r)
    {
        $nama = "admin";
        $username = $r->username;
        $password = $r->admin_password;
        $level = 'admin';
        $notelp = '0238423742';
        $pwd = Hash::make($password);

        
            $data = array(
                'username' => $username,
                'password' => $pwd,
                'id_s' => 1,
                'level' => 4,
            );
            DB::table('tb_user')->insert($data);
            return redirect('/')->with("pesan", "Register Sukses");
    }

    function logout(Request $request)
    {
        $request->session()->forget('nama_lengkap');
        $request->session()->forget('email');
        $request->session()->forget('level');
        $request->session()->forget('id_admin');
        $request->session()->forget('token');
        // redirect ke halaman home
        return redirect('/')->with("pesan", "Anda Sudah Logout");
    }

    public function dashboard()
    {
        return view('page/home');
    }
    
    public function tabel()
    {
        return view('page/contoh/index');
    }
}
