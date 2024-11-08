<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Suratkeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\UserAkses;

class DashboardController extends Controller
{
    public function dashboardadmin()
    {
        $datapengajuan = DB::table('pengajuansurat')->count();
        $jumlahWarga = DB::table('users')->where('role', 'warga')->count();
        $suratKeluar = DB::table('suratkeluar')->count();
        $surattolak = DB::table('suratditolak')->count();
        
       // Mengambil jumlah pengajuan berdasarkan jenis kelamin dari tabel pengajuansurat
        $genderCounts = DB::table('pengajuansurat')
            ->select('jenis_kelamin', DB::raw('count(*) as total'))
            ->groupBy('jenis_kelamin')
            ->get();
             
        // Ambil jumlah pengajuan berdasarkan jenis pengajuan
        $jenisPengajuanCounts = DB::table('pengajuansurat')
            ->select('jenis_pengajuan', DB::raw('count(*) as total'))
            ->groupBy('jenis_pengajuan')
            ->get();
        
        // Kirim data ke view
        return view('admin.dashboard', compact('datapengajuan', 'jumlahWarga', 'suratKeluar', 'surattolak', 'genderCounts', 'jenisPengajuanCounts'));
    }
    

    public function dashboardwarga(){
        return view('warga.dashboard');
    }
}

