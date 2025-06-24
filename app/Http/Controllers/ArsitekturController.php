<?php

namespace App\Http\Controllers;

use App\Models\Arsitektur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArsitekturController extends Controller
{
    /**
     * Tampilkan daftar arsitektur untuk admin.
     */
    public function index()
    {
        $arsitektur = Arsitektur::all();
        return view('pengunjung.sections.arsitektur', compact('arsitektur'));
    }

    /**
     * Tampilkan total arsitektur untuk admin.
     */
    public function getTotal()
    {
        $totalArsitektur = Arsitektur::count();

        return view('welcome', compact('totalArsitektur'));
    }

    /**
     * Tampilkan daftar arsitektur untuk pengunjung.
     */
    public function listForVisitors()
    {
        $arsitektur = Arsitektur::all();
        return view('pengunjung.sections.arsitektur', compact('arsitektur'));
    }

    /**
     * Menampilkan form tambah arsitektur.
     */
    public function create()
    {
        return view('pengunjung.sections.arsitektur-create');
    }

    /**
     * Menyimpan arsitektur baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_arsitektur' => 'required|string|max:255',
            'deskripsi_arsitektur' => 'required|string',
            'image_arsitektur' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        if ($request->hasFile('image_arsitektur')) {
            $imagePath = $request->file('image_arsitektur')->store('architecture', 'public');
        }
    
        $arsitektur = new Arsitektur();
        $arsitektur->nama_arsitektur = $validated['nama_arsitektur'];
        $arsitektur->deskripsi_arsitektur = $validated['deskripsi_arsitektur'];
        $arsitektur->image_arsitektur = $imagePath;
        $arsitektur->save();
    
        return redirect('/arsitektur')->with('success', 'Content added successfully!');
    }

    /**
     * Menampilkan form edit arsitektur.
     */
    public function edit(string $id)
    {
        $arsitektur = Arsitektur::findOrFail($id);
        return view('pengunjung.sections.arsitektur-edit', compact('arsitektur'));
    }

    /**
     * Update data arsitektur di database.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_arsitektur' => 'required|string|max:255',
            'deskripsi_arsitektur' => 'required|string',
            'image_arsitektur' => 'nullable|image|mimes:jpeg,png,jpg,gif,pdf|max:2048',
        ]);
        
        $arsitektur = Arsitektur::findOrFail($id);
        
        if ($request->hasFile('image_arsitektur')) {
            if (Storage::exists('public/' . $arsitektur->image_arsitektur)) {
                Storage::delete('public/' . $arsitektur->image_arsitektur);
            }
            $imagePath = $request->file('image_arsitektur')->store('architecture', 'public');
            $arsitektur->image_arsitektur = $imagePath;
        }

        $arsitektur->nama_arsitektur = $request->nama_arsitektur;
        $arsitektur->deskripsi_arsitektur = $request->deskripsi_arsitektur;
        $arsitektur->save();

        return redirect('/arsitektur')->with('success', 'Content updated successfully!');
    }

    /**
     * Hapus arsitektur dari database.
     */
    public function destroy(string $id)
    {
        $arsitektur = Arsitektur::findOrFail($id);
        
        if (Storage::exists('public/' . $arsitektur->image_arsitektur)) {
            Storage::delete('public/' . $arsitektur->image_arsitektur);
        }
        
        $arsitektur->delete();
        return redirect('/arsitektur')->with('success', 'Content deleted successfully!');
    }
}