<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataAdminController;
use App\Http\Controllers\DataWargaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PengajuansuratController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SuratDitolakController;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);
Route::get('/beranda', [HomeController::class, 'beranda'])->name('beranda');
Route::get('/informasilayanan', [HomeController::class, 'informasi'])->name('informasi.layanan');
Route::get('/lokasi', [HomeController::class, 'lokasi'])->name('lokasi');

Route::get('/masuk', [LoginController::class, 'index'])->name('masuk');
Route::post('/proses-masuk', [LoginController::class, 'login_proses'])->name('proses-masuk');
Route::post('/keluar', [LoginController::class, 'logout'])->name('keluar');
Route::get('/daftar', [RegisterController::class, 'index'])->name('daftar');
Route::post('/proses-daftar', [RegisterController::class, 'register_proses'])->name('proses-daftar');

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'dashboardadmin'])->name('admin.dashboard');
    Route::post('/pengajuansurat/diterima/{id}', [PengajuanSuratController::class, 'diterima'])->name('pengajuansurat.diterima');

    Route::get('/admin/suratkeluar', [SuratKeluarController::class, 'index'])->name('suratkeluar.index');
    Route::post('/admin/suratkeluar/diterima', [SuratKeluarController::class, 'simpandata'])->name('suratkeluar.simpan');
    Route::get('/admin/printsuratkeluar/{id}', [SuratKeluarController::class, 'print'])->name('suratkeluar.print');
    Route::post('/admin/suratkeluar/generateResi/{id}', [SuratKeluarController::class, 'generateResi'])->name('admin.suratkeluar.generateResi');
    Route::get('/generate-nomor-surat', [SuratKeluarController::class, 'generateNomorSurat']);

 
    Route::get('/admin/suratmasuk', [SuratMasukController::class, 'index'])->name('suratmasuk');
    Route::get('/admin/edit/{id}', [SuratMasukController::class, 'edit'])->name('suratmasuk.editt');
    Route::post('/admin/update/{id}', [SuratMasukController::class, 'update'])->name('suratmasuk.update');
    Route::delete('/admin/hapus/{id}', [SuratMasukController::class, 'destroy'])->name('suratmasuk.hapus');
    Route::post('/admin/suratmasuk/{id}/diterima', [SuratMasukController::class, 'diterima'])->name('suratmasuk.diterima');
    Route::post('/admin/suratmasuk/{id}/ditolak', [SuratMasukController::class, 'ditolak'])->name('suratmasuk.ditolak');
    Route::put('/admin/suratmasuk/update-status/{id}', [SuratMasukController::class, 'updateStatus'])->name('suratmasuk.updateStatus');
  
    Route::get('/admin/laporansurat', [LaporanController::class, 'laporanSurat'])->name('laporansurat');

    Route::get('/admin/datawarga', [DataWargaController::class, 'index'])->name('datawarga');
    Route::post('/admin/activate/{id}', [DataWargaController::class, 'activate'])->name('admin.activate');
    Route::post('/admin/deactivate/{id}', [DataWargaController::class, 'deactivate'])->name('admin.deactivate');
    Route::delete('/admin/delete/{id}', [DataWargaController::class, 'destroy'])->name('admin.delete');

    Route::get('/admin/dataadmin', [DataAdminController::class, 'index'])->name('dataadmin');

    Route::get('/admin/suratditolak', [SuratDitolakController::class, 'index'])->name('suratditolak.index');
    Route::post('admin/suratditolakstore', [SuratDitolakController::class, 'store'])->name('suratditolak.store');
});

Route::group(['middleware' => ['role:warga']], function () {
    Route::get('/warga/dashboard', [DashboardController::class, 'dashboardwarga'])->name('warga.dashboard');
    Route::get('/warga/statuspengajuan', [PengajuansuratController::class, 'statuspengajuan'])->name('pengajuan.status');
    Route::get('/warga/tambahpengajuan', [PengajuansuratController::class, 'tambah'])->name('pengajuan.tambah');
    Route::post('/warga/simpandata', [PengajuansuratController::class, 'simpan'])->name('pengajuan.simpandata');
    Route::get('/warga/riwayatdata', [PengajuansuratController::class, 'riwayat'])->name('pengajuan.riwayatdata');
    Route::get('/warga/edit/{id}', [PengajuansuratController::class, 'edit'])->name('pengajuan.edit');
    Route::post('/warga/update/{id}', [PengajuansuratController::class, 'update'])->name('pengajuan.update');
    Route::get('/akun-warga/{id}', [PengajuansuratController::class, 'resi'])->name('resi');
    Route::get('/warga/pengajuansurat/{id}/resi-pdf', [PengajuansuratController::class, 'getResiNumber'])->name('pengajuansurat.resi.pdf');
});
