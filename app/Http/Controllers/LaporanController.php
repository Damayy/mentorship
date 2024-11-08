<?php

namespace App\Http\Controllers;

use App\Models\Pengajuansurat;
use App\Models\Suratkeluar;
use Illuminate\Http\Request;
use App\Models\Suratmasuk;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function laporanSurat(Request $request)
    {
        // Inisialisasi variabel untuk menyimpan data
        $suratMasuk = collect();
        $suratKeluar = collect();
        $activeTab = $request->input('tab', 'surat-masuk'); // Default tab 'surat-masuk'
    
        // Cek tab mana yang sedang aktif
        if ($activeTab == 'surat-masuk') {
            // Ambil data surat masuk
            $query = Pengajuansurat::query();
    
            if ($request->filled('bulan')) {
                $query->whereMonth('tgl_pengajuan', $request->bulan);
            }
    
            if ($request->filled('tahun')) {
                $query->whereYear('tgl_pengajuan', $request->tahun);
            }
    
            $suratMasuk = $query->get();
        } elseif ($activeTab == 'surat-keluar') {
            // Ambil data surat keluar, pastikan memfilter dengan kolom yang benar
            $query = Suratkeluar::query();
    
            // Ganti kolom tgl_pengajuan menjadi tanggalsurat_keluar untuk memfilter surat keluar
            if ($request->filled('bulan')) {
                $query->whereMonth('tanggalsurat_keluar', $request->bulan);
            }
    
            if ($request->filled('tahun')) {
                $query->whereYear('tanggalsurat_keluar', $request->tahun);
            }
    
            $suratKeluar = $query->get();
        }
    
        // Cek jika parameter 'export' bernilai 'pdf'
        if ($request->get('export') === 'pdf') {
            if ($activeTab == 'surat-masuk') {
                $pdf = Pdf::loadView('admin.laporan.suratmasuk_pdf', [
                    'suratMasuk' => $suratMasuk,
                    'bulan' => $request->input('bulan'),
                    'tahun' => $request->input('tahun')
                ]);
                return $pdf->stream('Data_Laporan_SuratMasuk.pdf');
            } elseif ($activeTab == 'surat-keluar') {
                $pdf = Pdf::loadView('admin.laporan.suratkeluar_pdf', [
                    'suratKeluar' => $suratKeluar,
                    'bulan' => $request->input('bulan'),
                    'tahun' => $request->input('tahun')
                ]);
                return $pdf->stream('Data_Laporan_SuratKeluar.pdf');
            }
        }
    
        return view('admin.laporan.index', compact('suratMasuk', 'suratKeluar', 'activeTab'));
    }    

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

    public function destroy(string $id)
    {
        //
    }
}
