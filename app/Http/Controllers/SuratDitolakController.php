<?php

namespace App\Http\Controllers;

use App\Models\Suratditolak;
use App\Models\Pengajuansurat;
use Illuminate\Http\Request;

class SuratDitolakController extends Controller
{

    public function index()
    {
        $surattolak = Suratditolak::with('pengajuansurat')->get();
        return view('admin.surat_ditolak.index', compact('surattolak'));
    }
    
    public function create()
    {
        //
    }

public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'pengajuansurat_id' => 'required|exists:pengajuansurat,id',
            'alasan_penolakan' => 'required|string|max:1000',
            'tgl_surat_ditolak' => 'required|date',
        ]);

        // Cari pengajuan berdasarkan ID
        $pengajuansurat = Pengajuansurat::find($request->input('pengajuansurat_id'));

        if (!$pengajuansurat) {
            return redirect()->back()->with('error', 'Pengajuan tidak ditemukan.');
        }

        // Simpan data penolakan dengan informasi tambahan
        $suratDitolak = new SuratDitolak();
        $suratDitolak->pengajuansurat_id = $request->input('pengajuansurat_id');
        $suratDitolak->alasan_penolakan = $request->input('alasan_penolakan');
        $suratDitolak->tgl_surat_ditolak = $request->input('tgl_surat_ditolak');
        $suratDitolak->nama_pengaju = $pengajuansurat->nama_pengaju;
        $suratDitolak->nik = $pengajuansurat->nik;
        $suratDitolak->jenis_pengajuan = $pengajuansurat->jenis_pengajuan;
        $suratDitolak->save();

        // Update status pengajuan
        $pengajuansurat->status = 'ditolak_admin';
        $pengajuansurat->save();

        return redirect()->route('suratditolak.index')->with('success', 'Surat Ditolak!');
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

    public function destroy(string $id)
    {
        //
    }
}
