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
        Schema::table('pengajuansurat', function (Blueprint $table) {
            $table->string('status')->nullable()->after('upload_ktp'); 
            $table->text('keterangan')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuansurat', function (Blueprint $table) {
            $table->dropColumn(['status', 'keterangan']);
        });
    }
};
