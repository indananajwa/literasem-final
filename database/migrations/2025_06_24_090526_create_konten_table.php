<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        Schema::create('konten', function (Blueprint $table) {
            $table->char('kode_konten', 6)->primary();       // BUD1, TOK2, dst
            $table->char('kode_kategori', 3);
            $table->string('judul', 64);
            $table->text('deskripsi')->nullable();
            $table->string('video_url', 128)->nullable();
            $table->binary('gambar')->nullable();             // akan diubah jadi MEDIUMBLOB
            $table->string('mime_type', 50)->nullable();

            $table->timestamps();
            
            $table->foreign('kode_kategori')
                  ->references('kode_kategori')
                  ->on('kategori')
                  ->onDelete('cascade');
        });

        DB::statement("ALTER TABLE konten MODIFY gambar MEDIUMBLOB;");
    }

    public function down(): void {
        Schema::dropIfExists('konten');
    }
};