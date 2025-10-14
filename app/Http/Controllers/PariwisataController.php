<?php

namespace App\Http\Controllers;

use App\Models\Pariwisata;
use Illuminate\Http\Request;

class PariwisataController extends Controller
{
    // Halaman untuk pengunjung
    public function index()
    {
        $data = Pariwisata::all();
        $highlight = Pariwisata::limit(5)->get();
        return view('pengunjung.pariwisata', compact('data', 'highlight'));
    }

    // Halaman admin
    public function adminView()
    {
        $pariwisataList = Pariwisata::all();
        return view('admin.konten.tampilan_pariwisata', compact('pariwisataList'));
    }

    // Tambah konten pariwisata
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:64',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|max:2048', // Max 2MB
            'url_maps' => 'nullable|url',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
        ]);

        $data = $request->only(['nama', 'deskripsi', 'url_maps', 'lat', 'lng']);
        $data['kodePariwisata'] = Pariwisata::generateKodePariwisata();

        if ($request->hasFile('foto')) {
            $data['foto'] = file_get_contents($request->file('foto')->getRealPath());
            $data['mime_type'] = $request->file('foto')->getClientMimeType();
        }

        Pariwisata::create($data);

        return redirect()->route('admin.pariwisata.konten')->with('success', 'Konten berhasil ditambahkan');
    }

    // Update konten pariwisata via modal edit
    public function update(Request $request, $kodePariwisata)
    {
        $item = Pariwisata::where('kodePariwisata', $kodePariwisata)->firstOrFail();

        $request->validate([
            'nama' => 'required|string|max:64',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|max:2048',
            'url_maps' => 'nullable|url',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
        ]);

        $data = $request->only(['nama', 'deskripsi', 'url_maps', 'lat', 'lng']);

        if ($request->hasFile('foto')) {
            $data['foto'] = file_get_contents($request->file('foto')->getRealPath());
            $data['mime_type'] = $request->file('foto')->getClientMimeType();
        }

        $item->update($data);

        return redirect()->route('admin.pariwisata.konten')->with('success', 'Konten berhasil diperbarui');
    }

    // Hapus konten pariwisata
    public function destroy($kodePariwisata)
    {
        $item = Pariwisata::where('kodePariwisata', $kodePariwisata)->firstOrFail();
        $item->delete();

        return redirect()->route('admin.pariwisata.konten')->with('success', 'Konten berhasil dihapus');
    }

    // Gambar untuk frontend
    public function gambar($kodePariwisata)
    {
        $item = Pariwisata::where('kodePariwisata', $kodePariwisata)->firstOrFail();

        if (!$item->foto || !$item->mime_type) {
            abort(404, 'Image not found');
        }

        return response($item->foto)->header('Content-Type', $item->mime_type);
    }
}