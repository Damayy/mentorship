<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suratmasuk extends Model
{
    use HasFactory;
  protected $table = 'surat_masuk';

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
      'jenis_pengajuan',
      'deskripsi',
      'surat_pengantar',  
      'upload_kk',
      'upload_ktp',
    ];
    // protected $dates = ['tanggal_surat_masuk'];
}
