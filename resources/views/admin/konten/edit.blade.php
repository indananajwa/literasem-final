<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Edit Konten - Kategori {{ $kategori->nama_kategori }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-white flex min-h-screen">

  <!-- Sidebar -->
  <aside class="w-64 bg-white text-white min-h-screen">
    @include('admin.layouts.sidebar')
  </aside>

  <!-- Main Content -->
  <div class="flex-1 p-6 flex flex-col">
    @include('admin.layouts.header')

    <!-- Judul -->
    <div class="mb-6">
      <h1 class="text-3xl font-bold text-gray-800">Edit Konten - Kategori: {{ $kategori->nama_kategori }}</h1>
    </div>

    <div id="editContentModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-xl p-6 w-full max-w-lg relative max-h-[90vh] overflow-auto">
        <a href="{{ route('admin.konten.index', $kategori->kode_kategori) }}" 
           class="absolute top-2 right-3 text-gray-500 hover:text-gray-800 text-2xl font-bold">&times;</a>
        <h2 class="text-xl font-semibold mb-5 text-gray-800">Edit Konten</h2>

        <form action="{{ route('admin.konten.update', $konten->kode_konten) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
          @csrf
          @method('PUT')

          @foreach($fieldRules as $field => $rule)
            @if($rule === 'required' || $rule === 'optional')
              <div>
                <label for="{{ $field }}" class="block text-sm font-medium text-gray-700 capitalize mb-1">{{ $field }}</label>

                @php $value = old($field, $konten->$field); @endphp

                @if($field === 'deskripsi')
                  <textarea name="{{ $field }}" rows="4" class="mt-1 p-2 w-full border border-gray-300 rounded-md" @if($rule === 'required') required @endif>{{ $value }}</textarea>

                @elseif($field === 'gambar')
                  @if($konten->gambar)
                    <div class="mb-2">
                      <img src="{{ route('admin.konten.gambar', $konten->kode_konten) }}" alt="Gambar" class="w-32 h-32 object-cover rounded-md mb-2">
                    </div>
                  @endif
                  <input type="file" name="gambar" accept="image/*" class="block w-full text-sm text-gray-700 border border-gray-300 rounded-md p-1">

                @elseif($field === 'video_url')
                  @if($konten->video_url)
                    <div class="mb-2">
                      <video width="200" height="120" controls class="mb-2">
                        <source src="{{ $konten->video_url }}">
                        Browser tidak mendukung video.
                      </video>
                    </div>
                  @endif
                  <input type="url" name="video_url" value="{{ old('video_url', $konten->video_url) }}" class="mt-1 p-2 w-full border border-gray-300 rounded-md">

                @else
                  <input type="text" name="{{ $field }}" value="{{ $value }}" class="mt-1 p-2 w-full border border-gray-300 rounded-md" @if($rule === 'required') required @endif>
                @endif
              </div>
            @endif
          @endforeach

          <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-md">
            Update Konten
          </button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
