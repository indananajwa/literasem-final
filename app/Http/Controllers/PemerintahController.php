<?php

namespace App\Http\Controllers;

use App\Models\Pemerintah;
use Illuminate\Http\Request;

class PemerintahController extends Controller
{
    //controller admin
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
            'periode' => 'required|string|max:9|unique:pemerintah,periode',
            'nama_walikota' => 'required|string|max:64',
            'nama_wakil_walikota' => 'nullable|string|max:64',
            'foto_walikota' => 'nullable|image|max:2048',
            'foto_wakil_walikota' => 'nullable|image|max:2048',
        ]);

        $data = [
            'periode' => $request->periode,
            'kode_kategori' => 'PEM', // Fixed value as per migration
            'nama_walikota' => $request->nama_walikota,
            'nama_wakil_walikota' => $request->nama_wakil_walikota,
        ];

        // Handle foto walikota
        if ($request->hasFile('foto_walikota')) {
            $file = $request->file('foto_walikota');
            $data['foto_walikota'] = file_get_contents($file->getRealPath());
            $data['mime_type_walikota'] = $file->getMimeType();
        }

        // Handle foto wakil walikota
        if ($request->hasFile('foto_wakil_walikota')) {
            $file = $request->file('foto_wakil_walikota');
            $data['foto_wakil_walikota'] = file_get_contents($file->getRealPath());
            $data['mime_type_wakil_walikota'] = $file->getMimeType();
        }

        Pemerintah::create($data);

        return redirect()->route('admin.pemerintah.konten')->with('success', 'Data berhasil ditambahkan!');
    }

    // Update data (dipanggil via form modal edit)
    public function update(Request $request, $periode)
    {
        $pemerintah = Pemerintah::findOrFail($periode);

        $request->validate([
            'nama_walikota' => 'required|string|max:64',
            'nama_wakil_walikota' => 'nullable|string|max:64',
            'foto_walikota' => 'nullable|image|max:2048',
            'foto_wakil_walikota' => 'nullable|image|max:2048',
        ]);

        $data = [
            'nama_walikota' => $request->nama_walikota,
            'nama_wakil_walikota' => $request->nama_wakil_walikota,
        ];

        // Handle foto walikota
        if ($request->hasFile('foto_walikota')) {
            $file = $request->file('foto_walikota');
            $data['foto_walikota'] = file_get_contents($file->getRealPath());
            $data['mime_type_walikota'] = $file->getMimeType();
        }

        // Handle foto wakil walikota
        if ($request->hasFile('foto_wakil_walikota')) {
            $file = $request->file('foto_wakil_walikota');
            $data['foto_wakil_walikota'] = file_get_contents($file->getRealPath());
            $data['mime_type_wakil_walikota'] = $file->getMimeType();
        }

        $pemerintah->update($data);

        return redirect()->route('admin.pemerintah.konten')->with('success', 'Data berhasil diperbarui!');
    }

    // Hapus data
    public function destroy($periode)
    {
        $pemerintah = Pemerintah::findOrFail($periode);
        $pemerintah->delete();

        return redirect()->route('admin.pemerintah.konten')->with('success', 'Data berhasil dihapus!');
    }

    // Method untuk menampilkan foto
    public function showFoto($periode, $type = 'walikota')
    {
        $pemerintah = Pemerintah::findOrFail($periode);
        
        if ($type === 'wakil') {
            $foto = $pemerintah->foto_wakil_walikota;
            $mimeType = $pemerintah->mime_type_wakil_walikota;
        } else {
            $foto = $pemerintah->foto_walikota;
            $mimeType = $pemerintah->mime_type_walikota;
        }

        if (!$foto) {
            abort(404);
        }

        return response($foto)
            ->header('Content-Type', $mimeType)
            ->header('Cache-Control', 'public, max-age=31536000');
    }

    //controller pengunjung

    /**
     * Menampilkan halaman timeline pemerintahan untuk pengunjung
     * Data diurutkan berdasarkan periode terbaru
     */
    public function timelinePemerintahan()
    {
        $pemerintahan = Pemerintah::orderBy('periode', 'desc')->get();
        
        return view('pengunjung.pemerintahan', compact('pemerintahan'));
    }

    /**
     * Menampilkan halaman pemerintahan untuk pengunjung (versi alternatif)
     * Dengan tampilan grid/card
     */
    public function showPemerintahan()
    {
        $pemerintahan = Pemerintah::orderBy('periode', 'desc')->get();
        
        return view('pengunjung.pemerintahan.index', compact('pemerintahan'));
    }

    /**
     * Method untuk halaman utama pengunjung jika dipanggil dari index
     */
    public function indexPengunjung()
    {
        $pemerintahan = Pemerintah::orderBy('periode', 'desc')->get();
        
        return view('pengunjung.index', compact('pemerintahan'));
    }

    /**
     * Menampilkan detail pemerintahan berdasarkan periode
     */
    public function detailPemerintahan($periode)
    {
        $pemerintah = Pemerintah::findOrFail($periode);
        
        return view('pengunjung.pemerintahan.detail', compact('pemerintah'));
    }

    /**
     * API endpoint untuk mendapatkan data pemerintahan (JSON)
     * Berguna untuk AJAX request atau mobile app
     */
    public function apiPemerintahan()
    {
        $pemerintahan = Pemerintah::orderBy('periode', 'desc')
            ->select('periode', 'nama_walikota', 'nama_wakil_walikota', 'created_at')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $pemerintahan
        ]);
    }

    /**
     * Mendapatkan data pemerintahan terkini (periode terbaru)
     */
    public function currentPemerintahan()
    {
        $current = Pemerintah::orderBy('periode', 'desc')->first();
        
        if (!$current) {
            return view('pengunjung.pemerintahan.not-found');
        }

        return view('pengunjung.pemerintahan.current', compact('current'));
    }

    /**
     * Pencarian pemerintahan berdasarkan nama atau periode
     */
    public function searchPemerintahan(Request $request)
    {
        $keyword = $request->get('q');
        
        if (!$keyword) {
            return redirect()->route('pengunjung.pemerintahan.timeline');
        }

        $pemerintahan = Pemerintah::where(function($query) use ($keyword) {
            $query->where('nama_walikota', 'LIKE', "%{$keyword}%")
                  ->orWhere('nama_wakil_walikota', 'LIKE', "%{$keyword}%")
                  ->orWhere('periode', 'LIKE', "%{$keyword}%");
        })
        ->orderBy('periode', 'desc')
        ->get();

        return view('pengunjung.pemerintahan.search', compact('pemerintahan', 'keyword'));
    }

    /**
     * Menampilkan statistik pemerintahan
     */
    public function statistikPemerintahan()
    {
        $totalPeriode = Pemerintah::count();
        $periodeWithWakil = Pemerintah::whereNotNull('nama_wakil_walikota')->count();
        $periodeSingle = $totalPeriode - $periodeWithWakil;
        
        $firstPeriode = Pemerintah::orderBy('periode', 'asc')->first();
        $latestPeriode = Pemerintah::orderBy('periode', 'desc')->first();

        $stats = [
            'total_periode' => $totalPeriode,
            'periode_with_wakil' => $periodeWithWakil,
            'periode_single' => $periodeSingle,
            'first_periode' => $firstPeriode,
            'latest_periode' => $latestPeriode
        ];

        return view('pengunjung.pemerintahan.statistik', compact('stats'));
    }

    /**
     * Method khusus untuk menampilkan foto dengan caching yang lebih baik
     * untuk pengunjung (public access)
     */
    public function publicFoto($periode, $type = 'walikota')
    {
        $pemerintah = Pemerintah::findOrFail($periode);
        
        if ($type === 'wakil') {
            $foto = $pemerintah->foto_wakil_walikota;
            $mimeType = $pemerintah->mime_type_wakil_walikota;
        } else {
            $foto = $pemerintah->foto_walikota;
            $mimeType = $pemerintah->mime_type_walikota;
        }

        if (!$foto) {
            // Return placeholder image atau 404
            abort(404);
        }

        return response($foto)
            ->header('Content-Type', $mimeType)
            ->header('Cache-Control', 'public, max-age=86400') // 24 hours cache
            ->header('Expires', gmdate('D, d M Y H:i:s \G\M\T', time() + 86400))
            ->header('Last-Modified', gmdate('D, d M Y H:i:s \G\M\T', strtotime($pemerintah->updated_at)));
    }
}