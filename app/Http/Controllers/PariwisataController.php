<?php

namespace App\Http\Controllers;

use App\Models\Pariwisata;
use Illuminate\Http\Request;

class PariwisataController extends Controller
{
    public function index()
    {
        $pariwisata = Pariwisata::all();
        return view('pengunjung.sections.pariwisata', compact('pariwisata'));
    }

    public function create()
    {
        return view('admin.pariwisata.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'lokasi' => 'required|url', // Validasi link
            'foto' => 'nullable|image',
        ]);

        $fotoPath = $request->file('foto') ? $request->file('foto')->store('public/foto_pariwisata') : null;

        Pariwisata::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('pariwisata.index');
    }

    public function edit($id)
    {
        $pariwisata = Pariwisata::findOrFail($id);
        return view('admin.pariwisata.edit', compact('pariwisata'));
    }

    public function update(Request $request, $id)
    {
        $pariwisata = Pariwisata::findOrFail($id);
        
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'lokasi' => 'required|url',
            'foto' => 'nullable|image',
        ]);

        $fotoPath = $request->file('foto') ? $request->file('foto')->store('public/foto_pariwisata') : $pariwisata->foto;

        $pariwisata->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('pariwisata.index');
    }

    public function destroy($id)
    {
        $pariwisata = Pariwisata::findOrFail($id);
        $pariwisata->delete();

        return redirect()->route('pariwisata.index');
    }
}

