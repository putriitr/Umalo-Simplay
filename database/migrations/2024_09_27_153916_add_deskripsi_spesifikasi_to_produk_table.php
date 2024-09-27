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
        Schema::table('produk', function (Blueprint $table) {
            $table->text('deskripsi')->nullable()->after('link');  // Menambahkan kolom deskripsi setelah kolom link
            $table->text('spesifikasi')->nullable()->after('deskripsi');  // Menambahkan kolom spesifikasi setelah kolom deskripsi
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->dropColumn('deskripsi');
            $table->dropColumn('spesifikasi');
        });
    }
};
