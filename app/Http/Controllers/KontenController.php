<?php

namespace App\Http\Controllers;

use App\Models\Kategori;  // Mengganti Section dengan Kategori
use App\Models\Konten;   // Mengganti Content dengan Konten
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KontenController extends Controller
{
    public function index($kodeKategori)
    {
        $kategori = Kategori::where('kode_kategori', $kodeKategori)->firstOrFail();
        $kontenList = Konten::where('kode_kategori', $kodeKategori)->get();

        $kategoris = Kategori::all();

        // Karena field_rules tidak ada di migrasi baru, kita definisikan field yang diizinkan
        $fieldRules = [
            'judul' => 'required',
            'deskripsi' => 'nullable',
            'video_url' => 'nullable',
            'gambar' => 'nullable',
            'mime_type' => 'nullable'
        ];

        return view('admin.konten.index', compact('kategori', 'kontenList', 'fieldRules', 'kategoris'));
    }

    public function create($kodeKategori)
    {
        $kategori = Kategori::where('kode_kategori', $kodeKategori)->firstOrFail();
        $kontens = Konten::where('kode_kategori', $kodeKategori)->get();
        $kategoris = Kategori::all();

        $fieldRules = [
            'judul' => 'required',
            'deskripsi' => 'nullable',
            'video_url' => 'nullable',
            'gambar' => 'nullable',
            'mime_type' => 'nullable'
        ];

        return view('admin.konten.create', compact('kategori', 'fieldRules', 'konten', 'kategoris'));
    }

    public function store(Request $request, $kodeKategori)
    {
        $kategori = Kategori::where('kode_kategori', $kodeKategori)->firstOrFail();

        // Validasi input
        $validated = $request->validate([
            'judul' => 'required|string|max:64',
            'deskripsi' => 'nullable|string',
            'video_url' => 'nullable|string|max:128',
            'gambar' => 'nullable|image|max:10240', // Maks 10MB
            'mime_type' => 'nullable|string|max:50'
        ]);

        // Generate kode_konten (contoh: BUD1, TOK2, dst)
        $latestKonten = Konten::where('kode_kategori', $kodeKategori)
            ->orderBy('kode_konten', 'desc')
            ->first();
        
        $number = $latestKonten ? (int)substr($latestKonten->kode_konten, 3) + 1 : 1;
        $kodeKonten = $kodeKategori . sprintf("%03d", $number);

        // Handle upload gambar
        $gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = file_get_contents($request->file('gambar')->getRealPath());
            $validated['mime_type'] = $request->file('gambar')->getMimeType();
        }

        // Simpan konten
        Konten::create([
            'kode_konten' => $kodeKonten,
            'kode_kategori' => $kodeKategori,
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'video_url' => $validated['video_url'] ?? null,
            'gambar' => $gambar,
            'mime_type' => $validated['mime_type'] ?? null
        ]);

        return redirect()->back()->with('success', 'Konten berhasil ditambahkan!');
    }

    public function edit($kodeKonten)
    {
        $konten = Konten::where('kode_konten', $kodeKonten)->firstOrFail();
        $kategori = $konten->kategori;

        $fieldRules = [
            'judul' => 'required',
            'deskripsi' => 'nullable',
            'video_url' => 'nullable',
            'gambar' => 'nullable',
            'mime_type' => 'nullable'
        ];

        return view('admin.kontens.edit', compact('konten', 'kategori', 'fieldRules'));
    }

    public function update(Request $request, $kodeKonten)
    {
        $konten = Konten::where('kode_konten', $kodeKonten)->firstOrFail();

        // Validasi input
        $validated = $request->validate([
            'judul' => 'required|string|max:64',
            'deskripsi' => 'nullable|string',
            'video_url' => 'nullable|string|max:128',
            'gambar' => 'nullable|image|max:10240',
            'mime_type' => 'nullable|string|max:50'
        ]);

        // Handle upload gambar
        $gambar = $konten->gambar;
        if ($request->hasFile('gambar')) {
            $gambar = file_get_contents($request->file('gambar')->getRealPath());
            $validated['mime_type'] = $request->file('gambar')->getMimeType();
        }

        // Update konten
        $konten->fill([
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'video_url' => $validated['video_url'] ?? null,
            'gambar' => $gambar,
            'mime_type' => $validated['mime_type'] ?? null
        ]);

        $konten->save();
    }

    public function destroy($kodeKonten)
    {
        $konten = Konten::where('kode_konten', $kodeKonten)->firstOrFail();
        $konten->delete();

        return redirect()->back()->with('success', 'Konten berhasil dihapus!');
    }

}