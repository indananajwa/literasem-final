<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>{{ $kategori->nama_kategori }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
    .hidden {
      display: none;
    }
  </style>
</head>
<body class="bg-gray-100">

  @include('pengunjung.layouts.header')

  {{-- HERO SECTION --}}
  <div id="hero-section" class="relative h-screen bg-cover bg-center z-10"
       style="background-image: url('data:{{ $kategori->mime_type }};base64,{{ base64_encode($kategori->gambar_cover) }}');">
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>

    <div class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white px-4">
      <h1 class="text-5xl font-bold mb-4">{{ strtoupper($kategori->nama_kategori) }}</h1>
      @if(!empty($kategori->deskripsi_kategori))
        <p class="text-2xl font-light mb-6">{{ $kategori->deskripsi_kategori }}</p>
      @endif
      <button onclick="scrollToMenu()"
              class="bg-red-800 hover:bg-yellow-600 text-white px-6 py-3 rounded-full text-lg shadow-lg">
        View Detail
      </button>
    </div>

    {{-- SEARCH BAR --}}
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-20 w-full max-w-2xl px-4">
      <div class="flex bg-white rounded-full shadow-lg overflow-hidden">
        <input type="text" id="search-bar"
               placeholder="Search by title or description..."
               class="flex-grow px-6 py-3 text-gray-700 focus:outline-none rounded-l-full" />
        <button class="bg-red-800 text-white px-6 py-3 rounded-r-full hover:bg-yellow-600">
          Search
        </button>
      </div>
    </div>
  </div>

  {{-- KONTEN SECTION --}}
  <div id="menu-section" class="container mx-auto px-4 py-12 mt-8">
    <h2 class="text-3xl font-bold text-center mb-8">Konten dalam Kategori Ini</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="konten-list">
      @foreach($kontens as $konten)
        <div class="bg-white rounded-lg shadow-md hover:shadow-xl p-4 group transition">
          @if(!empty($konten->gambar))
            <img src="data:{{ $konten->mime_type }};base64,{{ base64_encode($konten->gambar) }}"
                 alt="{{ $konten->judul }}" class="w-full h-48 object-cover rounded-md mb-4">
          @endif

          <h3 class="text-xl font-semibold mb-2 group-hover:text-red-800">{{ $konten->judul }}</h3>

          @if(!empty($konten->deskripsi))
            <p class="text-gray-600 short-desc">{{ \Illuminate\Support\Str::limit($konten->deskripsi, 100) }}</p>
            <p class="text-gray-600 hidden full-desc">{{ $konten->deskripsi }}</p>
            <button onclick="toggleReadMore(this)" class="text-blue-500 mt-2 hover:underline read-more-btn">
              Read More
            </button>
          @endif

          @if(!empty($konten->video_url))
            <div class="aspect-w-16 aspect-h-9 mt-4">
              <iframe class="w-full h-48" src="{{ $konten->video_url }}" frameborder="0" allowfullscreen></iframe>
            </div>
          @endif
        </div>
      @endforeach
    </div>
  </div>

  <script>
    function toggleReadMore(button) {
      const card = button.closest('div');
      const shortDesc = card.querySelector('.short-desc');
      const fullDesc = card.querySelector('.full-desc');

      if (fullDesc.classList.contains('hidden')) {
        shortDesc.classList.add('hidden');
        fullDesc.classList.remove('hidden');
        button.textContent = 'Read Less';
      } else {
        shortDesc.classList.remove('hidden');
        fullDesc.classList.add('hidden');
        button.textContent = 'Read More';
      }
    }

    function scrollToMenu() {
      document.getElementById('menu-section').scrollIntoView({ behavior: 'smooth' });
    }

    document.getElementById('search-bar').addEventListener('input', function () {
      const search = this.value.toLowerCase();
      document.querySelectorAll('#konten-list > div').forEach(card => {
        const title = card.querySelector('h3').textContent.toLowerCase();
        const desc = card.querySelector('.short-desc')?.textContent.toLowerCase() || '';
        card.style.display = (title.includes(search) || desc.includes(search)) ? 'block' : 'none';
      });
    });
  </script>

</body>
</html>
