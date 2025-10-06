<div class="max-w-5xl mx-auto">
    {{-- Slide default Kota Lama hanya untuk halaman SIT --}}
    @if(request()->is('situs-kota-lama'))
    <div id="slide1" class="slide bg-white/95 backdrop-blur-sm rounded-2xl shadow-2xl p-8 mb-8 transform transition-all duration-500" style="opacity: 1; display: block;">
        <div class="video-container mb-6 shadow-lg rounded-xl overflow-hidden">
            <iframe src="https://www.youtube.com/embed/khNkocgfiN0" 
                    title="Revitalisasi Situs Kota Lama" 
                    frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen
                    class="w-full aspect-video">
            </iframe>
        </div>
        <div class="text-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-2">Revitalisasi Kota Lama Semarang</h2>
            <p class="text-gray-600">Upaya pelestarian Kota Lama Semarang agar tetap menjadi ikon bersejarah yang menarik dan berdaya guna.</p>
        </div>
    </div>
    @endif

    {{-- Video admin dinamis --}}
    @if(!empty($video_sampul))
        @foreach($video_sampul as $index => $video)
        @php
            // Jika default Kota Lama ada, slide admin mulai dari 2, kalau tidak mulai dari 1
            $slideNumber = request()->is('situs-kota-lama') ? (int)$index + 2 : (int)$index + 1;
        @endphp
        <div id="slide{{ $slideNumber }}" 
             class="slide bg-white/95 backdrop-blur-sm rounded-2xl shadow-2xl p-8 mb-8 transform transition-all duration-500" 
             style="opacity: 0; display: none;">
            
            <div class="video-container mb-6 shadow-lg rounded-xl overflow-hidden">
                @if(is_array($video) && !empty($video['youtube_id']))
                    <iframe src="https://www.youtube.com/embed/{{ $video['youtube_id'] }}" 
                            title="{{ $video['title'] ?? '' }}" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen
                            class="w-full aspect-video">
                    </iframe>
                @elseif(is_string($video) && $video != '')
                    <iframe src="https://www.youtube.com/embed/{{ $video }}" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen
                            class="w-full aspect-video">
                    </iframe>
                @else
                    <div class="bg-gray-200 w-full aspect-video flex items-center justify-center">
                        <span class="text-gray-500">Video tidak tersedia</span>
                    </div>
                @endif
            </div>

            @if(is_array($video))
            <div class="text-center mb-6">
                @if(!empty($video['title']))
                    <h2 class="text-2xl font-semibold text-gray-800 mb-2">{{ $video['title'] }}</h2>
                @endif
                @if(!empty($video['description']))
                    <p class="text-gray-600">{{ $video['description'] }}</p>
                @endif
            </div>
            @endif
        </div>
        @endforeach
    @endif

    {{-- Navigation Buttons --}}
    <div class="flex justify-center space-x-4">
        {{-- Default Kota Lama button --}}
        @if(request()->is('situs-kota-lama'))
            <button onclick="showSlide(1)" class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-full font-medium shadow-lg">Video 1</button>
        @endif

        {{-- Video admin buttons --}}
        @if(!empty($video_sampul))
            @foreach($video_sampul as $index => $video)
            @php
                $slideNumber = request()->is('situs-kota-lama') ? (int)$index + 2 : (int)$index + 1;
            @endphp
            <button onclick="showSlide({{ $slideNumber }})" class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-full font-medium shadow-lg">
                Video {{ $slideNumber }}
            </button>
            @endforeach
        @endif
    </div>
</div>

<script>
function showSlide(slideNumber) {
    document.querySelectorAll('.slide').forEach(slide => {
        slide.style.opacity = '0';
        slide.style.display = 'none';
    });

    const selectedSlide = document.getElementById(`slide${slideNumber}`);
    if(selectedSlide){
        selectedSlide.style.display = 'block';
        setTimeout(() => { selectedSlide.style.opacity = '1'; }, 50);
    }
}

// Tampilkan default slide pertama
document.addEventListener('DOMContentLoaded', () => {
    @if(request()->is('situs-kota-lama'))
        showSlide(1);
    @elseif(!empty($video_sampul))
        showSlide(1); // Jika default tidak ada, tampilkan slide admin pertama
    @endif
});
</script>
