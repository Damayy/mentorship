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
        Schema::table('suratditolak', function (Blueprint $table) {
            $table->date('tgl_surat_ditolak')->nullable()->after('alasan_penolakan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('suratditolak', function (Blueprint $table) {
            $table->dropColumn('tgl_surat_ditolak');
        });
    }
};
