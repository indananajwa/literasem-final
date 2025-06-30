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

            <!-- Welcome Message -->
            <div class="bg-white p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-4">Selamat Datang di Dashboard Admin LITERASEM</h1>
                <p class="text-gray-600">Pantau perkembangan website LITERASEM dengan statistik terbaru di bawah ini.</p>
            </div>

            <!-- Tabel Daftar kategori -->
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="text-lg font-semibold text-gray-700">Daftar kategori</h4>
                    <a href="{{ route('admin.kategori.create') }}" class="bg-red-800 text-white px-4 py-2 rounded hover:bg-red-600 text-sm">+ Tambah kategori</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama kategori</th>
                                <!-- <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Field Rules</th> -->
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($kategoris as $kategori)
                                <tr>
                                    <td class="px-4 py-2 text-gray-700">{{ $kategori->kode_kategori }}</td>
                                    <td class="px-4 py-2 text-gray-700">{{ $kategori->nama_kategori }}</td>
                                    <td class="px-4 py-2 space-x-2">
                                        <a href="{{ route('admin.konten.index', $kategori->kode_kategori) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 text-sm">Konten</a>
                                        <a href="{{ route('admin.kategori.edit', $kategori->kode_kategori) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-sm">Edit</a>
                                        <form action="{{ route('admin.kategori.destroy', $kategori->kode_kategori) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        
</body>
</html>
