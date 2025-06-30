<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Reverse the migrations.
     */
    public function up()
    {
        Schema::table('kategori', function (Blueprint $table) {
            $table->tinyInteger('tampilan')->nullable()->after('nama_kategori'); // 1 atau 2
        });
    }

    public function down()
    {
        Schema::table('kategori', function (Blueprint $table) {
            $table->dropColumn('tampilan');
        });
    }

};
