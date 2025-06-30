<?php

// admin

// database/migrations/xxxx_xx_xx_create_admin_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('admin', function (Blueprint $table) {
            $table->char('nip', 18)->primary();
            $table->string('name', 32);
            $table->string('email', 32)->unique();
            $table->string('password', 255);
        });
    }

    public function down(): void {
        Schema::dropIfExists('admin');
    }
};