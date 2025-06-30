<main class="container mx-auto p-8 transition-all duration-700">
    <section class="text-center transition-all duration-700">
        <h1 class="text-3xl font-bold mt-2 text-red-800">
            Semarang dari Masa ke Masa
        </h1>
        <p class="text-gray-600 mt-2">
            Jelajahi sejarah dan transformasi Kota Semarang dari masa lalu, masa kini, hingga masa depan.
        </p>
        <div class="mt-4 flex justify-center space-x-4">
            <button id="btnPastPresent" class="bg-gray-200 text-gray-700 px-4 py-2 rounded" onclick="showSection('past-present')">
                Semarang Dulu dan Kini
            </button>
            <button id="btnFuture" class="bg-gray-200 text-gray-700 px-4 py-2 rounded" onclick="showSection('future')">
                Semarang Masa Depan
            </button>
        </div>
    </section>

    <section id="past-present-section" class="mt-8 transition-all duration-700">
        <div class="flex justify-center space-x-4 relative">
            <div class="relative w-1/2 hover-effect">
                <img alt="Past Image" class="rounded-lg w-full h-80 object-cover slide-transition" id="pastImage" src="/api/placeholder/600/400"/>
                <div class="hover-overlay rounded-lg">
                    <h3 class="text-white text-lg font-semibold" id="pastCaption">Past Caption</h3>
                </div>
                <button class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-red-800 text-white px-4 py-2 rounded-full" onclick="prevSlide()">
                    <i class="fas fa-chevron-left"></i>
                </button>
            </div>
            <div class="relative w-1/2 hover-effect">
                <img alt="Present Image" class="rounded-lg w-full h-80 object-cover slide-transition" id="presentImage" src="/api/placeholder/600/400"/>
                <div class="hover-overlay rounded-lg">
                    <h3 class="text-white text-lg font-semibold" id="presentCaption">Present Caption</h3>
                </div>
                <button class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-red-800 text-white px-4 py-2 rounded-full" onclick="nextSlide()">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
        <div class="text-center mt-4">
            <h2 id="slideTitle" class="text-2xl font-bold"></h2>
            <p id="slideDescription" class="text-gray-600 text-justify"></p>
        </div>
    </section>

    <section id="future-section" class="mt-8 section-transition hidden transition-all duration-700">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg overflow-hidden shadow-lg group">
                    <div class="relative aspect-video">
                        <img src="https://i3.ytimg.com/vi/B4mLKcVIERs/maxresdefault.jpg" alt="Transportasi Modern" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                        <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <button class="p-3 bg-blue-500 rounded-full text-white" onclick="playVideo('B4mLKcVIERs')">
                                <i class="fas fa-play"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Transportasi Modern</h3>
                        <p class="text-gray-600 text-sm">Sistem MRT dan LRT terintegrasi yang akan menghubungkan seluruh wilayah Semarang.</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg overflow-hidden shadow-lg group">
                    <div class="relative aspect-video">
                        <img src="https://i3.ytimg.com/vi/c48g-XFcLcU/maxresdefault.jpg" alt="Smart City" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                        <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <button class="p-3 bg-blue-500 rounded-full text-white" onclick="playVideo('c48g-XFcLcU')">
                                <i class="fas fa-play"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Smart City Infrastructure</h3>
                        <p class="text-gray-600 text-sm">Implementasi teknologi pintar untuk sistem manajemen kota yang lebih efisien.</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg overflow-hidden shadow-lg group">
                    <div class="relative aspect-video">
                        <img src="https://i3.ytimg.com/vi/RYMQOcxeg6U/maxresdefault.jpg" alt="Green Building" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                        <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <button class="p-3 bg-blue-500 rounded-full text-white" onclick="playVideo('RYMQOcxeg6U')">
                                <i class="fas fa-play"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Green Building Development</h3>
                        <p class="text-gray-600 text-sm">Pembangunan gedung ramah lingkungan dengan teknologi hemat energi.</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg overflow-hidden shadow-lg group">
                    <div class="relative aspect-video">
                        <img src="https://i3.ytimg.com/vi/c48g-XFcLcU/maxresdefault.jpg" alt="Digital Tourism" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                        <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <button class="p-3 bg-blue-500 rounded-full text-white" onclick="playVideo('c48g-XFcLcU')">
                                <i class="fas fa-play"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Digital Tourism</h3>
                        <p class="text-gray-600 text-sm">Pengembangan wisata digital dengan teknologi AR/VR untuk eksplorasi sejarah kota.</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg overflow-hidden shadow-lg group">
                    <div class="relative aspect-video">
                        <img src="https://i3.ytimg.com/vi/B4mLKcVIERs/maxresdefault.jpg" alt="Waterfront City" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                        <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <button class="p-3 bg-blue-500 rounded-full text-white" onclick="playVideo('B4mLKcVIERs')">
                                <i class="fas fa-play"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Waterfront City</h3>
                        <p class="text-gray-600 text-sm">Pengembangan kawasan pesisir dengan konsep modern dan berkelanjutan.</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg overflow-hidden shadow-lg group">
                    <div class="relative aspect-video">
                        <img src="https://i3.ytimg.com/vi/RYMQOcxeg6U/maxresdefault.jpg" alt="Cultural Preservation" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                        <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <button class="p-3 bg-blue-500 rounded-full text-white" onclick="playVideo('RYMQOcxeg6U')">
                                <i class="fas fa-play"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Cultural Preservation</h3>
                        <p class="text-gray-600 text-sm">Pelestarian budaya dengan teknologi modern untuk generasi mendatang.</p>
                    </div>
                </div>
            </div>
            <div id="videoModal" class="fixed inset-0 bg-black bg-opacity-75 hidden items-center justify-center z-50">
                <div class="relative w-full max-w-4xl mx-4">
                    <button class="absolute -top-10 right-0 text-white text-xl" onclick="closeVideo()">
                        <i class="fas fa-times"></i>
                    </button>
                    <div class="aspect-video bg-black">
                        <iframe id="videoFrame" 
                                class="w-full h-full" 
                                src="" 
                                title="YouTube video player" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>