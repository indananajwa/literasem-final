<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body { font-family: 'Inter', sans-serif; }
    .stat-card { transition: all 0.3s ease; }
    .stat-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body class="bg-gray-50 flex">
  
  <!-- Sidebar -->
  <aside class="w-64 bg-gray-800 text-white min-h-screen">
    @include('admin.layouts.sidebar')
  </aside>

  <!-- Main Content -->
  <div class="flex-1 p-8">
    
    <!-- Header -->
    @include('admin.layouts.header')

    <!-- Header Top -->
    <div class="flex justify-between items-center mb-8">
      <!-- Title -->
      <div class="flex items-center">
        <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
        <i class="fas fa-info-circle text-gray-400 ml-2 cursor-help" title="Ringkasan data sistem"></i>
      </div>

      <!-- Search + Action Buttons -->
      <div class="flex items-center space-x-3">
        <!-- Search -->
        <div class="relative group">
          <input type="text" placeholder="Cari Kategori..." 
                 class="pl-10 pr-4 py-2 border border-gray-300 rounded-full text-sm 
                        focus:outline-none focus:ring-2 focus:ring-red-500
                        transition-all duration-300 group-hover:shadow-md">
          <i class="fas fa-search absolute left-3 top-3 text-gray-400 text-sm"></i>
        </div>

        <!-- Tambah Kategori -->
        <a href="{{ route('admin.kategori.create') }}" 
           class="bg-gradient-to-r from-red-600 to-red-700 text-white px-5 py-2 rounded-full 
                  text-sm font-medium shadow-sm hover:shadow-lg transform hover:-translate-y-0.5 
                  transition-all duration-300">
          <i class="fas fa-folder-plus mr-1"></i> Kategori
        </a>

        <!-- Tambah Konten -->
        <a href="{{ route('admin.kategori.index') }}" 
           class="bg-gradient-to-r from-red-500 to-red-600 text-white px-5 py-2 rounded-full 
                  text-sm font-medium shadow-sm hover:shadow-lg transform hover:-translate-y-0.5 
                  transition-all duration-300">
          <i class="fas fa-plus mr-1"></i> Konten
        </a>
      </div>
    </div>

    <!-- Grid Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
      <!-- LEFT SIDE -->
      <div class="lg:col-span-7 space-y-6">
        
        <!-- Stat Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <!-- Jumlah Kategori -->
          <div class="bg-white rounded-xl shadow-sm p-6 stat-card border border-gray-100">
            <div class="flex items-start justify-between mb-4">
              <div class="w-14 h-14 bg-red-50 rounded-full flex items-center justify-center">
                <i class="fas fa-folder text-red-600 text-xl"></i>
              </div>
            </div>
            <div>
              <p class="text-gray-500 text-xs font-medium mb-1">Jumlah</p>
              <p class="text-gray-800 text-sm font-semibold mb-2">Kategori</p>
              <p class="text-6xl font-bold text-red-800">{{ $totalKategori }}</p>
            </div>
          </div>

          <!-- Jumlah Konten -->
          <div class="bg-white rounded-xl shadow-sm p-6 stat-card border border-gray-100">
            <div class="flex items-start justify-between mb-4">
              <div class="w-14 h-14 bg-red-50 rounded-full flex items-center justify-center">
                <i class="fas fa-file-alt text-red-600 text-xl"></i>
              </div>
            </div>
            <div>
              <p class="text-gray-500 text-xs font-medium mb-1">Jumlah</p>
              <p class="text-gray-800 text-sm font-semibold mb-2">Konten</p>
              <p class="text-6xl font-bold text-red-800">{{ $totalKonten }}</p>
            </div>
          </div>
        </div>

        <!-- Feedback Chart -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
          <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-bold text-red-800">Feedback Bulanan</h2>
            <span class="text-xs text-gray-500 font-medium">(Monthly Feedback)</span>
          </div>
          <div class="relative" style="height: 300px;">
            <canvas id="feedbackChart"></canvas>
          </div>
        </div>
      </div>

      <!-- RIGHT SIDE -->
      <div class="lg:col-span-5 space-y-6">
        
        <!-- Recent Kategori -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
          <div class="mb-4 flex items-center justify-between">
            <h2 class="text-base font-bold text-gray-900">Recent Kategori</h2>
            <a href="{{ route('admin.kategori.index') }}" 
               class="text-xs text-red-600 font-medium hover:underline">Lihat Semua</a>
          </div>
          <div class="overflow-x-auto">
            <table class="min-w-full">
              <thead>
                <tr class="border-b border-gray-200">
                  <th class="text-left py-3 px-3 text-xs font-semibold text-gray-600 uppercase">ID</th>
                  <th class="text-left py-3 px-3 text-xs font-semibold text-gray-600 uppercase">Nama Kategori</th>
                  <th class="text-left py-3 px-3 text-xs font-semibold text-gray-600 uppercase">Konten</th>
                </tr>
              </thead>
              <tbody>
                @forelse($recentKategori as $kategori)
                <tr class="border-b border-gray-100 hover:bg-gray-50 transition cursor-pointer">
                  <td class="py-3 px-3 text-sm text-gray-900 font-medium">{{ $kategori->kode_kategori }}</td>
                  <td class="py-3 px-3 text-sm text-gray-700">{{ $kategori->nama_kategori }}</td>
                  <td class="py-3 px-3 text-sm text-gray-900 font-semibold">{{ $kategori->konten_count }}</td>
                </tr>
                @empty
                <tr>
                  <td colspan="3" class="py-12 text-center">
                    <i class="fas fa-folder-open text-gray-300 text-4xl mb-3"></i>
                    <p class="text-gray-400 text-sm">Belum ada kategori</p>
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>

        <!-- Recent Konten -->
        <div class="lg:col-span-3 bg-white rounded-xl shadow-sm p-6 border border-gray-100">
          <div class="flex items-center justify-between mb-4">
            <h2 class="text-base font-bold text-gray-900">Recent Konten</h2>
            <a href="{{ route('admin.konten.index', $recentKategori->first()->kode_kategori ?? '') }}" 
               class="text-xs text-red-600 hover:underline">Lihat semua</a>
          </div>

          <div class="space-y-4">
            @forelse($recentKonten as $konten)
              <div class="flex items-center justify-between hover:bg-gray-50 p-2 rounded-lg transition">
                <!-- Thumbnail -->
                <div class="flex items-center space-x-3">
                  @if($konten->gambar)
                    <img src="data:{{ $konten->mime_type }};base64,{{ base64_encode($konten->gambar) }}" 
                         alt="{{ $konten->judul }}" 
                         class="w-10 h-10 rounded-lg object-cover">
                  @else
                    <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center">
                      <i class="fas fa-image text-gray-400 text-sm"></i>
                    </div>
                  @endif
                  <div>
                    <p class="text-sm font-semibold text-gray-800 line-clamp-1">{{ $konten->judul }}</p>
                    <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($konten->created_at)->format('d M Y') }}</p>
                  </div>
                </div>

                <!-- Action -->
                <a href="{{ route('admin.konten.edit', [$konten->kode_kategori, $konten->kode_konten]) }}" 
                   class="px-3 py-1 text-xs font-medium text-white bg-gradient-to-r from-red-500 to-red-600 
                          rounded-lg hover:shadow-md hover:scale-105 transition">
                  Lihat
                </a>
              </div>
            @empty
              <div class="text-center py-6 text-gray-400 text-sm">
                <i class="fas fa-inbox text-2xl mb-2"></i>
                <p>Belum ada konten</p>
              </div>
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Chart Setup - Monthly Feedback
    const ctx = document.getElementById('feedbackChart').getContext('2d');
    const monthlyData = @json($monthlyFeedback);
    const labels = monthlyData.map(item => item.month_name);
    const data = monthlyData.map(item => item.total);

    // Buat gradient
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(220, 38, 38, 0.9)');   // merah
    gradient.addColorStop(1, 'rgba(244, 114, 182, 0.7)'); // pink

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: 'Jumlah Feedback',
          data: data,
          backgroundColor: gradient,
          borderRadius: 8,
          barThickness: 35
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { display: false },
          tooltip: {
            backgroundColor: 'rgba(0, 0, 0, 0.8)',
            padding: 12,
            titleFont: { size: 13, weight: 'bold' },
            bodyFont: { size: 12 },
            callbacks: {
              label: function(context) {
                return 'Total: ' + context.parsed.y + ' feedback';
              }
            }
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: { 
              stepSize: 10,
              precision: 0,
              font: { size: 11 },
              color: '#6B7280'
            },
            grid: { 
              display: true, 
              drawBorder: false,
              color: 'rgba(0, 0, 0, 0.05)'
            },
            border: { display: false }
          },
          x: { 
            grid: { display: false },
            ticks: {
              font: { size: 11 },
              color: '#6B7280'
            },
            border: { display: false }
          }
        }
      }
    });
  </script>

</body>
</html>
