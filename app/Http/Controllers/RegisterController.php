<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegisterController extends Controller
{
    
    public function index(){
        return view('auth.register');
    }

    public function register_proses(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|numeric|min:16|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'alamat' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'agama' => 'required|string',  
            'pekerjaan' => 'required|string',
            'bukti_ktp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', 
            'bukti_kk' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
    
        // Logic untuk menyimpan data ke database
        $user = User::create([
            'name' => $request->nama,
            'nik' => $request->nik,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'pekerjaan' => $request->pekerjaan,
            'pekerjaan_lainnya' => $request->pekerjaan_lainnya,
            'bukti_ktp' => $request->file('bukti_ktp')->store('uploads/ktp', 'public'), 
            'bukti_kk' => $request->file('bukti_kk')->store('uploads/kk', 'public'), 
        ]);
    
        return redirect()->route('masuk')->with('success', 'Daftar Akun Berhasil! Silahkan Login');
    }
    
}



