<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Manajemen Konten - Pariwisata</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gray-50">
<div class="flex min-h-screen">
  <!-- Sidebar -->
  <aside class="w-64 bg-gray-800 text-white min-h-screen">
    @include('admin.layouts.sidebar')
  </aside>

  <!-- Main -->
  <div class="flex-1">
    <div class="px-6 py-4">
      <!-- Header -->
      @include('admin.layouts.header')

      <!-- Header Section -->
    <div >
      <!-- Back Button -->
      <a href="{{ route('admin.kategori.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 mb-4 text-sm">
        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Kategori
      </a>

      <!-- Header Section -->
      <div class="flex justify-between items-center mb-8 max-w-6xl mx-auto">
        <div class="flex items-center">
          <h1 class="text-2xl font-bold text-gray-900">Manajemen Konten Pariwisata</h1>
          <i class="fas fa-info-circle text-gray-400 ml-2 cursor-help" title="Kelola konten pariwisata"></i>
        </div>
      </div>

      <!-- Search & Actions -->
      <div class="flex justify-between items-center mb-6">
        <div class="relative w-72">
          <i class="fas fa-search absolute left-4 top-3 text-gray-400"></i>
          <input 
            type="text" 
            id="searchInput"
            placeholder="Cari konten pariwisata..." 
            class="w-full pl-12 pr-4 py-2 rounded-full border border-gray-300 focus:ring-2 focus:ring-red-500 focus:outline-none text-sm"
          >
        </div>

        <div class="flex space-x-3">
          <a href="{{ route('pariwisata.index') }}" target="_blank"
             class="px-5 py-2 text-sm font-medium text-white rounded-full bg-gradient-to-r from-[#F1DF40] to-[#8B8125] hover:opacity-90 transition flex items-center">            <i class="far fa-eye mr-2"></i> Preview
          </a>
          <button onclick="openAddModal()" 
                  class="px-5 py-2 text-sm font-medium text-white rounded-full bg-gradient-to-r from-[#991B1B] to-[#330909] hover:opacity-90 transition flex items-center">
            <span class="mr-1">+</span> Tambah
          </button>
        </div>
      </div>

      <!-- Total Konten Badge -->
      <div class="mb-6">
        <div class="inline-flex items-center bg-white px-4 py-2 rounded-full border border-gray-200 text-sm">
          <span class="text-gray-600">Total Konten:</span>
          <span class="ml-2 font-semibold text-gray-900">{{ $pariwisataList->count() }}</span>
          <i class="fas fa-map-marker-alt ml-2 text-gray-400"></i>
        </div>
      </div>

      <!-- Content Cards Grid -->
      <div class="space-y-4" id="contentGrid">
        @forelse($pariwisataList as $index => $item)
          <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition p-4 content-item">
            <div class="flex items-start space-x-4">
              <!-- Thumbnail -->
                <div class="flex-shrink-0">
                @if($item->foto)
                    <img src="data:{{ $item->mime_type }};base64,{{ base64_encode($item->foto) }}" 
                        alt="Foto {{ $item->nama }}" 
                        class="w-32 h-24 object-cover rounded-lg border border-gray-200">
                @else
                    <div class="w-32 h-24 bg-gray-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-image text-gray-400 text-2xl"></i>
                    </div>
                @endif
                </div>


              <!-- Content Info -->
              <div class="flex-1 min-w-0">
                <h3 class="text-lg font-semibold text-red-800 mb-1 content-title">{{ $item->nama }}</h3>
                <p class="text-sm text-gray-600 mb-3 content-desc">{{ \Illuminate\Support\Str::limit($item->deskripsi, 80) }}</p>
                
                <!-- Tags -->
                <div class="flex flex-wrap gap-2">
                  <span class="px-3 py-1 bg-gray-100 text-gray-700 text-xs rounded-full">Lat: {{ $item->lat }}</span>
                  <span class="px-3 py-1 bg-gray-100 text-gray-700 text-xs rounded-full">Lng: {{ $item->lng }}</span>
                  <a href="{{ $item->url_maps }}" target="_blank" 
                     class="px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded-full">Maps</a>
                </div>
              </div>

              <!-- Actions -->
              <div class="flex flex-col items-end justify-between h-full">
                <div class="flex items-center space-x-2">
                  <span class="text-xs text-gray-500">
                      {{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('d M Y') : '' }}
                  </span>
                  <div class="relative dropdown-container">
                    <button 
                      type="button" 
                      onclick="toggleDropdown({{ $index }})" 
                      class="dropdown-toggle text-gray-400 hover:text-gray-600 p-1" 
                      title="More options">
                      <i class="fas fa-ellipsis-v"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="dropdown-{{ $index }}" class="dropdown-menu hidden absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg border border-gray-200 z-10">
                      <button type="button" onclick="openEditModal({{ $item->id }}, '{{ $item->nama }}', `{{ $item->deskripsi }}`, '{{ $item->url_maps }}', '{{ $item->lat }}', '{{ $item->lng }}')" 
                              class="w-full text-left px-4 py-2 hover:bg-gray-50 flex items-center text-sm text-gray-700 rounded-t-lg">
                        <i class="far fa-edit mr-3 text-gray-500"></i> Edit
                      </button>
                      <form action="{{ route('admin.pariwisata.destroy', $item->id) }}" 
                            method="POST" class="w-full">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn-delete w-full text-left px-4 py-2 hover:bg-gray-50 flex items-center text-sm text-red-600 rounded-b-lg border-t border-gray-100">
                          <i class="far fa-trash-alt mr-3"></i> Hapus
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @empty
          <div class="bg-white rounded-lg shadow-sm p-12 text-center">
            <i class="fas fa-inbox text-gray-300 text-5xl mb-4"></i>
            <p class="text-gray-500">Belum ada konten pariwisata.</p>
            <button onclick="openAddModal()" class="mt-4 text-red-800 hover:text-red-900 font-medium">
              + Tambah Konten Pertama
            </button>
          </div>
        @endforelse
      </div>

      <!-- No Result Message -->
      <div id="noResult" class="hidden bg-white rounded-lg shadow-sm p-12 text-center">
        <i class="fas fa-search text-gray-300 text-5xl mb-4"></i>
        <p class="text-gray-500">Tidak ada konten yang ditemukan</p>
      </div>

      {{-- Modal Tambah Konten --}}
      <div id="addContentModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md max-h-[90vh] overflow-y-auto">
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Tambah Konten Pariwisata</h2>
            <button onclick="closeAddModal()" class="text-gray-400 hover:text-gray-600">
              <i class="fas fa-times text-xl"></i>
            </button>
          </div>
          <p class="text-xs text-gray-500 mb-4"><span class="text-red-500">*</span> wajib diisi</p>
          <form action="{{ route('admin.pariwisata.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700 mb-1">Nama <span class="text-red-500">*</span></label>
              <input type="text" name="nama" required class="w-full border rounded-lg px-3 py-2">
            </div>
            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
              <textarea name="deskripsi" rows="3" class="w-full border rounded-lg px-3 py-2"></textarea>
            </div>
            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700 mb-1">Foto</label>
              <input type="file" name="foto" class="w-full text-sm">
            </div>
            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700 mb-1">URL Maps</label>
              <input type="url" name="url_maps" class="w-full border rounded-lg px-3 py-2">
            </div>
            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700 mb-1">Latitude</label>
              <input type="text" name="lat" class="w-full border rounded-lg px-3 py-2">
            </div>
            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700 mb-1">Longitude</label>
              <input type="text" name="lng" class="w-full border rounded-lg px-3 py-2">
            </div>
            <div class="flex space-x-2 mt-6">
              <button type="button" onclick="closeAddModal()" class="flex-1 bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">Batal</button>
              <button type="submit" class="flex-1 bg-red-800 text-white px-4 py-2 rounded-lg hover:bg-red-900 transition">Simpan</button>
            </div>
          </form>
        </div>
      </div>

      {{-- Modal Edit Konten --}}
      <div id="editContentModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md max-h-[90vh] overflow-y-auto">
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Edit Konten Pariwisata</h2>
            <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
              <i class="fas fa-times text-xl"></i>
            </button>
          </div>
          <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700 mb-1">Nama <span class="text-red-500">*</span></label>
              <input type="text" name="nama" id="edit_nama" required class="w-full border rounded-lg px-3 py-2">
            </div>
            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
              <textarea name="deskripsi" id="edit_deskripsi" rows="3" class="w-full border rounded-lg px-3 py-2"></textarea>
            </div>
            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700 mb-1">Foto (Opsional)</label>
              <input type="file" name="foto" class="w-full text-sm">
            </div>
            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700 mb-1">URL Maps</label>
              <input type="url" name="url_maps" id="edit_url_maps" class="w-full border rounded-lg px-3 py-2">
            </div>
            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700 mb-1">Latitude</label>
              <input type="text" name="lat" id="edit_lat" class="w-full border rounded-lg px-3 py-2">
            </div>
            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700 mb-1">Longitude</label>
              <input type="text" name="lng" id="edit_lng" class="w-full border rounded-lg px-3 py-2">
            </div>
            <div class="flex space-x-2 mt-6">
              <button type="button" onclick="closeEditModal()" class="flex-1 bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">Batal</button>
              <button type="submit" class="flex-1 bg-red-800 text-white px-4 py-2 rounded-lg hover:bg-red-900 transition">Simpan Perubahan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  // Toggle Dropdown
  function toggleDropdown(index) {
    const dropdown = document.getElementById('dropdown-' + index);
    const allDropdowns = document.querySelectorAll('[id^="dropdown-"]');
    allDropdowns.forEach(d => {
      if (d.id !== 'dropdown-' + index) {
        d.classList.add('hidden');
      }
    });
    dropdown.classList.toggle('hidden');
  }

  // Close dropdown when clicking outside
  document.addEventListener('click', function(event) {
    if (!event.target.closest('.relative')) {
      const allDropdowns = document.querySelectorAll('[id^="dropdown-"]');
      allDropdowns.forEach(d => d.classList.add('hidden'));
    }
  });

  function openAddModal() { document.getElementById('addContentModal').classList.remove('hidden'); }
  function closeAddModal() { document.getElementById('addContentModal').classList.add('hidden'); }
  function openEditModal(id, nama, deskripsi, url_maps, lat, lng) {
    const form = document.getElementById('editForm');
    form.action = `/admin/pariwisata/${id}`;
    document.getElementById('edit_nama').value = nama;
    document.getElementById('edit_deskripsi').value = deskripsi;
    document.getElementById('edit_url_maps').value = url_maps;
    document.getElementById('edit_lat').value = lat;
    document.getElementById('edit_lng').value = lng;
    document.getElementById('editContentModal').classList.remove('hidden');
  }
  function closeEditModal() { document.getElementById('editContentModal').classList.add('hidden'); }

  // Search functionality
  const searchInput = document.getElementById('searchInput');
  const contentGrid = document.getElementById('contentGrid');
  const noResult = document.getElementById('noResult');
  searchInput.addEventListener('keyup', function() {
    const searchValue = this.value.toLowerCase();
    const items = contentGrid.getElementsByClassName('content-item');
    let hasResult = false;
    for (let i = 0; i < items.length; i++) {
      const title = items[i].querySelector('.content-title').textContent.toLowerCase();
      const desc = items[i].querySelector('.content-desc').textContent.toLowerCase();
      if (title.indexOf(searchValue) > -1 || desc.indexOf(searchValue) > -1) {
        items[i].style.display = '';
        hasResult = true;
      } else {
        items[i].style.display = 'none';
      }
    }
    if (hasResult || searchValue === '') {
      noResult.classList.add('hidden');
      contentGrid.classList.remove('hidden');
    } else {
      noResult.classList.remove('hidden');
      contentGrid.classList.add('hidden');
    }
  });

  // Delete confirmation
  document.querySelectorAll('.btn-delete').forEach(button => {
    button.addEventListener('click', function() {
      const form = this.closest('form');
      Swal.fire({
        title: 'Apakah kamu yakin?',
        text: "Konten akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#991B1B',
        cancelButtonColor: '#6B7280',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      });
    });
  });

  // Close modal when clicking outside
  document.getElementById('addContentModal').addEventListener('click', function(e) {
    if (e.target === this) closeAddModal();
  });
  document.getElementById('editContentModal').addEventListener('click', function(e) {
    if (e.target === this) closeEditModal();
  });
</script>
</body>
</html>
