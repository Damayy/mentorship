<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DataWargaController extends Controller
{
    public function index()
{
    // Ambil semua data dari tabel users dengan role 'warga' dan urutkan berdasarkan created_at secara descending
    $data = DB::table('users')
        ->where('role', 'warga')
        ->select(
            'id',  
            'email', 
            'name', 
            'nik',
            'jenis_kelamin',
            'alamat',
            'bukti_ktp',
            'bukti_kk',
            'is_active'
        )
        ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan created_at secara descending
        ->get();

    return view('admin.data_warga.index', compact('data'));
}

public function activate($id)
{
    $user = User::findOrFail($id);

    // Hanya boleh diaktifkan jika akun dalam kondisi 0 atau 2.
    if ($user->is_active === 0 || $user->is_active === 2) {
        $user->is_active = 1;
        $user->save();
        
        return redirect()->back()->with('success', 'Akun berhasil diaktifkan');
    }

    return redirect()->back()->with('error', 'Akun tidak dapat diaktifkan');
}

public function deactivate($id)
{
    $user = User::findOrFail($id);

    // Jika akun awalnya bernilai 0 (baru) atau 1 (aktif), maka diubah menjadi 2.
    if ($user->is_active === 0 || $user->is_active === 1) {
        $user->is_active = 2;
        $user->save();

        return redirect()->back()->with('success', 'Akun berhasil dinonaktifkan');
    }

    return redirect()->back()->with('error', 'Akun tidak dapat dinonaktifkan');
}

public function destroy($id)
{
    // Temukan data user berdasarkan ID
    $user = User::findOrFail($id);

    // Cek jika akun bernilai is_active = 2 (nonaktif)
    if ($user->is_active === 2) {
        // Hapus data user
        $user->delete();

        // Redirect atau berikan response sesuai kebutuhan
        return redirect()->back()->with('success', 'Akun berhasil dihapus');
    } else {
        // Jika akun tidak dalam status nonaktif, berikan pesan error
        return redirect()->back()->with('error', 'Hanya akun nonaktif yang bisa dihapus');
    }
}

// public function destroy($id)
// {
//     // Temukan data user berdasarkan ID
//     $user = User::findOrFail($id);

//     // Cek jika akun bernilai is_active = 2 (nonaktif)
//     if ($user->is_active === 2) {
//         // Hapus data user
//         $user->delete();

//         // Redirect atau berikan response sesuai kebutuhan
//         return redirect()->route('admin.delete', ['id' => $id])->with('success', 'Akun berhasil dihapus');
//     } else {
//         // Jika akun tidak dalam status nonaktif, berikan pesan error
//         return redirect()->route('admin.delete')->with('error', 'Hanya akun nonaktif yang bisa dihapus.');
//     }
// }

//     public function index()
// {
//     $data = DB::table('pengajuansurat')
//         ->join('users', 'pengajuansurat.nama_pengaju', '=', 'users.name')
//         ->where('users.role', 'warga') 
//         ->select('users.email', 'users.name', 'pengajuansurat.nik', 'pengajuansurat.jenis_kelamin')
//         ->groupBy('users.email', 'users.name', 'pengajuansurat.nik', 'pengajuansurat.jenis_kelamin')
//         ->get();

//     return view('admin.data_warga.index', compact('data'));
// }
// Menambahkan kondisi untuk hanya mengambil data dengan role warga
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }
    public function update(Request $request, string $id)
    {
        //
    }

}
