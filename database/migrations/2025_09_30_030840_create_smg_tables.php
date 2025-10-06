<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tabel Masa Depan
        Schema::create('smgMasaDepan', function (Blueprint $table) {
            $table->char('kode_video', 6)->primary(); // e.g., 'SMD001'
            $table->string('judul'); // e.g., 'Transportasi Modern'
            $table->string('video')->nullable(); // YouTube video ID
            $table->text('deskripsi');
            $table->timestamps();
        });

        // Tabel Masa Lalu
        Schema::create('smgMasaLalu', function (Blueprint $table) {
            $table->char('kode_lokasi', 6)->primary(); // e.g., 'SML001'
            $table->string('judul');
            $table->text('deskripsi');

            // Foto sebelum & sesudah (pakai binary)
            $table->binary('foto_sebelum')->nullable();
            $table->string('mime_type_sebelum', 50)->nullable();
            $table->binary('foto_sesudah')->nullable();
            $table->string('mime_type_sesudah', 50)->nullable();

            $table->string('label_sebelum');
            $table->string('label_sesudah');
            $table->char('tahun_sebelum', 4);
            $table->char('tahun_sesudah', 4);
            $table->timestamps();
        });

        // upgrade kolom foto jadi MEDIUMBLOB
        DB::statement("ALTER TABLE smgMasaLalu MODIFY foto_sebelum MEDIUMBLOB");
        DB::statement("ALTER TABLE smgMasaLalu MODIFY foto_sesudah MEDIUMBLOB");


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smgMasaDepan');
        Schema::dropIfExists('smgMasaLalu');
    }
};
