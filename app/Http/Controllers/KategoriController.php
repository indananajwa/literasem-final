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
    /**
     * Tampilkan semua kategori.
     */
    public function index()
    {
        $pariwisataList = Pariwisata::all();
        $pemerintahList = Pemerintah::all();
        $kategori = Kategori::all();

        $kategoris = Kategori::withCount('konten')->get();
        $pariwisataCount = Pariwisata::count();
        $pemerintahCount = Pemerintah::count();

        return view('admin.kategori.index', compact(
            'kategoris',
            'pariwisataList',
            'pemerintahList',
            'pariwisataCount',
            'pemerintahCount'
        ));
        
    }

    /**
     * Form buat tambah kategori.
     */
    public function create()
    {
        return view('admin.kategori.create');
    }

    /**
     * Simpan kategori baru.
     */
    public function store(Request $request)
{
    try {
        // Validasi dengan pesan custom
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'kode_kategori' => 'required|string|max:3|unique:kategori,kode_kategori',
            'judul_kategori' => 'required|string|max:255',
            'deskripsi_kategori' => 'required|string',
            'gambar_cover' => 'required|image|max:10240',
            'field_rules' => 'required|array'
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi',
            'kode_kategori.required' => 'Kode kategori wajib diisi',
            'kode_kategori.unique' => 'Kode kategori sudah digunakan',
            'judul_kategori.required' => 'Judul kategori wajib diisi',
            'deskripsi_kategori.required' => 'Deskripsi wajib diisi',
            'gambar_cover.required' => 'Gambar cover wajib diupload',
            'gambar_cover.image' => 'File harus berupa gambar',
            'gambar_cover.max' => 'Ukuran gambar maksimal 10MB',
            'field_rules.required' => 'Aturan field wajib dipilih'
        ]);

        // Proses gambar cover
        $gambar = null;
        $mimeType = null;
        
        if ($request->hasFile('gambar_cover')) {
            $file = $request->file('gambar_cover');
            $gambar = file_get_contents($file->getRealPath());
            $mimeType = $file->getMimeType();
        }

        // Simpan ke database
        Kategori::create([
            'kode_kategori' => strtoupper($validated['kode_kategori']),
            'nama_kategori' => $validated['nama_kategori'],
            'judul_kategori' => $validated['judul_kategori'],
            'deskripsi_kategori' => $validated['deskripsi_kategori'],
            'gambar_cover' => $gambar,
            'mime_type' => $mimeType,
            'field_rules' => $validated['field_rules']
        ]);

        return redirect()->route('admin.kategori.index')
                         ->with('success', 'Kategori berhasil ditambahkan!');

    } catch (\Illuminate\Validation\ValidationException $e) {
        // Error validasi - redirect back dengan error
        return redirect()->back()
                         ->withErrors($e->validator)
                         ->withInput();
                         
    } catch (\Exception $e) {
        // Error umum (database, dll)
        Log::error('Error saat menyimpan kategori: ' . $e->getMessage());
        
        return redirect()->back()
                         ->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.')
                         ->withInput();
    }
}

    /**
     * Tampilkan detail kategori.
     */
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

        Log::info('Field Rules Debug', [
            'raw_field_rules' => $kategori->field_rules,
            'decoded_field_rules' => $fieldRules,
            'tampilan_value' => $fieldRules['tampilan'] ?? 'not_set',
            'tampilan_type' => gettype($fieldRules['tampilan'] ?? null),
        ]);

        $video_sampul = [];
        if (!empty($kategori->video_sampul)) {
            $decodedVideos = json_decode($kategori->video_sampul, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decodedVideos)) {
                $video_sampul = $decodedVideos;
            }
        }

        $tourData = $kontenList->map(function ($item) {
            return [
                'id' => $item->kode_konten,
                'name' => $item->judul,
                'images' => $item->gambar ? [route('konten.image', $item->kode_konten)] : [],
                'video' => $item->video_url,
                'description' => $item->deskripsi
            ];
        });

        $kategoriForJS = [
            'kode_kategori' => $kategori->kode_kategori,
            'nama_kategori' => $kategori->nama_kategori,
            'judul_kategori' => $kategori->judul_kategori,
            'deskripsi_kategori' => $kategori->deskripsi_kategori,
            'field_rules' => $kategori->field_rules,
            'video_sampul' => $kategori->video_sampul
        ];

        $tourDataForJS = $tourData->toArray();

        // tambahkan $video_sampul ke compact()
        return view('pengunjung.kategori.page1', compact(
            'kategori',
            'kontenList',
            'fieldRules',
            'tourData',
            'kategoriForJS',
            'tourDataForJS',
            'video_sampul'
        ));
    }



    /**
     * Form edit kategori.
     */
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Update kategori.
     */
    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi_kategori' => 'nullable|string',
            'gambar_cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'field_rules' => 'nullable|array',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar_cover')) {
            $file = $request->file('gambar_cover');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/kategori'), $filename);
            $data['gambar_cover'] = $filename;
        }

        if (isset($data['field_rules'])) {
            $data['field_rules'] = json_encode($data['field_rules']);
        }

        $kategori->update($data);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui');
    }

    /**
     * Hapus kategori.
     */
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus');
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
    public function cover($kodeKategori)
    {
        $kategori = Kategori::where('kode_kategori', strtoupper($kodeKategori))->first();
    
        if ($kategori && $kategori->gambar_cover) {
            return response($kategori->gambar_cover)
                ->header('Content-Type', $kategori->mime_type ?? 'image/jpeg');
        }
    
        // fallback kalau nggak ada gambar
        return response()->file(public_path('images/no-image.png'));
    }
    

}
