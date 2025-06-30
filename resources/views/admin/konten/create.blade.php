<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Tambah Konten - Kategori {{ $kategori->nama_kategori }}</title>
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

    <!-- Judul Section -->
    <div class="mb-6">
      <h1 class="text-3xl font-bold text-gray-800">Kategori: {{ $kategori->nama_kategori }}</h1>
    </div>

    <!-- Konten -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
      <div class="flex justify-between items-center mb-4">
        <h4 class="text-lg font-semibold text-gray-700">Daftar Konten</h4>
        <button onclick="openModal()" class="bg-red-800 text-white px-4 py-2 rounded hover:bg-red-600 text-sm">+ Tambah Konten</button>
      </div>

      <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 text-sm text-gray-700">
          <thead class="bg-gray-100 text-left">
            <tr>
              <th class="px-4 py-3 border">No</th>
              @php
                $fieldLabels = [
                  'judul' => 'Judul',
                  'deskripsi' => 'Deskripsi',
                  'gambar' => 'Gambar',
                  'video_url' => 'Video',
                ];
              @endphp
              @foreach($fieldRules as $field => $rule)
                @if($rule !== 'not_used')
                  <th class="px-4 py-3 border">{{ $fieldLabels[$field] ?? ucfirst($field) }}</th>
                @endif
              @endforeach
              <th class="px-4 py-3 border">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($konten as $index => $konten)
              <tr class="hover:bg-gray-50">
                <td class="px-4 py-2 border align-top">{{ $index + 1 }}</td>
                @foreach($fieldRules as $field => $rule)
                  @if($rule !== 'not_used')
                    <td class="px-4 py-2 border align-top">
                      @if($field === 'gambar')
                        @if($konten->gambar)
                          <img src="{{ route('admin.konten.gambar', $konten->kode_konten) }}" alt="Gambar" class="w-16 h-16 object-cover rounded-md">
                        @else
                          <span class="text-gray-400 italic">-</span>
                        @endif
                      @elseif($field === 'video_url')
                        @if($konten->$field)
                          <video width="160" height="90" controls>
                            <source src="{{ $konten->$field }}">
                            Video tidak dapat diputar.
                          </video>
                        @else
                          <span class="text-gray-400 italic">-</span>
                        @endif
                      @else
                        {{ $konten->$field ?? '-' }}
                      @endif
                    </td>
                  @endif
                @endforeach
                <td class="px-4 py-2 border align-top whitespace-nowrap">
                  {{-- Edit dan Hapus --}}
                  {{-- Jika butuh edit, buatkan route edit --}}
                  <form action="{{ route('admin.konten.destroy', ['kode_kategori' => $konten->kode_kategori, 'kode_konten' => $konten->kode_konten]) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus konten ini?')">
                    @method('DELETE')
                    <button type="submit" class="text-red-600 font-medium hover:underline">Hapus</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="{{ count(array_filter($fieldRules, fn($rule) => $rule !== 'not_used')) + 2 }}" class="text-center py-6 text-gray-500 italic">
                  Belum ada konten.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <!-- Modal Tambah Konten -->
    <div id="contentModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
      <div class="bg-white rounded-xl p-6 w-full max-w-lg relative max-h-[90vh] overflow-auto">
        <button onclick="closeModal()" class="absolute top-2 right-3 text-gray-500 hover:text-gray-800 text-2xl font-bold">&times;</button>
        <h2 class="text-xl font-semibold mb-5 text-gray-800">Tambah Konten</h2>

        <form action="{{ route('admin.konten.store', $kategori->kode_kategori) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
          @csrf
          @foreach($fieldRules as $field => $rule)
            @if($rule === 'required' || $rule === 'optional')
              <div>
                <label for="{{ $field }}" class="block text-sm font-medium text-gray-700 capitalize mb-1">{{ $field }}</label>

                @if($field === 'deskripsi')
                  <textarea name="{{ $field }}" rows="4" class="mt-1 p-2 w-full border border-gray-300 rounded-md" @if($rule === 'required') required @endif></textarea>
                @elseif($field === 'gambar')
                  <input type="file" name="gambar" accept="image/*" class="block w-full text-sm border border-gray-300 rounded-md p-1" @if($rule === 'required') required @endif>
                @elseif($field === 'video_url')
                  <input type="file" name="video_url" placeholder="https://example.com/video.mp4" class="mt-1 p-2 w-full border border-gray-300 rounded-md" @if($rule === 'required') required @endif>
                @else
                  <input type="text" name="{{ $field }}" class="mt-1 p-2 w-full border border-gray-300 rounded-md" @if($rule === 'required') required @endif>
                @endif
              </div>
            @endif
          @endforeach

          <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-md">
            Simpan Konten
          </button>
        </form>
      </div>
    </div>

  </div>

  <script>
    function openModal() {
      document.getElementById('contentModal').classList.remove('hidden');
    }
    function closeModal() {
      document.getElementById('contentModal').classList.add('hidden');
    }
  </script>

</body>
</html>
