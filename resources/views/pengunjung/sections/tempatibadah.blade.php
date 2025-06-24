<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tempat Ibadah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body class="bg-gray-100">

    <!-- Include Header -->
    @include('pengunjung.layouts.header')

    <div id="hero-section" class="relative h-screen bg-cover bg-center z-10" style="background-image: url('https://via.placeholder.com/1920x1080');">
        <!-- Overlay hitam transparan -->
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>

        <!-- Konten hero section -->
        <div id="hero" class="relative h-screen bg-cover bg-center" style="background-image: url('cover/cover_ibadah.jpg');">
            <!-- Transparansi dengan overlay dan efek blur -->
            <div class="absolute inset-0 bg-black opacity-50 backdrop-blur-lg"></div> <!-- Lapisan transparan hitam dan efek blur -->

            <div id="hero-content" class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white">
                <h1 class="text-5xl font-bold mb-4">
                    <span class="text-white shadow">Tempat Ibadah Kota Semarang:</span><br>
                    <span class="text-white font-normal text-3xl">Menapaki Keagungan Tempat Ibadah Bersejarah di Semarang</span>
                </h1>
                <button class="bg-red-800 text-white px-6 py-3 rounded-full shadow-lg flex items-center hover:bg-yellow-600" onclick="scrollToMenu()">
                    View Detail
                </button>
            </div>
        </div>



        <!-- Search bar -->
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

    <div id="menu-section" class="container mx-auto px-4 py-6 mt-12">
        <h1 class="text-3xl font-bold text-center mb-6">Tempat-Tempat Ibadah</h1>
        <div class="flex justify-center mb-6">
            <!-- Removed previous search input, only search-bar is kept -->
        </div>
        <div id="ibadah-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Konten akan di-generate lewat JavaScript -->
        </div>
    </div>

    <script>
        const ibadahData = [
            {
                name: "Gereja Blenduk",
                shortDesc: "Gereja Blenduk, atau GPIB Immanuel, awalnya dibangun pada 1742..",
                fullDesc: "Gereja Blenduk, atau GPIB Immanuel, awalnya dibangun pada 1742 sebagai rumah panggung Jawa. Renovasi besar pada 1787-1794 mengubahnya menjadi gereja bergaya Eropa dengan elemen Barok dan Renaisans. Pada 1894-1895, H.P.A. De Wilde dan W. Westmaas melakukan renovasi kedua, menghasilkan bentuk Pseudo Barok yang dikenal saat ini, mencerminkan arsitektur klasik abad ke-17 hingga ke-19. Sejarah renovasinya terukir di batu marmer di bawah altar.",
                imageUrl: "ibadah/gereja_blenduk.jpg",
                location: "https://goo.gl/maps/B9gQ5BfLLh62"
            },
            {
                name: "Gereja Katedral Randusari",
                shortDesc: "Pada 26 Januari 1927, dibelilah sebuah tanah dan bangunan..",
                fullDesc: "Pada 26 Januari 1927, dibelilah sebuah tanah dan bangunan di daerah Randusari, tepatnya di kaki Gunung Brintik. Bangunan yang awalnya digunakan sebagai gedung kesehatan 'Dienst voor Volkgezondheid' itu akan digunakan sebagai tempat ibadah yang baru. Setelah direnovasi pada tanggal 9 Oktober 1927, gedung gereja ini diberkati oleh Mgr. Antonius van Velsen, vicaris apostolic Batavia. Kemudian menjadi sebuah gereja paroki pada tahun 1930 dan menjadi katedral pada tahun 1937 ketika Albertus Soegijapranata diangkat sebagai vikaris apostolik pertama di Semarang. Gedung Gereja diarsiteki oleh T.H. van Oyen dan anemer Kleiverde.",
                imageUrl: "ibadah/gereja_katedral_randusari.jpg",
                location: "https://goo.gl/maps/B9gQ5BfLLh62"
            },
            {
                name: "Sampokong",
                shortDesc: "Klenteng Sam Poo Kong dibangun berdasarkan sejarah..",
                fullDesc: "Klenteng Sam Poo Kong dibangun berdasarkan sejarah kedatangan Laksamana Zheng He (Cheng Ho), atau Sam Po Tay Djien, di Semarang pada abad ke-15. Nama Sam Poo Kong berasal dari 'San Bao Dong,' yang berarti 'Gua Tiga Harta,' mengacu pada gua tempat Cheng Ho bermeditasi.",
                imageUrl: "ibadah/sampokong.jpg",
                location: "https://goo.gl/maps/B9gQ5BfLLh62"
            },
            {
                name: "Masjid Kauman",
                shortDesc: "Masjid Kauman berdiri pada 13 November 1890. Masjid ini didesain..",
                fullDesc: "Masjid Kauman berdiri pada 13 November 1890. Masjid ini didesain oleh arsitek dari Belanda bernama Ir. G. A. Gambier. Atap masjid Kauman ini terbuat dari seng yang ada sejak masa pemerintahan Hindia Belanda. Masjid Kauman memiliki keunikan arsitektur dengan atap bertingkat tiga khas Jawa, yang mengandung makna filosofis mendalam.",
                imageUrl: "ibadah/masjid_kauman.jpg",
                location: "https://goo.gl/maps/B9gQ5BfLLh62"
            },
            {
                name: "Pagoda Avalokitesvara",
                shortDesc: "Pagoda Avalokitesvara, atau Pagoda Metta Karuna..",
                fullDesc: "Pagoda Avalokitesvara, atau Pagoda Metta Karuna, terletak di Vihara Buddhagaya Watugong, Semarang, Jawa Tengah, dan didedikasikan untuk Dewi Kwan Im (Avalokitesvara), simbol cinta kasih dan welas asih. Dibangun pada 2005, pagoda ini merupakan salah satu yang tertinggi di Indonesia, dengan ketinggian sekitar 45 meter dan tujuh tingkat. Desainnya bergaya Tiongkok, dengan atap bertingkat, ornamen naga, dan patung Dewi Kwan Im di dalamnya.",
                imageUrl: "ibadah/pagoda_avalokitesvara.jpg",
                location: "https://goo.gl/maps/B9gQ5BfLLh62"
            }
        ];



        const ibadahListContainer = document.getElementById("ibadah-list");

        function displayIbadah() {
            ibadahData.forEach(ibadah => {
                const ibadahCard = document.createElement("div");
                ibadahCard.classList.add("bg-white", "p-4", "rounded-lg", "shadow-md", "hover:bg-red-800", "hover:text-white", "transition", "group");

                ibadahCard.innerHTML = `
                    <img src="${ibadah.imageUrl}" alt="${ibadah.name}" class="w-full h-48 object-cover rounded-md">
                    <h2 class="text-xl font-bold mt-4">${ibadah.name}</h2>
                    <p class="text-gray-700 mt-2 short-desc group-hover:text-white">${ibadah.shortDesc}</p>
                    <p class="text-gray-700 mt-2 full-desc hidden group-hover:text-white text-justify">${ibadah.fullDesc}</p>
                    <button class="text-blue-500 mt-2 read-more" onclick="toggleReadMore(this)">Read More</button>
                    <div class="mt-4 flex items-center">
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
                            onclick="openLocation('${ibadah.location}')"
                        >
                            Lihat Lokasi
                        </button>
                    </div>
                `;

                ibadahListContainer.appendChild(ibadahCard);
            });
        }

        function toggleReadMore(button) {
            const card = button.parentElement;
            const shortDesc = card.querySelector('.short-desc');
            const fullDesc = card.querySelector('.full-desc');

            if (fullDesc.classList.contains('hidden')) {
                shortDesc.classList.add('hidden');
                fullDesc.classList.remove('hidden');
                button.textContent = 'Read Less';
            } else {
                shortDesc.classList.remove('hidden');
                fullDesc.classList.add('hidden');
                button.textContent = 'Read More';
            }
        }

        function scrollToMenu() {
            const menuSection = document.getElementById('menu-section');
            menuSection.scrollIntoView({ behavior: 'smooth' });
        }

        document.getElementById('search-bar').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase();
            const ibadahCards = document.querySelectorAll('#ibadah-list > div');
            ibadahCards.forEach(item => {
                const itemName = item.querySelector('h2').textContent.toLowerCase();
                if (itemName.includes(searchValue)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });

        function openLocation(url) {
            window.open(url, '_blank');
        }

        displayIbadah();
    </script>
</body>
</html>
