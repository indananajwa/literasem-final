<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Situs Kota Lama Semarang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .hover-box:hover {
            transform: translateY(-10px);
            transition: transform 0.3s;
        }
        .hidden-opacity {
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .visible-opacity {
            opacity: 1;
            transition: opacity 0.5s ease;
        }
        .slide {
            transition: opacity 0.5s ease-in-out;
        }
        
        .batik-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='rgba(255,255,255,0.1)' fill-rule='evenodd'/%3E%3C/svg%3E");
        }

        .envelope-bg {
            clip-path: polygon(0 0, 100% 0, 100% 70%, 0 70%);
        }

        .envelope-fold {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100px;
            background: linear-gradient(to bottom, transparent, rgba(0,0,0,0.1));
            clip-path: polygon(0 0, 100% 0, 50% 100%);
            transform: translateY(50%);
        }

        .video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
            height: 0;
            overflow: hidden;
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 0.75rem;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Include Header -->
    @include('pengunjung.layouts.header')

    <!-- Hero Section -->
    <div id="hero-section" class="relative h-screen bg-cover bg-center z-10" style="background-image: url('cover/cover_kotalama.jpg');">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div id="hero-content" class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white">
            <h1 class="text-5xl font-bold mb-4">
                <span class="text-white shadow-lg">Situs Kota Lama Semarang</span><br>
                <span class="text-white-800 font-normal text-3xl">Menghidupkan Kembali Warisan Sejarah Kota Semarang</span>
            </h1>
            <button class="bg-red-800 text-white px-6 py-3 rounded-full shadow-lg flex items-center hover:bg-yellow-600" onclick="scrollToMenuSection()">
                View Detail
            </button>
        </div>
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 bg-white rounded-full shadow-lg px-6 py-4 flex space-x-4 items-center z-30">
            <input id="search-bar" type="text" placeholder="Search by name or description..." class="flex-1 border-none bg-gray-100 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500" style="width: 300px;" oninput="handleSearch()" />
            <button class="bg-red-800 text-white font-bold rounded-md px-6 py-2 hover:bg-yellow-600">Search</button>
        </div>
    </div>

        <div id="video-container" class="relative z-30 flex items-center justify-center hidden-opacity">
            <iframe 
                id="video" 
                class="w-full h-5/6 rounded-lg shadow-lg" 
                src="https://www.youtube.com/embed/-5q5mZbe3V8?autoplay=1&controls=1" 
                allow="autoplay; fullscreen" 
                allowfullscreen>
            </iframe>        
        </div>
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 bg-white rounded-full shadow-lg px-6 py-4 flex space-x-4 items-center z-30">
            <input
                id="search-bar"
                type="text"
                placeholder="Search by name or description..."
                class="flex-1 border-none bg-gray-100 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500" style="width: 300px;"
                oninput="handleSearch()"
            />
            <button class="bg-red-800 text-white font-bold rounded-md px-6 py-2 hover:bg-yellow-600">Search</button>
        </div>
    </div>

    <div class="min-h-screen relative overflow-hidden">
        <!-- Envelope Background -->
        <div class="absolute inset-0">
            <div class="envelope-bg w-full h-full bg-gradient-to-br batik-pattern">
                <div class="envelope-fold"></div>
            </div>
        </div>

        <!-- Content Container -->
        <div class="relative z-10 container mx-auto px-4 py-8">
            <!-- Slides Container -->
            <div class="max-w-5xl mx-auto">
                <!-- Slide 1 -->
                <div id="slide1" class="slide bg-white/95 backdrop-blur-sm rounded-2xl shadow-2xl p-8 mb-8 transform transition-all duration-500">
                    <!-- Video Container 1 -->
                    <div class="video-container mb-6 shadow-lg rounded-xl overflow-hidden">
                        <iframe 
                            src="https://www.youtube.com/embed/khNkocgfiN0" 
                            title="Revitalisasi Situs Kota Lama"
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                        </iframe>
                    </div>

                    <!-- Video Description -->
                    <div class="text-center mb-6">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-2">Revitalisasi Kota Lama Semarang</h2>
                        <p class="text-gray-600">Upaya pelestarian Kota Lama Semarang agar tetap menjadi ikon bersejarah yang menarik dan berdaya guna.</p>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div id="slide2" class="slide bg-white/95 backdrop-blur-sm rounded-2xl shadow-2xl p-8 mb-8">
                    <!-- Video Container 2 -->
                    <div class="video-container mb-6 shadow-lg rounded-xl overflow-hidden">
                        <iframe 
                            src="https://www.youtube.com/embed/WhW0GBZiRWo " 
                            title="Mengenal Kota Lama Semarang"
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                        </iframe>
                    </div>

                    <!-- Video Description -->
                    <div class="text-center mb-6">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-2">Mengenal Kota Lama Semarang</h2>
                        <p class="text-gray-600">Mengungkap sejarah dan pesona Kota Lama Semarang, sebuah kawasan bersejarah yang penuh cerita dan keindahan.</p>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-center space-x-4">
                    <button onclick="showSlide(1)" class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-full font-medium transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 shadow-lg">
                        Video 1
                    </button>
                    <button onclick="showSlide(2)" class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-full font-medium transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 shadow-lg">
                        Video 2
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-center text-red-800 mb-4">Jelajah Kota Lama Semarang</h2>
        <div class="border-t-2 border-red-800 w-16 mx-auto my-4"></div>
        <div id="food-list" class="grid grid-cols-1 gap-6"></div>
        <div id="pagination" class="mt-8 flex justify-center items-center space-x-4"></div>
    </div>

    <script>
        const heroContent = document.getElementById('hero-content');
        const videoContainer = document.getElementById('video-container');
        const video = document.getElementById('video');

        video.addEventListener('play', () => {
            heroContent.classList.remove('visible-opacity');
            heroContent.classList.add('hidden-opacity');
            videoContainer.classList.remove('hidden-opacity');
            videoContainer.classList.add('visible-opacity');
        });

        video.addEventListener('pause', () => {
            heroContent.classList.remove('hidden-opacity');
            heroContent.classList.add('visible-opacity');
        });

        video.addEventListener('ended', () => {
            heroContent.classList.remove('hidden-opacity');
            heroContent.classList.add('visible-opacity');
        });
    </script>

    <script>
        const foodData = [
            {
                name: "Jembatan Berok",
                description: "Salah satu pintu benteng yang masih ada hingga kini adalah Jembatan Berok, yang juga dikenal sebagai De Zuider Por. Nama \"Berok\" berasal dari cara pengucapan masyarakat Pribumi yang kesulitan menyebut kata \"Burg\" dalam bahasa Belanda.",
                rating: 5.0,
                image: "/SKL/Jembatan-Berok-1890.jpg",
            },
            {
                name: "Gereja Blenduk",
                description: "Terdapat bangunan Gereja Blenduk yang merupakan bangunan yang dibangun pada 1753 dengan bentuk rumah panggung Jawa dan atap bergaya Jawa. Renovasi besar dilakukan pada 1787, diikuti perubahan lagi pada 1794 dan pembangunan kembali pada 1894 oleh H.P.A. de Wilde dan W.Westmas. Setelah tiga renovasi—1753, 1894, dan 2003—gereja ini tetap mempertahankan gaya arsitektur Eropa klasik yang anggun dan aristokrat. Setiap renovasi tercatat di batu marmer di bawah altar.",
                rating: 5.0,
                image: "/SKL/Gereja-Blenduk-1930.jpg",
            },
            {
                name: "Gedung Schouwburg (Gedung Marabunta)",
                description: "Dibangun pada tahun 1870, dulunya menjadi pusat pertunjukan seni dan budaya bagi warga Semarang. Namun, pada tahun 1994, bangunan ini roboh dan digantikan oleh Gedung Marabunta yang didirikan pada tahun 1997 di lokasi yang sama. Nama \"Marabunta,\" yang berarti \"semut raksasa\" dalam bahasa Jawa, kini dikenal sebagai destinasi wisata dan cagar budaya. Selain itu, beberapa bagian gedung dimanfaatkan sebagai kafe, restoran, dan toko.",
                rating: 5.0,
                image: "/SKL/Gedung-Schouwburg.jpg",
            },
            {
                name: "De Koloniale Bank",
                description: "Koloniale Bank, yang didirikan di Amsterdam pada tahun 1881, bertujuan mendukung keuangan para pengusaha perkebunan di Hindia Belanda. Bank ini membuka cabang di Semarang pada Juni 1883, namun harus menghentikan operasinya pada Januari 1935 karena dampak krisis ekonomi.",
                rating: 5.0,
                image: "/SKL/De-Koloniale-Bank-120.jpg",
            },
            {
                name: "Kantor Pos Semarang",
                description: "Saat ini, Kantor Pos Besar Semarang tetap beroperasi dan melayani berbagai kebutuhan masyarakat. Sementara itu, bekas Kantor Gubernur kini berfungsi sebagai Gedung Keuangan Negara Semarang I, yang menjadi kantor wilayah Direktorat Jenderal Perbendaharaan (DJPb) Provinsi Jawa Tengah.",
                rating: 5.0,
                image: "/SKL/Kantor-Pos-127.tiff",
            },
            {
                name: "Taman Srigunting",
                description: "Taman Srigunting, dahulu dikenal sebagai Paradeplein, dibangun pada era kolonial Belanda sekitar 1690-an sebagai tempat latihan militer tentara VOC. Seiring waktu, fungsinya berubah, dan pada akhir 1970-an hingga awal 1980-an, taman ini dibangun ulang, meski belum langsung dibuka untuk umum. Kini, taman ini menjadi saksi perkembangan Kota Semarang dari masa kolonial hingga modern.",
                rating: 5.0,
                image: "/SKL/Taman-Srigunting-1920.tiff",
            },
            {
                name: "Gedung Asuransi Jiwasraya",
                description: "Gedung Jiwasraya, yang kini menjadi kantor PT Asuransi Jiwasraya (Persero) Wilayah Semarang, dulunya adalah Kantor Nillmij van 1859, perusahaan asuransi jiwa Belanda yang beroperasi di Hindia Belanda sejak 1859. Nillmij mengelola cabang di Semarang setelah membuka kantor pertama di Batavia pada 1909. Gedung ini terletak di kawasan Kota Lama Semarang, yang dikenal dengan peninggalan kolonial Belanda dan menjadi daya tarik wisata budaya.",
                rating: 5.0,
                image: "/SKL/Gedung-Asuransi-Jiwasraya.jpg",
            },
            {   name: "Pecinan Semarang",
                description: "Terbentuknya wilayah Pecinan Semarang berkaitan dengan peristiwa pemberontakan masyarakat Tionghoa pada masa kolonial yang bermula di Batavia yang saat ini Jakarta pada tahun 1740. Dampak dari pemberontakan tersebut banyak masyarakat Tionghoa yang dibawa Belanda ke Semarang. Mulanya, masyarakat Tionghoa berada di daerah Simongan sekitar kelenteng Sam Po Kong. Kemudian oleh Belanda dipindahkan ke pusat kota untuk menghindari meluasnya dampak pemberontakan masyarakat Cina & agar pemerintahan Belanda dapat mengawasi aktivitas orang orang Tionghoa di Semarang.",
                rating: 5.0,
                image: "/SKL/Pecinan-Semarang.jpg",
            },
            // Add other data objects here...
        ];

        const itemsPerPage = 5;
        let currentPage = 1;
        let filteredData = [...foodData];

        function renderList(page) {
            const startIndex = (page - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const paginatedData = filteredData.slice(startIndex, endIndex);

            const foodList = document.getElementById("food-list");
            foodList.innerHTML = ""; // Clear previous items

            paginatedData.forEach(food => {
                const foodItem = document.createElement("div");
                foodItem.className = "bg-white p-6 rounded-lg shadow flex items-center hover-box";
                foodItem.innerHTML = `
                    <div class="flex items-center space-x-4">
                        <div class="w-1/3"> <!-- Gambar -->
                            <img alt="${food.name}" 
                                class="w-full h-auto object-cover rounded-lg shadow-md border border-gray-300" 
                                src="${food.image}" />
                        </div>
                        <div class="w-2/3 text-left"> <!-- Teks -->
                            <h3 class="text-2xl mb-2 font-semibold">${food.name}</h3>
                            <p class="text-gray-600">${food.description}</p>
                        </div>
                    </div>
                `;
                foodList.appendChild(foodItem);
            });

            renderPagination();
        }

        function renderPagination() {
            const pagination = document.getElementById("pagination");
            pagination.innerHTML = "";

            const totalPages = Math.ceil(filteredData.length / itemsPerPage);

            for (let i = 1; i <= totalPages; i++) {
                const button = document.createElement("button");
                button.className = `px-4 py-2 rounded ${i === currentPage ? "bg-red-800 text-white" : "bg-gray-200"}`;
                button.innerText = i;
                button.onclick = () => {
                    currentPage = i;
                    renderList(currentPage);
                };
                pagination.appendChild(button);
            }
        }

        function handleSearch() {
            const query = document.getElementById("search-bar").value.toLowerCase();
            filteredData = foodData.filter(
                food =>
                    food.name.toLowerCase().includes(query) ||
                    food.description.toLowerCase().includes(query)
            );
            currentPage = 1; // Reset to the first page
            renderList(currentPage);
        }

        // Initial render
        renderList(currentPage);
    </script>

    <script>
        function showSlide(slideNumber) {
            // Hide all slides
            document.querySelectorAll('.slide').forEach(slide => {
                slide.style.opacity = '0';
                slide.style.display = 'none';
            });
            
            // Show selected slide
            const selectedSlide = document.getElementById(`slide${slideNumber}`);
            selectedSlide.style.display = 'block';
            setTimeout(() => {
                selectedSlide.style.opacity = '1';
            }, 50);
        }

        // Show first slide by default
        showSlide(1);
    </script>
</body>
</html>
