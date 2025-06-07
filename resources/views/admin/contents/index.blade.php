<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Konten di {{ $section->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-gray-100 p-8">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white min-h-screen">
        @include('admin.layouts.sidebar')
    </aside>
        
    <!-- Header -->
    <div class="flex-1 p-4">
        @include('admin.layouts.header')    
        
    <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-3xl font-bold mb-4 text-center text-red-800">Manajemen Konten {{ $section->name }}</h1>

        <!-- Button untuk menambah konten (ini akan membuka modal) -->
        <button class="bg-red-800 text-white px-4 py-2 rounded hover:bg-red-700 mb-4" onclick="openAddModal()">
            <i class="fas fa-plus mr-2"></i> Add Content
        </button>

        <!-- Tabel Konten -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-md table-auto">
                <thead class="bg-red-800 text-white text-sm">
                    <tr>
                        <th class="px-6 py-3 text-left">No</th>
                        <th class="px-6 py-3 text-left">Image</th>
                        <th class="px-6 py-3 text-left">Title</th>
                        <th class="px-6 py-3 text-left">Description</th>
                        <th class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm">
                    @foreach($contents as $index => $content)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-3">{{ $index + 1 }}</td>
                            <td class="px-6 py-3">
                                <img src="{{ asset('storage/' . $content->image) }}" alt="Image" class="w-12 h-12 object-cover rounded-md">
                            </td>
                            <td class="px-6 py-3">{{ $content->title }}</td>
                            <td class="px-6 py-3">{{ Str::limit($content->description, 50) }}</td>
                            <td class="px-6 py-3 text-center">
                                <a href="{{ route('admin.contents.edit', $content->id) }}" class="text-yellow-500 mr-3">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.contents.destroy', $content->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal Add New Content -->
        <div id="addContentModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                <h2 class="text-2xl font-bold mb-4">Tambah Konten Baru</h2>

                <!-- Form untuk menambahkan konten -->
                <form action="{{ route('admin.contents.store', $section->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="section_id" value="{{ $section->id }}">

                    @foreach($fieldRules as $field => $rule)
                        @if($rule !== 'not_used') <!-- Hanya tampilkan yang tidak "not_used" -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">{{ ucfirst($field) }}</label>

                                @if($field === 'description')
                                    <textarea 
                                        name="{{ $field }}" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm"
                                        @if($rule === 'required') required @endif
                                    >{{ old($field) }}</textarea>
                                @elseif($field === 'image')
                                    <input 
                                        type="file" 
                                        name="{{ $field }}" 
                                        class="w-full"
                                        @if($rule === 'required') required @endif
                                    >
                                @elseif($field === 'video_url')
                                    <input 
                                        type="text" 
                                        name="{{ $field }}" 
                                        value="{{ old($field) }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm"
                                        @if($rule === 'required') required @endif
                                    >
                                @else
                                    <input 
                                        type="text" 
                                        name="{{ $field }}" 
                                        value="{{ old($field) }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm"
                                        @if($rule === 'required') required @endif
                                    >
                                @endif
                            </div>
                        @endif
                    @endforeach

                    <div class="mt-6">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Simpan Konten
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script>
        // Buka modal
        function openAddModal() {
            document.getElementById('addContentModal').classList.remove('hidden');
        }

        // Tutup modal
        function closeAddModal() {
            document.getElementById('addContentModal').classList.add('hidden');
        }
    </script>
</body>
</html>
