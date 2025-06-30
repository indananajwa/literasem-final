<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
// feedback

// database/migrations/xxxx_xx_xx_create_feedback_table.php

return new class extends Migration {
    public function up(): void {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pengunjung', 32);
            $table->string('email', 64)->nullable();
            $table->text('pesan');
            $table->dateTime('tanggal_kirim')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    public function down(): void {
        Schema::dropIfExists('feedback');
    }
};