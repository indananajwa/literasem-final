<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Laravel Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
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

        <!-- Judul Section -->
    <div class="bg-white p-6">
      <h1 class="text-2xl font-bold text-gray-800 mb-4">Laporan Aduan Pengunjung Website LITERASEM</h1>
    </div>

    <!-- Tabel Daftar Section -->
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr class="text-center">
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Message</th>
                            <th class="px-4 py-2">Date</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($feedback as $item)
                            <tr class="text-center hover:bg-gray-100">
                                <td class="px-4 py-2">{{ $item->name_pengunjung }}</td>
                                <td class="px-4 py-2">{{ $item->email_pengunjung }}</td>
                                <td class="px-4 py-2">{{ $item->feedback_pengunjung }}</td>
                                <td class="px-4 py-2">{{ $item->created_at->format('d M Y, H:i') }}</td>
                                <td class="px-4 py-2">
                                    <form action="{{ route('feedback.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
