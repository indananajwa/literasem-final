<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        Schema::create('pemerintah', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 64);
            $table->string('jabatan', 64);
            $table->year('tahun_awal');
            $table->year('tahun_akhir')->nullable();
            $table->binary('foto')->nullable();               // binary dulu
            $table->string('mime_type', 50)->nullable();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE pemerintah MODIFY foto MEDIUMBLOB;");
    }

    public function down(): void {
        Schema::dropIfExists('pemerintah');
    }
};