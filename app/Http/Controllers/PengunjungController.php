<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Pemerintah;

class PengunjungController extends Controller
{
    /**
     * Menampilkan halaman utama (index)
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil data pemerintahan untuk ditampilkan di halaman index
        $pemerintahan = Pemerintah::orderBy('periode', 'desc')->get();
        
        // Ambil data masa lalu
        $masaLalu = DB::table('smgMasaLalu')
            ->orderBy('tahun_sebelum')
            ->get();

        // Ambil data masa depan
        $masaDepan = DB::table('smgMasaDepan')
            ->get();
        
        return view('pengunjung.index', compact('pemerintahan', 'masaLalu', 'masaDepan'));
    }

    /**
     * Menampilkan halaman pemerintahan
     *
     * @return \Illuminate\View\View
     */
    public function pemerintahan()
    {
        $pemerintahan = Pemerintah::orderBy('periode', 'desc')->get();
        
        return view('pengunjung.pemerintahan', compact('pemerintahan'));
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

    /**
     * Menampilkan gambar masa lalu dari database (BLOB)
     *
     * @param string $kode
     * @param string $type (sebelum|sesudah)
     * @return \Illuminate\Http\Response
     */
    public function getMasaLaluImage($kode, $type)
    {
        $data = DB::table('smgMasaLalu')
            ->where('kode_lokasi', $kode)
            ->first();

        if (!$data) {
            abort(404);
        }

        if ($type === 'sebelum') {
            $imageData = $data->foto_sebelum;
            $mimeType = $data->mime_type_sebelum;
        } else {
            $imageData = $data->foto_sesudah;
            $mimeType = $data->mime_type_sesudah;
        }

        if (!$imageData) {
            abort(404);
        }

        return response($imageData)
            ->header('Content-Type', $mimeType)
            ->header('Cache-Control', 'public, max-age=31536000');
    }
}