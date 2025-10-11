<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Manajemen Konten</title>
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
      
      <!-- Back Button -->
      <a href="{{ route('admin.kategori.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 mb-4 text-sm">
        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Kategori
      </a>

      <!-- ✅ SUCCESS/ERROR ALERT -->
      @if(session('success'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center">
          <i class="fas fa-check-circle mr-2"></i>
          <span>{{ session('success') }}</span>
        </div>
      @endif

      @if($errors->any())
        <div class="mb-4 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
          <div class="flex items-start">
            <i class="fas fa-exclamation-circle mr-2 mt-0.5"></i>
            <div>
              <p class="font-semibold mb-1">Terjadi kesalahan:</p>
              <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      @endif

      <!-- Header Section -->
      <div class="flex justify-between items-center mb-8 max-w-6xl mx-auto">
        <div class="flex items-center">
          <h1 class="text-2xl font-bold text-gray-900">Manajemen Konten {{ $kategori->nama_kategori }}</h1>
          <i class="fas fa-info-circle text-gray-400 ml-2 cursor-help" 
             title="Kelola konten untuk kategori {{ $kategori->nama_kategori }}"></i>
        </div>
      </div>

      <!-- Search & Actions -->
      <div class="flex justify-between items-center mb-6">
        <div class="relative w-72">
          <i class="fas fa-search absolute left-4 top-3 text-gray-400"></i>
          <input 
            type="text" 
            id="searchInput"
            placeholder="Cari Konten..." 
            class="w-full pl-12 pr-4 py-2 rounded-full border border-gray-300 focus:ring-2 focus:ring-red-500 focus:outline-none text-sm"
          >
        </div>

        <div class="flex space-x-3">
          <a href="{{ route('pengunjung.kategori.show', $kategori->kode_kategori) }}" target="_blank"
             class="px-5 py-2 text-sm font-medium text-white rounded-full bg-gradient-to-r from-[#F1DF40] to-[#8B8125] hover:opacity-90 transition flex items-center">
            <i class="far fa-eye mr-2"></i> Preview
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
          <span class="ml-2 font-semibold text-gray-900">{{ count($kontenList ?? $konten) }}</span>
        </div>
      </div>

      <!-- Content Cards Grid -->
      <div class="space-y-4" id="contentGrid">
        @forelse($kontenList ?? $konten as $index => $item)
          <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition p-4 content-item">
            <div class="flex items-start space-x-4">
              <!-- Thumbnail -->
              <div class="flex-shrink-0">
                @if($item->gambar)
                  <img src="data:{{ $item->mime_type }};base64,{{ base64_encode($item->gambar) }}" 
                       class="w-32 h-24 object-cover rounded-lg border border-gray-200">
                @else
                  <div class="w-32 h-24 bg-gray-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-image text-gray-400 text-2xl"></i>
                  </div>
                @endif
              </div>

              <!-- Content Info -->
              <div class="flex-1 min-w-0">
                <h3 class="text-lg font-semibold text-red-800 mb-1 content-title">{{ $item->judul }}</h3>
                <p class="text-sm text-gray-600 mb-3 content-desc">{{ \Illuminate\Support\Str::limit($item->deskripsi, 80) }}</p>
              </div>

              <!-- Actions -->
              <div class="flex flex-col items-end justify-between h-full">
                <div class="flex items-center space-x-2">
                  <span class="text-xs text-gray-500">
                      {{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('d M Y') : 'Tanggal Upload' }}
                  </span>
                  <div class="relative dropdown-container">
                    <button type="button" 
                            class="dropdown-toggle text-gray-400 hover:text-gray-600 p-1" 
                            data-index="{{ $index }}">
                      <i class="fas fa-ellipsis-v"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="dropdown-{{ $index }}" class="dropdown-menu hidden absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg border border-gray-200 z-10">
                      <button type="button" 
                              onclick="openEditModal('{{ $item->kode_konten }}', '{{ $item->kode_kategori }}', '{{ addslashes($item->judul) }}', '{{ addslashes($item->deskripsi) }}', '{{ $item->video_url }}', '{{ $item->gambar ? "data:".$item->mime_type.";base64,".base64_encode($item->gambar) : "" }}')" 
                              class="w-full text-left px-4 py-2 hover:bg-gray-50 flex items-center text-sm text-gray-700 rounded-t-lg">
                        <i class="far fa-edit mr-3 text-gray-500"></i> Edit
                      </button>

                      <form action="{{ route('admin.konten.destroy', ['kode_kategori' => $item->kode_kategori, 'kode_konten' => $item->kode_konten]) }}" 
                            method="POST" class="w-full">
                        @csrf
                        @method('DELETE')
                        <button type="button" 
                                class="btn-delete w-full text-left px-4 py-2 hover:bg-gray-50 flex items-center text-sm text-red-600 rounded-b-lg border-t border-gray-100">
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
            <p class="text-gray-500">Belum ada konten untuk kategori ini.</p>
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
    </div>
  </div>
</div>

{{-- ===== Modal Tambah (dinamis sesuai field_rules) ===== --}}
@php $rules = $fieldRules; @endphp
<div id="addContentModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
  <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md max-h-[90vh] overflow-y-auto">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl font-bold">Tambah Konten</h2>
      <button onclick="closeAddModal()" class="text-gray-400 hover:text-gray-600">
        <i class="fas fa-times text-xl"></i>
      </button>
    </div>

    <form action="{{ route('admin.konten.store', $kategori->kode_kategori) }}" method="POST" enctype="multipart/form-data">
      @csrf

      {{-- Judul --}}
      @if(($rules['judul'] ?? 'not_used') !== 'not_used')
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Judul
            @if(($rules['judul'] ?? '') === 'required')<span class="text-red-500">*</span>@endif
          </label>
          <input type="text" name="judul" value="{{ old('judul') }}"
                 class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 @error('judul') border-red-500 @enderror"
                 @if(($rules['judul'] ?? '') === 'required') required @endif>
          @error('judul')
            <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
          @enderror
        </div>
      @endif

      {{-- Deskripsi --}}
      @if(($rules['deskripsi'] ?? 'not_used') !== 'not_used')
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi
            @if(($rules['deskripsi'] ?? '') === 'required')<span class="text-red-500">*</span>@endif
          </label>
          <textarea name="deskripsi" rows="4"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 @error('deskripsi') border-red-500 @enderror"
                    @if(($rules['deskripsi'] ?? '') === 'required') required @endif>{{ old('deskripsi') }}</textarea>
          @error('deskripsi')
            <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
          @enderror
        </div>
      @endif

      {{-- Gambar --}}
      @if(($rules['gambar'] ?? 'not_used') !== 'not_used')
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Gambar
            @if(($rules['gambar'] ?? '') === 'required')<span class="text-red-500">*</span>@endif
          </label>
          <input type="file" name="gambar" accept="image/*"
                 class="w-full text-sm @error('gambar') border border-red-500 rounded @enderror"
                 @if(($rules['gambar'] ?? '') === 'required') required @endif>
          @error('gambar')
            <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
          @enderror
        </div>
      @endif

      {{-- Video --}}
      @if(($rules['video_url'] ?? 'not_used') !== 'not_used')
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Video URL
            @if(($rules['video_url'] ?? '') === 'required')<span class="text-red-500">*</span>@endif
          </label>
          <input type="url" name="video_url" value="{{ old('video_url') }}"
                 class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 @error('video_url') border-red-500 @enderror"
                 @if(($rules['video_url'] ?? '') === 'required') required @endif>
          @error('video_url')
            <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
          @enderror
        </div>
      @endif

      <div class="flex space-x-2 mt-6">
        <button type="button" onclick="closeAddModal()" class="flex-1 bg-gray-200 px-4 py-2 rounded-lg hover:bg-gray-300 transition">Batal</button>
        <button type="submit" class="flex-1 bg-red-800 text-white px-4 py-2 rounded-lg hover:bg-red-900 transition">Simpan</button>
      </div>
    </form>
  </div>
</div>

{{-- ===== Modal Edit (dinamis) ===== --}}
<div id="editContentModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
  <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md max-h-[90vh] overflow-y-auto">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl font-bold">Edit Konten</h2>
      <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times text-xl"></i></button>
    </div>

    <form id="editContentForm" method="POST" enctype="multipart/form-data">
      @csrf @method('PUT')

      @if(($rules['judul'] ?? 'not_used') !== 'not_used')
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
          <input type="text" id="edit-judul" name="judul" 
                 class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500">
        </div>
      @endif

      @if(($rules['deskripsi'] ?? 'not_used') !== 'not_used')
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
          <textarea id="edit-deskripsi" name="deskripsi" rows="4" 
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500"></textarea>
        </div>
      @endif

      @if(($rules['gambar'] ?? 'not_used') !== 'not_used')
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Saat Ini</label>
          <div id="edit-current-image" class="mb-2"></div>
          <label class="block text-sm font-medium text-gray-700 mb-1 mt-2">Upload Gambar Baru (Opsional)</label>
          <input type="file" name="gambar" accept="image/*" class="w-full text-sm">
        </div>
      @endif

      @if(($rules['video_url'] ?? 'not_used') !== 'not_used')
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Video URL</label>
          <input type="url" id="edit-video_url" name="video_url" 
                 class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500">
        </div>
      @endif

      <div class="flex space-x-2 mt-6">
        <button type="button" onclick="closeEditModal()" class="flex-1 bg-gray-200 px-4 py-2 rounded-lg hover:bg-gray-300 transition">Batal</button>
        <button type="submit" class="flex-1 bg-red-800 text-white px-4 py-2 rounded-lg hover:bg-red-900 transition">Simpan</button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  // ✅ AUTO-OPEN MODAL JIKA ADA ERROR (untuk keep modal terbuka)
  @if($errors->any() && old('_token'))
    document.addEventListener('DOMContentLoaded', function() {
      openAddModal();
    });
  @endif

  // Dropdown toggle
  document.querySelectorAll('.dropdown-toggle').forEach(btn=>{
    btn.addEventListener('click', e=>{
      e.stopPropagation();
      const index=btn.dataset.index;
      const dd=document.getElementById('dropdown-'+index);
      document.querySelectorAll('.dropdown-menu').forEach(d=>{if(d!==dd)d.classList.add('hidden');});
      dd.classList.toggle('hidden');
    });
  });
  document.addEventListener('click', e=>{
    if(!e.target.closest('.dropdown-container')){
      document.querySelectorAll('.dropdown-menu').forEach(d=>d.classList.add('hidden'));
    }
  });

  // Modal Tambah
  function openAddModal(){document.getElementById('addContentModal').classList.remove('hidden');}
  function closeAddModal(){document.getElementById('addContentModal').classList.add('hidden');}

  // Modal Edit
  function openEditModal(kodeKonten,kodeKategori,judul,deskripsi,videoUrl,gambarBase64){
    const modal=document.getElementById('editContentModal');
    const form=document.getElementById('editContentForm');
    form.action=`/admin/konten/${kodeKategori}/${kodeKonten}`;
    if(document.getElementById('edit-judul'))document.getElementById('edit-judul').value=judul||'';
    if(document.getElementById('edit-deskripsi'))document.getElementById('edit-deskripsi').value=deskripsi||'';
    if(document.getElementById('edit-video_url'))document.getElementById('edit-video_url').value=videoUrl||'';
    if(document.getElementById('edit-current-image')){
      if(gambarBase64){
        document.getElementById('edit-current-image').innerHTML=`<img src="${gambarBase64}" class="w-32 h-24 object-cover rounded-lg border">`;
      }else{
        document.getElementById('edit-current-image').innerHTML='<p class="text-sm text-gray-500">Tidak ada gambar</p>';
      }
    }
    modal.classList.remove('hidden');
  }
  function closeEditModal(){document.getElementById('editContentModal').classList.add('hidden');}

  // Search
  const searchInput=document.getElementById('searchInput');
  const contentGrid=document.getElementById('contentGrid');
  const noResult=document.getElementById('noResult');
  searchInput.addEventListener('keyup',function(){
    const val=this.value.toLowerCase();
    const items=contentGrid.getElementsByClassName('content-item');
    let found=false;
    for(let i=0;i<items.length;i++){
      const title=items[i].querySelector('.content-title').textContent.toLowerCase();
      const desc=items[i].querySelector('.content-desc').textContent.toLowerCase();
      if(title.includes(val)||desc.includes(val)){items[i].style.display='';found=true;}
      else{items[i].style.display='none';}
    }
    if(found||val===''){noResult.classList.add('hidden');contentGrid.classList.remove('hidden');}
    else{noResult.classList.remove('hidden');contentGrid.classList.add('hidden');}
  });

  // Delete confirm
  document.querySelectorAll('.btn-delete').forEach(btn=>{
    btn.addEventListener('click',function(e){
      e.preventDefault();
      const form=this.closest('form');
      Swal.fire({
        title:'Yakin hapus?',
        text:'Data tidak bisa dikembalikan!',
        icon:'warning',
        showCancelButton:true,
        confirmButtonColor:'#991B1B',
        cancelButtonColor:'#6B7280',
        confirmButtonText:'Ya, hapus!',
        cancelButtonText:'Batal'
      }).then(result=>{if(result.isConfirmed){form.submit();}});
    });
  });

  // ✅ AUTO HIDE SUCCESS ALERT AFTER 5 SECONDS
  @if(session('success'))
    setTimeout(function(){
      const alert = document.querySelector('.bg-green-50');
      if(alert) {
        alert.style.transition = 'opacity 0.5s';
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 500);
      }
    }, 5000);
  @endif
</script>
</body>
</html>