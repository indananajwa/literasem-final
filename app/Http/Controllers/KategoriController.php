<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
{
    $kategoris = Kategori::all();
    return view('admin.manajemen_konten', compact('kategoris'));
}

public function create()
{
    return view('admin.kategori.create');
}

public function store(Request $request)
{
    $request->validate([
        'kode_kategori' => 'required|size:3|unique:kategori,kode_kategori',
        'nama_kategori' => 'required|string|max:32',
        'deskripsi_kategori' => 'nullable|string',
        'gambar_cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'field_rules' => 'nullable|array',
        'tampilan' => 'nullable|integer|in:1,2',
    ]);

    $gambar = null;
    $mimeType = null;

    if ($request->hasFile('gambar_cover')) {
        $gambar = file_get_contents($request->file('gambar_cover')->getRealPath());
        $mimeType = $request->file('gambar_cover')->getMimeType();
    }

    DB::table('kategori')->insert([
        'kode_kategori' => $request->kode_kategori,
        'nama_kategori' => $request->nama_kategori,
        'deskripsi_kategori' => $request->deskripsi_kategori,
        'gambar_cover' => $gambar,
        'mime_type' => $mimeType,
        'field_rules' => json_encode($request->field_rules),
        'tampilan' => $request->tampilan,
    ]);

    return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan');
}

public function edit($kode)
{
    $kategori = DB::table('kategori')->where('kode_kategori', $kode)->first();
    return view('admin.kategori.edit', ['kategori' => $kategori]);
}

public function update(Request $request, $kode)
{
    $request->validate([
        'nama_kategori' => 'required|string|max:32',
        'deskripsi_kategori' => 'nullable|string',
        'gambar_cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'field_rules' => 'nullable|array',
        'tampilan' => 'nullable|integer|in:1,2',
    ]);

    $kategori = DB::table('kategori')->where('kode_kategori', $kode)->first();

    $gambar = $kategori->gambar_cover;
    $mimeType = $kategori->mime_type;

    if ($request->hasFile('gambar_cover')) {
        $gambar = file_get_contents($request->file('gambar_cover')->getRealPath());
        $mimeType = $request->file('gambar_cover')->getMimeType();
    }

    DB::table('kategori')->where('kode_kategori', $kode)->update([
        'nama_kategori' => $request->nama_kategori,
        'deskripsi_kategori' => $request->deskripsi_kategori,
        'gambar_cover' => $gambar,
        'mime_type' => $mimeType,
        'field_rules' => json_encode($request->field_rules),
        'tampilan' => $request->tampilan,
    ]);

    return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui.');
}

public function destroy($kode)
{
    DB::table('kategori')->where('kode_kategori', $kode)->delete();
    return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus.');
}

public function show($kode)
{
    $kategori = DB::table('kategori')->where('kode_kategori', $kode)->first();
    return view('admin.kategori.show', ['kategori' => $kategori]);
}
}
