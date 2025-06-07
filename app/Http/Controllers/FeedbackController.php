<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Response;


class FeedbackController extends Controller {
    public function store(Request $request) {
        // ✅ Validasi dulu sebelum insert ke database
        $validated = $request->validate([
            'name_pengunjung' => 'required|string|max:255',
            'email_pengunjung' => 'required|email|max:255',
            'feedback_pengunjung' => 'required|string'
        ]);

        // ✅ Simpan ke database
        $feedback = Feedback::create($validated);

        // ✅ Redirect dengan pesan sukses atau error
        return $feedback
            ? redirect()->back()->with('success', 'Feedback berhasil dikirim!')
            : redirect()->back()->with('error', 'Gagal mengirim feedback.');
    }

    public function index() {
        $feedback = Feedback::all();
        return view('admin.feedback.index', compact('feedback'));
    }

    public function getTotalFeedback()
    {
        $totalFeedback = Feedback::count();

        return view('welcome', compact('totalFeedback'));
    }

    public function destroy($id)
    {
        Feedback::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Feedback berhasil dihapus');
    }

    public function download()
    {
        $feedbacks = Feedback::all();
        $csv = "Name,Email,Message,Date\n";

        foreach ($feedbacks as $item) {
            $csv .= "\"{$item->name_pengunjung}\",\"{$item->email_pengunjung}\",\"{$item->feedback_pengunjung}\",\"{$item->created_at->format('d M Y, H:i')}\"\n";
        }

        return Response::make($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="feedback.csv"',
        ]);
    }
}

