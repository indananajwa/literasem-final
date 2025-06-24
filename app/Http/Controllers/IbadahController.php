<?php

namespace App\Http\Controllers;

use App\Models\Ibadah;
use Illuminate\Http\Request;

class IbadahController extends Controller
{
    public function index()
    {
        $ibadah = Ibadah::all();
        return view('pengunjung.sections.ibadah', compact('ibadah'));
    }

    public function create()
    {
        return view('admin.ibadah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'foto' => 'nullable|image',
        ]);

        $fotoPath = $request->file('foto') ? $request->file('foto')->store('public/foto_ibadah') : null;

        Ibadah::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('ibadah.index');
    }

    public function edit($id)
    {
        $ibadah = Ibadah::findOrFail($id);
        return view('admin.ibadah.edit', compact('ibadah'));
    }

    public function update(Request $request, $id)
    {
        $ibadah = Ibadah::findOrFail($id);
        
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'foto' => 'nullable|image',
        ]);

        $fotoPath = $request->file('foto') ? $request->file('foto')->store('public/foto_ibadah') : $ibadah->foto;

        $ibadah->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('ibadah.index');
    }

    public function destroy($id)
    {
        $ibadah = Ibadah::findOrFail($id);
        $ibadah->delete();

        return redirect()->route('ibadah.index');
    }
}

