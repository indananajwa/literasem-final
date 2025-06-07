<?php

namespace App\Http\Controllers;

use App\Models\Section;  // Pastikan ini ada
use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{

    public function index($sectionId)
{
    $section = Section::findOrFail($sectionId);
    $fieldRules = json_decode($section->field_rules, true);
    $contents = Content::where('section_id', $sectionId)->get();
    $sections = Section::all(); // ← TAMBAHKAN INI

    return view('admin.contents.index', compact('section', 'contents', 'fieldRules', 'sections'));
}

public function create($sectionId)
{
    $section = Section::findOrFail($sectionId);
    $fieldRules = json_decode($section->field_rules, true);
    $contents = Content::where('section_id', $sectionId)->get();
    $sections = Section::all(); // ← TAMBAHKAN INI

    return view('admin.contents.create', compact('section', 'fieldRules', 'contents', 'sections'));
}

public function store(Request $request, $sectionId)
{
    $section = Section::findOrFail($sectionId);
    $fieldRules = json_decode($section->field_rules, true);

    // Ambil hanya field yang digunakan
    $data = $request->only(array_keys(array_filter($fieldRules, function ($rule) {
        return $rule !== 'not_used';
    })));

    // Simpan konten
    Content::create($data + ['section_id' => $section->id]);

    return redirect()->back()->with('success', 'Konten berhasil ditambahkan!');
}

public function edit($id)
{
    $content = Content::findOrFail($id);
    $section = $content->section;

    // fieldRules dari section, sudah array karena casting
    $fieldRules = $section->field_rules ?? [];

    return view('admin.contents.edit', compact('content', 'section', 'fieldRules'));
}

public function destroy($id)
{
    $content = Content::findOrFail($id);
    $content->delete(); // Hapus data

    return redirect()->back()->with('success', 'Konten berhasil dihapus!');
}
}

