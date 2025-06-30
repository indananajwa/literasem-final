<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pariwisata;
use Illuminate\Http\Request;

class PariwisataController extends Controller
{
    // Untuk halaman publik
    public function index()
    {
        $data = Pariwisata::all();
        $highlight = Pariwisata::limit(5)->get();
        return view('pengunjung.pariwisata', compact('data', 'highlight'));
    }

    public function adminView()
    {
        $pariwisataList = Pariwisata::all();
        return view('admin.manajemen_konten', compact('pariwisataList'));
    }

    public function adminIndex()
    {
        $pariwisataList = Pariwisata::all();
        return view('admin.konten.tampilan_pariwisata', compact('pariwisataList'));
    }

    public function create()
    {
        return view('admin.pariwisata.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:64',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image',
            'url_maps' => 'nullable|url',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = file_get_contents($request->file('foto')->getRealPath());
            $data['mime_type'] = $request->file('foto')->getClientMimeType();
        }

        Pariwisata::create($data);

        return redirect()->route('admin.manajemen-konten');
    }

    public function edit($id)
    {
        $item = Pariwisata::findOrFail($id);
        return view('admin.pariwisata.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Pariwisata::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:64',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image',
            'url_maps' => 'nullable|url',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
        ]);

        if ($request->hasFile('foto')) {
            $item->foto = file_get_contents($request->file('foto')->getRealPath());
            $item->mime_type = $request->file('foto')->getClientMimeType();
        }

        $item->nama = $request->nama;
        $item->deskripsi = $request->deskripsi;
        $item->url_maps = $request->url_maps;
        $item->lat = $request->lat;
        $item->lng = $request->lng;

        $item->save();

        return redirect()->route('admin.manajemen-konten');
    }

    public function destroy($id)
    {
        $item = Pariwisata::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.manajemen-konten');
    }

    public function gambar($id)
    {
        $item = Pariwisata::findOrFail($id);

        if (!$item->foto) {
            abort(404);
        }

        return response($item->foto)->header('Content-Type', $item->mime_type);
    }
    
}
