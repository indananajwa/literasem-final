<?php

namespace App\Http\Controllers;

use App\Models\Tokoh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TokohController extends Controller
{
    /**
     * Tampilkan daftar tokoh untuk admin.
     */
    public function index()
    {
        $tokoh = Tokoh::all();
        return view('content-manage.tokoh', compact('tokoh'));
    }

    /**
     * Tampilkan total tokoh untuk admin.
     */
    public function getTotal()
    {
        $totalTokoh = Tokoh::count();

        return view('welcome', compact('totalTokoh'));
    }

    /**
     * Tampilkan daftar tokoh untuk pengunjung.
     */
    public function listForVisitors()
    {
        $tokoh = Tokoh::all();
        return view('pengunjung.figure', compact('tokoh'));
    }

    /**
     * Menampilkan form tambah tokoh.
     */
    public function create()
    {
        return view('content-manage.tokoh-create');
    }

    /**
     * Menyimpan tokoh baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_tokoh' => 'required|string|max:255',
            'deskripsi_tokoh' => 'required|string',
            'image_tokoh' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        if ($request->hasFile('image_tokoh')) {
            $imagePath = $request->file('image_tokoh')->store('foods', 'public');
        }
    
        $tokoh = new Tokoh();
        $tokoh->nama_tokoh = $validated['nama_tokoh'];
        $tokoh->deskripsi_tokoh = $validated['deskripsi_tokoh'];
        $tokoh->image_tokoh = $imagePath;
        $tokoh->save();
    
        return redirect('/tokoh')->with('success', 'Content added successfully!');
    }

    /**
     * Menampilkan form edit tokoh.
     */
    public function edit(string $id)
    {
        $tokoh = Tokoh::findOrFail($id);
        return view('content-manage.tokoh-edit', compact('tokoh'));
    }

    /**
     * Update data tokoh di database.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_tokoh' => 'required|string|max:255',
            'deskripsi_tokoh' => 'required|string',
            'image_tokoh' => 'nullable|image|mimes:jpeg,png,jpg,gif,pdf|max:2048',
        ]);
        
        $tokoh = Tokoh::findOrFail($id);
        
        if ($request->hasFile('image_tokoh')) {
            if (Storage::exists('public/' . $tokoh->image_tokoh)) {
                Storage::delete('public/' . $tokoh->image_tokoh);
            }
            $imagePath = $request->file('image_tokoh')->store('figure', 'public');
            $tokoh->image_tokoh = $imagePath;
        }

        $tokoh->nama_tokoh = $request->nama_tokoh;
        $tokoh->deskripsi_tokoh = $request->deskripsi_tokoh;
        $tokoh->save();

        return redirect('/tokoh')->with('success', 'Content updated successfully!');
    }

    /**
     * Hapus tokoh dari database.
     */
    public function destroy(string $id)
    {
        $tokoh = Tokoh::findOrFail($id);
        
        if (Storage::exists('public/' . $tokoh->image_tokoh)) {
            Storage::delete('public/' . $tokoh->image_tokoh);
        }
        
        $tokoh->delete();
        return redirect('/tokoh')->with('success', 'Content deleted successfully!');
    }
}