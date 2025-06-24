<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jelajah Wisata Semarang</title>
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
    <div id="hero-section" class="relative h-screen bg-cover bg-center z-10" style="background-image: url('cover/cover_pariwisata.jpg');">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div id="hero-content" class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white">
            <h1 class="text-5xl font-bold mb-4">
                <span class="text-white shadow-lg">Jelajah Wisata Semarang</span><br>
                <span class="text-white-800 font-normal text-3xl">Temukan Pesona Tersembunyi Semarang</span>
            </h1>
            <button class="bg-red-800 text-white px-6 py-3 rounded-full shadow-lg flex items-center hover:bg-yellow-600" onclick="scrollToMenuSection()">
                View More
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
            Jelajah Wisata
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
        Detail Destinasi Wisata
    </h2>
    
    <div class="space-y-6"></div>

    <script>
        const tourData = [
            {
                id: "kotalama",
                name: "Kota Lama",
                images: [
                    "budayaa/DUGDERAN .jpg"
                ],
                description: "Kota Lama merupakan pusat perdagangan penting, dan untuk melindungi warga serta wilayahnya, dibangunlah benteng Vijfhoek. Jalan utama di dalam benteng tersebut diberi nama Heerenstraat, yang kini dikenal sebagai Jalan Letjen Soeprapto. Kota Lama dijuluki \"Little Netherland\" karena lanskapnya yang terpisah dan mirip dengan kota-kota di Eropa, serta kanal-kanal air yang mengelilinginya. Arsitektur bangunan di kawasan ini mengusung gaya Eropa dengan pintu utama dan jendela besar, elemen dekoratif, dan langit-langit tinggi.",
                location: "https://goo.gl/maps/B9gQ5BfLLh62"
            },
            {
                id: "kampungmelayu",
                name: "Kampung Melayu",
                images: [
                    "/pariwisata/kampung-melayu.jpg"
                ],
                description: "Kampung Melayu yang berkembang dari abad ke-17 ini menjadi tempat pertemuan para pendatang yang berasal dari berbagai negara untuk berdagang.Dahulu, Kampung Melayu di Semarang dikenal sebagai tempat tinggal bagi pendatang keturunan Melayu yang berdagang di kawasan tersebut. Namun, tidak hanya pendatang dari Melayu, melainkan juga dari bangsa lain seperti Arab, Gujarat India, Cina, dan Eropa yang turut berlabuh untuk berdagang dan menyebarkan dakwah agama.",
                location: "https://goo.gl/maps/B9gQ5BfLLh62"
            },
            {
                id: "kampungbatik",
                name: "Kampung Batik",
                images: [
                    "budayaa/GEBYURAN.jpg"
                ],
                description: "kampung batik semarang sudah ada sejak zaman penjajahan Jepang. Kampung batik ini telah menjadi sumber perekonomian masyarakat setempat. Namun tentara Jepang membakar desa tersebut dan seluruh peralatan yang digunakan untuk membatik juga ikut rusak.",
                location: "https://goo.gl/maps/B9gQ5BfLLh62"
            },
            {
                id: "lawangsewu",
                name: "Lawang Sewu",
                images: [
                    "/pariwisata/lawangsewu.jpg",
                ],
                description: "Semarang night carnival merupakan ajang karnaval pertama yang digelar malam hari, dilaksanakan pertama tahun 2011 merupakan salah satu agenda perayaan HUT Kota Semarang yang kemudian dijadikan agenda tahunan. Diikuti ribuan peserta dengan kostum yang beragam, mencerminkan karakter Kota Semarang yang beragam budaya.",
                location: "https://goo.gl/maps/B9gQ5BfLLh62"
            },
            {
                id: "purimaerokoco",
                name: "Puri Maerokoco",
                images: [
                    "/pariwisata/purimaerokoco.jpg"
                ],
                description: "Tari Gambang Semarangan, atau Tari Semarangan, adalah seni tradisional Semarang yang memadukan budaya Tionghoa dan Jawa. Tarian ini sering disisipkan lawakan ringan, dan diiringi musik tradisional seperti gamelan, kendang, kempul, serta alat musik Tionghoa seperti konghayan dan tohyan.",
                location: "https://goo.gl/maps/B9gQ5BfLLh62"
            }
        ];


        const detailSection = document.getElementById("detail-section");
        
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
                    <p class="text-lg text-gray-700 text-justify mb-4">${tour.description}</p>
                    <div class="flex items-center">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="w-5 h-5 text-red-800 mr-2 group-hover:text-white transition"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 2.25c4.556 0 8.25 3.694 8.25 8.25 0 6.193-8.25 11.25-8.25 11.25S3.75 16.693 3.75 10.5c0-4.556 3.694-8.25 8.25-8.25z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 11.25a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"
                            />
                        </svg>
                        <button
                            class="text-sm bg-gray-100 text-gray-700 font-medium rounded-md px-3 py-1 hover:bg-red-800 hover:text-white transition"
                            onclick="openLocation('${tour.location}')"
                        >
                            Lihat Lokasi
                        </button>
                    </div>
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

        function openLocation(url) {
            window.open(url, '_blank');
        }
    </script>

</body>
</html>