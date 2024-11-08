<?php

namespace App\Http\Controllers;

use App\Models\Pengajuansurat;
use App\Models\Suratkeluar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;


class PengajuansuratController extends Controller
{

    public function index()
    {
        return view('warga.index');
    }

    public function riwayat()
    {
        $namaPengaju = Auth::user()->name;
        $pengajuansurat = Pengajuansurat::where('nama_pengaju', $namaPengaju)->get();
        return view('warga.riwayat', compact('pengajuansurat'));
    }

    public function statuspengajuan(Request $request)
{  
    $namaPengaju = Auth::user()->name;
    $pengajuansurat = Pengajuansurat::where('nama_pengaju', $namaPengaju)
        ->with('suratditolak')
        ->get();
    return view('warga.status', compact('pengajuansurat'));
}

    public function tambah()
{
    $user = Auth::user();
    $namapengaju = $user->name;
    $nik = $user->nik;
    $tempat_lahir = $user->tempat_lahir;
    $tanggal_lahir = $user->tanggal_lahir ? Carbon::parse($user->tanggal_lahir)->format('Y-m-d') : null; 
    $alamat = $user->alamat;
    $jenis_kelamin = $user->jenis_kelamin;
    $agama = $user->agama;
    $bukti_ktp = $user->bukti_ktp; 
    $bukti_kk = $user->bukti_kk;
    $tanggal_hariini = Carbon::now()->toDateString();

     // Ambil data pekerjaan dari user
     $pekerjaan = $user->pekerjaan; 
     $pekerjaan_lainnya = $user->pekerjaan_lainnya;
 
     // Jika pekerjaan adalah "lainnya", gunakan pekerjaan_lainnya
     if ($pekerjaan === 'lainnya') {
         $pekerjaan = $pekerjaan_lainnya;
     }

    return view('warga.tambah', compact(
        'namapengaju', 'nik', 'tanggal_hariini', 'tempat_lahir', 'tanggal_lahir', 
        'alamat', 'jenis_kelamin', 'agama', 'pekerjaan', 'bukti_ktp', 'bukti_kk'
    ));
}

public function simpan(Request $request)
{
    // Ambil data user yang sedang login
    $user = Auth::user();

    // Validasi input, termasuk validasi untuk file yang di-upload
    $request->validate([
        'tgl_pengajuan' => 'required|date',
        'jenis_pengajuan' => 'required|string|max:255',
        'deskripsi' => 'required|string|max:255',
        'surat_pengantar' => 'file|mimes:pdf,jpg,jpeg,png,doc|max:2048',
    ]);

    // Simpan file ke storage/app/public/uploads
    $suratPengantarPath = $request->file('surat_pengantar')->store('uploads', 'public');

    // Ambil path upload KTP dari data user yang sudah tersimpan di tabel users
    // $uploadKtpPath = $user->upload_ktp;

    // Data yang akan disimpan di tabel pengajuansurat, beberapa data diambil dari user yang sedang login
    $data = [
        'tgl_pengajuan' => $request->tgl_pengajuan,
        'nama_pengaju' => $user->name, 
        'nik' => $user->nik, 
        'tempat_lahir' => $user->tempat_lahir, 
        'tgl_lahir' => $user->tanggal_lahir, 
        'jenis_kelamin' => $user->jenis_kelamin,
        'agama' => $user->agama, 
        'pekerjaan' => $request->pekerjaan, 
        'alamat' => $request->alamat, 
        'rt' => $request->rt,
        'rw' => $request->rw,
        'jenis_pengajuan' => $request->jenis_pengajuan,
        'deskripsi' => $request->deskripsi,
        'surat_pengantar' => $suratPengantarPath,
        'upload_kk' => $user->bukti_kk,
        'upload_ktp' => $user->bukti_ktp, // Menggunakan path yang sudah tersimpan di tabel users
    ];

    // Simpan data ke tabel pengajuansurat
    Pengajuansurat::create($data);

    return redirect()->route('pengajuan.status')->with('success', 'Pengajuan Surat Berhasil!');
}

public function getResiNumber($id)
    {
        $suratKeluar = Suratkeluar::where('pengajuansurat_id', $id)->first();

        if ($suratKeluar) {
            $data = [
                'resi' => $suratKeluar->resi,
                'nik' => $suratKeluar->nik,
                'nama_pengaju' => $suratKeluar->nama_pengaju, 
                'jenis_kelamin' => $suratKeluar->jenis_kelamin,
                'jenis_pengajuan' => $suratKeluar->jenis_pengajuan 
            ];

            // Buat view untuk PDF dan masukkan data ke view tersebut
            $pdf = Pdf::loadView('warga.resi', $data);

            // Unduh atau tampilkan PDF
            // return $pdf->download('resi_' . $suratKeluar->resi . '.pdf');
            // Jika ingin menampilkan di browser tanpa mengunduh
            return $pdf->stream(); 
        } else {
            return redirect()->back()->with('error', 'Nomor resi tidak ditemukan');
        }
    }

    public function store(Request $request)
    {
        
    }

    
    public function show(string $id)
    {
        //
    }

    public function statusdata()
    {
    }

  
    public function edit(string $id)
    {
        $pengajuansurat = Pengajuansurat::find($id);
        $tanggal_hariini = Carbon::now()->toDateString();
        return view('warga.edit', compact('pengajuansurat', 'tanggal_hariini'));
    }
    public function update(Request $request, string $id)
    {
        // Validasi input, misalnya
        $request->validate([
            'tgl_pengajuan' => 'required|date',
            'nama_pengaju' => 'required|string|max:255',
            'nik' => 'required|string|max:16',
            'tempat_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'agama' => 'required|string',
            'pekerjaan' => 'required|string',
            'alamat' => 'required|string',
            'rt' => 'required|string',
            'rw' => 'required|string',
            'jenis_pengajuan' => 'required|string',
            'deskripsi' => 'nullable|string',
            'surat_pengantar' => 'file|mimes:pdf,jpg,jpeg,png,doc|max:2048', 
            'upload_kk' => 'file|mimes:pdf,jpg,jpeg,png,doc|max:2048', 
            'upload_ktp' =>'file|mimes:pdf,jpg,jpeg,png,doc|max:2048', 
        ]);
    
        $pengajuansurat = Pengajuansurat::findOrFail($id);
    
        // Array untuk data non-file
        $data = [
            'tgl_pengajuan' => $request->tgl_pengajuan,
            'nama_pengaju' => $request->nama_pengaju,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'pekerjaan' => $request->pekerjaan,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'jenis_pengajuan' => $request->jenis_pengajuan,
            'deskripsi' => $request->deskripsi,
        ];
    
         // Simpan file ke storage/app/public/uploads jika ada file baru
    if ($request->hasFile('surat_pengantar')) {
        $suratPengantarPath = $request->file('surat_pengantar')->store('uploads', 'public');
        $pengajuansurat->surat_pengantar = $suratPengantarPath;
    }

    if ($request->hasFile('upload_kk')) {
        $uploadKkPath = $request->file('upload_kk')->store('uploads', 'public');
        $pengajuansurat->upload_kk = $uploadKkPath;
    }

    if ($request->hasFile('upload_ktp')) {
        $uploadKtpPath = $request->file('upload_ktp')->store('uploads', 'public');
        $pengajuansurat->upload_ktp = $uploadKtpPath;
    }   
        // Update data di database
        $pengajuansurat->update($data);
        return redirect()->route('pengajuan.riwayatdata')->with('success', 'Data Berhasil Di Update!');
    }
    
    public function destroy(string $id)
    {
        //
    }
}
