<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengajuansurat', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_pengajuan');
            $table->string('nama_pengaju');
            $table->string('nik'); 
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan']);
            $table->string('agama');
            $table->string('pekerjaan');
            $table->text('alamat');
            $table->enum('jenis_pengajuan',['Surat Keterangan Belum Bekerja', 'Surat Keterangan Belum Memiliki Rumah', 'Surat Keterangan Belum Menikah',
                        'Surat Keterangan Domisili', 'Surat Keterangan Domisili Tanah', 'Surat Keterangan Penghasilan', 'Surat Keterangan Bersih Diri', 'Surat Keterangan Catatan Sipil', 'Surat Keterangan Duda', 'Surat Keterangan Janda', 'Surat Keterangan Orang Yang Sama', 'Surat Keterangan Ghoib', 'Surat Keterangan Selesai Penelitian']);
            $table->string('surat_pengantar');
            $table->string('upload_kk');
            $table->string('upload_ktp');
            $table->string('status')->default('diproses');
            $table->text('keterangan');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuansurat');
    }
};
