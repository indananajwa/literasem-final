<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        Schema::create('kategori', function (Blueprint $table) {
            $table->char('kode_kategori', 3)->primary();
            $table->string('nama_kategori', 32);
            $table->string('judul_kategori', 64);
            $table->text('deskripsi_kategori')->nullable();
            $table->binary('gambar_cover')->nullable();
            $table->string('mime_type', 50)->nullable();
            $table->json('field_rules')->nullable();
            $table->json('video_sampul')->nullable(); 
            $table->timestamps();
        });

        // Ubah tipe kolom gambar_cover jadi MEDIUMBLOB
        DB::statement("ALTER TABLE kategori MODIFY gambar_cover MEDIUMBLOB;");
    }

    public function down(): void {
        Schema::dropIfExists('kategori');
    }
};
