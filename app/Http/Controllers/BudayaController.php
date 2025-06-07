<?php

namespace App\Http\Controllers;

use App\Models\Budaya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BudayaController extends Controller
{
    /**
     * Tampilkan daftar budaya untuk admin.
     */
    public function index()
    {
        $budaya = Budaya::all();
        return view('content-manage.budaya', compact('budaya'));
    }

    /**
     * Tampilkan total budaya untuk admin.
     */
    public function getTotal()
    {
        $totalBudaya = Budaya::count();

        return view('welcome', compact('totalBudaya'));
    }

    /**
     * Tampilkan daftar budaya untuk pengunjung.
     */
    public function listForVisitors()
    {
        $budaya = Budaya::all();
        return view('pengunjung.culturee', compact('budaya'));
    }

    /**
     * Menampilkan form tambah budaya.
     */
    public function create()
    {
        return view('content-manage.budaya-create');
    }

    /**
     * Menyimpan budaya baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_budaya' => 'required|string|max:255',
            'deskripsi_budaya' => 'required|string',
            'image_budaya' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video_budaya' => 'nullable|mimes:mp4,mov,avi,wmv|max:10000',
        ]);
    
        if ($request->hasFile('image_budaya')) {
            $imagePath = $request->file('image_budaya')->store('culture_images', 'public');
        }

        if ($request->hasFile('video_budaya')) {
            $videoPath = $request->file('video_budaya')->store('culture_videos', 'public');
        } else {
            $videoPath = null; // Kalau gak ada video, set null
        }
    
        $budaya = new Budaya();
        $budaya->nama_budaya = $validated['nama_budaya'];
        $budaya->deskripsi_budaya = $validated['deskripsi_budaya'];
        $budaya->image_budaya = $imagePath;
        $budaya->video_budaya = $videoPath;
        $budaya->save();
    
        return redirect('/budaya')->with('success', 'Content added successfully!');
    }

    /**
     * Menampilkan form edit budaya.
     */
    public function edit(string $id)
    {
        $budaya = Budaya::findOrFail($id);
        return view('content-manage.budaya-edit', compact('budaya'));
    }

    /**
     * Update data budaya di database.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_budaya' => 'required|string|max:255',
            'deskripsi_budaya' => 'required|string',
            'image_budaya' => 'nullable|image|mimes:jpeg,png,jpg,gif,pdf|max:2048',
            'video_budaya' => 'nullable|mimes:mp4,mov,avi,wmv|max:10000',
        ]);
        
        $budaya = Budaya::findOrFail($id);
        
        if ($request->hasFile('image_budaya')) {
            if (Storage::exists('public/' . $budaya->image_budaya)) {
                Storage::delete('public/' . $budaya->image_budaya);
            }
            $imagePath = $request->file('image_budaya')->store('culture_images', 'public');
            $budaya->image_budaya = $imagePath;
        }

        if ($request->hasFile('video_budaya')) {
            if ($budaya->video_budaya && Storage::exists('public/' . $budaya->video_budaya)) {
                Storage::delete('public/' . $budaya->video_budaya);
            }
            $videoPath = $request->file('video_budaya')->store('culture_videos', 'public');
            $budaya->video_budaya = $videoPath;  
        }  

        $budaya->nama_budaya = $request->nama_budaya;
        $budaya->deskripsi_budaya = $request->deskripsi_budaya;
        $budaya->save();

        return redirect('/budaya')->with('success', 'Content updated successfully!');
    }

    /**
     * Hapus budaya dari database.
     */
    public function destroy(string $id)
    {
        $budaya = Budaya::findOrFail($id);
        
        if (Storage::exists('public/' . $budaya->image_budaya)) {
            Storage::delete('public/' . $budaya->image_budaya);
        }

        if ($budaya->video_budaya && Storage::exists('public/' . $budaya->video_budaya)) {
            Storage::delete('public/' . $budaya->video_budaya);
        }
        
        $budaya->delete();
        return redirect('/budaya')->with('success', 'Content deleted successfully!');
    }
}