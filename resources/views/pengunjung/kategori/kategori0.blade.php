<!-- kategori0.blade.php - Template Default untuk tourData -->
<section class="container mx-auto px-4 py-12">
    <!-- Section Header -->
    <div class="text-center mb-12">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-red-100 rounded-2xl mb-4">
            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
            </svg>
        </div>
        <h2 class="text-4xl font-bold text-gray-900 mb-3">Detail Arsip Kota Semarang</h2>
        <p class="text-gray-600 max-w-2xl mx-auto">Jelajahi koleksi arsip digital yang telah kami kurasi dengan cermat untuk Anda</p>
    </div>

    <!-- Content Grid -->
    <div id="detail-section" class="space-y-6 max-w-7xl mx-auto">
        <!-- Konten akan di-generate lewat JavaScript dari tourData -->
    </div>
</section>

<script src="{{ asset('js/kategori.js') }}"></script>
<script>
    // Template default - menggunakan tourData dari kategori.js
    // Tidak perlu script tambahan karena semua logic ada di kategori.js
    console.log('kategori0.blade.php loaded - using default template');
</script>