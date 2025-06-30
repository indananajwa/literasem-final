<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Jelajah Wisata Semarang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" 
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" 
          crossorigin=""/>
    
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>
    
    <style>
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        

    </style>
</head>
<body class="bg-gray-50 text-gray-800">

<!-- Header -->
@include('pengunjung.layouts.header')

<!-- Hero Section -->
<div class="relative h-screen bg-cover bg-center" style="background-image: url('/cover/cover_pariwisata.jpg');">
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    <div class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white">
        <h1 class="text-5xl font-bold mb-4">Jelajah Wisata Semarang</h1>
        <p class="text-xl mb-6">Temukan Pesona Tersembunyi Semarang</p>
        <div class="flex gap-4">
            <button onclick="scrollToSection('detail-section')" class="bg-red-800 hover:bg-yellow-600 text-white px-6 py-3 rounded-full shadow-lg transition-colors">View More</button>
            <!-- <button onclick="scrollToSection('map-section')" class="bg-yellow-600 hover:bg-red-800 text-white px-6 py-3 rounded-full shadow-lg transition-colors">Lihat Peta</button> -->
        </div>
    </div>
</div>

<!-- Search Bar -->
<div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 bg-white rounded-full shadow-lg px-6 py-4 flex space-x-4 items-center z-30">
    <input id="search-bar" type="text" placeholder="Search by name or description..." class="flex-1 border-none bg-gray-100 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500" style="width: 300px;" oninput="handleSearch()" />
    <button class="bg-red-800 text-white font-bold rounded-md px-6 py-2 hover:bg-yellow-600 transition-colors">Search</button>
</div>

<!-- Top 5 Wisata -->
<section class="container mx-auto px-4 py-12">
    <h2 class="text-4xl font-bold mb-8 text-center">Jelajah Wisata <span class="text-red-800">Semarang</span></h2>
    <div id="highlight-scroll-wrapper" class="flex space-x-6 overflow-x-auto hide-scrollbar scroll-smooth snap-x snap-mandatory px-1">
        @foreach($highlight as $item)
        <div class="flex-shrink-0 w-64 h-80 snap-start rounded-lg relative cursor-pointer overflow-hidden group">
            <img src="{{ route('pariwisata.gambar', $item->id) }}" alt="{{ $item->nama }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" />
            <div class="absolute inset-0 bg-black/40 flex flex-col items-center justify-end text-center px-4 pb-4">
                <h3 class="text-xl font-bold text-white drop-shadow-md shadow-black">{{ $item->nama }}</h3>
                <div class="flex gap-2 mt-3">
                    <button onclick="scrollToSection('detail-{{ $item->id }}')" class="text-sm bg-white text-red-800 px-3 py-1 rounded hover:bg-yellow-500 transition">Detail</button>
                    <!-- <button onclick="showOnMap({{ $item->lat }}, {{ $item->lng }}, '{{ $item->nama }}')" class="text-sm bg-yellow-600 text-white px-3 py-1 rounded hover:bg-red-800 transition">Peta</button> -->
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- Detail Section -->
<section id="detail-section" class="container mx-auto px-4 py-12">
    <h2 class="text-4xl font-bold text-center mb-8 text-red-800">Detail Destinasi</h2>
    <div class="bg-white rounded-lg shadow p-8 space-y-10" id="detail-list">
        @foreach($data as $item)
        <div id="detail-{{ $item->id }}" class="tour-detail flex flex-col md:flex-row gap-6" data-nama="{{ strtolower($item->nama) }}" data-deskripsi="{{ strtolower($item->deskripsi) }}">
            <div class="md:w-1/3 w-full">
                <img src="{{ route('pariwisata.gambar', $item->id) }}" alt="{{ $item->nama }}" class="w-full h-64 object-cover rounded border border-gray-300">
            </div>
            <div class="flex-1">
                <h3 class="text-3xl font-bold text-red-800 mb-4">{{ $item->nama }}</h3>
                <p class="text-gray-700 text-justify mb-4">{{ $item->deskripsi }}</p>
                <div class="flex gap-3">
                    <button onclick="showOnMap({{ $item->lat }}, {{ $item->lng }}, '{{ $item->nama }}')" 
                            class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-red-800 transition-colors">
                        📍 Lihat di Peta
                    </button>
                    <a href="{{ $item->url_maps }}" target="_blank" 
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors">
                        🗺️ Google Maps
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- Interactive Map Section -->
<section id="map-section" class="container mx-auto px-4 py-12">
    <h2 class="text-4xl font-bold text-center mb-8 text-red-800">Peta Lokasi Wisata</h2>
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="mb-4 flex flex-wrap gap-2">
            <button onclick="showAllMarkers()" class="bg-red-800 text-white px-4 py-2 rounded hover:bg-yellow-600 transition-colors">Tampilkan Semua</button>
            <button onclick="centerToSemarang()" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition-colors">Pusat Semarang</button>
            <!-- @foreach($data as $item)
            <button onclick="focusLocation({{ $item->lat }}, {{ $item->lng }}, '{{ $item->nama }}')" 
                    class="bg-yellow-600 text-white px-3 py-1 rounded text-sm hover:bg-red-800 transition-colors">
                {{ $item->nama }}
            </button>
            @endforeach -->
        </div>
        <div id="map" class="w-full h-96 rounded-lg border border-gray-300"></div>
        <div class="mt-4 text-sm text-gray-600">
            <p><strong>Panduan:</strong> Klik marker untuk melihat detail wisata. Gunakan tombol di atas untuk navigasi cepat.</p>
        </div>
    </div>
</section>



<!-- Script -->
<script>
    let map;
    let markers = [];
    
    // Data wisata dari PHP
    const wisataData = [
        @foreach($data as $item)
        {
            id: {{ $item->id }},
            nama: '{{ $item->nama }}',
            lat: {{ $item->lat }},
            lng: {{ $item->lng }},
            deskripsi: '{{ substr($item->deskripsi, 0, 150) }}...',
            url_maps: '{{ $item->url_maps }}'
        },
        @endforeach
    ];
    
    // Inisialisasi peta
    function initMap() {
        // Koordinat pusat Semarang
        const semarangCenter = [-6.9667, 110.4289];
        
        // Buat peta
        map = L.map('map').setView(semarangCenter, 12);
        
        // Tambahkan tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 18
        }).addTo(map);
        
        // Tambahkan marker untuk setiap destinasi wisata
        wisataData.forEach(function(item) {
            const marker = L.marker([item.lat, item.lng])
                .addTo(map)
                .bindPopup(`
                    <div class="text-center">
                        <h3 class="font-bold text-lg text-red-800 mb-2">${item.nama}</h3>
                        <p class="text-sm text-gray-600 mb-3">${item.deskripsi}</p>
                        <div class="flex gap-2 justify-center">
                            <button onclick="scrollToSection('detail-${item.id}')" 
                                    class="bg-red-800 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">
                                Detail
                            </button>
                            <a href="${item.url_maps}" target="_blank" 
                               class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
                                Google Maps
                            </a>
                        </div>
                    </div>
                `);
            
            markers.push(marker);
        });
    }
    
    // Fungsi untuk menampilkan lokasi di peta
    function showOnMap(lat, lng, nama) {
        scrollToSection('map-section');
        setTimeout(() => {
            map.setView([lat, lng], 16);
            
            // Buka popup marker yang sesuai
            markers.forEach(marker => {
                const markerLatLng = marker.getLatLng();
                if (Math.abs(markerLatLng.lat - lat) < 0.001 && Math.abs(markerLatLng.lng - lng) < 0.001) {
                    marker.openPopup();
                }
            });
        }, 500);
    }
    
    // Fungsi untuk menampilkan semua marker
    function showAllMarkers() {
        if (markers.length > 0) {
            const group = new L.featureGroup(markers);
            map.fitBounds(group.getBounds().pad(0.1));
        }
    }
    
    // Fungsi untuk fokus ke pusat Semarang
    function centerToSemarang() {
        map.setView([-6.9667, 110.4289], 12);
    }
    
    // Fungsi untuk fokus ke lokasi tertentu
    function focusLocation(lat, lng, nama) {
        showOnMap(lat, lng, nama);
    }
    
    // Fungsi scroll ke section
    function scrollToSection(id) {
        const el = document.getElementById(id);
        if (el) {
            el.scrollIntoView({ behavior: 'smooth' });
        }
    }
    
    // Fungsi pencarian
    function handleSearch() {
        const query = document.getElementById('search-bar').value.toLowerCase();
        document.querySelectorAll('.tour-detail').forEach(el => {
            const nama = el.dataset.nama;
            const desk = el.dataset.deskripsi;
            el.style.display = (nama.includes(query) || desk.includes(query)) ? 'flex' : 'none';
        });
    }
    
    // Inisialisasi peta saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        initMap();
    });
</script>

</body>
</html>