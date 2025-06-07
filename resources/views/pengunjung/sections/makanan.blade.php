<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $section->name ?? 'Makanan Khas Semarang' }}</title> {{-- Ambil nama section dari DB --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: Inter, sans-serif;
        }
        .hidden {
            display: none;
        }
        /* Tambahan style untuk line-clamp */
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-gray-100">

    {{-- Pastikan path ini benar sesuai lokasi file header lo --}}
    @include('pengunjung.layouts.header')

    <div id="hero-section" class="relative h-screen bg-cover bg-center z-10" style="background-image: url('{{ asset('storage/' . ($section->hero_image ?? 'placeholder_hero.jpg')) }}');">
        {{-- Asumsi lo punya kolom 'hero_image' di tabel sections buat gambar hero --}}
        {{-- Kalau gak ada, bisa pakai placeholder default atau image statis --}}
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>

        <div id="hero-content" class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white">
            <h1 class="text-5xl font-bold mb-4">
                {{-- Bisa diambil dari data section kalau ada kolom khusus untuk ini --}}
                <span class="text-red-800">{{ $section->hero_title ?? 'Ragam Kuliner Semarang:' }}</span><br>
                <span class="text-red-800 font-normal text-3xl">{{ $section->hero_subtitle ?? 'Kaya Rasa, Sarat Makna' }}</span>
            </h1>
            <button class="bg-red-800 text-white px-6 py-3 rounded-full shadow-lg flex items-center hover:bg-yellow-600" onclick="scrollToMenu()">
                View Menu
            </button>
        </div>

        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 bg-white rounded-full shadow-lg px-6 py-4 flex space-x-4 items-center z-30">
            <input
                id="search-bar"
                type="text"
                placeholder="Search by name or description..."
                class="flex-1 border-none bg-gray-100 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500" style="width: 300px;"
                oninput="handleSearch()"
            />
            <button class="bg-red-800 text-white font-bold rounded-md px-6 py-2 hover:bg-yellow-600">Search</button>
        </div>
    </div>

    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4 text-red-800">{{ $section->name ?? 'Kuliner Khas Semarang' }}</h1> {{-- Ambil nama section --}}
        @if ($section->description) {{-- Tampilkan deskripsi section jika ada --}}
            <p class="text-gray-700 mb-8">{{ $section->description }}</p>
        @endif

        <div id="food-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {{-- Loop untuk menampilkan semua konten di section ini --}}
            @forelse ($contents as $item) {{-- Variabelnya $contents, bukan $makanan --}}
                <div class="bg-white p-4 rounded-lg shadow-md hover:bg-red-800 hover:text-white transition group">
                    @if ($item->image) {{-- Kolom gambar di DB adalah 'image' --}}
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-48 object-cover rounded-md">
                    @else
                        {{-- Placeholder jika tidak ada gambar --}}
                        <img src="https://via.placeholder.com/400x300?text=No+Image" alt="No Image" class="w-full h-48 object-cover rounded-md">
                    @endif
                    <h2 class="text-xl font-bold mt-4 group-hover:text-white">{{ $item->title }}</h2> {{-- Kolom judul di DB adalah 'title' --}}
                    {{-- Gunakan line-clamp-3 untuk membatasi deskripsi di tampilan awal --}}
                    <p class="text-gray-700 mt-2 short-desc group-hover:text-white line-clamp-3">{{ $item->description }}</p> {{-- Kolom deskripsi di DB adalah 'description' --}}
                    {{-- Ini akan mengarahkan ke halaman detail konten. Abaikan script toggleReadMore di bagian card ini. --}}
                    <a href="{{ route('pengunjung.show.konten', $item->slug) }}" class="text-blue-500 mt-2 hover:underline group-hover:text-white">Read More</a>
                </div>
            @empty
                <p class="col-span-3 text-center text-gray-600">Belum ada konten untuk section ini.</p>
            @endforelse
        </div>
    </div>

    <script>
        // Fungsi scrollToMenu akan mengarahkan ke daftar makanan (food-list)
        function scrollToMenu() {
            const menuSection = document.getElementById('food-list');
            if (menuSection) {
                 menuSection.scrollIntoView({ behavior: 'smooth' });
            }
        }

        // Fungsi handleSearch untuk filter konten berdasarkan input search bar
        function handleSearch() {
            const searchValue = document.getElementById('search-bar').value.toLowerCase();
            const foodCards = document.querySelectorAll('#food-list > div'); // Pilih card konten
            foodCards.forEach(item => {
                const itemName = item.querySelector('h2').textContent.toLowerCase(); // Ambil judul konten
                const itemDesc = item.querySelector('.short-desc').textContent.toLowerCase(); // Ambil deskripsi singkat

                if (itemName.includes(searchValue) || itemDesc.includes(searchValue)) {
                    item.style.display = 'block'; // Tampilkan jika cocok
                } else {
                    item.style.display = 'none'; // Sembunyikan jika tidak cocok
                }
            });
        }

        // --- CATATAN PENTING ---
        // Script toggleReadMore yang ada di HTML lama lo, tidak diperlukan lagi di sini
        // karena link 'Read More' sekarang mengarahkan ke halaman detail konten,
        // bukan toggle deskripsi di halaman yang sama.
        // Lo bisa hapus fungsi toggleReadMore(button) jika sudah yakin tidak memakainya.
        // Karena di foreach loop sudah diganti dengan <a> tag.
    </script>
</body>
</html>