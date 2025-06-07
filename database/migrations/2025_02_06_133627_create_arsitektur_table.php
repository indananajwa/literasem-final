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
        Schema::create('arsitektur', function (Blueprint $table) {
            $table->id();
            $table->string('nama_arsitektur');
            $table->text('deskripsi_arsitektur');
            $table->string('image_arsitektur');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsitektur');
    }
};
