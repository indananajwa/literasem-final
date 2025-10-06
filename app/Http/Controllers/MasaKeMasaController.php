<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasaKeMasaController extends Controller
{
    public function index()
    {
        // Ambil data masa lalu, urutkan berdasarkan tahun
        $masaLalu = DB::table('smgMasaLalu')
            ->orderBy('tahun_sebelum')
            ->get();

        // Ambil data masa depan
        $masaDepan = DB::table('smgMasaDepan')
            ->get();

        return view('pengunjung.masa-ke-masa', compact('masaLalu', 'masaDepan'));
    }

    // Method untuk menampilkan gambar dari BLOB
    public function getImage($kode, $type)
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