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
                            <th class="px-4 py-2 text-left">Periode</th>
                            <th class="px-4 py-2 text-left">Walikota</th>
                            <th class="px-4 py-2 text-left">Wakil Walikota</th>
                            <th class="px-4 py-2 text-left">Foto Walikota</th>
                            <th class="px-4 py-2 text-left">Foto Wakil</th>
                            <th class="px-4 py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($items as $item)
                        <tr>
                            <td class="px-4 py-2">{{ $item->periode }}</td>
                            <td class="px-4 py-2">{{ $item->nama_walikota }}</td>
                            <td class="px-4 py-2">{{ $item->nama_wakil_walikota ?? '-' }}</td>
                            <td class="px-4 py-2">
                                @if($item->foto_walikota)
                                    <img src="{{ route('admin.pemerintah.foto', ['periode' => $item->periode, 'type' => 'walikota']) }}" 
                                         alt="Foto Walikota" class="w-12 h-12 object-cover rounded">
                                @else
                                    <span class="text-gray-400">Tidak ada foto</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                @if($item->foto_wakil_walikota)
                                    <img src="{{ route('admin.pemerintah.foto', ['periode' => $item->periode, 'type' => 'wakil']) }}" 
                                         alt="Foto Wakil" class="w-12 h-12 object-cover rounded">
                                @else
                                    <span class="text-gray-400">Tidak ada foto</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 space-x-2">
                                <button type="button"
                                    onclick="event.preventDefault(); openEditModal('{{ $item->periode }}', '{{ addslashes($item->nama_walikota) }}', '{{ addslashes($item->nama_wakil_walikota) }}'); return false;"
                                    class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                    Edit
                                </button>

                                <form action="{{ route('admin.pemerintah.destroy', $item->periode) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
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
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md max-h-screen overflow-y-auto">
                <h2 class="text-xl font-bold mb-4">Tambah Konten Pemerintah</h2>
                <form action="{{ route('admin.pemerintah.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm mb-1">Periode <span class="text-red-500">*</span></label>
                        <input type="text" name="periode" required placeholder="Contoh: 2024-2029" 
                               class="w-full border rounded px-3 py-2" maxlength="9">
                        <small class="text-gray-500">Format: YYYY-YYYY (contoh: 2024-2029)</small>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm mb-1">Nama Walikota <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_walikota" required class="w-full border rounded px-3 py-2" maxlength="64">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm mb-1">Nama Wakil Walikota</label>
                        <input type="text" name="nama_wakil_walikota" class="w-full border rounded px-3 py-2" maxlength="64">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm mb-1">Foto Walikota</label>
                        <input type="file" name="foto_walikota" accept="image/*" class="w-full">
                        <small class="text-gray-500">Format: JPG, PNG, maksimal 2MB</small>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm mb-1">Foto Wakil Walikota</label>
                        <input type="file" name="foto_wakil_walikota" accept="image/*" class="w-full">
                        <small class="text-gray-500">Format: JPG, PNG, maksimal 2MB</small>
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
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md max-h-screen overflow-y-auto">
                <h2 class="text-xl font-bold mb-4">Edit Konten Pemerintah</h2>
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-sm mb-1">Periode</label>
                        <input type="text" id="editPeriode" disabled class="w-full border rounded px-3 py-2 bg-gray-100">
                        <small class="text-gray-500">Periode tidak dapat diubah</small>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm mb-1">Nama Walikota <span class="text-red-500">*</span></label>
                        <input type="text" id="editNamaWalikota" name="nama_walikota" required 
                               class="w-full border rounded px-3 py-2" maxlength="64">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm mb-1">Nama Wakil Walikota</label>
                        <input type="text" id="editNamaWakilWalikota" name="nama_wakil_walikota" 
                               class="w-full border rounded px-3 py-2" maxlength="64">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm mb-1">Foto Walikota Baru</label>
                        <input type="file" name="foto_walikota" accept="image/*" class="w-full">
                        <small class="text-gray-500">Kosongkan jika tidak ingin mengubah foto</small>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm mb-1">Foto Wakil Walikota Baru</label>
                        <input type="file" name="foto_wakil_walikota" accept="image/*" class="w-full">
                        <small class="text-gray-500">Kosongkan jika tidak ingin mengubah foto</small>
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

    function openEditModal(periode, namaWalikota, namaWakilWalikota) {
        document.getElementById('editPeriode').value = periode;
        document.getElementById('editNamaWalikota').value = namaWalikota || '';
        document.getElementById('editNamaWakilWalikota').value = namaWakilWalikota || '';

        const form = document.getElementById('editForm');
        form.action = `/admin/pemerintah/${periode}`;

        document.getElementById('editContentModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editContentModal').classList.add('hidden');
    }

    // Show success/error messages if any
    @if(session('success'))
        alert('{{ session('success') }}');
    @endif

    @if(session('error'))
        alert('{{ session('error') }}');
    @endif
</script>

</body>
</html>