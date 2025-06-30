<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedback = DB::table('feedback')->orderBy('tanggal_kirim', 'desc')->get();
        return view('admin.feedback.index', compact('feedback'));
    }

    public function store(Request $request)
    {
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

    public function destroy($id)
    {
        try {
            DB::table('feedback')->where('id', $id)->delete();
            return redirect()->back()->with('success', 'Feedback berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus feedback.');
        }
    }
}
