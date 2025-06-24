<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Makanan Khas Semarang</title>
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
        <div id="hero-content" class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white">
            <h1 class="text-5xl font-bold mb-4">
                <span class="text-white">Ragam Kuliner Semarang:</span><br>
                <span class="text-white font-normal text-3xl">Kaya Rasa, Sarat Makna</span>
            </h1>
            <button class="bg-red-800 text-white px-6 py-3 rounded-full shadow-lg flex items-center hover:bg-yellow-600" onclick="scrollToMenu()">
                View Menu
            </button>
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
        <h1 class="text-3xl font-bold text-center mb-6">Makanan Khas Semarang</h1>
        <div id="food-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Konten akan di-generate lewat JavaScript -->
        </div>
    </div>

    <script>
        const foodData = [
            {
                name: "Lumpia",
                shortDesc: "Lumpia merupakan kuliner khas Kota Semarang...",
                fullDesc: 'Lumpia merupakan kuliner khas Kota Semarang yang mencerminkan akulturasi budaya Jawa dan Tionghoa. Nama "lumpia" berasal dari gabungan kata "lun" (Bahasa Jawa, berarti gulung) dan "pia" (Bahasa Hokkien, berarti kue). Pada 2014, lumpia Semarang resmi diakui sebagai Warisan Budaya Tak Benda Indonesia. Sejarahnya bermula dari pasangan suami istri etnis Tionghoa dan Jawa yang menikah pada abad ke-19, yang kemudian menginspirasi berdirinya berbagai kedai lumpia di Kota Semarang.',
                imageUrl: "makanan/lumpia.jpg"
            },
            {
                name: "Wingko Babat",
                shortDesc: "Sejarah Wingko Babat bermula dari kota...",
                fullDesc: "Sejarah Wingko Babat bermula dari kota Babat, Lamongan, Jawa Timur, tempat kudapan ini dikenal sebagai kue wingko oleh masyarakat setempat. Pada masa Perang Dunia II, sekitar tahun 1944, sebuah keluarga etnis Tionghoa pindah dari Babat ke Semarang. Pasangan suami istri bernama The Ek Tjong (D. Mulyono) dan Loe Lan Hwa membawa resep wingko babat sebagai warisan keluarga. Mereka melihat peluang bisnis karena kue wingko belum dikenal di Semarang.",
                imageUrl: "makanan/wingkobabat.jpg"
            },
            {
                name: "Mie Kopyok",
                shortDesc: "Mi kopyok adalah salah satu makanan...",
                fullDesc: "Mi kopyok adalah salah satu makanan legendaris khas Kota Semarang. Hidangan ini juga dikenal sebagai mi lontong, karena disajikan bersama lontong, atau mi teng-teng, merujuk pada suara \"teng-teng-teng\" yang dihasilkan saat penjual memukul piring untuk menarik perhatian pembeli. Nama \"kopyok\" sendiri berasal dari bahasa Jawa yang berarti diaduk, sesuai dengan cara terbaik menikmatinya, yaitu dengan mengaduk semua bahan di dalamnya.",
                imageUrl: "makanan/miekopyok.jpg"
            },
            {
                name: "Ganjel Rel",
                shortDesc: "Roti ganjel rel adalah warisan kuliner...",
                fullDesc: "Roti ganjel rel adalah warisan kuliner dari masa kolonial Belanda yang terinspirasi oleh roti tradisional Belanda bernama ontbijtkoek. Awalnya, roti ini dikenal dengan nama asli roti gambang, namun masyarakat Semarang lebih akrab menyebutnya \"ganjel rel\" karena bentuknya menyerupai bantalan rel kereta api.",
                imageUrl: "makanan/miekopyok.jpg"
            },
            {
                name: "Wedhang Tahu",
                shortDesc: "Wedang tahu berasal dari Tiongkok dan dibawa...",
                fullDesc: "Wedang tahu berasal dari Tiongkok dan dibawa ke Indonesia oleh seorang imigran pada akhir abad ke-19. Nama \"Wedang Tahu\" berasal dari bahan utamanya, yakni sari kedelai yang dibuat menyerupai tahu sutra, dicampur dengan kuah jahe hangat yang manis dan harum. Minuman ini dulunya dijajakan oleh pedagang keliling, terutama di pagi hari, karena dipercaya dapat memberikan kehangatan dan energi.",
                imageUrl: "makanan/wedangtahu.jpg"
            },
            {
                name: "Tahu Gimbal",
                shortDesc: "Tahu Gimbal adalah salah satu makanan...",
                fullDesc: "Tahu Gimbal adalah salah satu makanan khas Semarang yang sudah ada sejak era kolonial. Hidangan ini terdiri dari tahu goreng, lontong, kol, tauge, dan gimbal udang (bakwan udang), disajikan dengan siraman bumbu kacang manis pedas yang khas. Awalnya dijual oleh pedagang keliling di kawasan pelabuhan dan Pecinan, Tahu Gimbal dikenal karena rasanya yang lezat dan harganya yang terjangkau. Kini, hidangan ini telah menjadi ikon kuliner Kota Semarang.",
                imageUrl: "makanan/tahugimbal.jpg"
            },
            {
                name: "Tahu Petis",
                shortDesc: "Asal-usul tahu petis di Semarang masih belum...",
                fullDesc: "Asal-usul tahu petis di Semarang masih belum jelas, namun diperkirakan muncul pada akhir abad ke-19 atau awal abad ke-20, saat Kota Semarang sedang mengalami masa kejayaan sebagai pusat perdagangan dan pelabuhan penting di Jawa. Migrasi penduduk dari berbagai daerah, termasuk Tionghoa yang membawa tradisi kulinernya, turut mempengaruhi perkembangan kuliner Semarang. Tahu, bahan dasar tahu petis, sudah dikenal luas di Indonesia sejak lama, sementara petis, saus fermentasi udang khas Jawa Timur, kemungkinan masuk ke Semarang melalui jalur perdagangan. Perpaduan kedua bahan ini menciptakan tahu petis, camilan khas yang kemudian menjadi favorit di Semarang.",
                imageUrl: "makanan/tahupetis.jpg"
            },
            {
                name: "Tahu Pong",
                shortDesc: "Tahu pong adalah jenis tahu yang kosong...",
                fullDesc: "Tahu pong adalah jenis tahu yang kosong di bagian dalam. Kata \"kopong\" dalam bahasa Jawa berarti kosong atau tanpa isi, sehingga dikenal sebagai tahu pong atau tahu kopong. Ada juga yang mengaitkan asal-usul namanya dengan kata \"péng\" dalam dialek Hokkian, yang diucapkan \"phong\", yang berarti menggelembung. Tahu pong memiliki tekstur yang berbeda dari tahu biasa. Ketika digoreng, tahu pong akan menggembung, dengan bagian dalam yang berongga, sementara kulitnya tipis dan kering.",
                imageUrl: "makanan/tahupong.jpg"
            },
        ];

        const foodListContainer = document.getElementById("food-list");

        function displayFoodMenu() {
            foodData.forEach(food => {
                const foodCard = document.createElement("div");
                foodCard.classList.add("bg-white", "p-4", "rounded-lg", "shadow-md", "hover:bg-red-800", "hover:text-white", "transition", "group");

                foodCard.innerHTML = `
                    <img src="${food.imageUrl}" alt="${food.name}" class="w-full h-48 object-cover rounded-md">
                    <h2 class="text-xl font-bold mt-4 group-hover:text-white">${food.name}</h2>
                    <p class="text-gray-700 mt-2 short-desc group-hover:text-white">${food.shortDesc}</p>
                    <p class="text-gray-700 mt-2 full-desc hidden group-hover:text-white text-justify">${food.fullDesc}</p>
                    <button class="text-blue-500 mt-2 read-more group-hover:text-white" onclick="toggleReadMore(this)">Read More</button>
                `;

                foodListContainer.appendChild(foodCard);
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
            const foodCards = document.querySelectorAll('#food-list > div');
            foodCards.forEach(item => {
                const itemName = item.querySelector('h2').textContent.toLowerCase();
                if (itemName.includes(searchValue)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });

        displayFoodMenu();
    </script>
</body>
</html>
