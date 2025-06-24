<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Section;

// Controller Utama
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\PengunjungController;

// Controller Pengunjung Lain
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
| ROUTES: AUTENTIKASI (LOGIN, REGISTER, LOGOUT)
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');
Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register', [AuthController::class, 'store'])->name('auth.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

/*
|--------------------------------------------------------------------------
| ROUTES: ADMIN (DENGAN MIDDLEWARE AUTH)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/admin/dashboard', [SectionController::class, 'index'])->name('dashboard');

    // Section (tidak bisa dihapus, hanya tambah konten)
    Route::resource('admin/sections', SectionController::class)->except(['show'])->names([
        'index'   => 'admin.sections.index',
        'create'  => 'admin.sections.create',
        'store'   => 'admin.sections.store',
        'edit'    => 'admin.sections.edit',
        'update'  => 'admin.sections.update',
        'destroy' => 'admin.sections.destroy',
    ]);

    // Konten
    Route::get('/admin/sections/{section}/contents', [ContentController::class, 'index'])->name('admin.contents.index');
    Route::get('/admin/sections/{section}/contents/create', [ContentController::class, 'create'])->name('admin.contents.create');
    Route::post('/admin/sections/{section}/contents', [ContentController::class, 'store'])->name('admin.contents.store');
    Route::get('/admin/contents/{content}/edit', [ContentController::class, 'edit'])->name('admin.contents.edit');
    Route::put('/admin/contents/{content}', [ContentController::class, 'update'])->name('admin.contents.update');
    Route::delete('/admin/contents/{content}', [ContentController::class, 'destroy'])->name('admin.contents.destroy');

    // Feedback
    Route::get('/admin/feedback', [FeedbackController::class, 'index'])->name('admin.feedback.index');
    Route::get('/admin/feedback/download', [FeedbackController::class, 'download'])->name('admin.feedback.download');
    Route::delete('/admin/feedback/{id}', [FeedbackController::class, 'destroy'])->name('admin.feedback.destroy');
});

/*
|--------------------------------------------------------------------------
| ROUTES: PENGUNJUNG (UMUM, BEBAS DIAKSES)
|--------------------------------------------------------------------------
*/
// Halaman Utama
Route::get('/', [PengunjungController::class, 'index'])->name('pengunjung.homepage');

// Tampilan statis
Route::get('/literasi-arsip-semarang', fn() => view('pengunjung.homepage'))->name('literasi-arsip-semarang');
Route::get('/situs-kota-lama', fn() => view('pengunjung.sections.situs-kota-lama'))->name('situs-kota-lama');
Route::get('/makan', fn() => view('pengunjung.sections.eat'))->name('makanan');
Route::get('/wisata', fn() => view('pengunjung.sections.pariwisata'))->name('wisata');
Route::get('/arsitektur', fn() => view('pengunjung.sections.arsitektur'));
Route::get('/tokoh', fn() => view('pengunjung.sections.tokohM'));
Route::get('/tempatibadah', fn() => view('pengunjung.sections.tempatibadah'));
Route::get('/budaya', fn() => view('pengunjung.sections.budaya'));

// Halaman Dinamis
Route::get('/section/{slug}', [PengunjungController::class, 'showSection'])->name('pengunjung.show.section');
Route::get('/konten/{slug_konten}', [PengunjungController::class, 'showKonten'])->name('pengunjung.show.konten');
// Route::post('/kontak', [FeedbackController::class, 'store'])->name('pengunjung.feedback.store');

/*
|--------------------------------------------------------------------------
| ROUTES: PENGUNJUNG DENGAN RESOURCE CONTROLLER
|--------------------------------------------------------------------------
*/
Route::resource('pemerintah', PemerintahController::class);
Route::resource('arsitektur', ArsitekturController::class);
Route::resource('ibadah', IbadahController::class);
Route::resource('makanan', MakananController::class);
Route::resource('tokoh', TokohController::class);
Route::resource('kotalama', KotaLamaController::class);
Route::resource('budaya', BudayaController::class);
Route::resource('pariwisata', PariwisataController::class);

Route::get('/manajemen-konten', function () {
    $sections = Section::all(); // atau \App\Models\Section::all();
    return view('admin.manajemen_konten', compact('sections'));
})->name('manajemen_konten');

Route::get('/section/{slug}', [SectionController::class, 'show'])->name('pengunjung.section.show');
