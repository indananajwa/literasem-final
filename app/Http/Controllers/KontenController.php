<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Konten;
use Illuminate\Http\Request;

class KontenController extends Controller
{
    private function parseFieldRules($fieldRules)
    {
        if (empty($fieldRules)) {
            return [];
        }

        if (is_array($fieldRules)) {
            return $fieldRules;
        }

        if (is_string($fieldRules)) {
            $decoded = json_decode($fieldRules, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $decoded;
            }
        }

        return [];
    }

    public function index($kodeKategori)
    {
        $kategori   = Kategori::where('kode_kategori', $kodeKategori)->firstOrFail();
        $kontenList = Konten::where('kode_kategori', $kodeKategori)->get();
        $fieldRules = $this->parseFieldRules($kategori->field_rules);
        $kategoris  = Kategori::all();

        return view('admin.konten.index', compact('kategori', 'kontenList', 'fieldRules', 'kategoris'));
    }

    public function store(Request $request, $kodeKategori)
    {
        $kategori   = Kategori::where('kode_kategori', $kodeKategori)->firstOrFail();
        $fieldRules = $this->parseFieldRules($kategori->field_rules);

        // ✅ CEK DUPLIKAT BERDASARKAN JUDUL
        if (isset($fieldRules['judul']) && $fieldRules['judul'] !== 'not_used') {
            $existingKonten = Konten::where('kode_kategori', $kodeKategori)
                ->where('judul', $request->judul)
                ->first();

            if ($existingKonten) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['judul' => 'Konten dengan judul ini sudah ada di kategori ini!']);
            }
        }

        // Build validation rules dynamically
        $validationRules = [];
        foreach ($fieldRules as $field => $rule) {
            $rule = strtolower(trim($rule));
            if ($rule === 'required') {
                if (in_array($field, ['gambar', 'sampulvideo'])) {
                    $validationRules[$field] = 'required|image|max:10240';
                } elseif ($field === 'video_url') {
                    $validationRules[$field] = 'required|url|max:255';
                } elseif ($field === 'highlight') {
                    $validationRules[$field] = 'nullable|in:0,1';
                } else {
                    $validationRules[$field] = 'required|string|max:1000';
                }
            } elseif ($rule === 'optional') {
                if (in_array($field, ['gambar', 'sampulvideo'])) {
                    $validationRules[$field] = 'nullable|image|max:10240';
                } elseif ($field === 'video_url') {
                    $validationRules[$field] = 'nullable|url|max:255';
                } elseif ($field === 'highlight') {
                    $validationRules[$field] = 'nullable|in:0,1';
                } else {
                    $validationRules[$field] = 'nullable|string|max:1000';
                }
            }
        }

        $validated = $request->validate($validationRules);

        // Generate kode konten
        $latestKonten = Konten::where('kode_kategori', $kodeKategori)
            ->orderBy('kode_konten', 'desc')
            ->first();

        $number     = $latestKonten ? (int)substr($latestKonten->kode_konten, strlen($kodeKategori)) + 1 : 1;
        $kodeKonten = $kodeKategori . sprintf("%03d", $number);

        // Prepare data
        $data = [
            'kode_konten'   => $kodeKonten,
            'kode_kategori' => $kodeKategori,
        ];

        // Handle gambar
        if ($request->hasFile('gambar')) {
            $data['gambar']    = file_get_contents($request->file('gambar')->getRealPath());
            $data['mime_type'] = $request->file('gambar')->getMimeType();
        }

        // Handle sampulvideo
        if ($request->hasFile('sampulvideo')) {
            $data['sampulvideo'] = file_get_contents($request->file('sampulvideo')->getRealPath());
        }

        // Handle other fields
        foreach (['judul', 'deskripsi', 'video_url', 'highlight'] as $field) {
            if (isset($validated[$field])) {
                $data[$field] = $validated[$field];
            }
        }

        Konten::create($data);

        return redirect()->route('admin.konten.index', $kodeKategori)
            ->with('success', 'Konten berhasil ditambahkan!');
    }

    public function destroy($kodeKategori, $kodeKonten)
    {
        $konten = Konten::where('kode_konten', $kodeKonten)->firstOrFail();
        $konten->delete();

        return redirect()->route('admin.konten.index', $kodeKategori)
            ->with('success', 'Konten berhasil dihapus!');
    }

        public function tampilanPariwisata()
    {
        return view('admin.konten.tampilan_pariwisata');
    }

    public function tampilanPemerintah()
    {
        return view('admin.konten.tampilan_pemerintah');
    }

    public function edit($kodeKategori, $kodeKonten)
    {
        $kategori   = Kategori::where('kode_kategori', $kodeKategori)->firstOrFail();
        $konten     = Konten::where('kode_konten', $kodeKonten)->firstOrFail();
        $fieldRules = $this->parseFieldRules($kategori->field_rules);

        return view('admin.konten.edit', compact('kategori', 'konten', 'fieldRules'));
    }

    public function update(Request $request, $kodeKategori, $kodeKonten)
    {
        $kategori   = Kategori::where('kode_kategori', $kodeKategori)->firstOrFail();
        $konten     = Konten::where('kode_konten', $kodeKonten)->firstOrFail();
        $fieldRules = $this->parseFieldRules($kategori->field_rules);

        // ✅ CEK DUPLIKAT JUDUL (kecuali konten yang sedang diedit)
        if (isset($fieldRules['judul']) && $fieldRules['judul'] !== 'not_used') {
            $existingKonten = Konten::where('kode_kategori', $kodeKategori)
                ->where('judul', $request->judul)
                ->where('kode_konten', '!=', $kodeKonten)
                ->first();

            if ($existingKonten) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['judul' => 'Konten dengan judul ini sudah ada di kategori ini!']);
            }
        }

        // Build validation rules dynamically
        $validationRules = [];
        foreach ($fieldRules as $field => $rule) {
            $rule = strtolower(trim($rule));
            if ($rule === 'required') {
                if (in_array($field, ['gambar', 'sampulvideo'])) {
                    $validationRules[$field] = 'required|image|max:10240';
                } elseif ($field === 'video_url') {
                    $validationRules[$field] = 'required|url|max:255';
                } elseif ($field === 'highlight') {
                    $validationRules[$field] = 'nullable|in:0,1';
                } else {
                    $validationRules[$field] = 'required|string|max:1000';
                }
            } elseif ($rule === 'optional') {
                if (in_array($field, ['gambar', 'sampulvideo'])) {
                    $validationRules[$field] = 'nullable|image|max:10240';
                } elseif ($field === 'video_url') {
                    $validationRules[$field] = 'nullable|url|max:255';
                } elseif ($field === 'highlight') {
                    $validationRules[$field] = 'nullable|in:0,1';
                } else {
                    $validationRules[$field] = 'nullable|string|max:1000';
                }
            }
        }

        $validated = $request->validate($validationRules);

        // update data
        foreach (['judul', 'deskripsi', 'video_url', 'highlight'] as $field) {
            if (isset($validated[$field])) {
                $konten->$field = $validated[$field];
            }
        }

        if ($request->hasFile('gambar')) {
            $konten->gambar    = file_get_contents($request->file('gambar')->getRealPath());
            $konten->mime_type = $request->file('gambar')->getMimeType();
        }

        if ($request->hasFile('sampulvideo')) {
            $konten->sampulvideo = file_get_contents($request->file('sampulvideo')->getRealPath());
        }

        $konten->save();

        return redirect()->route('admin.konten.index', $kodeKategori)
            ->with('success', 'Konten berhasil diperbarui!');
    }
}