<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('suratmasuk', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->date('tanggal_surat_masuk');
            $table->string('pengirim');
            $table->string('perihal');
            $table->string('deskripsi');
            $table->string('bukti_foto_berkas');
            $table->string('status');
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('suratmasuk');
    }
};
