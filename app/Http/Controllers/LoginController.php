<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');  
    }

    // public function login_proses(Request $request){
    //     $request->validate([
    //         'nik' => 'required',
    //         'password' => 'required',
    //     ]); 
    
    //     $data = [
    //         'nik' => $request->nik,
    //         'password' => $request->password
    //     ];
    
    //     if (Auth::attempt($data)) {
    //         if (Auth::user()->role == 'admin') {
    //             return redirect()->route('admin.dashboard');
    //         } elseif (Auth::user()->role == 'warga') {
    //             return redirect()->route('warga.dashboard'); 
    //         }
    //     } else {
    //         // Gunakan array untuk mengirim pesan error ke withErrors
    //         return redirect('masuk')
    //             ->withErrors(['failed' => 'NIK atau Password Salah'])
    //             ->withInput();
    //     }
    // }  
    
    public function login_proses(Request $request)
{
    $request->validate([
        'nik' => 'required|numeric|min:16',
        'password' => 'required',
    ]); 

    $data = [
        'nik' => $request->nik,
        'password' => $request->password
    ];

    // Cek apakah pengguna ada berdasarkan NIK
    $user = User::where('nik', $request->nik)->first();

   // Jika pengguna ditemukan
    if ($user) {
    // Periksa apakah akun diaktifkan
    if ($user->is_active == 0) {
        return redirect('masuk')
            ->withErrors(['failed' => 'Akun Anda Belum Aktif. Silakan Menunggu...'])
            ->withInput();
    } elseif ($user->is_active == 2) {
        return redirect('masuk')
            ->withErrors(['failed' => 'Akun anda telah dinonaktifkan oleh Admin secara permanen'])
            ->withInput();
    }

    // Jika akun diaktifkan, coba untuk login
    if (Auth::attempt($data)) {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::user()->role == 'warga') {
            return redirect()->route('warga.dashboard'); 
        }
    }
    }

    // Jika login gagal
    return redirect('masuk')
        ->withErrors(['failed' => 'NIK atau Password Salah'])
        ->withInput();
}

    public function logout(){
        Auth::logout();
        return redirect()->route('beranda')->with('success', 'Kamu Berhasil Logout');
    }
}


