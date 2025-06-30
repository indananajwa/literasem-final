<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Edit Kategori</title>
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
      <h2 class="text-xl font-semibold mb-4 text-gray-800">Edit Kategori</h2>

      <form action="{{ route('kategori.update', $kategori->kode_kategori) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Kode Kategori (readonly) -->
        <div>
          <label for="kode_kategori" class="block text-sm font-medium text-gray-700 mb-1">Kode Kategori</label>
          <input type="text" id="kode_kategori" name="kode_kategori" value="{{ $kategori->kode_kategori }}" readonly
            class="w-full bg-gray-100 border border-gray-300 rounded-lg px-3 py-2">
        </div>

        <!-- Nama Kategori -->
        <div>
          <label for="nama_kategori" class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
          <input type="text" id="nama_kategori" name="nama_kategori" value="{{ $kategori->nama_kategori }}" required
            class="w-full border border-gray-300 rounded-lg px-3 py-2">
        </div>

        <!-- Deskripsi -->
        <div>
          <label for="deskripsi_kategori" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
          <textarea id="deskripsi_kategori" name="deskripsi_kategori" rows="3"
            class="w-full border border-gray-300 rounded-lg px-3 py-2">{{ $kategori->deskripsi_kategori }}</textarea>
        </div>

        <!-- Gambar Cover -->
        <div>
          <label for="gambar_cover" class="block text-sm font-medium text-gray-700 mb-1">Ganti Gambar Cover</label>
          <input type="file" id="gambar_cover" name="gambar_cover" accept="image/*"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-red-700 file:text-white hover:file:bg-red-600">

          @if($kategori->gambar_cover)
            <p class="mt-2 text-sm text-gray-500">Gambar saat ini:</p>
            <img src="data:{{ $kategori->mime_type }};base64,{{ base64_encode($kategori->gambar_cover) }}" class="h-40 mt-2 rounded">
          @endif
        </div>

        <!-- Aturan Field -->
        <div>
          <h3 class="text-lg font-medium text-gray-800 mb-3">Aturan Field Konten</h3>
          <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 text-center text-sm">
              <thead class="bg-gray-100 text-gray-600">
                <tr>
                  <th class="text-left px-4 py-2 border-b">Field</th>
                  <th class="px-4 py-2 border-b">Wajib</th>
                  <th class="px-4 py-2 border-b">Opsional</th>
                  <th class="px-4 py-2 border-b">Tidak Digunakan</th>
                </tr>
              </thead>
              <tbody class="text-gray-700">
                @php
                  $fields = ['title' => 'Judul', 'description' => 'Deskripsi', 'image' => 'Gambar', 'video_url' => 'Video'];
                  $currentRules = json_decode($kategori->field_rules, true) ?? [];
                @endphp
                @foreach ($fields as $key => $label)
                <tr class="hover:bg-gray-50">
                  <td class="text-left px-4 py-2 font-medium border-t">{{ $label }}</td>
                  <td class="py-2 border-t">
                    <input type="radio" name="field_rules[{{ $key }}]" value="required"
                      {{ ($currentRules[$key] ?? '') === 'required' ? 'checked' : '' }}>
                  </td>
                  <td class="py-2 border-t">
                    <input type="radio" name="field_rules[{{ $key }}]" value="optional"
                      {{ ($currentRules[$key] ?? '') === 'optional' ? 'checked' : '' }}>
                  </td>
                  <td class="py-2 border-t">
                    <input type="radio" name="field_rules[{{ $key }}]" value="not_used"
                      {{ ($currentRules[$key] ?? '') === 'not_used' ? 'checked' : '' }}>
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


        <!-- Submit Button -->
        <div class="text-end">
          <button type="submit"
            class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-6 rounded-lg shadow transition">
            Simpan Perubahan
          </button>
        </div>
      </form>
    </div>
  </div>

</body>
</html>
