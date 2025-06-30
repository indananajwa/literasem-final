<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manajemen Konten - Pemerintah</title>
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
            <h2 class="text-xl font-bold mb-4 text-gray-800">Daftar Data Pemerintah</h2>

            <button onclick="openAddModal()" class="bg-red-800 text-white px-4 py-2 rounded hover:bg-red-700 mb-4">+ Tambah Konten</button>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left">ID</th>
                            <th class="px-4 py-2 text-left">Nama</th>
                            <th class="px-4 py-2 text-left">Jabatan</th>
                            <th class="px-4 py-2 text-left">Tahun Awal</th>
                            <th class="px-4 py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($items as $item)
                        <tr>
                            <td class="px-4 py-2">{{ $item->id }}</td>
                            <td class="px-4 py-2">{{ $item->nama }}</td>
                            <td class="px-4 py-2">{{ $item->jabatan }}</td>
                            <td class="px-4 py-2">{{ $item->tahun_awal }}</td>
                            <td class="px-4 py-2 space-x-2">
                            <button type="button"
                                onclick="event.preventDefault(); openEditModal({{ $item->id }}, '{{ $item->nama }}', '{{ $item->jabatan }}', '{{ $item->tahun_awal }}'); return false;"
                                class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                Edit
                                </button>


                                <form action="{{ route('admin.pemerintah.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Tambah -->
        <div id="addContentModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                <h2 class="text-xl font-bold mb-4">Tambah Konten Pemerintah</h2>
                <form action="{{ route('admin.pemerintah.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm mb-1">Nama</label>
                        <input type="text" name="nama" required class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm mb-1">Jabatan</label>
                        <input type="text" name="jabatan" required class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm mb-1">Tahun Awal</label>
                        <input type="number" name="tahun_awal" required class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm mb-1">Foto (Opsional)</label>
                        <input type="file" name="foto" class="w-full">
                    </div>
                    <div class="text-right">
                        <button type="button" onclick="closeAddModal()" class="mr-2 px-4 py-2 bg-gray-300 rounded">Batal</button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Edit -->
        <div id="editContentModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                <h2 class="text-xl font-bold mb-4">Edit Konten Pemerintah</h2>
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-sm mb-1">Nama</label>
                        <input type="text" id="editNama" name="nama" required class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm mb-1">Jabatan</label>
                        <input type="text" id="editJabatan" name="jabatan" required class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm mb-1">Tahun Awal</label>
                        <input type="number" id="editTahunAwal" name="tahun_awal" required class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="text-right">
                        <button type="button" onclick="closeEditModal()" class="mr-2 px-4 py-2 bg-gray-300 rounded">Batal</button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Scripts -->
<script>
    function openAddModal() {
        document.getElementById('addContentModal').classList.remove('hidden');
    }

    function closeAddModal() {
        document.getElementById('addContentModal').classList.add('hidden');
    }

    function openEditModal(id, nama, jabatan, tahun_awal) {
        document.getElementById('editNama').value = nama;
        document.getElementById('editJabatan').value = jabatan;
        document.getElementById('editTahunAwal').value = tahun_awal;

        const form = document.getElementById('editForm');
        form.action = `/admin/pemerintah/${id}`;

        document.getElementById('editContentModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editContentModal').classList.add('hidden');
    }
</script>

</body>
</html>
