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
        Schema::create('pemerintah', function (Blueprint $table) {
            $table->char('periode', 9)->primary(); // e.g., '2024-2025'
            $table->char('kode_kategori', 3); // Set to 'PEM'
            $table->string('nama_walikota', 64);
            $table->string('nama_wakil_walikota', 64)->nullable();
            $table->binary('foto_walikota')->nullable();
            $table->string('mime_type_walikota', 50)->nullable();
            $table->binary('foto_wakil_walikota')->nullable();
            $table->string('mime_type_wakil_walikota', 50)->nullable();
            $table->timestamps();
        });

        // Ubah kolom foto_walikota dan foto_wakil_walikota menjadi MEDIUMBLOB
        DB::statement("ALTER TABLE pemerintah MODIFY foto_walikota MEDIUMBLOB");
        DB::statement("ALTER TABLE pemerintah MODIFY foto_wakil_walikota MEDIUMBLOB");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemerintah');
    }
};