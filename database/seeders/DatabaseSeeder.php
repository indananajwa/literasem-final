<?php

namespace Database\Seeders;

use App\Models\Masalampau;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Jalankan semua seeder.
     */
    public function run(): void
    {
        // Tambahkan pemanggilan seeder di sini
        $this->call([
            PariwisataSeeder::class,
            KategoriSeeder::class,
            KontenSeeder::class,
            // Masalampau::class,
        ]);
    }
}
