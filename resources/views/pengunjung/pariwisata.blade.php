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
        </div>
    </div>
</div>

<!-- Search Bar -->
<div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 bg-white rounded-full shadow-lg px-6 py-4 flex space-x-4 items-center z-30">
    <input id="search-bar" type="text" placeholder="Search by name or description..." class="flex-1 border-none bg-gray-100 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500" style="width: 300px;" oninput="handleSearch()" />
    <button class="bg-red-800 text-white font-bold rounded-md px-6 py-2 hover:bg-yellow-600 transition-colors">Search</button>
</div>

<!-- Top 5 Wisata / Highlight -->
<section class="w-full py-12">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-8 text-center">Wisata <span class="text-red-800">Populer</span></h2>
        
        <div class="flex justify-center">
            <div id="highlight-scroll-wrapper" class="flex space-x-6 overflow-x-auto hide-scrollbar scroll-smooth snap-x snap-mandatory">
                @foreach($highlight as $item)
                <div class="flex-shrink-0 w-64 h-80 snap-start rounded-lg relative cursor-pointer overflow-hidden group">
                    <img src="{{ route('pariwisata.gambar', $item->kodePariwisata) }}" alt="{{ $item->nama }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" />
                    <div class="absolute inset-0 bg-black/40 flex flex-col items-center justify-end text-center px-4 pb-4">
                        <h3 class="text-xl font-bold text-white drop-shadow-md">{{ $item->nama }}</h3>
                        <button 
                            onclick="scrollToSection('detail-{{ $item->kodePariwisata }}')" 
                            class="text-sm bg-white text-red-800 px-4 py-2 rounded font-semibold hover:bg-yellow-500 transition mt-3"
                        >
                            Detail
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Detail Section -->
<section id="detail-section" class="container mx-auto px-4 py-12">
    <h2 class="text-4xl font-bold text-center mb-8 text-red-800">Detail Destinasi</h2>
    <div class="bg-white rounded-lg shadow p-8 space-y-10" id="detail-list">
        @foreach($data as $item)
        <div id="detail-{{ $item->kodePariwisata }}" class="tour-detail flex flex-col md:flex-row gap-6" data-nama="{{ strtolower($item->nama) }}" data-deskripsi="{{ strtolower($item->deskripsi) }}">
            <div class="md:w-1/3 w-full">
                <img src="{{ route('pariwisata.gambar', $item->kodePariwisata) }}" alt="{{ $item->nama }}" class="w-full h-64 object-cover rounded border border-gray-300">
            </div>
            <div class="flex-1 flex flex-col justify-between">
                <div>
                    <h3 class="text-3xl font-bold text-red-800 mb-4">{{ $item->nama }}</h3>
                    <p class="text-gray-700 text-justify mb-4">{{ $item->deskripsi }}</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <button onclick="showOnMap({{ $item->lat }}, {{ $item->lng }}, '{{ $item->nama }}')" 
                            class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-red-800 transition-colors">
                        📍 Lihat di Peta
                    </button>
                    
                    @if($item->url_maps)
                    <a href="{{ $item->url_maps }}" target="_blank" 
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors">
                        🗺️ Google Maps
                    </a>
                    @endif

                    <!-- TOMBOL BOOKMARK -->
                    <button 
                        class="flex items-center gap-2 px-4 py-2 bg-amber-500 text-white rounded-lg hover:bg-amber-600 transition-colors duration-200 bookmark-btn"
                        data-tour-json="{{ urlencode(json_encode([
                            'id' => $item->kodePariwisata,
                            'name' => $item->nama,
                            'description' => $item->deskripsi,
                            'lat' => $item->lat,
                            'lng' => $item->lng,
                            'url_maps' => $item->url_maps,
                            'images' => [route('pariwisata.gambar', $item->kodePariwisata)],
                            'video' => null
                        ])) }}"
                    >
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2z"/>
                        </svg>
                        Bookmark
                    </button>
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
            kodePariwisata: '{{ $item->kodePariwisata }}',
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
                        <h3 class="font-bold text-lg text-red-800 mb-2 mt-1">${item.nama}</h3>
                        <p class="text-sm text-gray-600 mb-3">${item.deskripsi}</p>
                        <div class="flex gap-2 justify-center">
                            <button onclick="scrollToSection('detail-${item.kodePariwisata}')" 
                                    class="bg-red-800 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">
                                Detail
                            </button>
                            ${item.url_maps ? `<a href="${item.url_maps}" target="_blank" 
                               class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700" style="color: white !important;">
                                Google Maps
                            </a>` : ''}
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

    // ===== BOOKMARK FUNCTIONS =====
    
    // Attach bookmark listeners
    function attachBookmarkListeners() {
        document.querySelectorAll('.bookmark-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const tourJson = decodeURIComponent(btn.dataset.tourJson);
                const tour = JSON.parse(tourJson);
                addToBookmark(tour);
            });
        });
    }

    // Add to bookmark
    function addToBookmark(tour) {
        initializeModal();
        
        try {
            let bookmarks = JSON.parse(localStorage.getItem('literasem_bookmarks')) || [];
            
            const exists = bookmarks.some(b => b.id === tour.id);
            if (exists) {
                showErrorModal('Konten ini sudah ada di daftar bookmark Anda.', 'duplicate');
                return;
            }
            
            const newBookmark = {
                id: tour.id,
                name: tour.name,
                description: tour.description || '',
                url: window.location.href + '#' + tour.id,
                category: 'Pariwisata',
                dateAdded: new Date().toISOString(),
                images: tour.images || [],
                video: tour.video || null
            };
            
            bookmarks.push(newBookmark);
            localStorage.setItem('literasem_bookmarks', JSON.stringify(bookmarks));
            
            showSuccessModal(tour);
            
        } catch (error) {
            console.error('Gagal menyimpan bookmark:', error);
            showErrorModal('Gagal menyimpan bookmark. Silakan coba lagi.', 'error');
        }
    }

    // Modal functions
    function createModalHTML() {
        return `
            <div id="bookmark-modal" class="fixed inset-0 z-50 hidden">
                <div class="absolute inset-0 bg-black bg-opacity-50 backdrop-blur-sm transition-opacity duration-300"></div>
                <div class="flex items-center justify-center min-h-screen p-4">
                    <div id="modal-content" class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all duration-300 scale-95 opacity-0">
                        <button id="close-modal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                        <div id="modal-body" class="p-8"></div>
                    </div>
                </div>
            </div>
        `;
    }

    function initializeModal() {
        if (!document.getElementById('bookmark-modal')) {
            document.body.insertAdjacentHTML('beforeend', createModalHTML());
            
            const modal = document.getElementById('bookmark-modal');
            const closeBtn = document.getElementById('close-modal');
            const backdrop = modal.querySelector('.absolute.inset-0');
            
            closeBtn.addEventListener('click', closeModal);
            backdrop.addEventListener('click', closeModal);
            
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                    closeModal();
                }
            });
        }
    }

    function showModal() {
        const modal = document.getElementById('bookmark-modal');
        const modalContent = document.getElementById('modal-content');
        
        modal.classList.remove('hidden');
        
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeModal() {
        const modal = document.getElementById('bookmark-modal');
        const modalContent = document.getElementById('modal-content');
        
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    function showSuccessModal(tour) {
        const modalBody = document.getElementById('modal-body');
        modalBody.innerHTML = `
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2z"/>
                    </svg>
                </div>
                
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Bookmark Berhasil Disimpan!</h3>
                
                <p class="text-gray-600 mb-6">
                    <strong>${tour.name}</strong> telah berhasil ditambahkan ke daftar bookmark Anda.
                </p>
                
                <div class="flex gap-3">
                    <button onclick="closeModal()" class="flex-1 bg-gray-100 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-200 transition-colors">
                        Tutup
                    </button>
                    <button onclick="viewBookmarks()" class="flex-1 bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 transition-colors">
                        Lihat Bookmark
                    </button>
                </div>
            </div>
        `;
        showModal();
    }

    function showErrorModal(message, type = 'duplicate') {
        const modalBody = document.getElementById('modal-body');
        
        const iconColor = type === 'duplicate' ? 'text-amber-500' : 'text-red-500';
        const bgColor = type === 'duplicate' ? 'bg-amber-100' : 'bg-red-100';
        const title = type === 'duplicate' ? 'Sudah Ada di Bookmark' : 'Terjadi Kesalahan';
        
        modalBody.innerHTML = `
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center w-16 h-16 ${bgColor} rounded-full mb-4">
                    ${type === 'duplicate' ? `
                        <svg class="w-8 h-8 ${iconColor}" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    ` : `
                        <svg class="w-8 h-8 ${iconColor}" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                        </svg>
                    `}
                </div>
                
                <h3 class="text-xl font-semibold text-gray-900 mb-2">${title}</h3>
                
                <p class="text-gray-600 mb-6">${message}</p>
                
                <div class="flex gap-3">
                    <button onclick="closeModal()" class="flex-1 bg-gray-100 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-200 transition-colors">
                        Tutup
                    </button>
                    ${type === 'duplicate' ? `
                        <button onclick="viewBookmarks()" class="flex-1 bg-amber-500 text-white py-2 px-4 rounded-lg hover:bg-amber-600 transition-colors">
                            Lihat Bookmark
                        </button>
                    ` : ''}
                </div>
            </div>
        `;
        showModal();
    }

    function viewBookmarks() {
        closeModal();
        window.location.href = '/bookmark';
    }
    
    // Initialize pada DOMContentLoaded
    document.addEventListener('DOMContentLoaded', function() {
        initMap();
        attachBookmarkListeners();
        initializeModal();
    });
</script>

</body>
</html>