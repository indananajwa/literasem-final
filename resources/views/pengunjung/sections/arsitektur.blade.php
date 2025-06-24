<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arsitektur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: Inter, sans-serif;
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
        <div id="hero" class="relative h-screen bg-cover bg-center" style="background-image: url('cover/cover_arsi.jpg');">
            <!-- Transparansi dengan overlay dan efek blur -->
            <div class="absolute inset-0 bg-black opacity-50 backdrop-blur-lg"></div> <!-- Lapisan transparan hitam dan efek blur -->

            <div id="hero-content" class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white">
                <h1 class="text-5xl font-bold mb-4">
                    <span class="text-white shadow">Arsitektur Kota Semarang:</span><br>
                    <span class="text-white font-normal text-3xl">Menelusuri Jejak Arsitektur Semarang, Dari Masa ke Masa</span>
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
        <h1 class="text-3xl font-bold text-center mb-6">Bagunan Arsitektur Khas Semarang</h1>
        <div id="arsi-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Konten akan di-generate lewat JavaScript -->
        </div>
    </div>

    <script>
        const arsiData = [
            {
                name: "Pasar Djohar",
                shortDesc: "Pasar Johar, pasar terbesar di Asia Tenggara pada masanya...",
                fullDesc: 'Pasar Johar adalah salah satu pasar tradisional di Kota Semarang yang pernah menjadi Pasar Terbesar se-Asia Tenggara. Karena lokasinya berdekatan dengan Penjara sehingga sering dijadikan tempat transit bagi orang yang sedang menjenguk kerabat di penjara. Nama Johar dipilih karena pada saat itu di sebelah timur Alun-alun Kota Semarang dan lokasinya dipagari pohon Johar di tepi jalan. Pasar Johar Kota Semarang dimulai tahun 1860 dan baru diresmikan kembali pada tahun 2022 setelah masa pemulihan karena sebelumnya mengalami kebakaran pada tahun 2015 dan baru di bangun kembali tahun 2017 dan selesai pada tahun 2021. Pasar Johar dirancang oleh insinyur Belanda, Ir. Thomas Kristen.',
                imageUrl: "arsi/PasarDjohar1928.jpg"
            },
            {
                name: "Lawang Sewu",
                shortDesc: "Lawang Sewu, ikon wisata Semarang, dikenal karena arsitektur kolonialnya...",
                fullDesc: 'Lawang Sewu, ikon wisata Semarang, dikenal karena arsitektur kolonialnya yang megah dan kisah sejarahnya yang kaya. Dibangun tahun 1904 sebagai kantor perusahaan kereta api NIS, nama "Lawang Sewu" merujuk pada banyaknya pintu dan jendela besar di bangunan ini. Selain menikmati keindahan arsitekturnya, pengunjung bisa belajar tentang sejarah transportasi kereta api Indonesia dan masa kelam saat bangunan ini menjadi penjara di era pendudukan Jepang. Lawang Sewu juga terkenal dengan cerita-cerita mistisnya, seperti ruang bawah tanah yang memikat pencinta wisata horor. Tempat ini kerap menjadi lokasi acara seni dan budaya, menjadikannya destinasi unik yang memadukan sejarah, seni, dan misteri.',
                imageUrl: "arsi/LawangSewu40.jpg"
            },
            {
                name: "Tangsi Militer",
                shortDesc: "Tangsi militer Belanda yang dibangun pada 1743 bernama De Werttenbergse...",
                fullDesc: "Tangsi militer Belanda yang dibangun pada 1743 bernama De Werttenbergse Kazerne. Tempat ini menjadi markas bagi tentara bayaran dari berbagai daerah dan negara yang direkrut oleh penguasa Belanda, yang berawal dari pemberontakan orang Tionghoa di Batavia (Jakarta) pada 1740. Dalam peristiwa tersebut, banyak orang Tionghoa melarikan diri ke arah timur sepanjang jalur utara Pulau Jawa, sambil terus melawan tentara Belanda. Saat ini, lokasi ini telah menjadi Gedung Plaza Semarang.",
                imageUrl: "arsi/TangsiMiliter.jpg"
            },
            {
                name: "Javasche Bank",
                shortDesc: "Javasche Bank, yang sekarang dikenal sebagai Bank Indonesia, merupakan...",
                fullDesc: "Javasche Bank, yang sekarang dikenal sebagai Bank Indonesia, merupakan kantor cabang pertama De Javasche Bank N.V di seluruh Hindia Belanda, yang dibuka pada 1 Maret 1829. Terletak di Jl. Letjen Suprapto, pembangunan gedung ini didasari oleh pertimbangan bahwa Kota Semarang, sebagai kota besar dengan pelabuhan utama di Jawa, memiliki potensi ekonomi dan perdagangan yang strategis. Setelah kemerdekaan Indonesia, pada 30 Juni 1958, DJB dinasionalisasi menjadi Bank Indonesia.",
                imageUrl: "arsi/JavascheBank.jpg"
            },
            {
                name: "RSUP DR KARIYADI",
                shortDesc: "RSUP Dr. Kariyadi, rumah sakit bersejarah yang dibangun pada 1925...",
                fullDesc: 'Pada 1919, dr. N.F. Liem mengusulkan untuk mengganti dan menggabungkan Rumah Sakit Kota di Tawang dengan Rumah Sakit Kota Pembantu di Alun-alun Semarang. Rencana ini diwujudkan dengan membangun rumah sakit yang lebih besar di Semarang. Pembangunannya dimulai pada 1920 dan selesai lima tahun kemudian. Pada 9 September 1925, lahirlah "Centrale Burgerlijke Ziekeninrichting" yang lebih dikenal dengan nama CBZ. Awalnya, rumah sakit ini fokus pada pelayanan medis berupa pengobatan kuratif dan pendidikan paramedis.',
                imageUrl: "arsi/RSUPKariadi.jpg"
            },
            {
                name: "RSU ST. ELISABETH",
                shortDesc: "RSU St. Elisabeth, rumah sakit bersejarah di Semarang, didirikan pada 1927...",
                fullDesc: 'Pada tanggal 3 September 1923 dana tersebut digunakan untuk membeli sebidang tanah bekas kuburan Tionghoa seluas 34.000 m2 di daerah perbukitan candi baru, dengan pemandangan yang sangat indah, suatu kawasan yang tenang. Pembangunan dilaksanakan oleh 3 kontraktor yaitu Ir.Karsten, Ir.Zoetmulder, Ir.Peters dan Ir. Keliverda dan selesai pada tanggal 8 Agustus 1927. Pada masa pendudukan Jepang, RS St. Elisabeth diambil alih dan dijadikan kantor militer.',
                imageUrl: "arsi/RSUElisabeth.jpg"
            },
            {
                name: "Gedung Balai Kota Semarang",
                shortDesc: "Gedung Balai Kota Semarang, awalnya villa keluarga Gimberg...",
                fullDesc: 'Gedung Balai Kota Semarang, yang awalnya merupakan villa milik keluarga Gimberg, terletak di Jalan Pemuda No. 148. Gedung ini digunakan sebagai kantor utama Stadsgemeente (Kotapraja) Semarang, tempat Burgemeester (Walikota) Semarang berkantor. Pada 1960-an, gedung ini beralih fungsi menjadi Dinas Pekerjaan Umum (DPU) Kotamadya Semarang, dengan renovasi penambahan dinding berjendela di bagian depan. Kemudian, pada 1980-an, dilakukan perombakan besar dengan menutup pilar-pilar dan menambahkan kanopi bergaya Romawi kuno di bagian depan gedung.',
                imageUrl: ""
            },
            {
                name: "Gedung Pertamina",
                shortDesc: "Gedung Pertamina, salah satu bangunan bersejarah di Semarang...",
                fullDesc: 'Gedung Pertamina, yang sebelumnya dikenal sebagai Gedung BP Migas, adalah salah satu bangunan bersejarah yang terletak di Jalan Pemuda 114, Semarang. Bangunan ini masih terjaga keasliannya dengan baik. Meskipun di sisi kirinya telah dibangun Mall Paragon dan Hotel Crowne Plaza, sebagai bangunan tua, keberadaannya masih terlihat serasi berdampingan dengan bangunan-bangunan modern di sekitarnya.',
                imageUrl: "arsi/GedungPertamina1938.jpg"
            },
            {
                name: "Pasar Pedamaran Semarang",
                shortDesc: "Pasar Pedamaran Semarang, sebelum dibangunnya Pasar Johar pada 1931...",
                fullDesc: 'Pasar Pedamaran Semarang Pasar Pedamaran Johar Semarang, Pada foto tahun 1910. Situasi Pasar Pedamaran ini sebelum dibagunnya Pasar Johar pada tahun 1931. Pasar ini memiliki 240 buah dasarn sehingga pemerintah pada saat itu meminta Ir. Herman Thomas Karsten mendirikan pasar gede Semarang yang menggabungkan Pasar Pedamaran, Johar, Beteng, Jurnatan dan Pekojan.',
                imageUrl: ""
            },
            {
                name: "Gedung Papak",
                shortDesc: "Gedung Papak, yang dibangun pada 1919 dengan arsitektur kolonial Belanda...",
                fullDesc: 'Gedung Papak, yang dibangun pada 1919 dengan arsitektur kolonial Belanda, awalnya berfungsi sebagai markas tentara Belanda dan tempat penyiksaan bagi pribumi yang melawan. Dengan desain kokoh dan sederhana, gedung ini akhirnya dikuasai oleh tentara Jepang.',
                imageUrl: "arsi/GedungPapak.jpg"
            },
            {
                name: "Penjara Bulu",
                shortDesc: "Penjara Bulu, tempat terjadinya pembantaian pada Perang Dunia II...",
                fullDesc: 'Penjara bulu adalah tempat terjadinya pembantaian Penjara Bulu pada Perang Dunia II. Saat itu Dr. Kariadi sebagai kepala laboratorium Rumah Sakit Purusara (Sekarang Rumah Sakit Kariadi) dipanggil untuk membuktikan kebenaran adanya racun pada tandon air Siranda, Candi Baru. Namun, Dr. Kariadi dan sopirnya ditembak oleh Jepang saat melewati Jl. Pandanaran. Hal ini memicu perlawanan dari warga Semarang untuk menyerang tahanan-tahanan jepang yang berada di penjara bulu.',
                imageUrl: "arsi/penjaraBulu.jpg"
            },
            {
                name: "Gedung Chinese English School Bodjong 1930",
                shortDesc: "Gedung yang kini menjadi SMA Negeri 5 Semarang, sebelumnya sekolah Tionghoa...",
                fullDesc: 'Chinese English School "Hwa Ing" terletak di Bodjong Straat, yang kini dikenal sebagai Jalan Pemuda Semarang. Thio menjabat sebagai ketua sekolah ini pada tahun 1928. Saat ini, gedung tersebut digunakan sebagai SMA Negeri 5 Semarang.',
                imageUrl: "arsi/GedungChineseBodjong.jpg"
            },
            {
                name: "Gedung Gris",
                shortDesc: "Gedung Gris yang kini menjadi Paragon Mall, dulunya tempat pertunjukan seni...",
                fullDesc: 'GRIS, yang dulunya merupakan sebuah Sositet de Harmonie milik seorang Belanda, dibeli oleh masyarakat pribumi dengan membentuk panitia Fonds GRIS. Di masa keemasannya, GRIS selalu ramai dikunjungi masyarakat untuk menyaksikan pertunjukan Wayang Orang Ngesti Pandowo. Selain digunakan untuk menimba ilmu tentang kesenian serta hiburan murah, GRIS juga digunakan untuk acara resepsi, perpustakaan rakyat, gedung bioskop, kampus sebuah akademi bahasa, dan sebagainya (Gedung GRIS sekarang menjadi Paragon Mall).',
                imageUrl: "arsi/GedungGris1925.jpg"
            },
            {
                name: "Gedung Mega Eltra",
                shortDesc: "Gedung Mega Eltra, bangunan bersejarah yang dibangun pada 1897...",
                fullDesc: 'Gedung Mega Eltra, dibangun sekitar tahun 1897. Penghuni gedung ini dulunya NV. Lindeteves yang menyediakan kelistrikan di wilayah pelabuhan Semarang. Pada masa pendudukan Jepang, gedung ini dikenal dengan nama Semarang Kikei Sesaku Syo. Mega Eltra sendiri adalah perusahaan yang bermula dari perusahaan Belanda yang kegiatan usaha di bidang listrik, mesin dan peralatan tehnik yang telah eksis sejak tahun 1930, dikenal dengan nama Electro Import NV. Perusahaan ini merupakan anak perusahaan Jacobson Vanden Berg & Co, sebuah perusahaan Belanda yang pada zamannya dikenal dalam kelompok perusahaan “The Big Five”.',
                imageUrl: "arsi/GedungMegaEltra.jpg"
            }


        ];

        const arsiListContainer = document.getElementById("arsi-list");

        function displayArsiMenu() {
            arsiData.forEach(arsi => {
                const arsiCard = document.createElement("div");
                arsiCard.classList.add("bg-white", "p-4", "rounded-lg", "shadow-md", "hover:bg-red-800", "hover:text-white", "transition", "group");

                arsiCard.innerHTML = `
                    <img src="${arsi.imageUrl}" alt="${arsi.name}" class="w-full h-48 object-cover rounded-md">
                    <h2 class="text-xl font-bold mt-4 group-hover:text-white">${arsi.name}</h2>
                    <p class="text-gray-700 mt-2 short-desc group-hover:text-white">${arsi.shortDesc}</p>
                    <p class="text-gray-700 mt-2 full-desc hidden group-hover:text-white text-justify">${arsi.fullDesc}</p>
                    <button class="text-blue-500 mt-2 read-more group-hover:text-white" onclick="toggleReadMore(this)">Read More</button>
                `;

                arsiListContainer.appendChild(arsiCard);
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
            const arsiCards = document.querySelectorAll('#arsi-list > div');
            arsiCards.forEach(item => {
                const itemName = item.querySelector('h2').textContent.toLowerCase();
                if (itemName.includes(searchValue)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });

        displayArsiMenu();
    </script>
</body>
</html>