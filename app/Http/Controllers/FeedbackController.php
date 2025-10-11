<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_pengunjung' => 'required|string|max:32',
            'email' => 'nullable|email|max:64',
            'pesan' => 'required|string',
        ], [
            'nama_pengunjung.required' => 'Nama wajib diisi',
            'nama_pengunjung.max' => 'Nama maksimal 32 karakter',
            'email.email' => 'Format email tidak valid',
            'email.max' => 'Email maksimal 64 karakter',
            'pesan.required' => 'Pesan wajib diisi',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Simpan ke database
            DB::table('feedback')->insert([
                'nama_pengunjung' => $request->nama_pengunjung,
                'email' => $request->email,
                'pesan' => $request->pesan,
                'tanggal_kirim' => now(),
            ]);

            return redirect()->back()->with('success', 'Pesan berhasil dikirim! Terima kasih atas feedback Anda.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.');
        }
    }

    public function index()
    {
        $feedback = DB::table('feedback')->orderBy('tanggal_kirim', 'desc')->get();
        return view('admin.feedback.index', compact('feedback'));
    }

    public function destroy($id)
    {
        try {
            // Cek apakah feedback exists
            $feedback = DB::table('feedback')->where('id', $id)->first();

            if (!$feedback) {
                return redirect()->back()->with('error', 'Data feedback tidak ditemukan.');
            }

            // Hapus feedback
            DB::table('feedback')->where('id', $id)->delete();

            return redirect()->route('feedback.index')->with('success', 'Feedback berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus feedback. Silakan coba lagi.');
        }
    }

    // ✅ FITUR BARU: Download Feedback sebagai CSV
    public function download()
    {
        try {
            $feedback = DB::table('feedback')->orderBy('tanggal_kirim', 'desc')->get();

            // Nama file dengan timestamp
            $filename = 'feedback_' . date('Y-m-d_His') . '.csv';

            // Headers untuk download
            $headers = [
                'Content-Type' => 'text/csv; charset=UTF-8',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                'Pragma' => 'no-cache',
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
                'Expires' => '0'
            ];

            // Buat callback untuk streaming
            $callback = function() use ($feedback) {
                $file = fopen('php://output', 'w');
                
                // Add BOM untuk Excel UTF-8
                fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
                
                // Header kolom
                fputcsv($file, ['No', 'Nama Pengunjung', 'Email', 'Pesan', 'Tanggal Kirim']);

                // Data rows
                $no = 1;
                foreach ($feedback as $item) {
                    fputcsv($file, [
                        $no++,
                        $item->nama_pengunjung,
                        $item->email ?? '-',
                        $item->pesan,
                        \Carbon\Carbon::parse($item->tanggal_kirim)->format('d/m/Y H:i:s')
                    ]);
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengunduh data feedback.');
        }
    }

    // ✅ ALTERNATIF: Download sebagai Excel (jika ada library PhpSpreadsheet)
    public function downloadExcel()
    {
        try {
            $feedback = DB::table('feedback')->orderBy('tanggal_kirim', 'desc')->get();

            // Nama file
            $filename = 'feedback_' . date('Y-m-d_His') . '.xlsx';

            // Jika menggunakan Laravel Excel
            // return Excel::download(new FeedbackExport($feedback), $filename);

            // Atau bisa pakai PhpSpreadsheet manual
            return redirect()->back()->with('info', 'Fitur Excel dalam pengembangan. Silakan gunakan format CSV.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengunduh data feedback.');
        }
    }
}