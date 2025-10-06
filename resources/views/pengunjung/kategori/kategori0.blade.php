<!-- kategori0.blade.php - Template Default untuk tourData -->
<section class="container mx-auto px-4 py-12">
    <h2 class="text-4xl font-bold mb-8 text-center">Detail Destinasi</h2>

    {{-- tampilkan highlight kalau aktif --}}
    @if(isset($kategori) && $kategori->highlight == 1)
        @include('pengunjung.kategori.highlight')
    @endif

    {{-- tampilkan video sampul kalau ada --}}
    @if(!empty($video_sampul) && count($video_sampul) > 0)
        @include('pengunjung.kategori.sampulvideo', ['video_sampul' => $video_sampul])
    @endif

    <div id="detail-section" class="space-y-8">
        <!-- Konten akan di-generate lewat JavaScript dari tourData -->
    </div>
</section>

<script src="{{ asset('js/kategori.js') }}"></script>
<script>
    console.log('kategori0.blade.php loaded - using default template');
</script>
