<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $kategori->judul_kategori }}</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>
.batik-pattern {
    background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='rgba(255,255,255,0.1)' fill-rule='evenodd'/%3E%3C/svg%3E");
}

.envelope-bg {
    clip-path: polygon(0 0, 100% 0, 100% 70%, 0 70%);
}

.envelope-fold {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 100px;
    background: linear-gradient(to bottom, transparent, rgba(0,0,0,0.1));
    clip-path: polygon(0 0, 100% 0, 50% 100%);
    transform: translateY(50%);
}

.video-container {
    position: relative;
    padding-bottom: 56.25%;
    height: 0;
    overflow: hidden;
}

.video-container iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 0.75rem;
}

.slide {
    transition: opacity 0.5s ease-in-out;
}
</style>
<body class="bg-gray-100 text-gray-800 font-sans antialiased">

    @include('pengunjung.layouts.header')

    <!-- Hero Section -->
    <section id="hero-section" class="relative w-full h-[60vh] md:h-[80vh] overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img 
                src="{{ route('kategori.cover', $kategori->kode_kategori) }}" 
                alt="Cover {{ $kategori->judul_kategori }}" 
                class="w-full h-full object-cover object-center"
                onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjY2NjIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxOCIgZmlsbD0iIzk5OSIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPk5vIEltYWdlPC90ZXh0Pjwvc3ZnPg=='"
            >
            <div class="absolute inset-0 hero-overlay"></div>
        </div>

        <div class="relative z-10 flex flex-col justify-center items-center h-full text-center px-4 text-white">
            <h1 class="text-3xl md:text-5xl font-bold mb-4 leading-tight drop-shadow-lg">
                {{ $kategori->judul_kategori }}
            </h1>
            <p class="text-base md:text-xl font-light max-w-3xl mb-6 drop-shadow-md">
                {{ $kategori->deskripsi_kategori }}
            </p>
            <button onclick="scrollToMenuSection()"
                class="bg-red-600 text-white px-6 py-3 rounded-full shadow-lg hover:bg-red-700 transition duration-300 font-medium">
                Explore {{ $kategori->nama_kategori }}
            </button>
        </div>

        <!-- Search Bar -->
        <div class="absolute bottom-8 w-full flex justify-center px-4 z-20">
            <div class="bg-white rounded-lg shadow-lg flex flex-col sm:flex-row items-center w-full max-w-2xl p-3">
                <input 
                    id="search-bar" 
                    type="text" 
                    placeholder="Search destinations..." 
                    class="flex-1 w-full sm:w-auto border-none bg-gray-100 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" 
                    oninput="handleSearch()" 
                    aria-label="Search destinations"
                />
                <button onclick="performSearch()" 
                    class="bg-red-600 text-white font-semibold rounded-md px-6 py-2 mt-2 sm:mt-0 sm:ml-3 hover:bg-red-700 transition">
                    Search
                </button>
            </div>
        </div>
    </section>

    @if(isset($fieldRules['highlight']) && $fieldRules['highlight'] === 'required')
        @include('pengunjung.kategori.highlight')
    @endif
    
    @if(isset($fieldRules['sampulvideo']) && $fieldRules['sampulvideo'] === 'required')
        @include('pengunjung.kategori.sampulvideo')
    @endif

    <!-- Detail Section -->
    @if(isset($fieldRules['tampilan']) && $fieldRules['tampilan'] === '1')
        @include('pengunjung.kategori.kategori1')
    @else
        @include('pengunjung.kategori.kategori0')
    @endif

    <script>
        window.kategoriDataFromPHP = {!! json_encode($kategoriForJS ?? [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!};
        window.fieldRulesFromPHP = {!! json_encode($fieldRules ?? [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!};
        window.tourDataFromPHP = {!! json_encode($tourDataForJS ?? [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!};

        document.addEventListener('DOMContentLoaded', function () {
            if (typeof initializeData === 'function') {
                initializeData(
                    window.kategoriDataFromPHP,
                    window.fieldRulesFromPHP,
                    window.tourDataFromPHP
                );
                if (typeof initializePage === 'function') {
                    initializePage();
                }
            }
        });
    </script>

</body>
</html>
