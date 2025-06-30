<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Kategori;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            // Ambil semua kategori tambahan, kecuali yang sudah fixed
            $kategoris = Kategori::whereNotIn('nama_kategori', [
                'arsitektur', 'budaya', 'tokoh', 'makan', 'pemerintahan', 'situs kota lama', 'tempat ibadah', 'wisata smg'
            ])->get();

            $view->with('additional_sections', $kategoris);
        });
    }
}
