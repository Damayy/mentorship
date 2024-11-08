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
            $table->string('rt')->nullable()->after('alamat'); // Menambahkan kolom RT
            $table->string('rw')->nullable()->after('rt'); // Menambahkan kolom RW
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('suratkeluar', function (Blueprint $table) {
            $table->dropColumn('rt'); 
            $table->dropColumn('rw'); 
        });
    }
};
