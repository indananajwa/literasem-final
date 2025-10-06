<!-- Menu Section (Highlight) -->
@if(isset($highlightKategori) && count($highlightKategori) > 0)
<div id="menu-section" class="container mx-auto px-4 py-6 mt-12 relative">
    <h2 class="text-4xl font-bold mb-8 text-center">
        Jelajah Budaya
        <span class="text-red-800">Semarang</span>
    </h2>
    
    <!-- Left Arrow Button -->
    <button id="scroll-left" 
            onclick="scrollHighlight('left')" 
            class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-red-800 text-white px-4 py-2 rounded-full hover:bg-yellow-600 transition-colors duration-300 shadow-lg z-20">
        <i class="fas fa-chevron-left"></i>
    </button>
    
    <!-- Tour Items Container -->
    <div id="tour-items" class="overflow-x-auto hide-scrollbar flex space-x-4 px-12 scroll-smooth">
        @foreach($highlightData as $highlight)
            @php
                $kat = $highlight['kategori'];
                $kontenItems = $highlight['konten'];
            @endphp
            
            <!-- Kategori Group -->
            <div class="highlight-category-group min-w-max">
                <!-- Kategori Title -->
                <h3 class="text-xl font-semibold text-gray-800 mb-4 px-2">
                    {{ $kat->nama_kategori }}
                </h3>
                
                <!-- Konten Items -->
                <div class="flex space-x-4">
                    @forelse($kontenItems as $item)
                        <a href="{{ route('pengunjung.kategori.show', $kat->kode_kategori) }}" 
                           class="highlight-item block min-w-[280px] bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                            <!-- Gambar -->
                            @if($item->gambar)
                                <div class="h-48 overflow-hidden bg-gray-200">
                                    <img src="data:{{ $item->mime_type }};base64,{{ base64_encode($item->gambar) }}" 
                                         alt="{{ $item->judul }}"
                                         class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                                </div>
                            @else
                                <div class="h-48 bg-gradient-to-br from-red-100 to-yellow-100 flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400 text-4xl"></i>
                                </div>
                            @endif
                            
                            <!-- Content -->
                            <div class="p-4">
                                <h4 class="text-lg font-semibold text-gray-800 mb-2 line-clamp-2">
                                    {{ $item->judul }}
                                </h4>
                                <p class="text-sm text-gray-600 line-clamp-3">
                                    {{ $item->deskripsi }}
                                </p>
                                
                                <!-- Badge Kategori -->
                                <div class="mt-3 inline-flex items-center px-3 py-1 rounded-full bg-red-100 text-red-800 text-xs font-medium">
                                    <i class="fas fa-tag mr-1"></i>
                                    {{ $kat->kode_kategori }}
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="min-w-[280px] bg-gray-100 rounded-lg p-6 text-center">
                            <i class="fas fa-inbox text-gray-400 text-3xl mb-2"></i>
                            <p class="text-gray-500 text-sm">Belum ada konten</p>
                        </div>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>
    
    <!-- Right Arrow Button -->
    <button id="scroll-right" 
            onclick="scrollHighlight('right')" 
            class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-red-800 text-white px-4 py-2 rounded-full hover:bg-yellow-600 transition-colors duration-300 shadow-lg z-20">
        <i class="fas fa-chevron-right"></i>
    </button>
</div>

<!-- Add Font Awesome CDN if not already included -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<script>
    function scrollHighlight(direction) {
        const container = document.getElementById('tour-items');
        const scrollAmount = 400;
        
        if (direction === 'left') {
            container.scrollBy({
                left: -scrollAmount,
                behavior: 'smooth'
            });
        } else {
            container.scrollBy({
                left: scrollAmount,
                behavior: 'smooth'
            });
        }
    }

    // Auto-hide buttons if no scroll needed
    window.addEventListener('load', function() {
        const container = document.getElementById('tour-items');
        const leftBtn = document.getElementById('scroll-left');
        const rightBtn = document.getElementById('scroll-right');
        
        function checkScrollButtons() {
            if (container.scrollWidth <= container.clientWidth) {
                leftBtn.style.display = 'none';
                rightBtn.style.display = 'none';
            } else {
                leftBtn.style.display = 'block';
                rightBtn.style.display = 'block';
            }
        }
        
        checkScrollButtons();
        window.addEventListener('resize', checkScrollButtons);
    });
</script>
@endif