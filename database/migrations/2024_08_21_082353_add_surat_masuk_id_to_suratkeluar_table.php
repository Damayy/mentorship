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
            $table->foreignId('surat_masuk_id')->constrained('surat_masuk')->onDelete('cascade')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('suratkeluar', function (Blueprint $table) {
            $table->dropForeign(['surat_masuk_id']);
            $table->dropColumn('surat_masuk_id');
        });
    }
};
