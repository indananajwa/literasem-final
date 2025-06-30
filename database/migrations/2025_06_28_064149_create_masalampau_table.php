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
        Schema::create('masalampau', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('image_lalu');
            $table->string('image_sekarang');
            $table->json('labels'); // Stores {"year": "YYYY"}
            $table->json('description'); // Stores JSON array of description paragraphs
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masalampau');
    }
};