<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jelajah Budaya Semarang</title>
    <style>
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        
        /* Tambahan untuk memastikan container scrollable */
        #menu-section {
            position: relative;
            width: 100%;
            overflow: hidden;
        }
        
        #tour-items {
            display: flex;
            gap: 1rem;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
            scroll-snap-type: x mandatory;
            padding: 1rem;
        }
        
        .tour-item {
            flex: 0 0 auto;
            width: 256px; /* w-64 dalam pixels */
            scroll-snap-align: start;
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Include Header -->
    @include('pengunjung.layouts.header')

    <!-- Hero Section -->
    <div id="hero-section" class="relative h-screen bg-cover bg-center z-10" style="background-image: url('cover/cover_budaya.png');">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div id="hero-content" class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white">
            <h1 class="text-5xl font-bold mb-4">
                <span class="text-white shadow-lg">Jelajah Budaya Semarang</span><br>
                <span class="text-white-800 font-normal text-3xl">Keindahan yang Tak Lekang oleh Waktu</span>
            </h1>
            <button class="bg-red-800 text-white px-6 py-3 rounded-full shadow-lg flex items-center hover:bg-yellow-600" onclick="scrollToMenuSection()">
                View Culture
            </button>
        </div>
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 bg-white rounded-full shadow-lg px-6 py-4 flex space-x-4 items-center z-30">
            <input id="search-bar" type="text" placeholder="Search by name or description..." class="flex-1 border-none bg-gray-100 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500" style="width: 300px;" oninput="handleSearch()" />
            <button class="bg-red-800 text-white font-bold rounded-md px-6 py-2 hover:bg-yellow-600">Search</button>
        </div>
    </div>

    <!-- Menu Section -->
    <div id="menu-section" class="container mx-auto px-4 py-6 mt-12 relative">

        <h2 class="text-4xl font-bold mb-8 text-center">
            Jelajah Budaya
            <span class="text-red-800">Semarang</span>
        </h2>

        <!-- Left Arrow -->
        <button id="scroll-left" onclick="scrollLeft()" class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-red-800 text-white p-2 rounded-full shadow-lg hover:bg-yellow-600 z-20">
            &#8592;
        </button>

        <!-- Tour Items -->
        <div id="tour-items" class="overflow-x-auto hide-scrollbar">
            <!-- Dynamically generated tour items will go here -->
        </div>

        <!-- Right Arrow -->
        <button id="scroll-right" onclick="scrollRight()" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-red-800 text-white p-2 rounded-full shadow-lg hover:bg-yellow-600 z-20">
            &#8594;
        </button>
    </div>




<!-- Detail Section -->
<div id="detail-section" class="container mx-auto px-4 py-6 mt-12">
    <h2 class="text-4xl font-bold mb-8 text-center">
        Detail Destinasi Budaya
    </h2>
    
    <div class="space-y-6"></div>

    <script>
        const tourData = [
            {
                id: "dugderan",
                name: "Dugderan",
                images: [
                    "budayaa/DUGDERAN .jpg"
                ],
                video: "https://youtu.be/B4mLKcVIERs?si=M0_LI27XiNACFyqW",
                description: "Dugderan adalah festival tahunan di Semarang yang dimulai pada abad ke-19 untuk menyambut bulan Ramadan. Nama 'Dugderan' berasal dari suara drum yang digunakan untuk menandakan dimulainya puasa. Festival ini melibatkan pawai, hiburan, dan bazar, menjadi simbol kebersamaan masyarakat Semarang dalam menyambut bulan suci Ramadan."
            },
            {
                id: "sesaji-rewanda",
                name: "Sesaji Rewanda",
                images: [
                    "budayaa/SESAJI REWANDA.png"
                ],
                description: "Sesaji Rewanda adalah tradisi ritual syukur masyarakat Semarang, khususnya di Kampung Melayu, yang dilakukan dengan menyajikan nasi, lauk, dan hasil bumi sebagai persembahan kepada leluhur. Ritual ini biasanya digelar pada Hari Raya Idul Fitri atau hari-hari sakral, dengan tujuan menjaga keharmonisan antara manusia, alam, dan roh leluhur serta mempererat silaturahmi antar warga."
            },
            {
                id: "gebyuran",
                name: "Gebyuran",
                images: [
                    "budayaa/GEBYURAN.jpg"
                ],
                description: "Gebyuran adalah tradisi unik di Semarang yang dilakukan pada Hari Raya Idul Fitri, di mana warga saling melemparkan air sebagai bentuk kegembiraan dan perayaan. Tradisi ini diperkirakan sudah ada sejak zaman kolonial, sebagai cara masyarakat merayakan kedatangan bulan suci Ramadan dan Idul Fitri. Selain menjadi hiburan, Gebyuran juga simbol kebersamaan, persaudaraan, dan berbagi kebahagiaan."
            },
            {
                id: "semarang-night-carnival",
                name: "Semarang Night Carnival",
                images: [
                    "budayaa/SEMARANG NIGHT CARNIVAL.jpg",
                ],
                video: "https://youtu.be/fiufDc9AUWA?si=GWVIOAMEIf_8AwV6",
                description: "Semarang night carnival merupakan ajang karnaval pertama yang digelar malam hari, dilaksanakan pertama tahun 2011 merupakan salah satu agenda perayaan HUT Kota Semarang yang kemudian dijadikan agenda tahunan. Diikuti ribuan peserta dengan kostum yang beragam, mencerminkan karakter Kota Semarang yang beragam budaya."
            },
            {
                id: "tari-gambang-semarangan",
                name: "Tari Gambang Semarangan",
                images: [
                    "budayaa/TARI SEMARANGAN.jpg"
                ],
                description: "Tari Gambang Semarangan, atau Tari Semarangan, adalah seni tradisional Semarang yang memadukan budaya Tionghoa dan Jawa. Tarian ini sering disisipkan lawakan ringan, dan diiringi musik tradisional seperti gamelan, kendang, kempul, serta alat musik Tionghoa seperti konghayan dan tohyan."
            }
        ];


        const detailSection = document.getElementById("detail-section");

        function getYouTubeVideoId(url) {
            if (!url) return null;
            let videoId = null;
            if (url.includes('youtu.be/')) {
                videoId = url.split('youtu.be/')[1];
            } else if (url.includes('youtube.com/')) {
                const urlParams = new URLSearchParams(new URL(url).search);
                videoId = urlParams.get('v');
            }
            if (videoId) {
                videoId = videoId.split('?')[0];
                videoId = videoId.split('&')[0];
            }
            return videoId;
        }
        
        function createMainContent(tour) {
                const hasVideo = tour.video && getYouTubeVideoId(tour.video);
                
                if (hasVideo) {
                    const videoId = getYouTubeVideoId(tour.video);
                    return `
                        <div class="relative w-full pb-[56.25%]"> <!-- 16:9 aspect ratio -->
                            <iframe
                                id="largeContent-${tour.id}"
                                class="absolute inset-0 w-full h-full rounded-lg shadow-md"
                                src="https://www.youtube.com/embed/${videoId}"
                                title="${tour.name} Video"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                            ></iframe>
                        </div>
                    `;
                } else {
                    return `
                        <div class="relative w-full pb-[56.25%]"> <!-- 16:9 aspect ratio -->
                            <img 
                                id="largeContent-${tour.id}"
                                src="${tour.images[0]}"
                                alt="${tour.name}"
                                class="absolute inset-0 w-full h-full object-cover rounded-lg shadow-md border border-gray-300"
                            >
                        </div>
                    `;
                }
            }
            
            function changeContent(tourId, type, src) {
                const container = document.getElementById(`content-container-${tourId}`);
                if (type === 'video') {
                    const videoId = getYouTubeVideoId(src);
                    container.innerHTML = `
                        <div class="relative w-full pb-[56.25%]"> <!-- 16:9 aspect ratio -->
                            <iframe
                                id="largeContent-${tourId}"
                                class="absolute inset-0 w-full h-full rounded-lg shadow-md"
                                src="https://www.youtube.com/embed/${videoId}"
                                title="YouTube Video"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                            ></iframe>
                        </div>
                    `;
                } else {
                    container.innerHTML = `
                        <div class="relative w-full pb-[56.25%]"> <!-- 16:9 aspect ratio -->
                            <img 
                                id="largeContent-${tourId}"
                                src="${src}"
                                alt="Main Image"
                                class="absolute inset-0 w-full h-full object-cover rounded-lg shadow-md border border-gray-300"
                            >
                        </div>
                    `;
                }
            }

        tourData.forEach(tour => {
            const detailItem = document.createElement("div");
            detailItem.id = tour.id;
            detailItem.className = "flex flex-col md:flex-row items-start gap-6 bg-white shadow-lg rounded-lg p-6";
            
            const hasVideo = tour.video && getYouTubeVideoId(tour.video);
            const totalContent = tour.images.length + (hasVideo ? 1 : 0);
            const shouldShowThumbnails = totalContent > 1;
            
            const mainContent = createMainContent(tour);
            
            detailItem.innerHTML = `
            <div class="flex md:flex-row flex-col gap-6">
                <div class="md:w-2/5 flex flex-col gap-4">
                    <!-- Container untuk konten utama -->
                    <div class="mb-6" id="content-container-${tour.id}">
                        ${mainContent}
                    </div>
                    
                    ${shouldShowThumbnails ? `
                        <!-- Thumbnails Section -->
                        <div class="flex justify-center space-x-2 mb-6">
                            ${hasVideo ? `
                                <!-- Video Thumbnail -->
                                <div 
                                    class="thumbnail w-24 h-24 rounded-lg border border-gray-300 shadow-md cursor-pointer hover:scale-105 hover:border-blue-500 transition-transform relative overflow-hidden"
                                    onclick="changeContent('${tour.id}', 'video', '${tour.video}')"
                                >
                                    <img 
                                        src="https://img.youtube.com/vi/${getYouTubeVideoId(tour.video)}/mqdefault.jpg"
                                        alt="Video Thumbnail"
                                        class="w-full h-full object-cover"
                                    >
                                    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30">
                                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8 5v14l11-7z"/>
                                        </svg>
                                    </div>
                                </div>
                            ` : ''}
                            
                            <!-- Image Thumbnails -->
                            ${tour.images.map((img, index) => `
                                <img 
                                    class="thumbnail w-24 h-24 rounded-lg border border-gray-300 shadow-md cursor-pointer hover:scale-105 hover:border-blue-500 transition-transform object-cover" 
                                    src="${img}" 
                                    alt="${tour.name} ${index + 1}" 
                                    onclick="changeContent('${tour.id}', 'image', '${img}')"
                                >
                            `).join('')}
                        </div>
                    ` : ''}
                </div>
        
                <div class="flex-1 md:pl-6">
                    <h3 class="text-3xl font-semibold text-red-800 mb-4">${tour.name}</h3>
                    <p class="text-lg text-gray-700 text-justify mb-12">${tour.description}</p>
                </div>
            </div>
            `;
        
            detailSection.appendChild(detailItem);
        });
        
        window.changeContent = changeContent;

        // fungsi thumbnail
        function changeImage(tourId, newSrc) {
            const largeImage = document.getElementById(`largeImage-${tourId}`);
            largeImage.src = newSrc;
        }

        // Load tour items dynamically
                function loadTourItems() {
            const tourItemsContainer = document.getElementById("tour-items");
            tourItemsContainer.innerHTML = tourData.map(tour => `
                <div class="tour-item relative h-80 rounded-lg transform transition hover:scale-105 hover:shadow-xl">
                    <img 
                        src="${tour.images[0]}" 
                        alt="${tour.name}" 
                        class="absolute inset-0 w-full h-full object-cover rounded-lg cursor-pointer" 
                        onclick="scrollToSection('${tour.id}')"
                    >
                    <div class="absolute inset-0 bg-black bg-opacity-50 rounded-lg"></div>
                    <div class="absolute inset-0 flex flex-col items-center justify-end pb-4 z-10">
                        <h2 class="text-xl font-bold text-white mb-2">${tour.name}</h2>
                        <button 
                            onclick="scrollToSection('${tour.id}')"
                            class="text-white underline hover:text-blue-400" transition-colors"
                        >
                            View Detail
                        </button>
                    </div>
                </div>
            `).join('');


            updateScrollButtons();
        }

                // Function untuk scroll ke menu section
        function scrollToMenuSection() {
            document.getElementById("menu-section").scrollIntoView({ behavior: 'smooth' });
        }

        // Function to scroll to specific section
        function scrollToSection(sectionId) {
            const element = document.getElementById(sectionId);
            if (element) {
                element.scrollIntoView({ 
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        }

        // Initialize when page loads
        window.onload = () => {
            loadTourItems();
            
            // Add scroll event listener to update button visibility
            const container = document.getElementById("tour-items");
            container.addEventListener('scroll', updateScrollButtons);
            
            // Initial update of button visibility
            updateScrollButtons();
        };



        // Check scroll position and update button visibility
        function updateScrollButtons() {
            const container = document.getElementById("tour-items");
            const leftButton = document.getElementById("scroll-left");
            const rightButton = document.getElementById("scroll-right");

            // Show/hide left button based on scroll position
            leftButton.style.display = container.scrollLeft <= 0 ? "none" : "block";

            // Show/hide right button based on whether we can scroll further right
            const canScrollRight = container.scrollWidth > (container.scrollLeft + container.clientWidth);
            rightButton.style.display = canScrollRight ? "block" : "none";
        }

        // Scroll left
        function scrollLeft() {
            const container = document.getElementById("tour-items");
            const scrollAmount = container.clientWidth * 0.8; // Scroll 80% of container width
            container.scrollBy({
                left: -scrollAmount,
                behavior: 'smooth'
            });
        }

        // Scroll right
        function scrollRight() {
            const container = document.getElementById("tour-items");
            const scrollAmount = container.clientWidth * 0.8; // Scroll 80% of container width
            container.scrollBy({
                left: scrollAmount,
                behavior: 'smooth'
            });
        }

        // Scroll to section
        function scrollToSection(sectionId) {
            const element = document.getElementById(sectionId);
            if (element) {
                element.scrollIntoView({ behavior: 'smooth' });
            }
        }

        // Initialize the page
        window.onload = () => {
            loadTourItems();
            
            // Add scroll event listener to update button visibility
            const container = document.getElementById("tour-items");
            container.addEventListener('scroll', updateScrollButtons);
            
            // Initial update of button visibility
            updateScrollButtons();
        };
    </script>

</body>
</html>