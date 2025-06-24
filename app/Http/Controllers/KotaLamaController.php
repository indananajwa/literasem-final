<?php

namespace App\Http\Controllers;

use App\Models\Kotalama;
use Illuminate\Http\Request;

class KotalamaController extends Controller
{
    public function index()
    {
        $kotalama = Kotalama::all();
        return view('pengunjung.sections.kotalama', compact('kotalama'));
    }

    public function create()
    {
        return view('admin.kotalama.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'foto' => 'nullable|image',
        ]);

        $fotoPath = $request->file('foto') ? $request->file('foto')->store('public/foto_kotalama') : null;

        Kotalama::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('kotalama.index');
    }

    public function edit($id)
    {
        $kotalama = Kotalama::findOrFail($id);
        return view('admin.kotalama.edit', compact('kotalama'));
    }

    public function update(Request $request, $id)
    {
        $kotalama = Kotalama::findOrFail($id);
        
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'foto' => 'nullable|image',
        ]);

        $fotoPath = $request->file('foto') ? $request->file('foto')->store('public/foto_kotalama') : $kotalama->foto;

        $kotalama->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('kotalama.index');
    }

    public function destroy($id)
    {
        $kotalama = Kotalama::findOrFail($id);
        $kotalama->delete();

        return redirect()->route('kotalama.index');
    }
}

