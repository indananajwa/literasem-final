<!-- resources/views/admin/kategori/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen Kategori Konten</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
    .tab-active {
      border-bottom: 3px solid #991B1B;
      color: #1f2937;
      font-weight: 600;
    }
    .tab-inactive {
      color: #9ca3af;
      border-bottom: 3px solid transparent;
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

    <div class="flex justify-between items-center mb-6 px-6 py-3">
      <div class="flex items-center">
        <h1 class="text-2xl font-bold text-gray-900">Manajemen Kategori Konten</h1>
        <i class="fas fa-info-circle text-gray-400 ml-2 cursor-help" 
           title="Berisi daftar kategori yang akan ditampilkan di halaman pengunjung. Admin dapat menambah, mengubah, atau menghapus kategori."></i>
        </div>
    </div>

    <!-- Search & Tambah -->
    <div class="flex justify-between items-center mb-6 ml-4">
      <!-- Search -->
      <div class="relative w-72">
        <i class="fas fa-search absolute left-4 top-3 text-gray-400"></i>
        <input 
          type="text" 
          id="searchInput"
          placeholder="Cari kategori..." 
          class="w-full pl-12 pr-4 py-2 rounded-full border border-gray-300 focus:ring-2 focus:ring-red-500 focus:outline-none text-sm"
        >
      </div>

      <!-- Button -->
      <a href="{{ route('admin.kategori.create') }}" 
         class="px-5 py-2 text-sm font-medium text-white rounded-full bg-gradient-to-r from-[#991B1B] to-[#330909] hover:opacity-90 transition flex items-center">
        <span class="mr-1">+</span> Tambah
      </a>
    </div>

    <!-- Tabs -->
    <div class="border-b border-gray-200 mb-6 max-w-6xl mx-auto">
      <div class="flex space-x-8">
        <button class="pb-3 px-1 tab-active">Umum</button>
        <button class="pb-3 px-1 tab-inactive hover:text-gray-700">Khusus</button>
      </div>
    </div>

     <!-- Table Umum -->
     <div id="umum-content" class="bg-white rounded-lg shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Konten</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Preview</th>
                    </tr>
                </thead>
                <tbody id="tableBody" class="bg-white divide-y divide-gray-100 mx-auto">
                    @foreach ($kategoris as $kategori)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $kategori->kode_kategori }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 kategori-nama">{{ $kategori->nama_kategori }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $kategori->konten_count ?? 0 }}</td>
                            <td class="px-6 py-4 text-sm">
                                <div class="flex space-x-8">
                                    <form action="{{ route('admin.kategori.destroy', $kategori->kode_kategori) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn-delete text-gray-500 hover:text-red-600" title="Hapus">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.kategori.edit', $kategori->kode_kategori) }}" class="text-gray-500 hover:text-blue-600" title="Edit">
                                        <i class="far fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <a href="{{ route('admin.konten.index', $kategori->kode_kategori) }}" class="inline-flex items-center text-green-600 hover:text-green-700 font-medium">
                                    <i class="far fa-plus-square mr-1"></i> Tambah
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tr id="noResult" class="hidden">
                    <td colspan="5" class="text-center text-gray-500 py-4">Tidak ada hasil ditemukan</td>
                </tr>
            </table>
        </div>
     </div>
        
     <!-- Table Khusus -->
     <div id="khusus-content" class="bg-white rounded-lg shadow-sm hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Konten</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Preview</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-900">1</td>
                        <td class="px-6 py-4 text-sm text-gray-900">Pariwisata</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $pariwisataCount }}</td>
                        <td class="px-6 py-4 text-sm">
                            <a href="{{ route('admin.pariwisata.konten') }}" class="inline-flex items-center text-green-600 hover:text-green-700 font-medium">
                                <i class="far fa-plus-square mr-1"></i> Tambah
                            </a>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-900">2</td>
                        <td class="px-6 py-4 text-sm text-gray-900">Pemerintah</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $pemerintahCount }}</td>
                        <td class="px-6 py-4 text-sm">
                            <a href="{{ route('admin.pemerintah.konten') }}" class="inline-flex items-center text-green-600 hover:text-green-700 font-medium">
                                <i class="far fa-plus-square mr-1"></i> Tambah
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
     </div>
    </div>
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
    timer: 2000,
    showConfirmButton: false
});
</script>
@endif

<script>
// Tab switching
const tabs = document.querySelectorAll('.pb-3');
const umumContent = document.getElementById('umum-content');
const khususContent = document.getElementById('khusus-content');

tabs.forEach((tab, index) => {
    tab.addEventListener('click', () => {
        tabs.forEach(t => {
            t.classList.remove('tab-active');
            t.classList.add('tab-inactive');
        });
        tab.classList.remove('tab-inactive');
        tab.classList.add('tab-active');
        
        if (index === 0) {
            umumContent.classList.remove('hidden');
            khususContent.classList.add('hidden');
        } else {
            umumContent.classList.add('hidden');
            khususContent.classList.remove('hidden');
        }
    });
});

// Search functionality
const searchInput = document.getElementById('searchInput');
const tableBody = document.getElementById('tableBody');
const noResult = document.getElementById('noResult');

searchInput.addEventListener('keyup', function() {
    const searchValue = this.value.toLowerCase();
    const rows = tableBody.getElementsByTagName('tr');
    let hasResult = false;

    for (let i = 0; i < rows.length; i++) {
        const kategoriNama = rows[i].querySelector('.kategori-nama');
        if (kategoriNama) {
            const textValue = kategoriNama.textContent || kategoriNama.innerText;
            if (textValue.toLowerCase().indexOf(searchValue) > -1) {
                rows[i].style.display = '';
                hasResult = true;
            } else {
                rows[i].style.display = 'none';
            }
        }
    }

    if (hasResult || searchValue === '') {
        noResult.classList.add('hidden');
    } else {
        noResult.classList.remove('hidden');
    }
});

// Delete confirmation
document.querySelectorAll('.btn-delete').forEach(button => {
    button.addEventListener('click', function() {
        const form = this.closest('form');

        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Data akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>
</body>
</html>
