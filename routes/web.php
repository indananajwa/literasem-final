<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\PengunjungController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- ROUTES UNTUK AUTENTIKASI (LOGIN/REGISTER/LOGOUT) ---
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');
Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register', [AuthController::class, 'store'])->name('auth.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');


// --- ROUTES UNTUK ADMIN (MEMBUTUHKAN AUTENTIKASI) ---
Route::middleware(['auth'])->group(function () {
    // Dashboard Admin (misal tampilkan daftar sections)
    Route::get('/admin/dashboard', [SectionController::class, 'index'])->name('dashboard');

    // CRUD Section oleh Admin
    // MODIFIKASI BAGIAN INI!!! Gunakan ->names() untuk memaksa penamaan route
    Route::resource('admin/sections', SectionController::class)->except(['show'])->names([
        'index'   => 'admin.sections.index',
        'create'  => 'admin.sections.create',
        'store'   => 'admin.sections.store',
        'edit'    => 'admin.sections.edit',
        'update'  => 'admin.sections.update',
        'destroy' => 'admin.sections.destroy',
    ]);


    // CRUD Content oleh Admin (Ini sudah benar namanya di route:list)
    Route::get('/admin/sections/{section}/contents', [ContentController::class, 'index'])->name('admin.contents.index');
    Route::get('/admin/sections/{section}/contents/create', [ContentController::class, 'create'])->name('admin.contents.create');
    Route::post('/admin/sections/{section}/contents', [ContentController::class, 'store'])->name('admin.contents.store');
    Route::get('/admin/contents/{content}/edit', [ContentController::class, 'edit'])->name('admin.contents.edit');
    Route::put('/admin/contents/{content}', [ContentController::class, 'update'])->name('admin.contents.update');
    Route::delete('/admin/contents/{content}', [ContentController::class, 'destroy'])->name('admin.contents.destroy');

    // Manajemen Feedback oleh Admin (Ini sudah benar namanya di route:list)
    Route::get('/admin/feedback', [FeedbackController::class, 'index'])->name('admin.feedback.index');
    Route::get('/admin/feedback/download', [FeedbackController::class, 'download'])->name('admin.feedback.download');
    Route::delete('/admin/feedback/{id}', [FeedbackController::class, 'destroy'])->name('admin.feedback.destroy');
});


// --- ROUTES UNTUK PENGUNJUNG (UMUM, TIDAK BUTUH AUTENTIKASI) ---
Route::get('/', [PengunjungController::class, 'index'])->name('pengunjung.homepage');
Route::get('/literasi-arsip-semarang', function () {
    return view('pengunjung.homepage');
})->name('literasi-arsip-semarang');
Route::get('/section/{slug}', [PengunjungController::class, 'showSection'])->name('pengunjung.show.section');
Route::get('/konten/{slug_konten}', [PengunjungController::class, 'showKonten'])->name('pengunjung.show.konten');
// Route::post('/kontak', [FeedbackController::class, 'store'])->name('pengunjung.feedback.store');

// Hapus atau komen route-route yang tidak relevan atau duplikat (seperti yang sudah kita bahas)