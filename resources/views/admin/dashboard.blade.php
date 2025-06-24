<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin Literasem</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
        font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-white">
<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white min-h-screen">
      @include('admin.layouts.sidebar')
    </aside>
    <!-- Main Content -->
    <div class="flex-1 p-4">
    
      @include('admin.layouts.header')

      @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif


            <!-- Welcome Message -->
            <div class="bg-white p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-4">Selamat Datang di Dashboard Admin LITERASEM</h1>
                <p class="text-gray-600">Pantau perkembangan website LITERASEM dengan statistik terbaru di bawah ini.</p>
            </div>

            <!-- Graphs -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h4 class="text-lg font-semibold text-gray-700 mb-4">Grafik Views</h4>
                    <img src="graph-views.jpg" class="w-full h-64 object-cover rounded-lg" alt="Grafik Views">
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h4 class="text-lg font-semibold text-gray-700 mb-4">Grafik Interaksi Pengunjung</h4>
                    <img src="graph-interaction.jpg" class="w-full h-64 object-cover rounded-lg" alt="Grafik Interaksi">
                </div>
            </div>
        </div>
    </div>
</body>
</html>
