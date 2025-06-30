<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PengunjungController extends Controller
{
    /**
     * Menampilkan halaman utama (index)
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('pengunjung.index');
    }

    /**
     * Menampilkan halaman pemerintahan
     *
     * @return \Illuminate\View\View
     */
    public function pemerintahan()
    {
        return view('pengunjung.pemerintahan');
    }

    /**
     * Menampilkan halaman masa ke masa
     *
     * @return \Illuminate\View\View
     */
    public function masaKeMasa()
    {
        return view('pengunjung.masa-ke-masa');
    }

    public function situsKotaLama()
    {
        return view('pengunjung.situs-kota-lama');
    }

    public function showKategori($kode_kategori)
    {
        // Fetch category details
        $kategori = DB::table('kategori')
            ->where('kode_kategori', $kode_kategori)
            ->first();

        if (!$kategori) {
            abort(404, 'Kategori tidak ditemukan');
        }

        // Fetch related content for the category
        $konten = DB::table('konten')
            ->where('kode_kategori', $kode_kategori)
            ->get()
            ->map(function ($item) {
                // Convert binary image to base64 if exists
                $item->gambar_base64 = ($item->gambar && $item->mime_type)
                    ? 'data:' . $item->mime_type . ';base64,' . base64_encode($item->gambar)
                    : null;
                return $item;
            });

        // Pre-process tourData for the view
        $tourData = $konten->map(function ($item) {
            return [
                'id' => $item->kode_konten,
                'name' => $item->judul,
                'images' => [$item->gambar_base64],
                'video' => $item->video_url,
                'description' => $item->deskripsi,
            ];
        })->toArray();

        // Log tourData for debugging
        Log::info('tourData for category ' . $kode_kategori, ['tourData' => $tourData]);

        return view('pengunjung.kategori.page1', compact('kategori', 'konten', 'tourData'));
    }


}