<?php

namespace App\Http\Controllers;

use App\Models\Makanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MakananController extends Controller
{
    /**
     * Tampilkan daftar makanan untuk admin.
     */
    public function index()
    {
        $makanan = Makanan::all();
        return view('content-manage.makanan', compact('makanan'));
    }

    /**
     * Tampilkan total makanan untuk admin.
     */
    public function getTotal()
    {
        $totalMakanan = Makanan::count();

        return view('welcome', compact('totalMakanan'));
    }

    /**
     * Tampilkan daftar makanan untuk pengunjung.
     */
    public function listForVisitors()
    {
        $makanan = Makanan::all();
        return view('pengunjung.foods', compact('makanan'));
    }

    /**
     * Menampilkan form tambah makanan.
     */
    public function create()
    {
        return view('content-manage.makanan-create');
    }

    /**
     * Menyimpan makanan baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_makanan' => 'required|string|max:255',
            'deskripsi_makanan' => 'required|string',
            'image_makanan' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        if ($request->hasFile('image_makanan')) {
            $imagePath = $request->file('image_makanan')->store('foods', 'public');
        }
    
        $makanan = new Makanan();
        $makanan->nama_makanan = $validated['nama_makanan'];
        $makanan->deskripsi_makanan = $validated['deskripsi_makanan'];
        $makanan->image_makanan = $imagePath;
        $makanan->save();
    
        return redirect('/makanan')->with('success', 'Content added successfully!');
    }

    /**
     * Menampilkan form edit makanan.
     */
    public function edit(string $id)
    {
        $makanan = Makanan::findOrFail($id);
        return view('content-manage.makanan-edit', compact('makanan'));
    }

    /**
     * Update data makanan di database.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_makanan' => 'required|string|max:255',
            'deskripsi_makanan' => 'required|string',
            'image_makanan' => 'nullable|image|mimes:jpeg,png,jpg,gif,pdf|max:2048',
        ]);
        
        $makanan = Makanan::findOrFail($id);
        
        if ($request->hasFile('image_makanan')) {
            if (Storage::exists('public/' . $makanan->image_makanan)) {
                Storage::delete('public/' . $makanan->image_makanan);
            }
            $imagePath = $request->file('image_makanan')->store('foods', 'public');
            $makanan->image_makanan = $imagePath;
        }

        $makanan->nama_makanan = $request->nama_makanan;
        $makanan->deskripsi_makanan = $request->deskripsi_makanan;
        $makanan->save();

        return redirect('/makanan')->with('success', 'Content updated successfully!');
    }

    /**
     * Hapus makanan dari database.
     */
    public function destroy(string $id)
    {
        $makanan = Makanan::findOrFail($id);
        
        if (Storage::exists('public/' . $makanan->image_makanan)) {
            Storage::delete('public/' . $makanan->image_makanan);
        }
        
        $makanan->delete();
        return redirect('/makanan')->with('success', 'Content deleted successfully!');
    }
}
