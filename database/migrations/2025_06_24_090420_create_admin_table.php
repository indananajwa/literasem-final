<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Jalankan migration
     */
    public function up(): void
    {
        // Jika tabel admin belum ada, buat baru
        if (!Schema::hasTable('admin')) {
            Schema::create('admin', function (Blueprint $table) {
                $table->char('nip', 18)->primary();
                $table->string('name', 32);
                $table->string('email', 32)->unique();
                $table->string('password', 255);
                $table->timestamps(); // Tambah created_at & updated_at
            });
        } else {
            // Jika tabel sudah ada, cek apakah butuh menambah timestamps
            if (!Schema::hasColumns('admin', ['created_at', 'updated_at'])) {
                Schema::table('admin', function (Blueprint $table) {
                    $table->timestamps();
                });
            }
        }
    }

    /**
     * Batalkan migration
     */
    public function down(): void
    {
        Schema::table('admin', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
};