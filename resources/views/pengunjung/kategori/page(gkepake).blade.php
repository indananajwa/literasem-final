<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $kategori->judul_kategori }}</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
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

    <!-- Detail Section -->
    <section id="detail-section" class="container mx-auto px-4 py-12">
        <h2 class="text-2xl md:text-4xl font-bold mb-12 text-center text-gray-800">
            Explore {{ $kategori->nama_kategori }} Destinations
        </h2>
        <div class="bg-white shadow-lg rounded-lg p-6 space-y-12">
            <!-- Dynamic tour content will be injected here -->
        </div>
    </section>

    <script src="{{ asset('js/kategori.js') }}"></script>
    
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