<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Kategori</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
    .btn-green-gradient {
      background: linear-gradient(to right, #48D92E, #267318);
    }
    .hide-scrollbar::-webkit-scrollbar {
      display: none;
    }
    .hide-scrollbar {
      -ms-overflow-style: none;
      scrollbar-width: none;
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
    <!-- Header -->
    <div class="mb-6">
      <!-- Back Button -->
      <a href="{{ route('admin.kategori.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 mb-4 text-sm">
        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Kategori
      </a>
      <h1 class="text-2xl font-bold text-gray-900 flex items-center">
        Manajemen Kategori Konten
      </h1>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow-sm">
      <!-- Header Card -->
      <div class="bg-red-gradient text-white px-6 py-4 rounded-t-lg">
        <h2 class="text-lg font-semibold">Tambah Kategori Baru</h2>
      </div>

      <!-- Form -->
      <form id="formKategori" action="{{ route('admin.kategori.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
        @csrf

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

  @if(session('error'))
  <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
    <div class="flex items-center">
      <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
      <p class="text-red-800">{{ session('error') }}</p>
    </div>
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
            <div id="preview-container" class="hidden">
              <img id="preview-image" src="" alt="Preview" class="max-h-64 mx-auto rounded-lg mb-4">
            </div>
            <div id="upload-placeholder">
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
          <input type="text" id="nama_kategori" name="nama_kategori" required
                 class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-500">
        </div>

        <!-- Kode Kategori -->
        <div class="mb-6">
          <label for="kode_kategori" class="block text-sm font-medium text-gray-700 mb-2">
            Kode Kategori (3 huruf) <span class="text-red-600">*</span>
          </label>
          <input type="text" id="kode_kategori" name="kode_kategori" maxlength="3" readonly required
                 class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-gray-100 text-gray-600">
        </div>

        <!-- Judul Kategori -->
        <div class="mb-6">
          <label for="judul_kategori" class="block text-sm font-medium text-gray-700 mb-2">
            Judul Kategori <span class="text-red-600">*</span>
          </label>
          <input type="text" id="judul_kategori" name="judul_kategori" required
                 class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-500">
        </div>

        <!-- Deskripsi -->
        <div class="mb-8">
          <label for="deskripsi_kategori" class="block text-sm font-medium text-gray-700 mb-2">
            Deskripsi <span class="text-red-600">*</span>
          </label>
          <textarea id="deskripsi_kategori" name="deskripsi_kategori" rows="4" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-500"
                    placeholder="Deskripsikan kategori ini secara singkat..."></textarea>
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
                    <input type="radio" name="field_rules[{{ $key }}]" value="required" required>
                  </td>
                  <td class="px-6 py-4 text-center border-b">
                    <input type="radio" name="field_rules[{{ $key }}]" value="optional">
                  </td>
                  <td class="px-6 py-4 text-center border-b">
                    <input type="radio" name="field_rules[{{ $key }}]" value="not_used">
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <!-- Highlight Option (REVISED) -->
        <div class="mb-8 mt-6">
          <div class="bg-red-gradient text-white px-6 py-3 -mx-6 mb-4">
            <h3 class="font-semibold">Opsi Highlight</h3>
          </div>
          
          
          <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">
              Tampilkan di Highlight?
            </label>
            <div class="flex gap-6">
              <label class="inline-flex items-center">
                <input type="radio" name="field_rules[highlight]" value="required" class="text-red-600 focus:ring-red-500" required>
                <span class="ml-2 text-gray-700">Ya</span>
              </label>

              <label class="inline-flex items-center">
                <input type="radio" name="field_rules[highlight]" value="not_used" class="text-red-600 focus:ring-red-500" required>
                <span class="ml-2 text-gray-700">Tidak</span>
              </label>
            </div>
          </div>

          <!-- Preview Tampilan Highlight -->
          <div id="highlight-preview" class="hidden mt-6 p-6 bg-gradient-to-br from-yellow-50 to-red-50 rounded-lg border-2 border-yellow-400">
            <div class="flex items-start gap-3 mb-4">
              <i class="fas fa-info-circle text-yellow-600 text-xl mt-1"></i>
              <div>
                <h4 class="font-semibold text-gray-800 mb-2">Preview Tampilan Highlight</h4>
                <p class="text-sm text-gray-600 mb-4">Kategori highlight akan ditampilkan dengan scrollable carousel di halaman utama seperti berikut:</p>
              </div>
            </div>
            
            <!-- Mini Preview -->
            <div class="bg-white rounded-lg p-4 shadow-sm">
              <h5 class="text-center font-bold text-xl mb-4">
                Jelajah Budaya <span class="text-red-800">Semarang</span>
              </h5>
              
              <div class="relative">
                <!-- Left Arrow -->
                <button type="button" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-red-800 text-white px-3 py-2 rounded-full text-sm z-10">
                  <i class="fas fa-chevron-left"></i>
                </button>
                
                <!-- Scrollable Items Preview -->
                <div class="overflow-x-auto hide-scrollbar flex gap-3 px-10">
                  <div class="min-w-[200px] bg-gray-100 rounded-lg p-3 text-center">
                    <div class="bg-gray-200 h-32 rounded-lg mb-2 flex items-center justify-center">
                      <i class="fas fa-image text-gray-400 text-2xl"></i>
                    </div>
                    <p class="text-xs font-medium text-gray-700">Item 1</p>
                  </div>
                  <div class="min-w-[200px] bg-gray-100 rounded-lg p-3 text-center">
                    <div class="bg-gray-200 h-32 rounded-lg mb-2 flex items-center justify-center">
                      <i class="fas fa-image text-gray-400 text-2xl"></i>
                    </div>
                    <p class="text-xs font-medium text-gray-700">Item 2</p>
                  </div>
                  <div class="min-w-[200px] bg-gray-100 rounded-lg p-3 text-center">
                    <div class="bg-gray-200 h-32 rounded-lg mb-2 flex items-center justify-center">
                      <i class="fas fa-image text-gray-400 text-2xl"></i>
                    </div>
                    <p class="text-xs font-medium text-gray-700">Item 3</p>
                  </div>
                </div>
                
                <!-- Right Arrow -->
                <button type="button" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-red-800 text-white px-3 py-2 rounded-full text-sm z-10">
                  <i class="fas fa-chevron-right"></i>
                </button>
              </div>
              
              <p class="text-xs text-gray-500 text-center mt-3">
                <i class="fas fa-lightbulb text-yellow-500"></i> 
                Konten dapat di-scroll horizontal dengan tombol panah
              </p>
            </div>
          </div>
        </div>

        <!-- Opsi Video Sampul -->
        <div class="mb-8 mt-6">
          <div class="bg-red-gradient text-white px-6 py-3 -mx-6 mb-4">
            <h3 class="font-semibold">Opsi Video Sampul</h3>
          </div>
          
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-3">
              Apakah mau menambahkan video sampul? <span class="text-red-600">*</span>
            </label>
            <div class="flex gap-6">
              <label class="inline-flex items-center cursor-pointer">
                <input type="radio" name="use_video_sampul" value="1" required
                      class="h-5 w-5 text-red-600 border-gray-300 focus:ring-red-500">
                <span class="ml-2 text-sm font-medium text-gray-700">Ya</span>
              </label>
              <label class="inline-flex items-center cursor-pointer">
                <input type="radio" name="use_video_sampul" value="0" required
                      class="h-5 w-5 text-red-600 border-gray-300 focus:ring-red-500">
                <span class="ml-2 text-sm font-medium text-gray-700">Tidak</span>
              </label>
            </div>
          </div>

          <!-- Form Input Video -->
          <div id="video-sampul-form" class="hidden mt-6 space-y-4 bg-gray-50 p-6 rounded-lg border border-gray-200">
            <h4 class="text-gray-800 font-semibold mb-2">Informasi Video Sampul</h4>
            <p class="text-sm text-gray-600 mb-4">Masukkan detail video yang ingin ditampilkan sebagai sampul kategori ini.</p>

            <div>
              <label for="video_title" class="block text-sm font-medium text-gray-700 mb-2">
                Judul Video <span class="text-red-600">*</span>
              </label>
              <input type="text" id="video_title" name="video_sampul[title]" 
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-500"
                    placeholder="Masukkan judul video">
            </div>

            <div>
              <label for="video_description" class="block text-sm font-medium text-gray-700 mb-2">
                Deskripsi Video <span class="text-red-600">*</span>
              </label>
              <textarea id="video_description" name="video_sampul[description]" rows="3"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-500"
                        placeholder="Tuliskan deskripsi singkat video..."></textarea>
            </div>
            <div>
              <label for="youtube_url" class="block text-sm font-medium text-gray-700 mb-2">
                Link YouTube Video <span class="text-red-600">*</span>
              </label>
              <input type="url" id="youtube_url" name="video_sampul[youtube_url]" 
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-500"
                    placeholder="Contoh: https://www.youtube.com/watch?v=dQw4w9WgXcQ">
              <p class="text-xs text-gray-500 mt-1">Masukkan URL lengkap video YouTube, nanti akan otomatis dikonversi ke ID.</p>
              <!-- Hidden field untuk simpan hasil convert ID -->
              <input type="hidden" id="youtube_id" name="video_sampul[youtube_id]">
            </div>

          </div>
        </div>

        <!-- Opsi Tampilan -->
        <div class="bg-red-gradient text-white px-6 py-3 -mx-6 mb-6">
          <h3 class="font-semibold">Opsi Tampilan</h3>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-8">
          <label class="cursor-pointer">
            <input type="radio" name="field_rules[tampilan]" value="0" class="hidden peer">
            <div class="border-2 border-gray-300 peer-checked:border-red-600 peer-checked:bg-red-50 rounded-lg p-4">
              <div class="h-40 rounded-lg mb-3 overflow-hidden flex items-center justify-center border bg-gray-200">
                  <img src="{{ asset('img/tampilan1.png') }}" class="w-full h-full object-cover">
              </div>
              <p class="text-center text-sm font-medium">Tampilan 1</p>
            </div>
          </label>

          <label class="cursor-pointer">
            <input type="radio" name="field_rules[tampilan]" value="1" class="hidden peer">
            <div class="border-2 border-gray-300 peer-checked:border-red-600 peer-checked:bg-red-50 rounded-lg p-4">
              <div class="bg-gray-200 h-40 rounded-lg mb-3 flex items-center justify-center">
                <div class="h-40 rounded-lg mb-3 overflow-hidden flex items-center justify-center border bg-gray-200">
                  <img src="{{ asset('img/tampilan2.png') }}" class="w-full h-full object-cover">
              </div>
              </div>
              <p class="text-center text-sm font-medium">Tampilan 2</p>
            </div>
          </label>
        </div>

        <!-- Submit -->
        <div class="flex justify-end">
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
    // Auto-generate kode kategori
    document.getElementById("nama_kategori").addEventListener("input", function() {
      let nama = this.value.trim().toUpperCase();
      document.getElementById("kode_kategori").value = nama.substring(0,3);
    });

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

    // Show/Hide Highlight Preview
    document.querySelectorAll('input[name="field_rules[highlight]"').forEach(radio => {
      radio.addEventListener('change', function() {
        const preview = document.getElementById('highlight-preview');
        if (this.value === 'required') {
          preview.classList.remove('hidden');
        } else {
          preview.classList.add('hidden');
        }
      });
    });

    // Validasi form
    document.getElementById('formKategori').addEventListener('submit', function(e) {
      e.preventDefault();
      let form = this;

      // Cek manual field yang required
      let gambar = document.getElementById('gambar_cover').files.length;
      let nama = document.getElementById('nama_kategori').value.trim();
      let judul = document.getElementById('judul_kategori').value.trim();
      let deskripsi = document.getElementById('deskripsi_kategori').value.trim();
      
      // Cek apakah ada radio yang dipilih untuk setiap field rule
      let fieldRulesValid = true;
      let fieldNames = ['judul', 'deskripsi', 'gambar', 'video_url'];
      fieldNames.forEach(field => {
        let checked = document.querySelector(`input[name="field_rules[${field}]"]:checked`);
        if (!checked) fieldRulesValid = false;
      });

      // Cek tampilan dipilih
      let tampilanChecked = document.querySelector('input[name="field_rules[tampilan]"]:checked');
      
      // Cek highlight dipilih
      let highlightChecked = document.querySelector('input[name="field_rules[highlight]"]:checked');

      if (!gambar || !nama || !judul || !deskripsi || !fieldRulesValid || !tampilanChecked || !highlightChecked) {
        Swal.fire({
          title: 'Peringatan!',
          text: 'Semua field wajib diisi, termasuk pilih gambar cover, opsi highlight, aturan field, dan opsi tampilan.',
          icon: 'warning',
          confirmButtonColor: '#991B1B'
        });
        return;
      }

      Swal.fire({
        title: 'Simpan data?',
        text: "Data kategori akan ditambahkan.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#48D92E',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, simpan',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      });
    });
  </script>

  <!-- SweetAlert Success -->
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

<!-- SweetAlert Error -->
@if(session('error'))
<script>
Swal.fire({
    title: "Error!",
    text: "{{ session('error') }}",
    icon: "error",
    confirmButtonColor: '#991B1B'
});
</script>
@endif

@if($errors->any())
<script>
Swal.fire({
    title: "Validasi Gagal!",
    html: `
      <ul style="text-align: left; padding-left: 20px;">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    `,
    icon: "error",
    confirmButtonColor: '#991B1B'
});
</script>
@endif
<script>
  // Tampilkan form video jika "Ya" dipilih
  document.querySelectorAll('input[name="use_video_sampul"]').forEach(radio => {
    radio.addEventListener('change', function() {
      const form = document.getElementById('video-sampul-form');
      if (this.value === '1') {
        form.classList.remove('hidden');
      } else {
        form.classList.add('hidden');
      }
    });
  });

  // === Convert link YouTube ke ID otomatis ===
  function extractYouTubeID(url) {
    try {
      const parsed = new URL(url);
      if (parsed.hostname.includes("youtube.com")) {
        return parsed.searchParams.get("v");
      } else if (parsed.hostname.includes("youtu.be")) {
        return parsed.pathname.substring(1);
      }
      return null;
    } catch (e) {
      return null;
    }
  }

  // Saat submit form, ubah URL jadi ID dulu
  document.getElementById('formKategori').addEventListener('submit', function(e) {
    const ytInput = document.getElementById('youtube_url');
    const ytHidden = document.getElementById('youtube_id');

    if (ytInput && ytInput.value.trim() !== "") {
      const videoId = extractYouTubeID(ytInput.value.trim());
      if (videoId) {
        ytHidden.value = videoId;
      } else {
        e.preventDefault();
        Swal.fire({
          title: 'Link YouTube tidak valid!',
          text: 'Pastikan URL YouTube dalam format yang benar (misal: https://www.youtube.com/watch?v=XXXX).',
          icon: 'error',
          confirmButtonColor: '#991B1B'
        });
        return false;
      }
    }
  });
</script>

</body>
</html>