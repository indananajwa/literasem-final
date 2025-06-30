<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kenal Kota Semarang</title>
    <link rel="stylesheet" href="{{ asset('img/logo.png') }}">
    <link rel="stylesheet" href="https://cdn.tailwindcss.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body class="font-roboto">
    <!-- Header Section -->
    @include('pengunjung.layouts.header')

    <!-- Hero Section -->
    <section id="hero-section" class="relative h-screen bg-cover bg-center z-10" style="background-image: url('{{ asset('sampul.jpg') }}');">
        <div id="hero-content" class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white pb-32">
            <h1 class="text-5xl font-bold mb-2">
                <span class="text-6xl font-bold tracking-widest" style="text-shadow: 4px 4px 10px rgba(0, 0, 0, 0.7);">LITERASEM</span>
                <br>
                <span class="font-normal text-3xl" style="text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5);">Literasi Arsip Kota Semarang</span>
            </h1>
            <div class="border-t-2 border-white w-16 mx-auto my-4"></div>
        </div>
    </section>

    <!-- Video Section -->
    <section class="min-h-screen relative overflow-hidden">
        <!-- Envelope Background -->
        <div class="absolute inset-0">
            <div class="envelope-bg w-full h-full bg-gradient-to-br batik-pattern">
                <div class="envelope-fold"></div>
            </div>
        </div>

        <!-- Content Container -->
        <div class="relative z-10 container mx-auto px-4 py-8">
            <div class="max-w-5xl mx-auto">
                <!-- Video Container -->
                <div class="video-container mb-6 shadow-lg rounded-xl overflow-hidden">
                    <iframe
                        id="videoFrame"
                        src="https://www.youtube.com/embed/79fpUpJFtXM"
                        title="Pertempuran 5 Hari Semarang"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                        class="w-full h-full"
                    ></iframe>
                </div>

                <!-- Video Description -->
                <div class="text-center mb-6">
                    <h2 id="videoTitle" class="text-2xl font-semibold text-gray-800 mb-2">Pertempuran 5 Hari di Semarang</h2>
                    <p id="videoDescription" class="text-gray-600">
                        Mengupas kisah heroik di balik Pertempuran 5 Hari di Semarang, perjuangan rakyat mempertahankan kemerdekaan dari ancaman penjajah. 
                        Saksikan bagaimana semangat juang para pahlawan tetap dikenang hingga hari ini.
                    </p>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-center space-x-4">
                    <button
                        onclick="changeVideo(1)"
                        class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-full font-medium transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 shadow-lg"
                    >
                        Video 1
                    </button>
                    <button
                        onclick="changeVideo(2)"
                        class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-full font-medium transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 shadow-lg"
                    >
                        Video 2
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Sejarah Section -->
    <section
        id="sejarah"
        class="opacity-0 translate-y-10 transition-all duration-700 bg-cover bg-center bg-fixed"
        style="background-image: url('{{ asset('img/pattern.png') }}');"
    >
        <div class="bg-white bg-opacity-80 py-8">
            <h2 class="text-3xl font-bold text-center text-red-800 mb-4">Jejak Sejarah Kota Semarang</h2>
            <div class="border-t-2 border-red-800 w-16 mx-auto my-4"></div>
            <div class="container mx-auto px-6 py-8">
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Image -->
                    <div class="flex flex-col items-center">
                        <img
                            src="{{ asset('img/PetaSemarang1913.jpg') }}"
                            alt="Peta Semarang 1913"
                            class="w-full max-w-md rounded-md shadow-md"
                        >
                        <p class="text-center text-gray-500 text-sm mt-2">Peta Semarang Tahun 1913</p>
                    </div>

                    <!-- Text Content -->
                    <div>
                        <p class="text-gray-700 text-justify leading-relaxed">
                            Sejarah Kota Semarang bermula pada <strong>abad ke-8 M</strong> sebagai daerah pesisir bernama <strong>Pragota</strong>, bagian dari Kerajaan Mataram Kuno. Saat itu, daerah ini merupakan pelabuhan penting dengan gugusan pulau kecil yang kini menjadi daratan akibat pengendapan. Pelabuhan ini diduga berada di sekitar Pasar Bulu hingga Pelabuhan Simongan, tempat Laksamana Cheng Ho bersandar pada 1405 M dan mendirikan Kelenteng Sam Po Kong.<br><br>
                            Pada abad ke-15, Kerajaan Demak menugaskan Pangeran Made Pandan untuk menyebarkan Islam di Pragota. Nama "Semarang" berasal dari pohon asam yang jarang tumbuh di daerah ini (Asem Arang). Pendiri desa, Kyai Ageng Pandan Arang I, digantikan putranya, Pandan Arang II, yang membawa kemajuan hingga Semarang ditetapkan sebagai kabupaten oleh Sultan Hadiwijaya pada 2 Mei 1547—tanggal yang kini diperingati sebagai Hari Jadi Kota Semarang.<br><br>
                            Pada tahun 1678, Amangkurat II menyerahkan Semarang kepada VOC sebagai pembayaran utang. Pada 1705, Pakubuwono I menyerahkan Semarang kepada VOC, menjadikannya kota kolonial hingga dibentuk Gemeente pada 1906. Pemerintahan ini berakhir pada 1942 saat pendudukan Jepang, yang membentuk pemerintahan lokal dengan kepala militer (Shico).<br><br>
                            Setelah kemerdekaan, Semarang mengalami Pertempuran Lima Hari (15–20 Oktober 1945) melawan Jepang. Pada 1946, Inggris menyerahkan Semarang kepada Belanda, yang menduduki kota hingga 1950. Pemerintahan kota selama pendudukan dijalankan di daerah pengungsian, hingga pada 1 April 1950, pemerintahan kota diserahkan kembali kepada pemerintah Republik Indonesia.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Masa ke Masa Section -->
    @include('pengunjung.masa-ke-masa')

    <!-- Pemerintahan Section -->
    @include('pengunjung.pemerintahan')

    <!-- Situs Kota Lama Section -->
    <section id="situs-kota-lama" class="mt-16 bg-white opacity-100 translate-y-0 transition-all duration-700">
        <div class="container mx-auto p-4">
            <div class="flex flex-col lg:flex-row items-center lg:items-start gap-8">
                <!-- Image -->
                <div class="w-full lg:w-2/3 flex justify-center">
                    <img
                        src="{{ asset('SKL/situskotalama.png') }}"
                        alt="Map of Kota Lama Semarang with various landmarks marked"
                        class="w-full h-auto max-h-[500px] rounded-lg shadow-lg object-cover"
                    >
                </div>

                <!-- Content -->
                <div class="w-full lg:w-1/3 flex flex-col justify-between min-h-full">
                    <h1 class="text-4xl font-bold text-gray-800 mb-4">Kota Lama</h1>
                    <p id="description" class="text-gray-600 text-justify">
                        Kota Lama Semarang adalah destinasi ideal bagi para penggemar wisata sejarah dan fotografi arsitektur. Kawasan ini memiliki berbagai landmark menakjubkan dan bangunan peninggalan Belanda yang terpelihara dengan baik. Pada abad ke-19 hingga ke-20, Kota Lama merupakan pusat perdagangan penting, dan untuk melindungi warga serta wilayahnya, dibangunlah benteng Vijfhoek. Jalan utama di dalam benteng tersebut diberi nama Heerenstraat, yang kini dikenal sebagai Jalan Letjen Soeprapto. Kota Lama dijuluki "Little Netherland" karena lanskapnya yang terpisah dan mirip dengan kota-kota di Eropa, serta kanal-kanal air yang mengelilinginya. Arsitektur bangunan di kawasan ini mengusung gaya Eropa dengan pintu utama dan jendela besar, elemen dekoratif, dan langit-langit tinggi.
                    </p>
                    <div class="mt-2">
                        <button
                            id="readMoreBtn"
                            class="text-red-800 underline text-sm"
                            onclick="toggleReadMore()"
                        >
                            Read More
                        </button>
                    </div>
                    <button
                        class="mt-6 bg-red-800 text-white px-4 py-2 rounded-full flex items-center self-start"
                        onclick="window.location.href='{{ route('situs-kota-lama') }}'"
                    >
                        More Information
                        <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Icon Gallery Section -->
    @include('pengunjung.layouts.icon-gallery')

    <!-- Footer Section -->
    @include('pengunjung.layouts.footer')

    <!-- Scripts -->
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>