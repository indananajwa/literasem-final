<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kenal Kota Semarang</title>
    <link rel="stylesheet" href="{{ asset('img/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet"/>
    <style>
        body {
                font-family: 'Inter', sans-serif;
            }
            .carousel {
                display: flex;
                overflow-x: auto;
                scroll-snap-type: x mandatory;
            }
            .carousel-item {
                scroll-snap-align: center;
                flex: none;
                width: 60%;
                margin-right: 1rem;
            }
            .modal {
                display: none;
                position: fixed;
                z-index: 50;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0, 0, 0, 0.8);
            }
            .modal-content {
                background-color: #fefefe;
                margin: 15% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
                max-width: 500px;
            }
            .close {
                color: #aaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }
            .close:hover,
            .close:focus {
                color: black;
                text-decoration: none;
                cursor: pointer;
            }
            .carousel {
            position: relative;
            overflow: hidden;
            }
            .carousel-control-prev, .carousel-control-next {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                background-color: rgba(0, 0, 0, 0.5);
                color: white;
                padding: 10px;
                cursor: pointer;
            }
            .carousel-control-prev {
                left: 10px;
            }
            .carousel-control-next {
                right: 10px;
            }
            #semarang-masa-depan {
                display: none;
            }
            .carousel-container {
                overflow: hidden;
                position: relative;
                height: 100%; /* Sesuaikan agar tidak ada jeda */
            }

            .carousel-inner {
                display: flex;
                transition: transform 0.5s ease-in-out; /* Transisi smooth */
                will-change: transform; /* Performa lebih baik */
            }

            .carousel-item {
                flex: 0 0 100%; /* Setiap slide mengisi 100% */
                height: auto; /* Sesuaikan dengan kontennya */
            }
    </style>
</head>
<body class="font-sans antialiased">

    <!-- Include Header -->
    @include('layouts.header')

    <!-- Hero Section -->
    <section id="hero" class="pt-10 relative opacity-0 translate-y-10 transition-all duration-700">
        <main class="flex flex-col items-center text-center mt-10">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-white opacity-100"></div>
                <div class="flex">
                <img alt="Lawang Sewu" class="w-1/4 h-80 object-cover" height="300" src="/lawang sewu.jpg" width="300"/>
                <img alt="Sam Poo Kong" class="w-1/4 h-80 object-cover" height="300" src="/sampookong.jpg" width="300"/>
                <img alt="Tugu Muda" class="w-1/4 h-80 object-cover" height="300" src="/tugu muda.jpg" width="300"/>
                <img alt="Balaikota" class="w-1/4 h-80 object-cover" height="300" src="/balaikota.jpg" width="300"/>
            </div>
            <!-- <div class="absolute inset-0 flex flex-col justify-center items-center text-white text-center p-4">
                <h2 class="text-4xl font-bold">YUK KENALAN SAMA KOTA SEMARANG</h2>
                <p class="text-lg">Kota Semarang adalah Ibu kota Provinsi Jawa Tengah</p>
            </div> -->
            <div class = "absolute inset-0 flex flex-col justify-center items-center text-white text-center p-4">
                <h1 class="text-5xl font-bold">
                    Yuk Kenalan Sama<br/>
                    Kota Semarang!
                </h1>
                <p class="text-gray-400 mt-4">
                    Find a variety of properties that suit you very easily,<br/>
                    forget all difficulties in finding a residence for you
                </p>
            </div>
        </main>
    </section>

    <!-- Sejarah Section -->
    <section id="sejarah" class="p-8 opacity-0 translate-y-10 transition-all duration-700">
        <h2 class="text-3xl font-bold text-center text-red-800 mb-4">Jejak Sejarah Kota Semarang</h2>
        <div class="border-t-2 border-red-800 w-16 mx-auto my-4"></div>
        <div class="container mx-auto px-6 py-8">
            <!-- Grid Layout -->
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Artikel dengan gambar di atas -->
                <div>
                    <div class="flex flex-col items-center">
                        <img 
                            src="/img/PetaSemarang1913.jpg" 
                            alt="Peta Semarang 1913" 
                            class="w-full max-w-md rounded-md shadow-md"
                        />
                        <p class="text-center text-gray-500 text-sm mt-2">
                            Peta Semarang Tahun 1913
                        </p>
                    </div>
                </div>

                <!-- Artikel dengan gambar di bawah -->
                <div>
                        <p class="text-gray-700 text-justify mt-4 leading-relaxed">
                            Sejarah Kota Semarang bermula pada <strong>abad ke-8 M</strong> sebagai daerah pesisir bernama <strong>Pragota</strong>, bagian dari Kerajaan Mataram Kuno. Saat itu, daerah ini merupakan pelabuhan penting dengan gugusan pulau kecil yang kini menjadi daratan akibat pengendapan. Pelabuhan ini diduga berada di sekitar Pasar Bulu hingga Pelabuhan Simongan, tempat Laksamana Cheng Ho bersandar pada 1405 M dan mendirikan Kelenteng Sam Po Kong.</br></br>
                            Pada abad ke-15, Kerajaan Demak menugaskan Pangeran Made Pandan untuk menyebarkan Islam di Pragota. Nama "Semarang" berasal dari pohon asam yang jarang tumbuh di daerah ini (Asem Arang). Pendiri desa, Kyai Ageng Pandan Arang I, digantikan putranya, Pandan Arang II, yang membawa kemajuan hingga Semarang ditetapkan sebagai kabupaten oleh Sultan Hadiwijaya pada 2 Mei 1547—tanggal yang kini diperingati sebagai Hari Jadi Kota Semarang.</br></br>
                            Pada tahun 1678, Amangkurat II menyerahkan Semarang kepada VOC sebagai pembayaran utang. Pada 1705, Pakubuwono I menyerahkan Semarang kepada VOC, menjadikannya kota kolonial hingga dibentuk Gemeente pada 1906. Pemerintahan ini berakhir pada 1942 saat pendudukan Jepang, yang membentuk pemerintahan lokal dengan kepala militer (Shico).</br></br>
                            Setelah kemerdekaan, Semarang mengalami Pertempuran Lima Hari (15–20 Oktober 1945) melawan Jepang. Pada 1946, Inggris menyerahkan Semarang kepada Belanda, yang menduduki kota hingga 1950. Pemerintahan kota selama pendudukan dijalankan di daerah pengungsian, hingga pada 1 April 1950, pemerintahan kota diserahkan kembali kepada pemerintah Republik Indonesia.
                        </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Semarang Masa Lalu, Kini, dan Depan Section -->
<section id="masa-lalu-kini" class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-blue-500 text-sm uppercase tracking-widest">Discover</h1>
            <h2 class="text-4xl font-bold text-gray-800">Semarang Dulu dan Kini</h2>
            <p class="mt-2 text-gray-600 text-lg max-w-2xl mx-auto">
                Jelajahi sejarah dan transformasi Kota Semarang dari masa lalu hingga masa kini.
            </p>
        </div>

        <!-- Buttons -->
        <div class="flex justify-center space-x-4 mb-10">
            <button
                class="px-6 py-3 bg-blue-500 text-white rounded-md shadow-lg hover:bg-blue-600 transition duration-200"
                onclick="showContent('masa-lalu-kini')">
                Semarang Dulu dan Kini
            </button>
            <button
                class="px-6 py-3 bg-gray-200 text-gray-700 rounded-md shadow-lg hover:bg-gray-300 transition duration-200"
                onclick="showContent('semarang-masa-depan')">
                Semarang Masa Depan
            </button>
        </div>

        <!-- Carousel -->
        <div class="relative mt-8" x-data="carousel">
            <!-- Slide 1 -->
            <div class="carousel-item" x-show="currentSlide === 0" x-transition>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Image 1 -->
                    <div class="relative group">
                        <img src="{{ asset('/smg-masa-lalu-sekarang/lawangsewutahun1930.jpg') }}" alt="Lawang Sewu Tahun 1930"
                            class="w-full h-64 object-cover rounded-lg shadow-md group-hover:scale-105 transition duration-300">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-60 text-white flex items-center justify-center text-lg font-semibold opacity-0 group-hover:opacity-100 transition duration-300 rounded-lg">
                            Lawang Sewu 1930
                        </div>
                    </div>

                    <!-- Image 2 -->
                    <div class="relative group">
                        <img src="{{ asset('/smg-masa-lalu-sekarang/lawangsewu2024.jpg') }}" alt="Lawang Sewu 2024"
                            class="w-full h-64 object-cover rounded-lg shadow-md group-hover:scale-105 transition duration-300">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-60 text-white flex items-center justify-center text-lg font-semibold opacity-0 group-hover:opacity-100 transition duration-300 rounded-lg">
                            Lawang Sewu 2024
                        </div>
                    </div>
                </div>
                <!-- Text -->
                <div class="text-center mt-8 max-w-2xl mx-auto">
                    <h3 class="text-2xl font-bold mb-2">Lawang Sewu Dulu dan Kini</h3>
                    <p class="text-gray-600">
                        Lawang Sewu adalah gedung bersejarah milik PT Kereta Api Indonesia (Persero) yang awalnya digunakan sebagai Kantor Pusat perusahaan kereta api swasta Nederlandsch-Indische Spoorweg Maatschappij (NISM). Gedung Lawang Sewu dibangun secara bertahap di atas lahan seluas 18.232 m2. Bangunan utama dimulai pada 27 Februari 1904 dan selesai pada Juli 1907. Sedangkan bangunan tambahan dibangun sekitar tahun 1916 dan selesai tahun 1918.                    </p>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item" x-show="currentSlide === 1" x-transition>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Image 1 -->
                    <div class="relative group">
                        <img src="{{ asset('/smg-masa-lalu-sekarang/stasiunsemarangnis1905.png') }}" alt="Future Vision 1"
                            class="w-full h-64 object-cover rounded-lg shadow-md group-hover:scale-105 transition duration-300">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-60 text-white flex items-center justify-center text-lg font-semibold opacity-0 group-hover:opacity-100 transition duration-300 rounded-lg">
                            Stasiun Semarang NIS 1905
                        </div>
                    </div>

                    <!-- Image 2 -->
                    <div class="relative group">
                        <img src="{{ asset('/smg-masa-lalu-sekarang/KampungSpoorland2024.jpg') }}" alt="Future Vision 2"
                            class="w-full h-64 object-cover rounded-lg shadow-md group-hover:scale-105 transition duration-300">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-60 text-white flex items-center justify-center text-lg font-semibold opacity-0 group-hover:opacity-100 transition duration-300 rounded-lg">
                            Sekarang Menjadi Kampung Spoorland
                        </div>
                    </div>
                </div>
                <!-- Text -->
                <div class="text-center mt-8 max-w-2xl mx-auto">
                    <h3 class="text-2xl font-bold mb-2">Stasiun Semarang NIS 1905</h3>
                    <p class="text-gray-600">
                        Stasiun Samarang NIS atau disebut juga Stasiun Kemidjen NIS dibangun pada 17 Juni 1864 dan dibuka untuk umum pada 10 Agustus 1867. Ini merupakan jalur pertama kereta api di Indonesia dengan rute Semarang-Tanggoeng. Kini, stasiun tersebut sudah tidak ada lagi bangunan fisik yang tersisa dan menjadi kompleks perkampungan.                    </p>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item" x-show="currentSlide === 2" x-transition>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Image 1 -->
                    <div class="relative group">
                        <img src="{{ asset('/smg-masa-lalu-sekarang/stasiunsemarangnis1905.png') }}" alt="Future Vision 1"
                            class="w-full h-64 object-cover rounded-lg shadow-md group-hover:scale-105 transition duration-300">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-60 text-white flex items-center justify-center text-lg font-semibold opacity-0 group-hover:opacity-100 transition duration-300 rounded-lg">
                            Stasiun Semarang NIS 1905
                        </div>
                    </div>

                    <!-- Image 2 -->
                    <div class="relative group">
                        <img src="{{ asset('/smg-masa-lalu-sekarang/KampungSpoorland2024.jpg') }}" alt="Future Vision 2"
                            class="w-full h-64 object-cover rounded-lg shadow-md group-hover:scale-105 transition duration-300">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-60 text-white flex items-center justify-center text-lg font-semibold opacity-0 group-hover:opacity-100 transition duration-300 rounded-lg">
                            Sekarang Menjadi Kampung Spoorland
                        </div>
                    </div>
                </div>
                <!-- Text -->
                <div class="text-center mt-8 max-w-2xl mx-auto">
                    <h3 class="text-2xl font-bold mb-2">Stasiun Semarang NIS 1905</h3>
                    <p class="text-gray-600">
                        Stasiun Samarang NIS atau disebut juga Stasiun Kemidjen NIS dibangun pada 17 Juni 1864 dan dibuka untuk umum pada 10 Agustus 1867. Ini merupakan jalur pertama kereta api di Indonesia dengan rute Semarang-Tanggoeng. Kini, stasiun tersebut sudah tidak ada lagi bangunan fisik yang tersisa dan menjadi kompleks perkampungan.                    </p>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <button @click="prevSlide"
                class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-blue-500 text-white p-3 rounded-full shadow-lg hover:scale-110 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button @click="nextSlide"
                class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-blue-500 text-white p-3 rounded-full shadow-lg hover:scale-110 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
</section>


<script>
    const button = document.getElementById("changeContentBtn");
    const contentDiv = document.getElementById("content");

    button.addEventListener("click", () => {
        // Update the content dynamically
        contentDiv.innerHTML = `
            <h1 class="text-green-500 text-sm uppercase tracking-widest">Future</h1>
            <h2 class="text-4xl font-bold text-gray-800">Welcome to Semarang's Future</h2>
            <div class="mt-2">
                <span class="text-red-500 text-sm">Discover the Possibilities</span>
            </div>
        `;
    });
</script>


<!-- Alpine.js Script -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('carousel', () => ({
            currentSlide: 0,
            totalSlides: 2,

            nextSlide() {
                if (this.currentSlide < this.totalSlides - 1) {
                    this.currentSlide++;
                } else {
                    this.currentSlide = 0;
                }
            },

            prevSlide() {
                if (this.currentSlide > 0) {
                    this.currentSlide--;
                } else {
                    this.currentSlide = this.totalSlides - 1;
                }
            },

            get transformValue() {
                return `translateX(-${this.currentSlide * 100}%)`;
            },
        }));
    });
</script>

<!-- Semarang Masa Depan Section -->
<div id="semarang-masa-depan" class="container mx-auto px-4 py-6 mt-12 hidden">
    <h2 class="text-4xl font-bold mb-8 text-center">
        Semarang Masa Depan
    </h2>
    <p class="text-lg text-gray-700">
        Bayangkan Semarang di masa depan, penuh dengan inovasi teknologi dan perubahan budaya yang memikat!
    </p>
    
    <!-- Detail Section MASA DEPAN -->
    <div id="detail-section" class="container mx-auto px-4 py-6 mt-12">
        <h2 class="text-4xl font-bold mb-8 text-center">
            Detail Destinasi Budaya
        </h2>
        
        <div class="space-y-6">
            <div class="bg-white shadow-lg rounded-md overflow-hidden">
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-4">Dugderan</h3>
                    <img src="budayaa/DUGDERAN .jpg" alt="Dugderan Festival" class="w-full h-64 object-cover rounded-md mb-4">
                    <p class="text-gray-600 mb-4">
                        Dugderan adalah festival tahunan di Semarang yang dimulai pada abad ke-19 untuk menyambut bulan Ramadan. Nama 'Dugderan' berasal dari suara drum yang digunakan untuk menandakan dimulainya puasa. Festival ini melibatkan pawai, hiburan, dan bazar, menjadi simbol kebersamaan masyarakat Semarang dalam menyambut bulan suci Ramadan.
                    </p>
                    <a href="https://youtu.be/B4mLKcVIERs?si=M0_LI27XiNACFyqW" target="_blank" class="text-blue-500 hover:underline">Tonton Video</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Detail Section MASA DEPAN -->
    <script>
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

        function showContent(sectionId) {
            // Sembunyikan semua section dengan ID yang diawali 'semarang-'
            const allSections = document.querySelectorAll('section, div[id^="semarang-"]');
            allSections.forEach(section => section.classList.add('hidden'));

            // Tampilkan section yang dipilih
            const selectedSection = document.getElementById(sectionId);
            if (selectedSection) {
                selectedSection.classList.remove('hidden');
            }
        }

    </script>






    <!-- Situs Kota Lama -->
    <section id="situs-kota-lama" class="opacity-0 translate-y-10 transition-all duration-700">
    <div class="container mx-auto p-4">
        <div class="flex flex-col lg:flex-row">
            <div class="w-full lg:w-2/3">
                <img alt="Map of Kota Lama Surabaya with various landmarks marked" class="w-full" height="600" src="/SKL/situskotalama.png" width="800"/>
            </div>
            <div class="w-full lg:w-1/3 lg:pl-8 mt-4 lg:mt-0">
                <h1 class="text-4xl font-bold text-gray-800">
                    Kota Lama
                </h1>
                <p class="mt-4 text-gray-600 text-justify">
                    Kota Lama Semarang adalah destinasi ideal bagi para penggemar wisata sejarah dan fotografi arsitektur. Kawasan ini memiliki berbagai landmark menakjubkan dan bangunan peninggalan Belanda yang terpelihara dengan baik. Pada abad ke-19 hingga ke-20, Kota Lama merupakan pusat perdagangan penting, dan untuk melindungi warga serta wilayahnya, dibangunlah benteng Vijfhoek. Jalan utama di dalam benteng tersebut diberi nama Heerenstraat, yang kini dikenal sebagai Jalan Letjen Soeprapto. Kota Lama dijuluki "Little Netherland" karena lanskapnya yang terpisah dan mirip dengan kota-kota di Eropa, serta kanal-kanal air yang mengelilinginya. Arsitektur bangunan di kawasan ini mengusung gaya Eropa dengan pintu utama dan jendela besar, elemen dekoratif, dan langit-langit tinggi.                 </p>
                <button class="mt-6 bg-green-600 text-white px-4 py-2 rounded-full flex items-center" onclick="window.location.href='{{ route('situs-kota-lama') }}'">
                    More Information
                    <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>
    </div>
    </section>

    <script>
        function scrollCarousel(direction) {
            const carousel = document.querySelector('.carousel');
            const carouselItems = carousel.querySelectorAll('.carousel-item');

            // Hitung total scroll berdasarkan dua elemen
            const itemWidth = carouselItems[0].offsetWidth;
            const scrollAmount = itemWidth * 2;

            carousel.scrollBy({
                left: direction * scrollAmount,
                behavior: 'smooth'
            });
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const sections = document.querySelectorAll("section");

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Tambahkan animasi saat elemen terlihat
                        entry.target.classList.remove("opacity-0", "translate-y-10");
                        entry.target.classList.add("opacity-100", "translate-y-0");
                    } else {
                        // Reset animasi saat elemen keluar dari viewport
                        entry.target.classList.remove("opacity-100", "translate-y-0");
                        entry.target.classList.add("opacity-0", "translate-y-10");
                    }
                });
            }, {
                threshold: 0.2, // Berapa persen elemen terlihat sebelum animasi dimulai
            });

            sections.forEach(section => {
                observer.observe(section);
            });
        });
    </script>
    <script>
        const photos = {
            past: [
                { src: 'l/smg-masa-lalu-kini/lawangsewutahun1930.jpg', title: 'Foto 1', desc: 'Deskripsi foto 1' },
                { src: 'link2.jpg', title: 'Foto 2', desc: 'Deskripsi foto 2' },
                { src: 'link3.jpg', title: 'Foto 3', desc: 'Deskripsi foto 3' },
                { src: 'link4.jpg', title: 'Foto 4', desc: 'Deskripsi foto 4' },
                { src: 'link5.jpg', title: 'Foto 5', desc: 'Deskripsi foto 5' },
                { src: 'link6.jpg', title: 'Foto 6', desc: 'Deskripsi foto 6' },
                { src: 'link7.jpg', title: 'Foto 7', desc: 'Deskripsi foto 7' },
                { src: 'link8.jpg', title: 'Foto 8', desc: 'Deskripsi foto 8' },
                { src: 'link9.jpg', title: 'Foto 9', desc: 'Deskripsi foto 9' },
                { src: 'link10.jpg', title: 'Foto 10', desc: 'Deskripsi foto 10' },
            ],
            present: [],
            future: [],
        };

        let currentPage = { past: 1, present: 1, future: 1 };
        const photosPerPage = 4;

        function showTab(tabId) {
            const tabs = document.querySelectorAll('.tab-content');
            tabs.forEach(tab => tab.classList.add('hidden'));
            document.getElementById(tabId).classList.remove('hidden');
            loadPhotos(tabId);
        }

        function loadPhotos(tabId) {
            const grid = document.getElementById('photo-grid');
            grid.innerHTML = ''; // Clear previous photos
                const startIndex = (currentPage[tabId] - 1) * photosPerPage;
                const endIndex = startIndex + photosPerPage;
                const selectedPhotos = photos[tabId].slice(startIndex, endIndex);
                
                selectedPhotos.forEach(photo => {
                    const photoCard = `
                        <div class="relative group w-full aspect-[4/3]">
                            <img 
                                alt="${photo.title}" 
                                class="w-full h-full object-cover transform group-hover:scale-105 transition duration-300 rounded-lg" 
                                src="${photo.src}" 
                            />
                            <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-60 text-white text-lg opacity-0 font-semibold transition duration-300 group-hover:opacity-100 group-hover:scale-105 rounded-lg">
                                ${photo.title}
                            </div>
                        </div>`;
                    grid.innerHTML += photoCard;
                });
        }

        function changePage(tabId, direction) {
            const totalPages = Math.ceil(photos[tabId].length / photosPerPage);
            if (direction === 'prev' && currentPage[tabId] > 1) {
                currentPage[tabId]--;
            } else if (direction === 'next' && currentPage[tabId] < totalPages) {
                currentPage[tabId]++;
            }
            loadPhotos(tabId);
        }

        // Initialize the first tab
        showTab('past');
    </script>
    <script>

    function showSection(sectionId, buttonId) {
        document.getElementById('semarang-masa-lalu').style.display = 'none';
        document.getElementById('semarang-masa-depan').style.display = 'none';
        document.getElementById(sectionId).style.display = 'block';

        document.getElementById('btn-masa-lalu').classList.remove('bg-blue-800', 'text-white');
        document.getElementById('btn-masa-lalu').classList.add('text-gray-800');
        document.getElementById('btn-masa-depan').classList.remove('bg-blue-800', 'text-white');
        document.getElementById('btn-masa-depan').classList.add('text-gray-800');

        document.getElementById(buttonId).classList.add('bg-blue-800', 'text-white');
    }

    // Show the first section by default
    showSection('semarang-masa-lalu', 'btn-masa-lalu');
  </script>

</body>
</html>
