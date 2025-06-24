<?php

namespace App\Http\Controllers;

use App\Models\Pemerintah;
use Illuminate\Http\Request;

class PemerintahController extends Controller
{
    public function index()
    {
        $pemerintah = Pemerintah::all();
        return view('pengunjung.sections.pemerintah', compact('pemerintah'));
    }

    public function create()
    {
        return view('admin.pemerintah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'tahun_awal' => 'required', 
            'tahun_akhir' => 'nullable', 
            'foto' => 'nullable|image',
        ]);

        $fotoPath = $request->file('foto') ? $request->file('foto')->store('public/foto_pemerintah') : null;

        Pemerintah::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'tahun_awal' => $request->tahun_awal,
            'tahun_akhir' => $request->tahun_akhir,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('pemerintah.index');
    }

    public function edit($id)
    {
        $pemerintah = Pemerintah::findOrFail($id);
        return view('admin.pemerintah.edit', compact('pemerintah'));
    }

    public function update(Request $request, $id)
    {
        $pemerintah = Pemerintah::findOrFail($id);
        
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'tahun_awal' => 'required', 
            'tahun_akhir' => 'nullable', 
            'foto' => 'nullable|image',
        ]);

        $fotoPath = $request->file('foto') ? $request->file('foto')->store('public/foto_pemerintah') : $pemerintah->foto;

        $pemerintah->update([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'tahun_awal' => $request->tahun_awal,
            'tahun_akhir' => $request->tahun_akhir,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('pemerintah.index');
    }

    public function destroy($id)
    {
        $pemerintah = Pemerintah::findOrFail($id);
        $pemerintah->delete();

        return redirect()->route('pemerintah.index');
    }
}

