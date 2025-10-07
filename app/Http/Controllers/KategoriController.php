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
            // ✅ Validasi utama
            $validated = $request->validate([
                'nama_kategori' => 'required|string|max:32',
                'kode_kategori' => 'required|string|max:3|unique:kategori,kode_kategori',
                'judul_kategori' => 'required|string|max:64',
                'deskripsi_kategori' => 'required|string',
                'gambar_cover' => 'required|image|max:10240',
                'field_rules' => 'nullable|array',
                'use_video_sampul' => 'required|in:0,1',
            ]);

            // ✅ Jika video sampul digunakan, lakukan validasi tambahan
            if ($request->input('use_video_sampul') == '1') {
                $request->validate([
                    'video_sampul.title' => 'required|string|max:255',
                    'video_sampul.description' => 'required|string',
                    'video_sampul.youtube_id' => 'required|string|max:50',
                ]);
            }

            // ✅ Handle upload gambar cover
            $gambar = null;
            $mimeType = null;
            if ($request->hasFile('gambar_cover')) {
                $file = $request->file('gambar_cover');
                $gambar = file_get_contents($file->getRealPath());
                $mimeType = $file->getMimeType();
            }

            // ✅ Susun field_rules dengan default agar aman (biar sama kayak update)
            $fieldRules = [
                'tampilan' => $request->input('field_rules.tampilan', '0'),
                'sampulvideo' => $request->input('use_video_sampul') == '1' ? 'required' : 'not_used',
                'highlight' => $request->input('field_rules.highlight', 'not_used'),
                'judul' => $request->input('field_rules.judul', 'required'),
                'deskripsi' => $request->input('field_rules.deskripsi', 'required'),
                'gambar' => $request->input('field_rules.gambar', 'required'),
                'video_url' => $request->input('field_rules.video_url', 'optional'),
            ];

            // ✅ Susun video_sampul (hanya jika digunakan)
            $videoSampul = null;
            if ($request->input('use_video_sampul') == '1' && $request->has('video_sampul')) {
                $videoData = $request->input('video_sampul');
                $videoSampul = [[
                    'title' => $videoData['title'],
                    'description' => $videoData['description'],
                    'youtube_id' => $videoData['youtube_id'],
                ]];
            }

            // ✅ Simpan ke database
            Kategori::create([
                'kode_kategori' => strtoupper($validated['kode_kategori']),
                'nama_kategori' => $validated['nama_kategori'],
                'judul_kategori' => $validated['judul_kategori'],
                'deskripsi_kategori' => $validated['deskripsi_kategori'],
                'gambar_cover' => $gambar,
                'mime_type' => $mimeType,
                'field_rules' => $fieldRules,
                'video_sampul' => $videoSampul,
            ]);

            return redirect()->route('admin.kategori.index')
                             ->with('success', 'Kategori baru berhasil ditambahkan!');
        } 
        catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                             ->withErrors($e->validator)
                             ->withInput();
        } 
        catch (\Exception $e) {
            \Log::error('Error saat menambah kategori: ' . $e->getMessage());
            return redirect()->back()
                             ->with('error', 'Terjadi kesalahan saat menyimpan kategori.')
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

        // Decode field_rules dengan default values
        $fieldRules = [
            'tampilan' => '0',
            'sampulvideo' => 'not_used',
            'highlight' => 'not_used',
            'judul' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required',
            'video_url' => 'optional'
        ];
        
        if (!empty($kategori->field_rules)) {
            $decodedRules = json_decode($kategori->field_rules, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decodedRules)) {
                $fieldRules = array_merge($fieldRules, $decodedRules);
            }
        }

        Log::info('Field Rules Debug', [
            'raw_field_rules' => $kategori->field_rules,
            'decoded_field_rules' => $fieldRules,
            'tampilan_value' => $fieldRules['tampilan'],
            'highlight_value' => $fieldRules['highlight'],
            'sampulvideo_value' => $fieldRules['sampulvideo'],
        ]);

        // Decode video_sampul
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
public function update(Request $request, $kode_kategori)
{
    try {
        $kategori = Kategori::where('kode_kategori', $kode_kategori)->firstOrFail();
    
        // Validasi dasar
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:32',
            'judul_kategori' => 'required|string|max:64',
            'deskripsi_kategori' => 'required|string',
            'gambar_cover' => 'nullable|image|max:10240',
            'field_rules' => 'required|array',
            'use_video_sampul' => 'required|in:0,1',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi',
            'judul_kategori.required' => 'Judul kategori wajib diisi',
            'deskripsi_kategori.required' => 'Deskripsi wajib diisi',
            'field_rules.required' => 'Aturan field wajib dipilih',
            'use_video_sampul.required' => 'Opsi video sampul wajib dipilih',
            'gambar_cover.image' => 'File harus berupa gambar',
            'gambar_cover.max' => 'Ukuran gambar maksimal 10MB'
        ]);

        // Validasi video sampul jika diperlukan
        if ($request->input('use_video_sampul') == '1') {
            $request->validate([
                'video_sampul.title' => 'required|string|max:255',
                'video_sampul.description' => 'required|string',
                'video_sampul.youtube_id' => 'required|string|max:50'
            ], [
                'video_sampul.title.required' => 'Judul video wajib diisi',
                'video_sampul.description.required' => 'Deskripsi video wajib diisi',
                'video_sampul.youtube_id.required' => 'Link YouTube wajib diisi'
            ]);
        }
    
        // Handle gambar baru jika diupload
        $gambar = $kategori->gambar_cover;
        $mimeType = $kategori->mime_type;
    
        if ($request->hasFile('gambar_cover')) {
            $file = $request->file('gambar_cover');
            $gambar = file_get_contents($file->getRealPath());
            $mimeType = $file->getMimeType();
        }
    
        // Susun field_rules yang diperbarui
        $fieldRules = [
            'tampilan' => $validated['field_rules']['tampilan'] ?? ($kategori->field_rules['tampilan'] ?? '0'),
            'sampulvideo' => $request->input('use_video_sampul') == '1' ? 'required' : 'not_used',
            'highlight' => $validated['field_rules']['highlight'] ?? ($kategori->field_rules['highlight'] ?? 'not_used'),
            'judul' => $validated['field_rules']['judul'] ?? ($kategori->field_rules['judul'] ?? 'required'),
            'deskripsi' => $validated['field_rules']['deskripsi'] ?? ($kategori->field_rules['deskripsi'] ?? 'required'),
            'gambar' => $validated['field_rules']['gambar'] ?? ($kategori->field_rules['gambar'] ?? 'required'),
            'video_url' => $validated['field_rules']['video_url'] ?? ($kategori->field_rules['video_url'] ?? 'optional')
        ];
    
        // Proses video sampul
        $videoSampul = $kategori->video_sampul;
        if ($request->input('use_video_sampul') == '1' && $request->has('video_sampul')) {
            $videoData = $request->input('video_sampul');
            
            // Buat array dengan satu video saja (untuk edit form yang single video)
            $videoSampul = [[
                'title' => $videoData['title'],
                'description' => $videoData['description'],
                'youtube_id' => $videoData['youtube_id']
            ]];
        }
    
        // Update data ke database
        $kategori->update([
            'nama_kategori' => $validated['nama_kategori'],
            'judul_kategori' => $validated['judul_kategori'],
            'deskripsi_kategori' => $validated['deskripsi_kategori'],
            'gambar_cover' => $gambar,
            'mime_type' => $mimeType,
            'field_rules' => $fieldRules,
            'video_sampul' => $videoSampul,
        ]);
    
        return redirect()->route('admin.kategori.index')
                         ->with('success', 'Kategori berhasil diperbarui!');
    
    } catch (\Illuminate\Validation\ValidationException $e) {
        return redirect()->back()
                         ->withErrors($e->validator)
                         ->withInput();
    
    } catch (\Exception $e) {
        Log::error('Error saat memperbarui kategori: ' . $e->getMessage());
    
        return redirect()->back()
                         ->with('error', 'Terjadi kesalahan saat memperbarui data. Silakan coba lagi.')
                         ->withInput();
    }
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
    
        return response()->file(public_path('images/no-image.png'));
    }
}