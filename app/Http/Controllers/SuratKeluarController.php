<?php

namespace App\Http\Controllers;

use App\Models\Pengajuansurat;
use Illuminate\Http\Request;
use App\Models\Suratkeluar;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Str;

class SuratKeluarController extends Controller
{
    
    public function index()
    {
        $suratKeluar = Suratkeluar::orderBy('created_at', 'desc')->get();
        return view('admin.surat_keluar.index', compact('suratKeluar'));
    }

    public function suratketblmbekerja(){
        return view('admin.surat_keluar.skblmbekerja');
    }

    public function suratketblmmemilikirumah(){
        return view('admin.surat_keluar.skblmmemilikirumah');
    }

    public function suratketblmmenikah(){
        return view('admin.surat_keluar.skblmmenikah');
    }

    public function suratketdomisili(){
        return view('admin.surat_keluar.skdomisili');
    }

    public function suratketdomisilitanah(){
        return view('admin.surat_keluar.skdomisilitanah');
    }

    public function suratketpenghasilan(){
        return view('admin.surat_keluar.skpenghasilan');
    }

    public function suratketbersihdiri(){
        return view('admin.surat_keluar.skbersihdiri');
    }

    public function suratketcatatansipil(){
        return view('admin.surat_keluar.skcatatansipil');
    }

    public function suratketduda(){
        return view('admin.surat_keluar.skduda');
    }

    public function suratketjanda(){
        return view('admin.surat_keluar.skjanda');
    }

    public function suratketghoib(){
        return view('admin.surat_keluar.skghoib');
    }

    public function suratketorangygsama(){
        return view('admin.surat_keluar.skorangygsama');
    }

    public function suratketselesaipenelitian(){
        return view('admin.surat_keluar.skselesaipenelitian');
    }


    public function create()
    {
        //
    }

    public function generateNomorSurat()
{
    // Ambil nomor surat terakhir dari database
    $lastSurat = Suratkeluar::orderBy('nomor_surat', 'desc')->first();
    $nextNomor = $lastSurat ? str_pad((int)$lastSurat->nomor_surat + 1, 3, '0', STR_PAD_LEFT) : '001';

    // Kirim nomor surat berikutnya ke front-end
    return response()->json(['nomor_surat' => $nextNomor]);
}

    public function simpandata(Request $request)
{
    // Validasi data yang diperlukan
    $request->validate([
        'pengajuansurat_id' => 'required|exists:pengajuansurat,id',
        'tanggalsurat_keluar' => 'required|date',
        'nomor_surat' => 'required',
    ]);

    $pengajuansurat = Pengajuansurat::find($request->input('pengajuansurat_id'));

    // Simpan data surat keluar ke database
    $suratKeluar = new SuratKeluar();
    $suratKeluar->pengajuansurat_id = $request->pengajuansurat_id;
    $suratKeluar->tanggalsurat_keluar = $request->tanggalsurat_keluar;
    $suratKeluar->nomor_surat = $request->nomor_surat;
    $suratKeluar->nama_pengaju = $pengajuansurat->nama_pengaju;
    $suratKeluar->nik = $pengajuansurat->nik;
    $suratKeluar->tempat_lahir = $pengajuansurat->tempat_lahir;
    $suratKeluar->tgl_lahir = $pengajuansurat->tgl_lahir;
    $suratKeluar->jenis_kelamin = $pengajuansurat->jenis_kelamin;
    $suratKeluar->agama = $pengajuansurat->agama;
    $suratKeluar->pekerjaan = $pengajuansurat->pekerjaan;
    $suratKeluar->alamat = $pengajuansurat->alamat;
    $suratKeluar->rt = $pengajuansurat->rt;
    $suratKeluar->rw = $pengajuansurat->rw;
    $suratKeluar->jenis_pengajuan = $pengajuansurat->jenis_pengajuan;
    $suratKeluar->deskripsi = $pengajuansurat->deskripsi;
    $suratKeluar->save();

      // Ubah status pengajuan menjadi "pembuatan_dokumen"
      $pengajuansurat->status = 'pembuatan_dokumen';
      $pengajuansurat->save();
    // Redirect ke halaman yang diinginkan dengan pesan sukses
    return redirect()->route('suratkeluar.index')->with('success', 'Dokumen Surat Keluar Berhasil Dibuat!');
}

//     public function simpandata(Request $request)
// {
//     $request->validate([
//         'pengajuansurat_id' => 'required|exists:pengajuansurat,id',
//         'tanggalsurat_keluar' => 'required|date',
//     ]);

//     $pengajuansurat = Pengajuansurat::find($request->input('pengajuansurat_id'));

//     if (!$pengajuansurat) {
//         return redirect()->back()->with('error', 'Pengajuan tidak ditemukan.');
//     }

//     // Menghitung nomor surat berikutnya
//     $lastSuratKeluar = Suratkeluar::orderBy('id', 'desc')->first();
//     $nomorSurat = $lastSuratKeluar ? (intval(substr($lastSuratKeluar->nomor_surat, 0, 3)) + 1) : 1;
//     $nomorSurat = str_pad($nomorSurat, 3, '0', STR_PAD_LEFT); 

//     $suratKeluar = new Suratkeluar();
//     $suratKeluar->pengajuansurat_id = $pengajuansurat->id;
//     $suratKeluar->tanggalsurat_keluar = $request->input('tanggalsurat_keluar');
//     $suratKeluar->nomor_surat = $nomorSurat; 

//     // Mengisi data lainnya
//     $suratKeluar->nama_pengaju = $pengajuansurat->nama_pengaju;
//     $suratKeluar->nik = $pengajuansurat->nik;
//     $suratKeluar->tempat_lahir = $pengajuansurat->tempat_lahir;
//     $suratKeluar->tgl_lahir = $pengajuansurat->tgl_lahir;
//     $suratKeluar->jenis_kelamin = $pengajuansurat->jenis_kelamin;
//     $suratKeluar->agama = $pengajuansurat->agama;
//     $suratKeluar->pekerjaan = $pengajuansurat->pekerjaan;
//     $suratKeluar->alamat = $pengajuansurat->alamat;
//     $suratKeluar->rt = $pengajuansurat->rt;
//     $suratKeluar->rw = $pengajuansurat->rw;
//     $suratKeluar->jenis_pengajuan = $pengajuansurat->jenis_pengajuan;
//     $suratKeluar->deskripsi = $pengajuansurat->deskripsi;

//     $suratKeluar->save();

//     // Update status pengajuan surat
//     $pengajuansurat->status = 'pembuatan_dokumen';
//     $pengajuansurat->save();

//     return redirect()->route('suratkeluar.index')->with('success', 'Surat keluar berhasil dibuat!');
// }
    
// public function print($id)
// {
//     \Carbon\Carbon::setLocale('id');
    
//     // $suratKeluar = Suratkeluar::where('id', $id)->get();
//     $suratkeluar = Suratkeluar::findOrFail($id);
//     // Mendapatkan tanggal saat ini dalam format dd F yyyy dengan bulan dalam bahasa Indonesia
//     $today = Carbon::now()->locale('id')->format('d F Y'); // Format dd F yyyy, contoh: 28 Agustus 2024
//     $today = Carbon::now()->locale('id')->translatedFormat('d F Y');

//     // Menghasilkan PDF menggunakan view
//     $pdf = Pdf::loadView('admin.surat_keluar.print', compact('suratkeluar', 'today'));

//     return $pdf->stream('Surat_Keluar.pdf'); 
// }

public function print($id)
{
    \Carbon\Carbon::setLocale('id');
    
    $suratkeluar = Suratkeluar::findOrFail($id);

    // Mendapatkan tanggal saat ini dalam format dd F yyyy
    $today = Carbon::now()->locale('id')->translatedFormat('d F Y');

    // Mendapatkan bulan saat ini dalam angka Romawi
    $currentMonth = Carbon::now()->format('n'); // Mengambil bulan sebagai angka (1-12)
    $romanMonth = $this->getRomanNumerals($currentMonth); // Mengonversi ke angka Romawi

    // Format hasil akhir untuk surat
    $suratFormat = " $romanMonth";

    // Mengirim data ke view
    $pdf = Pdf::loadView('admin.surat_keluar.print', compact('suratkeluar', 'today', 'suratFormat'));

    return $pdf->stream('Surat_Keluar.pdf'); 
}

private function getRomanNumerals($number)
{
    $romans = [
        1 => 'I',
        2 => 'II',
        3 => 'III',
        4 => 'IV',
        5 => 'V',
        6 => 'VI',
        7 => 'VII',
        8 => 'VIII',
        9 => 'IX',
        10 => 'X',
        11 => 'XI',
        12 => 'XII',
    ];

    return isset($romans[$number]) ? $romans[$number] : '';
}


// public function generateResi($id)
// {
//     $suratKeluar = Suratkeluar::findOrFail($id);
    
//     // Periksa apakah nomor resi sudah ada
//     if (!$suratKeluar->resi) {
//         // Generate nomor resi unik
//         do {
//             $resiNumber = strtoupper(Str::random(6)); // Generate nomor resi dengan 6 karakter
//         } while (Suratkeluar::where('resi', $resiNumber)->exists());

//         // Simpan nomor resi ke dalam suratkeluar
//         $suratKeluar->resi = $resiNumber;
//         $suratKeluar->save();
//     } else {
//         // Jika sudah ada nomor resi, gunakan yang sudah ada
//         $resiNumber = $suratKeluar->resi;
//     }

//     return response()->json(['resiNumber' => $resiNumber]);
// }

// public function generateResi(Request $request)
// {
//     $request->validate([
//         'id' => 'required|exists:surat_keluar,id', // Validasi untuk memastikan ID ada
//     ]);

//     $suratKeluar = Suratkeluar::findOrFail($request->id);

//     // Periksa apakah nomor resi sudah ada
//     if (empty($suratKeluar->resi)) { 
//         // Generate nomor resi unik
//         do {
//             $resiNumber = strtoupper(Str::random(6)); // Generate nomor resi dengan 6 karakter
//         } while (Suratkeluar::where('resi', $resiNumber)->exists()); 

//         // Simpan nomor resi ke dalam surat_keluar
//         $suratKeluar->resi = $resiNumber; 
//         $suratKeluar->save();
//     } else {
//         // Jika sudah ada nomor resi, gunakan yang sudah ada
//         $resiNumber = $suratKeluar->resi; 
//     }

//     return response()->json(['resiNumber' => $resiNumber]);
// }

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
    
public function generateResi($id)
{
    try {
        $suratKeluar = Suratkeluar::findOrFail($id);
        
        // Periksa apakah nomor resi sudah ada
        if (!$suratKeluar->resi) {
            // Generate nomor resi unik
            do {
                $resiNumber = strtoupper(Str::random(6)); // Generate nomor resi dengan 6 karakter
            } while (Suratkeluar::where('resi', $resiNumber)->exists());

            // Simpan nomor resi ke dalam suratkeluar
            $suratKeluar->resi = $resiNumber;
            $suratKeluar->save();
        } else {
            // Jika sudah ada nomor resi, gunakan yang sudah ada
            $resiNumber = $suratKeluar->resi;
        }

        // Kembalikan respon JSON dengan nomor resi yang baru
        return response()->json(['resiNumber' => $resiNumber]);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Terjadi kesalahan saat menghasilkan nomor resi.',
        ], 500);
    }
}

}
