<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Edit Konten - {{ $kategori->nama_kategori }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-gray-50 flex min-h-screen">

  <!-- Sidebar -->
  <aside class="w-64 bg-white border-r border-gray-200">
    @include('admin.layouts.sidebar')
  </aside>

  <!-- Main Content -->
  <div class="flex-1 p-6 flex flex-col">
    @include('admin.layouts.header')

    <!-- Judul -->
    <div class="mb-6">
      <h1 class="text-2xl font-bold text-gray-800">Edit Konten - {{ $kategori->nama_kategori }}</h1>
    </div>

    <!-- Modal Box -->
    <div class="bg-white rounded-xl p-6 w-full max-w-3xl shadow mx-auto">
      <a href="{{ route('admin.konten.index', $kategori->kode_kategori) }}" 
         class="absolute top-4 right-6 text-gray-500 hover:text-gray-800 text-2xl font-bold">&times;</a>

      <h2 class="text-xl font-semibold mb-5 text-gray-800">Form Edit Konten</h2>

      <form action="{{ route('admin.konten.update', [$kategori->kode_kategori, $konten->kode_konten]) }}" 
            method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        @foreach($fieldRules as $field => $rule)
          @if($rule === 'required' || $rule === 'optional')
            <div>
              <label for="{{ $field }}" class="block text-sm font-medium text-gray-700 capitalize mb-1">
                {{ str_replace('_', ' ', $field) }}
              </label>

              @php $value = old($field, $konten->$field); @endphp

              {{-- Deskripsi --}}
              @if($field === 'deskripsi')
                <textarea name="{{ $field }}" rows="4" 
                          class="mt-1 p-2 w-full border border-gray-300 rounded-md"
                          @if($rule === 'required') required @endif>{{ $value }}</textarea>

              {{-- Gambar --}}
              @elseif($field === 'gambar')
                @if($konten->gambar)
                  <div class="mb-2">
                    <img src="data:{{ $konten->mime_type }};base64,{{ base64_encode($konten->gambar) }}" 
                         alt="Gambar" class="w-32 h-32 object-cover rounded-md mb-2">
                  </div>
                @endif
                <input type="file" name="gambar" accept="image/*" 
                       class="block w-full text-sm text-gray-700 border border-gray-300 rounded-md p-1">

              {{-- Video URL --}}
              @elseif($field === 'video_url')
                @if($konten->video_url)
                  <div class="mb-2">
                    <video width="200" height="120" controls class="rounded-md">
                      <source src="{{ $konten->video_url }}">
                      Browser tidak mendukung video.
                    </video>
                  </div>
                @endif
                <input type="url" name="video_url" 
                       value="{{ old('video_url', $konten->video_url) }}" 
                       class="mt-1 p-2 w-full border border-gray-300 rounded-md">

              {{-- Input default --}}
              @else
                <input type="text" name="{{ $field }}" value="{{ $value }}" 
                       class="mt-1 p-2 w-full border border-gray-300 rounded-md"
                       @if($rule === 'required') required @endif>
              @endif
            </div>
          @endif
        @endforeach

        <!-- Buttons -->
        <div class="flex justify-end space-x-3 pt-4">
          <a href="{{ route('admin.konten.index', $kategori->kode_kategori) }}"
             class="px-5 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-full hover:bg-gray-200 transition">
            Batal
          </a>
          <button type="submit"
                  class="px-5 py-2 text-sm font-medium text-white rounded-full bg-gradient-to-r from-blue-600 to-blue-800 hover:opacity-90 transition">
            <i class="fas fa-save mr-2"></i> Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
