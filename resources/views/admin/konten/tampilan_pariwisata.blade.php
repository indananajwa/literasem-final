<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Konten - Pariwisata</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white">
<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white min-h-screen">
        @include('admin.layouts.sidebar')
    </aside>

    <!-- Main Content -->
    <div class="flex-1 p-6">
        @include('admin.layouts.header')

        <div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4 text-gray-800">Manajemen Konten - Pariwisata</h2>

    <button onclick="openAddModal()" class="bg-red-800 text-white px-4 py-2 rounded hover:bg-red-700 mb-4">+ Tambah Konten</button>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Lat</th>
                    <th class="px-4 py-2">Lng</th>
                    <th class="px-4 py-2">Maps</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($pariwisataList as $item)
                <tr>
                    <td class="px-4 py-2">{{ $item->id }}</td>
                    <td class="px-4 py-2">{{ $item->nama }}</td>
                    <td class="px-4 py-2">{{ $item->lat }}</td>
                    <td class="px-4 py-2">{{ $item->lng }}</td>
                    <td class="px-4 py-2"><a href="{{ $item->url_maps }}" target="_blank" class="text-blue-600 underline">Lihat</a></td>
                    <!-- Tombol Aksi -->
                    <td class="px-4 py-2 space-x-2">
                        <button 
                            type="button"
                            onclick="openEditModal({{ $item->id }}, '{{ $item->nama }}', `{{ $item->deskripsi }}`, '{{ $item->url_maps }}', '{{ $item->lat }}', '{{ $item->lng }}')"
                            class="bg-yellow-500 text-white px-3 py-1 rounded"
                        >
                            Edit
                        </button>


                        <form action="{{ route('admin.pariwisata.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus konten ini?');">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 rounded">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Tambah Konten --}}
<div id="addContentModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-xl font-bold mb-4">Tambah Konten Pariwisata</h2>
        <form action="{{ route('admin.pariwisata.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-sm mb-1">Nama</label>
                <input type="text" name="nama" required class="w-full border rounded px-3 py-2">
            </div>
            <div class="mb-4">
                <label class="block text-sm mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="3" class="w-full border rounded px-3 py-2"></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-sm mb-1">Foto</label>
                <input type="file" name="foto" class="w-full">
            </div>
            <div class="mb-4">
                <label class="block text-sm mb-1">URL Maps</label>
                <input type="url" name="url_maps" class="w-full border rounded px-3 py-2">
            </div>
            <div class="mb-4">
                <label class="block text-sm mb-1">Latitude</label>
                <input type="text" name="lat" class="w-full border rounded px-3 py-2">
            </div>
            <div class="mb-4">
                <label class="block text-sm mb-1">Longitude</label>
                <input type="text" name="lng" class="w-full border rounded px-3 py-2">
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeAddModal()" class="mr-2 px-4 py-2 border rounded">Batal</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit Konten --}}
<div id="editContentModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-xl font-bold mb-4">Edit Konten Pariwisata</h2>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-sm mb-1">Nama</label>
                <input type="text" name="nama" id="edit_nama" required class="w-full border rounded px-3 py-2">
            </div>
            <div class="mb-4">
                <label class="block text-sm mb-1">Deskripsi</label>
                <textarea name="deskripsi" id="edit_deskripsi" rows="3" class="w-full border rounded px-3 py-2"></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-sm mb-1">Foto (Opsional)</label>
                <input type="file" name="foto" class="w-full">
            </div>
            <div class="mb-4">
                <label class="block text-sm mb-1">URL Maps</label>
                <input type="url" name="url_maps" id="edit_url_maps" class="w-full border rounded px-3 py-2">
            </div>
            <div class="mb-4">
                <label class="block text-sm mb-1">Latitude</label>
                <input type="text" name="lat" id="edit_lat" class="w-full border rounded px-3 py-2">
            </div>
            <div class="mb-4">
                <label class="block text-sm mb-1">Longitude</label>
                <input type="text" name="lng" id="edit_lng" class="w-full border rounded px-3 py-2">
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeEditModal()" class="mr-2 px-4 py-2 border rounded">Batal</button>
                <button type="submit" class="bg-red-800 text-white px-4 py-2 rounded hover:bg-red-700">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>


<script>
    function openAddModal() {
        document.getElementById('addContentModal').classList.remove('hidden');
    }

    function closeAddModal() {
        document.getElementById('addContentModal').classList.add('hidden');
    }

    function openEditModal(id, nama, deskripsi, url_maps, lat, lng) {
        const form = document.getElementById('editForm');
        form.action = `/admin/pariwisata/${id}`; // Pastikan route ini sesuai dengan Route::put()

        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_deskripsi').value = deskripsi;
        document.getElementById('edit_url_maps').value = url_maps;
        document.getElementById('edit_lat').value = lat;
        document.getElementById('edit_lng').value = lng;

        document.getElementById('editContentModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editContentModal').classList.add('hidden');
    }
</script>

</div>
</body>
</html>
