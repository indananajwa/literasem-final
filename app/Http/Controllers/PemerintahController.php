<?php

namespace App\Http\Controllers;

use App\Models\Pemerintah;
use Illuminate\Http\Request;

class PemerintahController extends Controller
{
    // Menampilkan semua data (opsional)
    public function index()
    {
        $pemerintah = Pemerintah::all();
        return view('admin.pemerintah.index', compact('pemerintah'));
    }

    // Tampilan utama untuk admin (tampilan daftar + modal tambah/edit)
    public function adminIndex()
    {
        $items = Pemerintah::all();
        return view('admin.konten.tampilan_pemerintah', compact('items'));
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'tahun_awal' => 'required|integer',
            'tahun_akhir' => 'nullable|integer',
            'foto' => 'nullable|image|max:2048',
        ]);

        $fotoPath = $request->file('foto') ? $request->file('foto')->store('public/foto_pemerintah') : null;

        Pemerintah::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'tahun_awal' => $request->tahun_awal,
            'tahun_akhir' => $request->tahun_akhir,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('admin.pemerintah.konten')->with('success', 'Data berhasil ditambahkan!');
    }

    // Update data (dipanggil via form modal edit)
    public function update(Request $request, $id)
    {
        $pemerintah = Pemerintah::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'tahun_awal' => 'required|integer',
            'tahun_akhir' => 'nullable|integer',
            'foto' => 'nullable|image|max:2048',
        ]);

        $fotoPath = $request->file('foto') ? $request->file('foto')->store('public/foto_pemerintah') : $pemerintah->foto;

        $pemerintah->update([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'tahun_awal' => $request->tahun_awal,
            'tahun_akhir' => $request->tahun_akhir,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('admin.pemerintah.konten')->with('success', 'Data berhasil diperbarui!');
    }

    // Hapus data
    public function destroy($id)
    {
        $pemerintah = Pemerintah::findOrFail($id);

        // (Opsional) Hapus foto lama dari storage
        // if ($pemerintah->foto) {
        //     \Storage::delete($pemerintah->foto);
        // }

        $pemerintah->delete();

        return redirect()->route('admin.pemerintah.konten')->with('success', 'Data berhasil dihapus!');
    }
}
