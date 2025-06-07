<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contents', function (Blueprint $table) { // Nama tabelnya 'contents' (plural)
            // GANTI 'judul' MENJADI 'title' SESUAI STRUKTUR TABEL LO
            $table->string('slug')->unique()->nullable()->after('title');
        });
    }

    public function down(): void
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};