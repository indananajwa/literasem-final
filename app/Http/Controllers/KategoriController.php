<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kategori;
use App\Models\Pariwisata;
use App\Models\Pemerintah;

class KategoriController extends Controller
{
    public function index()
{
    $kategoris = Kategori::all();
    $pariwisataList = Pariwisata::all();
    $pemerintahList = Pemerintah::all();

    return view('admin.manajemen_konten', compact('kategoris', 'pariwisataList', 'pemerintahList'));
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
        'judul_kategori' => 'required|string|max:32',
        'deskripsi_kategori' => 'required|string',
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
        'judul_kategori' => $request->judul_kategori,
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
        'judul_kategori' => 'required|string|max:32',
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
        'judul_kategori' => $request->judul_kategori,
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

// public function show($kode)
// {
//     $kategori = DB::table('kategori')->where('kode_kategori', $kode)->first();
//     return view('admin.kategori.show', ['kategori' => $kategori]);
// }

public function show($kodeKategori)
    {
        try {
            $kategori = DB::table('kategori')
                ->where('kode_kategori', strtoupper($kodeKategori))
                ->first();

            Log::info('KategoriController Debug', [
                'kode_kategori_input' => $kodeKategori,
                'kode_kategori_upper' => strtoupper($kodeKategori),
                'kategori_found' => $kategori ? true : false,
            ]);

        } catch (\Exception $e) {
            Log::error('Database Error in KategoriController: ' . $e->getMessage());
            abort(500, 'Database connection error');
        }

        if (!$kategori) {
            abort(404, 'Kategori tidak ditemukan');
        }

        $kontenList = DB::table('konten')
            ->where('kode_kategori', strtoupper($kodeKategori))
            ->orderBy('kode_konten')
            ->get();

        Log::info('Konten Data Debug', [
            'kategori_code' => $kategori->kode_kategori,
            'konten_count' => $kontenList->count(),
        ]);

        // Fix: Ensure fieldRules is always an array
        $fieldRules = [];
        if (!empty($kategori->field_rules)) {
            $decodedRules = json_decode($kategori->field_rules, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decodedRules)) {
                $fieldRules = $decodedRules;
            }
        }

        // Buat array yang akan dikirim ke JavaScript
        $tourData = $kontenList->map(function ($item) {
            return [
                'id' => $item->kode_konten,
                'name' => $item->judul,
                'images' => $item->gambar ? [route('konten.image', $item->kode_konten)] : [],
                'video' => $item->video_url,
                'description' => $item->deskripsi
            ];
        });

        // FIX: Create safe versions for JavaScript without breaking existing template
        $kategoriForJS = [
            'kode_kategori' => $kategori->kode_kategori,
            'nama_kategori' => $kategori->nama_kategori,
            'judul_kategori' => $kategori->judul_kategori,
            'deskripsi_kategori' => $kategori->deskripsi_kategori,
            'field_rules' => $kategori->field_rules,
        ];

        $tourDataForJS = $tourData->toArray();

        return view('pengunjung.kategori.page1', compact('kategori', 'kontenList', 'fieldRules', 'tourData', 'kategoriForJS', 'tourDataForJS'));
    }

    /**
     * Menampilkan gambar kategori cover
     */
    public function showCoverImage($kodeKategori)
    {
        $kategori = DB::table('kategori')
            ->where('kode_kategori', strtoupper($kodeKategori))
            ->first();
            
        if (!$kategori || !$kategori->gambar_cover) {
            abort(404);
        }
        
        return response($kategori->gambar_cover)
            ->header('Content-Type', $kategori->mime_type ?? 'image/jpeg');
    }
    
    /**
     * Menampilkan gambar konten
     */
    public function showKontenImage($kodeKonten)
    {
        $konten = DB::table('konten')
            ->where('kode_konten', $kodeKonten)
            ->first();
            
        if (!$konten || !$konten->gambar) {
            abort(404);
        }
        
        return response($konten->gambar)
            ->header('Content-Type', $konten->mime_type ?? 'image/jpeg');
    }
    
    /**
     * API untuk search konten dalam kategori
     */
    public function searchKonten(Request $request, $kodeKategori)
    {
        $query = $request->get('q', '');
        
        $kontenList = DB::table('konten')
            ->where('kode_kategori', strtoupper($kodeKategori))
            ->where(function($q) use ($query) {
                $q->where('judul', 'LIKE', "%{$query}%")
                  ->orWhere('deskripsi', 'LIKE', "%{$query}%");
            })
            ->orderBy('kode_konten')
            ->get();
            
        return response()->json($kontenList);
    }
}
