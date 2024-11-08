<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suratkeluar extends Model
{
    use HasFactory;
    protected $table = 'suratkeluar';
    protected $fillable = [
        'pengajuansurat_id',
        'tanggalsurat_keluar',
        'nomor_surat',
        'nama_pengaju',
        'nik',
        'tempat_lahir',
        'tgl_lahir',
        'jenis_kelamin', 
        'agama',
        'pekerjaan',
        'alamat',
        'rt',
        'rw',
        'jenis_pengajuan',
        'deskripsi',     
        'resi',  
        ];

        public function pengajuanSurat()
    {
        return $this->belongsTo(Pengajuansurat::class, 'pengajuansurat_id');
    }
    // public function suratMasuk()
    //     {
    //         return $this->belongsTo(Suratmasuk::class, 'surat_masuk_id');
    //     }
}
