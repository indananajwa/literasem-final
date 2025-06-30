<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Tambah Kategori</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gray-100 flex">

  <!-- Sidebar -->
  <aside class="w-64 bg-gray-800 text-white min-h-screen">
    @include('admin.layouts.sidebar')
  </aside>

  <!-- Main Content -->
  <div class="flex-1 p-6">
    @include('admin.layouts.header')

    <div class="bg-white rounded-xl shadow p-6">
      <h2 class="text-xl font-semibold mb-4 text-gray-800">Tambah Kategori</h2>

      <form action="{{ route('admin.kategori.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf

    <!-- Kode Kategori -->
    <div>
        <label for="kode_kategori" class="block text-sm font-medium text-gray-700 mb-1">Kode Kategori (3 huruf)</label>
        <input type="text" id="kode_kategori" name="kode_kategori" maxlength="3" required
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <!-- Nama Kategori -->
    <div>
        <label for="nama_kategori" class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
        <input type="text" id="nama_kategori" name="nama_kategori" required
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <!-- Deskripsi -->
    <div>
        <label for="deskripsi_kategori" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
        <textarea id="deskripsi_kategori" name="deskripsi_kategori" rows="3"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Deskripsikan kategori ini secara singkat..."></textarea>
    </div>

    <!-- Gambar Cover -->
    <div>
        <label for="gambar_cover" class="block text-sm font-medium text-gray-700 mb-1">Gambar Cover</label>
        <input type="file" id="gambar_cover" name="gambar_cover" accept="image/*"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-red-700 file:text-white hover:file:bg-red-600">
    </div>

    <!-- Field Rules -->
    <div>
        <h3 class="text-lg font-medium text-gray-800 mb-3">Aturan Field Konten</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 text-center text-sm">
                <thead class="bg-gray-100 text-gray-600">
                    <tr>
                        <th class="text-left px-4 py-2 font-semibold border-b border-gray-200">Field</th>
                        <th class="px-4 py-2 border-b border-gray-200">Wajib</th>
                        <th class="px-4 py-2 border-b border-gray-200">Opsional</th>
                        <th class="px-4 py-2 border-b border-gray-200">Tidak Digunakan</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @php
                        $fields = ['title' => 'Judul', 'description' => 'Deskripsi', 'image' => 'Gambar', 'video_url' => 'Video'];
                    @endphp
                    @foreach ($fields as $key => $label)
                    <tr class="hover:bg-gray-50">
                        <td class="text-left px-4 py-2 font-medium border-t border-gray-200">{{ $label }}</td>
                        <td class="py-2 border-t border-gray-200">
                            <input type="radio" name="field_rules[{{ $key }}]" value="required" required>
                        </td>
                        <td class="py-2 border-t border-gray-200">
                            <input type="radio" name="field_rules[{{ $key }}]" value="optional">
                        </td>
                        <td class="py-2 border-t border-gray-200">
                            <input type="radio" name="field_rules[{{ $key }}]" value="not_used">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Opsi -->
     <div class="mb-4">
          <label for="tampilan" class="block mb-1">Tampilan</label>
          <select name="tampilan" id="tampilan" class="w-full border p-2 rounded">
              <option value="">Pilih Tampilan</option>
              <option value="1" {{ old('tampilan', $kategori->tampilan ?? '') == 1 ? 'selected' : '' }}>Tampilan 1</option>
              <option value="2" {{ old('tampilan', $kategori->tampilan ?? '') == 2 ? 'selected' : '' }}>Tampilan 2</option>
          </select>
      </div>


    <!-- Submit -->
    <div class="text-end">
        <button type="submit"
            class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-6 rounded-lg shadow transition duration-150">
            Simpan Kategori
        </button>
    </div>
</form>

    </div>
  </div>

  <!-- SweetAlert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @if(session('success'))
    <script>
      Swal.fire({
        title: "Berhasil!",
        text: "{{ session('success') }}",
        icon: "success",
      });
    </script>
  @endif

  @if(session('error'))
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Oops!',
        text: '{{ session('error') }}',
      });
    </script>
  @endif

</body>
</html>
