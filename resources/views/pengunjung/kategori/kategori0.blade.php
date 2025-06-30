
<!-- kategori0.blade.php - Template Default untuk tourData -->
<section id="detail-section" class="container mx-auto px-4 py-12">
    <h2 class="text-4xl font-bold mb-8 text-center">Detail Destinasi</h2>
    <div id="tour-items-container" class="space-y-8">
        <!-- Konten akan di-generate lewat JavaScript dari tourData -->
    </div>
</section>
<script src="{{ asset('js/kategori.js') }}"></script>
<script>
    // Template default - menggunakan tourData dari kategori.js
    // Tidak perlu script tambahan karena semua logic ada di kategori.js
    console.log('kategori0.blade.php loaded - using default template');
</script>