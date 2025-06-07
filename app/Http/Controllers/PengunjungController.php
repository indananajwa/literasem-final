<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section; // Pastikan ini sudah benar: App\Models\Section
use App\Models\Content; // Pastikan ini sudah benar: App\Models\Content (bukan Konten)

class PengunjungController extends Controller
{
    /**
     * Menampilkan halaman utama atau daftar semua section untuk pengunjung.
     */
    public function index()
    {
        // Ambil semua section dari database
        $sections = Section::all();

        // Mengirim data sections ke view 'pengunjung.homepage'
        return view('pengunjung.homepage', compact('sections'));
    }

    /**
     * Menampilkan detail sebuah section dan konten-konten di dalamnya.
     * Menggunakan slug untuk identifikasi section.
     */
    public function showSection($slug)
    {
        // Cari section berdasarkan slug. Jika tidak ditemukan, otomatis Laravel akan melempar 404.
        $section = Section::where('slug', $slug)->firstOrFail();

        // Ambil semua konten yang terhubung dengan section ini.
        // Variabel yang dikirim ke view sekarang adalah $contents (plural dari Content)
        $contents = Content::where('section_id', $section->id)->get();

        // Daftar slug section yang akan menggunakan blade custom (desain khusus)
        // Pastikan slug di sini sama persis dengan yang ada di database (misal 'makanan' bukan 'kuliner-makanan')
        $customSections = [
            'arsitektur',
            'budaya',
            'makanan', // Contoh: Sesuaikan dengan slug 'makanan' di DB
            'pariwisata',
            'tempat-ibadah',
            'tokoh',
            'situs-kota-lama',
            'pemerintahan',
        ];

        // Cek apakah slug section saat ini ada di daftar customSections
        if (in_array($section->slug, $customSections)) {
            // Jika section memiliki blade khusus, load blade itu
            // Contoh: untuk slug 'makanan', akan meload 'pengunjung.sections.makanan'
            // Variabel yang dikirim adalah $section (objek Section) dan $contents (kumpulan objek Content)
            return view('pengunjung.sections.' . $section->slug, compact('section', 'contents'));
        } else {
            // Jika section adalah yang baru dibuat admin dan tidak ada di daftar customSections, load blade default
            // Variabel yang dikirim adalah $section dan $contents
            return view('pengunjung.sections.default', compact('section', 'contents'));
        }
    }

    /**
     * Menampilkan detail satu konten secara penuh.
     * Menggunakan slug konten untuk identifikasi.
     */
    public function showKonten($slug_konten)
    {
        // Cari konten berdasarkan slug. Jika tidak ditemukan, otomatis Laravel akan melempar 404.
        // Variabel yang dikirim ke view sekarang adalah $content (singular dari Content)
        $content = Content::where('slug', $slug_konten)->firstOrFail();

        // Mengirim data $content ke view 'pengunjung.detail_konten'
        return view('pengunjung.detail_konten', compact('content'));
    }
}