<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Hitung total kategori
            $totalKategori = DB::table('kategori')->count();
            
            // Hitung total konten
            $totalKonten = DB::table('konten')->count();
            
            // Ambil 5 kategori terbaru dengan jumlah konten
            $recentKategori = DB::table('kategori')
                ->leftJoin('konten', 'kategori.kode_kategori', '=', 'konten.kode_kategori')
                ->select(
                    'kategori.kode_kategori',
                    'kategori.nama_kategori',
                    DB::raw('COUNT(konten.kode_konten) as konten_count')
                )
                ->groupBy('kategori.kode_kategori', 'kategori.nama_kategori')
                ->orderBy('kategori.created_at', 'desc')
                ->limit(5)
                ->get();
            
            // Ambil 5 konten terbaru
            $recentKonten = DB::table('konten')
                ->select('kode_konten', 'kode_kategori', 'judul', 'deskripsi', 'gambar', 'mime_type', 'video_url', 'created_at')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
            
            // Hitung feedback per bulan (12 bulan terakhir)
            $monthlyFeedback = [];
            $currentMonth = Carbon::now();
            
            for ($i = 11; $i >= 0; $i--) {
                $month = $currentMonth->copy()->subMonths($i);
                $startDate = $month->copy()->startOfMonth();
                $endDate = $month->copy()->endOfMonth();
                
                $count = DB::table('feedback')
                    ->whereBetween('tanggal_kirim', [$startDate, $endDate])
                    ->count();
                
                $monthlyFeedback[] = [
                    'month_name' => $month->format('M'), // Jan, Feb, Mar
                    'total' => $count
                ];
            }
            
            // Debug: Cek apakah ada data feedback
            $totalFeedback = DB::table('feedback')->count();
            \Log::info('Total Feedback: ' . $totalFeedback);
            \Log::info('Monthly Feedback Data: ', $monthlyFeedback);
            
            return view('admin.dashboard', compact(
                'totalKategori',
                'totalKonten',
                'recentKategori',
                'recentKonten',
                'monthlyFeedback'
            ));
        } catch (\Exception $e) {
            \Log::error('Dashboard Error: ' . $e->getMessage());
            
            // Jika error, return dengan data default
            return view('admin.dashboard', [
                'totalKategori' => 0,
                'totalKonten' => 0,
                'recentKategori' => collect([]),
                'recentKonten' => collect([]),
                'monthlyFeedback' => []
            ]);
        }
    }
}