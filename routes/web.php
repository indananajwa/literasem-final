<?php

use Illuminate\Support\Facades\Route;
use App\Models\Kategori;

// Controller
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\KontenController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PengunjungController;

// Controller Lain (pengunjung)
use App\Http\Controllers\PemerintahController;
use App\Http\Controllers\ArsitekturController;
use App\Http\Controllers\MakananController;
use App\Http\Controllers\IbadahController;
use App\Http\Controllers\TokohController;
use App\Http\Controllers\KotaLamaController;
use App\Http\Controllers\BudayaController;
use App\Http\Controllers\PariwisataController;

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
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/admin/dashboard', fn () => view('admin.dashboard'))->name('dashboard');

    // Kategori
    Route::resource('admin/kategori', KategoriController::class)->except(['show'])->names([
        'index'   => 'admin.kategori.index',
        'create'  => 'admin.kategori.create',
        'store'   => 'admin.kategori.store',
        'edit'    => 'admin.kategori.edit',
        'update'  => 'admin.kategori.update',
        'destroy' => 'admin.kategori.destroy',
    ]);

    // Konten per kategori
    Route::prefix('admin/kategori/{kode_kategori}/konten')->name('admin.konten.')->group(function () {
        Route::get('/', [KontenController::class, 'index'])->name('index');
        Route::get('/create', [KontenController::class, 'create'])->name('create');
        Route::post('/', [KontenController::class, 'store'])->name('store');
        Route::get('/{kode_konten}', [KontenController::class, 'show'])->name('show');
        Route::get('/{kode_konten}/edit', [KontenController::class, 'edit'])->name('edit');
        Route::put('/{kode_konten}', [KontenController::class, 'update'])->name('update');
        Route::delete('/{kode_konten}', [KontenController::class, 'destroy'])->name('destroy');
    });

    // Gambar konten (terpisah karena tidak dalam prefix yang sama)
    Route::get('/admin/konten/gambar/{kode_konten}', [KontenController::class, 'showGambar'])->name('admin.konten.gambar');

    // Feedback
    Route::prefix('admin/feedback')->name('admin.feedback.')->group(function () {
        Route::get('/', [FeedbackController::class, 'index'])->name('index');
        Route::get('/download', [FeedbackController::class, 'download'])->name('download');
        Route::delete('/{id}', [FeedbackController::class, 'destroy'])->name('destroy');
    });
});

/*
|--------------------------------------------------------------------------
| PENGUNJUNG
|--------------------------------------------------------------------------
*/
Route::get('/literasi-arsip-semarang', [PengunjungController::class, 'index'])->name('pengunjung.homepage');

Route::get('/section/{slug}', [PengunjungController::class, 'showSection'])->name('pengunjung.show.section');
Route::get('/konten/{slug_konten}', [PengunjungController::class, 'showKonten'])->name('pengunjung.show.konten');
Route::get('/kategori', [PengunjungController::class, 'showKategori'])->name('pengunjung.kategori');

// Optional: Legacy/manual page
Route::get('/manajemen-konten', function () {
    $kategoris = Kategori::all();
    return view('admin.manajemen_konten', compact('kategoris'));
})->name('manajemen_konten');

// Resource publik
Route::resources([
    'pemerintah' => PemerintahController::class,
    'arsitektur' => ArsitekturController::class,
    'ibadah'     => IbadahController::class,
    'makanan'    => MakananController::class,
    'tokoh'      => TokohController::class,
    'kotalama'   => KotaLamaController::class,
    'budaya'     => BudayaController::class,
    'pariwisata' => PariwisataController::class,
]);
