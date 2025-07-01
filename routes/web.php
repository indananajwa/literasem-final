<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// MODELS
use App\Models\Kategori;

// CONTROLLERS
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\KontenController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PengunjungController;

// PENGUNJUNG: Resource controller per kategori
use App\Http\Controllers\PemerintahController;
use App\Http\Controllers\PariwisataController;
use App\Http\Controllers\ArsitekturController;
use App\Http\Controllers\MakananController;
use App\Http\Controllers\IbadahController;
use App\Http\Controllers\TokohController;
use App\Http\Controllers\KotaLamaController;
use App\Http\Controllers\BudayaController;


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');
Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register', [AuthController::class, 'store'])->name('auth.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');


/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/admin/dashboard', fn () => view('admin.dashboard'))->name('dashboard');

    // Kategori Management
    Route::resource('admin/kategori', KategoriController::class)->except(['show'])->names([
        'index'   => 'admin.kategori.index',
        'create'  => 'admin.kategori.create',
        'store'   => 'admin.kategori.store',
        'edit'    => 'admin.kategori.edit',
        'update'  => 'admin.kategori.update',
        'destroy' => 'admin.kategori.destroy',
    ]);

    // Konten per Kategori
    Route::prefix('admin/kategori/{kode_kategori}/konten')->name('admin.konten.')->group(function () {
        Route::get('/', [KontenController::class, 'index'])->name('index');
        Route::get('/create', [KontenController::class, 'create'])->name('create');
        Route::post('/', [KontenController::class, 'store'])->name('store');
        Route::get('/{kode_konten}', [KontenController::class, 'show'])->name('show');
        Route::get('/{kode_konten}/edit', [KontenController::class, 'edit'])->name('edit');
        Route::put('/{kode_konten}', [KontenController::class, 'update'])->name('update');
        Route::delete('/{kode_konten}', [KontenController::class, 'destroy'])->name('destroy');
    });

    // Gambar konten (khusus untuk admin)
    Route::get('/admin/konten/gambar/{kode_konten}', [KontenController::class, 'showGambar'])->name('admin.konten.gambar');

    // Feedback admin panel
    Route::prefix('admin/feedback')->name('admin.feedback.')->group(function () {
        Route::get('/', [FeedbackController::class, 'index'])->name('index');
        Route::get('/download', [FeedbackController::class, 'download'])->name('download');
        Route::delete('/{id}', [FeedbackController::class, 'destroy'])->name('destroy');
    });

    // Route untuk pariwisata
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/pariwisata/konten', [PariwisataController::class, 'adminView'])->name('pariwisata.konten');
        Route::post('/kategori/pariwisata', [PariwisataController::class, 'store'])->name('pariwisata.store');
        Route::put('/pariwisata/{id}', [PariwisataController::class, 'update'])->name('pariwisata.update');
        Route::delete('/pariwisata/{id}', [PariwisataController::class, 'destroy'])->name('pariwisata.destroy');
    });

    
    // Route untuk pemerintah
    Route::prefix('admin')->name('admin.')->group(function () {
        // Route untuk halaman utama manajemen pemerintah
        Route::get('/pemerintah/konten', [PemerintahController::class, 'adminIndex'])->name('pemerintah.konten');
        
        // Route untuk CRUD operations
        Route::post('/pemerintah', [PemerintahController::class, 'store'])->name('pemerintah.store');
        Route::put('/pemerintah/{periode}', [PemerintahController::class, 'update'])->name('pemerintah.update');
        Route::delete('/pemerintah/{periode}', [PemerintahController::class, 'destroy'])->name('pemerintah.destroy');
        
        // Route untuk menampilkan foto
        Route::get('/pemerintah/{periode}/foto/{type?}', [PemerintahController::class, 'showFoto'])->name('pemerintah.foto');
        
        // Route opsional untuk index biasa
        Route::get('/pemerintah', [PemerintahController::class, 'index'])->name('pemerintah.index');
    });



    // Optional manual content management page
    Route::get('/manajemen-konten', [KategoriController::class, 'index'])->name('manajemen_konten');
});


/*
|--------------------------------------------------------------------------
| PENGUNJUNG AREA
|--------------------------------------------------------------------------
*/

// Landing Page dan Halaman Utama
Route::get('/', [PengunjungController::class, 'index'])->name('home');
Route::get('/masa-ke-masa', [PengunjungController::class, 'masaKeMasa'])->name('masa-ke-masa');
Route::get('/situs-kota-lama', [PengunjungController::class, 'situsKotaLama'])->name('situs-kota-lama');
Route::get('/pemerintahan/foto/{periode}/{type?}', [PengunjungController::class, 'showFotoPemerintahan'])
    ->name('pengunjung.pemerintahan.foto');
    
// Routes untuk pengunjung
Route::get('/pemerintahan', [PemerintahController::class, 'timelinePemerintahan'])->name('pengunjung.pemerintahan.timeline');
Route::get('/pemerintahan/current', [PemerintahController::class, 'currentPemerintahan'])->name('pengunjung.pemerintahan.current');
Route::get('/pemerintahan/detail/{periode}', [PemerintahController::class, 'detailPemerintahan'])->name('pengunjung.pemerintahan.detail');
Route::get('/pemerintahan/search', [PemerintahController::class, 'searchPemerintahan'])->name('pengunjung.pemerintahan.search');
Route::get('/pemerintahan/statistik', [PemerintahController::class, 'statistikPemerintahan'])->name('pengunjung.pemerintahan.statistik');
Route::get('/pemerintahan/foto/{periode}/{type?}', [PemerintahController::class, 'publicFoto'])->name('pengunjung.pemerintahan.foto');
Route::get('/api/pemerintahan', [PemerintahController::class, 'apiPemerintahan'])->name('api.pemerintahan');


// Halaman kategori & konten
Route::get('/kategori', [PengunjungController::class, 'showKategori'])->name('pengunjung.kategori');
Route::get('/kategori/{kodeKategori}', [KategoriController::class, 'show'])->name('kategori.show')->where('kodeKategori', '[A-Z]{3}');
Route::get('/kategori/{kodeKategori}/cover', [KategoriController::class, 'showCoverImage'])->name('kategori.cover')->where('kodeKategori', '[A-Z]{3}');
Route::get('/konten/{kodeKonten}/image', [KategoriController::class, 'showKontenImage'])->name('konten.image')->where('kodeKonten', '[A-Z]{3}[0-9]{3}');
Route::get('/konten/{slug_konten}', [PengunjungController::class, 'showKonten'])->name('pengunjung.show.konten');
Route::get('/section/{slug}', [PengunjungController::class, 'showSection'])->name('pengunjung.show.section');

// Search API
Route::get('/api/kategori/{kodeKategori}/search', [KategoriController::class, 'searchKonten'])->name('kategori.search')->where('kodeKategori', '[A-Z]{3}');

// // Pariwisata (khusus pengunjung)
Route::get('/wisata', [PariwisataController::class, 'index'])->name('pariwisata.index');
Route::get('/wisata/gambar/{id}', [PariwisataController::class, 'gambar'])->name('pariwisata.gambar');


// Bookmark Page
Route::get('/bookmark', fn () => view('pengunjung.bookmark'))->name('bookmark');

// Feedback dari pengunjung
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
Route::delete('/admin/feedback/{id}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');

// Public resource routes (kategori tematik)
Route::resources([
    'pemerintah' => PemerintahController::class,
    'arsitektur' => ArsitekturController::class,
    'ibadah'     => IbadahController::class,
    'makanan'    => MakananController::class,
    'tokoh'      => TokohController::class,
    'kotalama'   => KotaLamaController::class,
    'budaya'     => BudayaController::class,
]);
