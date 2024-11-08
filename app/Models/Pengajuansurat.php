<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuansurat extends Model
{
    use HasFactory;
    protected $table = 'pengajuansurat';

    protected $fillable = [
        'tgl_pengajuan',
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
        'surat_pengantar',  
        'upload_kk',
        'upload_ktp',
        'status',
        'keterangan',
    ];

    public function suratKeluars()
    {
        return $this->hasMany(Suratkeluar::class, 'pengajuansurat_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function suratDitolak()
    {
        return $this->hasOne(Suratditolak::class, 'pengajuansurat_id');
    }
}
    // public function suratditolak()
    // {
    //     return $this->hasOne(Suratditolak::class, 'pengajuansurat_id');
    // }


    // protected static function boot()
    // {
    //     parent::boot();

    //     static::created(function ($pengajuansurat) {
    //         // Simpan data ke tabel suratmasuk
    //         SuratMasuk::create([
    //             'tgl_pengajuan' => $pengajuansurat->tgl_pengajuan,
    //             'nama_pengaju' => $pengajuansurat->nama_pengaju,
    //             'nik' => $pengajuansurat->nik,
    //             'tempat_lahir' => $pengajuansurat->tempat_lahir,
    //             'tgl_lahir' => $pengajuansurat->tgl_lahir,
    //             'jenis_kelamin' => $pengajuansurat->jenis_kelamin,
    //             'agama' => $pengajuansurat->agama,
    //             'pekerjaan' => $pengajuansurat->pekerjaan,
    //             'alamat' => $pengajuansurat->alamat,
    //             'jenis_pengajuan' => $pengajuansurat->jenis_pengajuan, 
    //             'deskripsi' => $pengajuansurat->deskripsi,
    //             'surat_pengantar' => $pengajuansurat->surat_pengantar,
    //             'upload_kk' => $pengajuansurat->upload_kk,
    //             'upload_ktp' => $pengajuansurat->upload_ktp,
    //         ]);
    //     });
    // }

  

    // public function statusPengajuan()
    // {
    //     return $this->hasOne(StatusPengajuan::class);
    // }

