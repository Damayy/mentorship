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
        Schema::table('suratkeluar', function (Blueprint $table) {
            $table->dropForeign(['surat_masuk_id']); // Hapus foreign key jika ada
            $table->dropColumn('surat_masuk_id'); // Hapus kolom surat_masuk_id
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('suratkeluar', function (Blueprint $table) {
            $table->unsignedBigInteger('surat_masuk_id')->after('id'); // Tambahkan kolom jika dibutuhkan kembali
            $table->foreign('surat_masuk_id')->references('id')->on('surat_masuk')->onDelete('cascade');
        });
    }
};
