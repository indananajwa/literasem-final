
<div class="min-h-screen relative overflow-hidden">
    <!-- Envelope Background -->
    <div class="absolute inset-0">
        <div class="envelope-bg w-full h-full bg-gradient-to-br batik-pattern">
            <div class="envelope-fold"></div>
        </div>
    </div>

    <!-- Content Container -->
    <div class="relative z-10 container mx-auto px-4 py-8">
        <div class="max-w-5xl mx-auto">

            @if(!empty($video_sampul) && count($video_sampul) > 0)
                @foreach($video_sampul as $index => $video)
                <!-- Slide {{ $index + 1 }} -->
                <div id="slide{{ $index + 1 }}" 
                     class="slide bg-white/95 backdrop-blur-sm rounded-2xl shadow-2xl p-8 mb-8 transform transition-all duration-500" 
                     style="opacity: {{ $index === 0 ? '1' : '0' }}; display: {{ $index === 0 ? 'block' : 'none' }};">
                    
                    <!-- Video Container -->
                    <div class="video-container mb-6 shadow-lg rounded-xl overflow-hidden">
                        <iframe 
                            src="https://www.youtube.com/embed/{{ $video['youtube_id'] }}" 
                            title="{{ $video['title'] }}"
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen
                            class="w-full aspect-video">
                        </iframe>
                    </div>

                    <!-- Video Description -->
                    <div class="text-center mb-6">
                        @if(!empty($video['title']))
                            <h2 class="text-2xl font-semibold text-gray-800 mb-2">
                                {{ $video['title'] }}
                            </h2>
                        @endif

                        @if(!empty($video['description']))
                            <p class="text-gray-600">
                                {{ $video['description'] }}
                            </p>
                        @endif
                    </div>



                </div>
                @endforeach

                <!-- Navigation Buttons -->
                <div class="flex justify-center space-x-4">
                    @foreach($video_sampul as $index => $video)
                    <button onclick="showSlide({{ $index + 1 }})" 
                        class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-full font-medium transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 shadow-lg">
                        Video {{ $index + 1 }}
                    </button>
                    @endforeach
                </div>

            @else
                <!-- Fallback kalau gak ada video -->
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl p-8 text-center">
                    <h2 class="text-2xl font-semibold text-gray-700 mb-3">Belum Ada Video</h2>
                    <p class="text-gray-500">Kategori ini belum memiliki video untuk ditampilkan.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
function showSlide(slideNumber) {
    // Sembunyikan semua slide
    document.querySelectorAll('.slide').forEach(slide => {
        slide.style.opacity = '0';
        slide.style.display = 'none';
    });
    
    // Tampilkan slide terpilih
    const selectedSlide = document.getElementById(`slide${slideNumber}`);
    selectedSlide.style.display = 'block';
    setTimeout(() => {
        selectedSlide.style.opacity = '1';
    }, 50);
}

// Default: tampilkan slide pertama
document.addEventListener('DOMContentLoaded', () => {
    const firstSlide = document.querySelector('.slide');
    if (firstSlide) showSlide(1);
});
</script>

