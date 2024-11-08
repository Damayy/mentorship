<?php

namespace App\Http\Controllers;

use App\Models\Pengajuansurat;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SuratMasukController extends Controller
{

    public function index()
    {
        $pengajuansurat = Pengajuansurat::orderBy('id', 'desc')->get();
        $title = 'Hapus Data Ini!';
        $text = "Apakah kamu ingin menghapusnya?";
        confirmDelete($title, $text);
        return view('admin.surat_masuk.index', compact('pengajuansurat'));
    }

    public function create()
    {
       
    }

    public function save(Request $request){     
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        
    }

    public function updateStatus(Request $request, $id)
    {
    $pengajuansurat = Pengajuansurat::find($id);

    if (!$pengajuansurat) {
        return redirect()->back()->with('error', 'Pengajuan tidak ditemukan.');
    }

    $status = $request->input('status');
    
    // Validasi status yang diterima
    $validStatuses = [
        'verifikasi_berkas',
        'pembuatan_dokumen',
        'menunggu_disetujui_lurah',
        'surat_selesai',
        'ditolak_admin'
    ];

    if (in_array($status, $validStatuses)) {
        // Hanya izinkan perubahan status ke status berikutnya
        if ($status == 'ditolak_admin') {
            $pengajuansurat->status = 'ditolak_admin';
        } else if ($status == 'verifikasi_berkas' && !in_array($pengajuansurat->status, ['ditolak_admin'])) {
            $pengajuansurat->status = 'verifikasi_berkas';
        } else if ($status == 'pembuatan_dokumen' && $pengajuansurat->status == 'verifikasi_berkas') {
            $pengajuansurat->status = 'pembuatan_dokumen';
        } else if ($status == 'menunggu_disetujui_lurah' && $pengajuansurat->status == 'pembuatan_dokumen') {
            $pengajuansurat->status = 'menunggu_disetujui_lurah';
        } else if ($status == 'surat_selesai' && $pengajuansurat->status == 'menunggu_disetujui_lurah') {
            $pengajuansurat->status = 'surat_selesai';
        } else {
            return redirect()->back()->with('error', 'Status tidak valid untuk pengajuan ini.');
        }

        // Simpan perubahan ke database
        $pengajuansurat->save();

        return redirect()->back()->with('success', 'Status pengajuan telah diperbarui !');
    } else {
        return redirect()->back()->with('error', 'Status tidak valid.');
    }
}

}


