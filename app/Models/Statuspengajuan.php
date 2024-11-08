<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statuspengajuan extends Model
{
    use HasFactory;
    protected $table = 'Statuspengajuan';

    protected $fillable = [
            'tgl_pengajuan',
            'nama_pengaju',
            'nik',
            'jenis_pengajuan',
            'surat_pengantar',
            'upload_kk',
            'upload_ktp',
            'status',
            'keterangan',
    ];

    public function dataPengajuan()
    {
        return $this->belongsTo(Pengajuansurat::class);
    }
}
