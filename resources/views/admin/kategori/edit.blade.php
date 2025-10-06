<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Kategori</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
    .upload-area {
      background: #f5f5f5;
      border: 2px dashed #ccc;
      transition: all 0.3s;
    }
    .upload-area:hover {
      border-color: #991B1B;
      background: #fef2f2;
    }
    .bg-red-gradient {
      background: linear-gradient(to right, #991B1B, #330909);
    }
  </style>
</head>
<body class="bg-gray-50">
<div class="flex min-h-screen">
  <!-- Sidebar -->
  <aside class="w-64 bg-gray-800 text-white min-h-screen">
    @include('admin.layouts.sidebar')
  </aside>

  <!-- Main -->
  <div class="flex-1 ">
    <div class="px-6 py-4">
    <!-- Header -->
     @include('admin.layouts.header')

    <div class="mb-6">
      <a href="{{ route('admin.kategori.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 mb-4 text-sm">
        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Kategori
      </a>
      <h1 class="text-2xl font-bold text-gray-900 flex items-center">
        Edit Kategori Konten
      </h1>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow-sm">
      <!-- Header Card -->
      <div class="bg-red-gradient text-white px-6 py-4 rounded-t-lg">
        <h2 class="text-lg font-semibold">Edit Kategori</h2>
      </div>

      <!-- Form -->
      <form id="formKategori" action="{{ route('admin.kategori.update', $kategori->kode_kategori) }}" 
            method="POST" enctype="multipart/form-data" class="p-6">
        @csrf
        @method('PUT')

        <!-- Alert Error -->
        @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
          <div class="flex items-center mb-2">
            <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
            <h3 class="text-red-800 font-semibold">Terjadi Kesalahan:</h3>
          </div>
          <ul class="list-disc list-inside text-red-700 text-sm">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <!-- Info -->
        <p class="text-red-600 text-sm font-medium mb-4">* Semua field wajib diisi</p>

        <!-- Upload Gambar Cover -->
        <div class="mb-8">
          <label class="block text-sm font-medium text-gray-700 mb-3">
            Gambar Cover <span class="text-red-600">*</span>
          </label>
          <div class="upload-area rounded-lg p-12 text-center cursor-pointer" onclick="document.getElementById('gambar_cover').click()">
            <div id="preview-container" class="{{ $kategori->gambar_cover ? '' : 'hidden' }}">
              @if($kategori->gambar_cover)
    <img id="preview-image" 
         src="{{ route('kategori.cover', $kategori->kode_kategori) }}" 
         class="max-h-64 mx-auto rounded-lg mb-4">
@endif

            </div>
            <div id="upload-placeholder" class="{{ $kategori->gambar_cover ? 'hidden' : '' }}">
              <i class="fas fa-cloud-upload-alt text-gray-400 text-5xl mb-4"></i>
              <p class="text-gray-600 font-medium">Pilih Gambar Cover</p>
              <p class="text-gray-400 text-sm mt-2">PNG, JPG hingga 10MB</p>
            </div>
            <input type="file" id="gambar_cover" name="gambar_cover" accept="image/*" class="hidden">
          </div>
        </div>

        <!-- Nama Kategori -->
        <div class="mb-6">
          <label for="nama_kategori" class="block text-sm font-medium text-gray-700 mb-2">
            Nama Kategori <span class="text-red-600">*</span>
          </label>
          <input type="text" id="nama_kategori" name="nama_kategori" 
                 value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required
                 class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500">
        </div>

        <!-- Kode Kategori -->
        <div class="mb-6">
          <label for="kode_kategori" class="block text-sm font-medium text-gray-700 mb-2">
            Kode Kategori (3 huruf) <span class="text-red-600">*</span>
          </label>
          <input type="text" id="kode_kategori" name="kode_kategori" 
                 value="{{ $kategori->kode_kategori }}" readonly
                 class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-gray-100 text-gray-600">
        </div>

        <!-- Judul Kategori -->
        <div class="mb-6">
          <label for="judul_kategori" class="block text-sm font-medium text-gray-700 mb-2">
            Judul Kategori <span class="text-red-600">*</span>
          </label>
          <input type="text" id="judul_kategori" name="judul_kategori" 
                 value="{{ old('judul_kategori', $kategori->judul_kategori) }}" required
                 class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500">
        </div>

        <!-- Deskripsi -->
        <div class="mb-8">
          <label for="deskripsi_kategori" class="block text-sm font-medium text-gray-700 mb-2">
            Deskripsi <span class="text-red-600">*</span>
          </label>
          <textarea id="deskripsi_kategori" name="deskripsi_kategori" rows="4" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500"
                    placeholder="Deskripsikan kategori ini secara singkat...">{{ old('deskripsi_kategori', $kategori->deskripsi_kategori) }}</textarea>
        </div>

        <!-- Aturan Field -->
        <div class="bg-red-gradient text-white px-6 py-3 -mx-6 mb-6">
          <h3 class="font-semibold">Aturan Field</h3>
        </div>

        <div class="mb-8">
          <div class="overflow-x-auto">
            <table class="min-w-full">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border-b">Field</th>
                  <th class="px-6 py-3 text-center text-sm font-medium text-gray-700 border-b">Wajib</th>
                  <th class="px-6 py-3 text-center text-sm font-medium text-gray-700 border-b">Opsional</th>
                  <th class="px-6 py-3 text-center text-sm font-medium text-gray-700 border-b">Tidak Digunakan</th>
                </tr>
              </thead>
              <tbody class="bg-white">
                @php
                  $fields = ['judul' => 'Judul', 'deskripsi' => 'Deskripsi', 'gambar' => 'Gambar', 'video_url' => 'Video'];
                @endphp
                @foreach ($fields as $key => $label)
                <tr class="hover:bg-gray-50">
                  <td class="px-6 py-4 text-sm text-gray-900 border-b">{{ $label }}</td>
                  <td class="px-6 py-4 text-center border-b">
                    <input type="radio" name="field_rules[{{ $key }}]" value="required"
                           {{ ($kategori->field_rules[$key] ?? '') === 'required' ? 'checked' : '' }}>
                  </td>
                  <td class="px-6 py-4 text-center border-b">
                    <input type="radio" name="field_rules[{{ $key }}]" value="optional"
                           {{ ($kategori->field_rules[$key] ?? '') === 'optional' ? 'checked' : '' }}>
                  </td>
                  <td class="px-6 py-4 text-center border-b">
                    <input type="radio" name="field_rules[{{ $key }}]" value="not_used"
                           {{ ($kategori->field_rules[$key] ?? '') === 'not_used' ? 'checked' : '' }}>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <!-- Opsi Tampilan -->
        <div class="bg-red-gradient text-white px-6 py-3 -mx-6 mb-6">
          <h3 class="font-semibold">Opsi Tampilan</h3>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-8">
          <label class="cursor-pointer">
            <input type="radio" name="field_rules[tampilan]" value="0" class="hidden peer"
                   {{ ($kategori->field_rules['tampilan'] ?? '') == '0' ? 'checked' : '' }}>
            <div class="border-2 border-gray-300 peer-checked:border-red-600 peer-checked:bg-red-50 rounded-lg p-4">
              <div class="bg-gray-200 h-40 rounded-lg mb-3 flex items-center justify-center">
                <i class="fas fa-image text-gray-400 text-4xl"></i>
              </div>
              <p class="text-center text-sm font-medium">Tampilan 1</p>
            </div>
          </label>

          <label class="cursor-pointer">
            <input type="radio" name="field_rules[tampilan]" value="1" class="hidden peer"
                   {{ ($kategori->field_rules['tampilan'] ?? '') == '1' ? 'checked' : '' }}>
            <div class="border-2 border-gray-300 peer-checked:border-red-600 peer-checked:bg-red-50 rounded-lg p-4">
              <div class="bg-gray-200 h-40 rounded-lg mb-3 flex items-center justify-center">
                <i class="fas fa-image text-gray-400 text-4xl"></i>
              </div>
              <p class="text-center text-sm font-medium">Tampilan 2</p>
            </div>
          </label>
        </div>

        <!-- Buttons -->
        <div class="flex justify-end space-x-3">
          <a href="{{ route('admin.kategori.index') }}"
             class="px-5 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-full hover:bg-gray-200 transition">
            Batal
          </a>
          <button type="submit"
            class="px-5 py-2 text-sm font-medium text-white rounded-full bg-gradient-to-r from-[#991B1B] to-[#330909] hover:opacity-90 transition">
            <i class="fas fa-save mr-2"></i> Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Preview gambar
document.getElementById('gambar_cover').addEventListener('change', function(e) {
  const file = e.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function(e) {
      document.getElementById('preview-image').src = e.target.result;
      document.getElementById('preview-container').classList.remove('hidden');
      document.getElementById('upload-placeholder').classList.add('hidden');
    }
    reader.readAsDataURL(file);
  }
});
</script>
</body>
</html>
