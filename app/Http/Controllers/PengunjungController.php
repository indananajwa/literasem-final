<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Konten;

class PengunjungController extends Controller
{
    /**
     * Menampilkan halaman utama atau daftar semua Kategori untuk pengunjung.
     */
    public function index()
    {
        // Ambil semua Kategori dari database
        $kategoris = Kategori::all();

        // Mengirim data Kategoris ke view 'pengunjung.homepage'
        return view('pengunjung.homepage', compact('kategoris'));
    }

    /**
     * Menampilkan detail sebuah kategori dan konten-konten di dalamnya.
     */
    public function showKategori()
    {
        // Ambil salah satu kategori sebagai default (misal yang pertama)
        $kategori = Kategori::firstOrFail();

        // Ambil semua konten terkait kategori
        $kontens = Konten::where('kode_kategori', $kategori->kode_kategori)->get();

        // Cek apakah kategori ini pakai blade custom
        $customKategoris = [
            'arsitektur',
            'budaya',
            'makanan',
            'pariwisata',
            'tempat-ibadah',
            'tokoh',
            'situs-kota-lama',
            'pemerintahan',
        ];

        // Jika slug-nya masuk daftar kategori custom, arahkan ke tampilan custom
        if (in_array($kategori->slug, $customKategoris)) {
            return view('pengunjung.kategori.custom', compact('kategori', 'kontens'));
        }

        // Kalau bukan kategori custom, tampilkan berdasarkan 'tampilan'
        $tampilan = $kategori->tampilan ?? null;

        $viewName = match ($tampilan) {
            1 => 'pengunjung.default.default_1',
            2 => 'pengunjung.default.default_2',
            default => 'pengunjung.default.default_1',
        };

        return view($viewName, compact('kategori', 'kontens'));
    }

    /**
     * Menampilkan detail satu konten secara penuh.
     */
    public function showKonten($slug_konten)
    {
        // Cari konten berdasarkan slug
        $konten = Konten::where('slug', $slug_konten)->firstOrFail();

        // Kirim ke view detail
        return view('pengunjung.detail_konten', compact('konten'));
    }
}
