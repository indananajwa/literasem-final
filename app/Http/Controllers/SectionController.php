<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::all();
        return view('admin.dashboard', compact('sections'));
    }

    public function create()
    {
        $sections = Section::all(); // jika ingin ditampilkan sebagai referensi
        return view('admin.sections.create', compact('sections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'rule_title' => 'required',
            'rule_description' => 'required',
            'rule_image' => 'required',
            'rule_video_url' => 'required',
        ]);

        $rules = [
            'title' => $request->input('rule_title'),
            'description' => $request->input('rule_description'),
            'image' => $request->input('rule_image'),
            'video_url' => $request->input('rule_video_url'),
        ];
        
        if (collect($rules)->every(fn($v) => $v === 'not_used')) {
            return redirect()->back()->with('error', 'Setidaknya satu field harus digunakan.');
        }
        
        // Tangani gambar
        if ($request->hasFile('gambar_file')) {
            $path = $request->file('gambar_file')->store('images', 'public');
            $data['gambar'] = $path;
        } elseif ($request->gambar_url) {
            $data['gambar'] = $request->gambar_url;
        }

        // Tangani video
        if ($request->hasFile('video_file')) {
            $path = $request->file('video_file')->store('videos', 'public');
            $data['video'] = $path;
        } elseif ($request->video_url) {
            $data['video'] = $request->video_url;
        }

        Section::create([
            'name' => $request->name,
            'field_rules' => json_encode($rules),
        ]);

        return redirect()->back()->with('success', 'Section berhasil ditambahkan!');
    }
    public function destroy($id)
    {
        $section = Section::findOrFail($id);
        $section->delete(); // Hapus data

        return redirect()->back()->with('success', 'Konten berhasil dihapus!');
    }
    // Tampilkan form edit
    public function edit($id)
    {
        $section = Section::findOrFail($id);

        // Decode JSON rules jadi array supaya bisa ditampilkan kembali di radio button
        $fieldRules = json_decode($section->field_rules, true);

        return view('admin.sections.edit', compact('section', 'fieldRules'));
    }

    // Proses update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $section = Section::findOrFail($id);

        $fieldRules = [
            'title' => $request->input('rule_title'),
            'description' => $request->input('rule_description'),
            'image' => $request->input('rule_image'),
            'video_url' => $request->input('rule_video_url'),
        ];

        $section->name = $request->name;
        $section->field_rules = json_encode($fieldRules);
        $section->save();

        return redirect()->route('dashboard')->with('success', 'Section berhasil diperbarui!');
    }

    public function show($id)
    {
        $sections = Section::all();
        $section = Section::findOrFail($id); // cari by ID langsung

        $itemsRaw = $section->items ?? collect(); // pastikan bukan null

        $items = $itemsRaw->map(function ($item) {
            return (object) [
                'title' => $item->nama ?? $item->title ?? 'No Title',
                'description' => $item->deskripsi ?? $item->description ?? '',
                'image' => $item->image ?? $item->image_makanan ?? 'default.jpg',
            ];
        });

        return view('section.detail', [
            'items' => $items,
            'sectionTitle' => $section->name,
            'sectionSubtitle' => 'Kaya Rasa, Sarat Makna',
            'sections' => $sections,
        ]);
    }




    



}
