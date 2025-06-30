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
  <aside class="w-64 bg-red-800 text-white min-h-screen">
    @include('admin.layouts.sidebar')
  </aside>
  <div class="flex-1 p-4">
    @include('admin.layouts.header')
    <div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">

      <h1 class="text-3xl font-bold mb-4 text-center text-red-800">
        Manajemen Konten {{ $kategori->nama_kategori }}
      </h1>

      {{-- Detail Konten jika tersedia --}}
      @isset($kontenDetail)
        <div class="bg-blue-50 p-4 rounded-md border border-blue-200 mb-6">
          <h3 class="text-lg font-semibold mb-3 text-blue-800">
            Detail Konten: {{ $kontenDetail->judul ?? '-' }}
          </h3>
          <div class="space-y-2 text-gray-700 text-sm">
            <div>
              <strong>Judul:</strong> {{ $kontenDetail->judul ?? '-' }}
            </div>
            <div>
              <strong>Deskripsi:</strong> {{ $kontenDetail->deskripsi ?? '-' }}
            </div>
            <div>
              <strong>Gambar:</strong><br>
              @if($kontenDetail->gambar)
                <img src="{{ route('admin.konten.gambar', $kontenDetail->kode_konten) }}" class="w-32 mt-1 rounded border">
              @else
                <em class="text-gray-500">Tidak ada gambar</em>
              @endif
            </div>
            <div>
              <strong>Video:</strong><br>
              @if($kontenDetail->video_url)
                <video width="320" height="180" controls class="mt-1">
                  <source src="{{ $kontenDetail->video_url }}">
                  Video tidak dapat diputar.
                </video>
              @else
                <span class="text-gray-500">Tidak ada video</span>
              @endif
            </div>
          </div>
          <a href="{{ route('admin.konten.index', ['kode_kategori' => $konten->kode_kategori, 'kode_konten' => $konten->kode_konten]) }}" class="inline-block mt-4 text-blue-600 hover:underline text-sm">← Kembali ke daftar konten</a>
        </div>
      @endisset

      {{-- Tombol Tambah --}}
      <button onclick="openAddModal()" class="bg-red-800 text-white px-4 py-2 rounded hover:bg-red-700 mb-4">+ Tambah Konten</button>

      {{-- Tabel Konten --}}
      <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow rounded table-auto">
          <thead class="bg-red-800 text-white">
            <tr>
              <th class="px-6 py-3 text-left">No</th>
              <th class="px-6 py-3 text-left">Gambar</th>
              <th class="px-6 py-3 text-left">Judul</th>
              <th class="px-6 py-3 text-left">Deskripsi</th>
              <th class="px-6 py-3 text-left">Video</th>
              <th class="px-6 py-3 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($kontenList ?? $konten as $index => $item)
              <tr class="border-b hover:bg-gray-50 text-sm text-gray-700">
                <td class="px-6 py-3">{{ $index + 1 }}</td>
                <td class="px-6 py-3">
                  @if($item->gambar)
                    <img src="data:{{ $item->mime_type }};base64,{{ base64_encode($item->gambar) }}" class="w-12 h-12 object-cover rounded-md">
                  @else
                    <span class="text-gray-400 italic">-</span>
                  @endif
                </td>
                <td class="px-6 py-3">{{ $item->judul }}</td>
                <td class="px-6 py-3">{{ \Illuminate\Support\Str::limit($item->deskripsi, 50) }}</td>
                <td class="px-6 py-3">
                  @if($item->video_url)
                    <video width="160" height="90" controls>
                      <source src="{{ $item->video_url }}">
                      Video tidak dapat diputar.
                    </video>
                  @else
                    <span class="text-gray-400 italic">-</span>
                  @endif
                </td>
                <td class="px-6 py-3 text-center whitespace-nowrap">
                    <a href="{{ route('pengunjung.kategori') }}" class="text-blue-600 mr-3 hover:underline text-sm" target="_blank">Lihat</a>


                  <form action="{{ route('admin.konten.destroy', [  'kode_kategori' => $item->kode_kategori, 'kode_konten' => $item->kode_konten ]) }}" method="POST" onsubmit="return confirm('Yakin?')" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 text-sm hover:underline">Hapus</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-center py-6 text-gray-500 italic">Belum ada konten.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      {{-- Modal Tambah --}}
      <div id="addContentModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
          <h2 class="text-xl font-bold mb-4">Tambah Konten</h2>
          <form action="{{ route('admin.konten.store', $kategori->kode_kategori) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
              <label class="block text-sm mb-1">Judul</label>
              <input type="text" name="judul" required class="w-full border rounded px-3 py-2">
            </div>
            <div class="mb-4">
              <label class="block text-sm mb-1">Deskripsi</label>
              <textarea name="deskripsi" rows="3" class="w-full border rounded px-3 py-2"></textarea>
            </div>
            <div class="mb-4">
              <label class="block text-sm mb-1">Gambar</label>
              <input type="file" name="gambar" class="w-full">
            </div>
            <div class="mb-4">
              <label class="block text-sm mb-1">Video URL</label>
              <input type="url" name="video_url" class="w-full border rounded px-3 py-2">
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    function openAddModal() { document.getElementById('addContentModal').classList.remove('hidden'); }
    function closeAddModal() { document.getElementById('addContentModal').classList.add('hidden'); }
  </script>
</body>
