<!-- kategori1.blade.php - Template Card Grid untuk tourData -->
<section id="menu-section" class="container mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold text-center mb-6">Destinasi Wisata</h1>
    <div id="food-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Konten akan di-generate lewat JavaScript dari kategori.js -->
    </div>
</section>

<script src="{{ asset('js/kategori.js') }}"></script>
<script>
    console.log('kategori1.blade.php loaded - using card grid template');
</script>