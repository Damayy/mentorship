<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suratditolak extends Model
{
    use HasFactory;
    protected $table = 'suratditolak';
    protected $fillable = [
        'pengajuansurat_id',
        'nama_pengaju',
        'nik',
        'jenis_pengajuan',
        'alasan_penolakan',
        'tgl_surat_ditolak',
    ];

    public function pengajuanSurat()
    {
        return $this->belongsTo(Pengajuansurat::class, 'pengajuansurat_id');
    }
}
