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
        Schema::table('surat_masuk', function (Blueprint $table) {
            if (Schema::hasColumn('surat_masuk', 'pengajuansurat_id')) {
                $table->dropColumn('pengajuansurat_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surat_masuk', function (Blueprint $table) {
            if (!Schema::hasColumn('surat_masuk', 'pengajuansurat_id')) {
                $table->unsignedBigInteger('pengajuansurat_id')->nullable();
                $table->foreign('pengajuansurat_id')->references('id')->on('pengajuansurat')->onDelete('cascade');
            }
        });
    }
};
