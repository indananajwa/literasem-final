<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Profile Cards</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Include Header -->
    @include('pengunjung.layouts.header')

    <!-- Hero Section -->
    <div id="hero-section" class="relative h-screen bg-cover bg-center z-10" style="background-image: url('cover/tokoh.png');">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div id="hero-content" class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white">
            <h1 class="text-5xl font-bold mb-4">
                <span class="text-white shadow-lg">Jelajah Para Tokoh</span><br>
                <span class="text-white-800 font-normal text-3xl">Mengenal Sosok-Sosok Berpengaruh dalam Sejarah Semarang</span>
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


    <!-- Card Section -->
    <div id="card-section" class="mt-16 flex flex-wrap justify-center gap-8 px-4"></div>

    <script>
      // Data Array
      const profiles = [
        {
          name: "Jenderal Ahmad Yani",
          img: "tokohM/AhmadYani.jpeg",
          desc: 'Jenderal TNI Anumerta Ahmad Yani lahir di Purworejo, Jawa Tengah, pada 19 Juni 1922....',
          more: 'Jenderal TNI Anumerta Ahmad Yani lahir di Purworejo, Jawa Tengah, pada 19 Juni 1922. Ia wafat pada usia 43 tahun dalam tragedi Lubang Buaya, Jakarta, pada 1 Oktober 1965. Ahmad Yani, seorang komandan Tentara Nasional Indonesia Angkatan Darat, gugur dalam peristiwa yang dikenal sebagai tragedi genosida atau pembantaian massal. Menurut catatan sejarah, ia dibunuh oleh anggota Gerakan 30 September.',
        },
        {
          name: "K.R.M.T Wongsonegoro",
          img: "tokohM/K.R.M.T WONGSONEGORO.png",
          desc: 'Mr. Wongsonegoro (20 April 1897 - 4 Maret 1978) pernah menjabat sebagai Wakil Perdana Menteri Indonesia...',
          more: 'Mr. Wongsonegoro (20 April 1897 - 4 Maret 1978) pernah menjabat sebagai Wakil Perdana Menteri Indonesia dalam Kabinet Ali Sastroamidjojo I pada 1953-1955 dan Menteri Pendidikan dan Kebudayaan pada 1951-1952. Sebelum kemerdekaan, ia menjadi anggota BPUPKI sebagai perwakilan Surakarta bersama Wuryaningrat, Sosrodiningrat, dan Radjiman Wedyodiningrat. Untuk menghormatinya, nama K.R.M.T Wongsonegoro kini digunakan sebagai nama Rumah Sakit Umum Daerah di Kota Semarang.',
        },
        {
          name: "Dr. Tjipto Mangoenkoesoemo",
          img: "tokohM/TJIPTO MANGOENKOESOEMO.jpeg",
          desc: 'Dr. Tjipto Mangoenkoesoemo adalah tokoh pergerakan kemerdekaan Indonesia yang terkenal sebagai bagian dari...',
          more: 'Dr. Tjipto Mangoenkoesoemo adalah tokoh pergerakan kemerdekaan Indonesia yang terkenal sebagai bagian dari "Tiga Serangkai" bersama Ernest Douwes Dekker dan Ki Hajar Dewantara. Sebagai tokoh terkemuka di Indische Partij, Tjipto kerap mengkritik pemerintahan kolonial Hindia-Belanda melalui tulisan-tulisannya yang dianggap radikal. Akibat aktivitasnya, ia diasingkan oleh pemerintah kolonial Belanda dan pada tahun 1927 dibuang ke Banda.',
        },
        {
          name: "Dr. Kariadi",
          img: "tokohM/DrKariadi.png",
          desc: 'Dr. Kariadi adalah salah satu pahlawan yang turut berjuang dalam pertempuran lima hari di Semarang...',
          more: 'Dr. Kariadi adalah salah satu pahlawan yang turut berjuang dalam pertempuran lima hari di Semarang, yang terjadi antara rakyat Indonesia dan tentara Jepang pada Oktober 1945. Sebagai kepala laboratorium, ia gugur di usia 40 tahun saat hendak memeriksa kebenaran kabar tentang racun di reservoir Siranda. Dalam perjalanan tersebut, Dr. Kariadi ditembak hingga meninggal dunia.',
        },
        {
          name: "Soemantri Brodjonegoro",
          img: "tokohM/SOEMANTRI BRODJONEGORO.jpeg",
          desc: 'Soemantri, yang lahir di Semarang, Jawa Tengah, pada 3 Juni 1926, meninggal dunia di Jakarta pada...',
          more: 'Soemantri, yang lahir di Semarang, Jawa Tengah, pada 3 Juni 1926, meninggal dunia di Jakarta pada 18 Desember 1973 di usia 47 tahun. Ia pernah menjabat sebagai Menteri Energi dan Sumber Daya Mineral Republik Indonesia dari 1967 hingga 1973. Pada tahun 1973, ia juga menjabat sebagai Menteri Pendidikan dan Kebudayaan. Sumantri wafat saat masih menjabat sebagai Menteri Pendidikan dan Kebudayaan, dan posisinya kemudian digantikan oleh Syarief Thayeb.',
        },
        {
          name: "MGR. Soegijapranata",
          img: "tokohM/mgr soegijapranata.jpeg",
          desc: 'Mgr. Albertus Soegijapranata, SJ, adalah seorang Vikaris Apostolik Semarang yang kemudian diangkat menjadi...',
          more: 'Mgr. Albertus Soegijapranata, SJ, adalah seorang Vikaris Apostolik Semarang yang kemudian diangkat menjadi uskup agung. Ia dikenal sebagai uskup pribumi pertama dengan semangat nasionalisme yang kuat. Meski menempuh pendidikan di lingkungan Belanda, ia tidak terpengaruh oleh pemikiran kolonial. Sebaliknya, ia mengajarkan agama dengan pendekatan yang selaras dengan nilai-nilai keindonesiaan.',
        },
        {
          name: "M. Mutahar",
          img: "tokohM/M. Mutahar.png",
          desc: 'Nama M. Husein Mutahar diabadikan sebagai nama jalan di Lampung. Lahir di Semarang, Jawa Tengah, pada 5...',
          more: 'Nama M. Husein Mutahar diabadikan sebagai nama jalan di Lampung. Lahir di Semarang, Jawa Tengah, pada 5 Agustus 1916, ia wafat di Jakarta pada 9 Juni 2004 di usia 87 tahun. Ia berjasa dalam mengembangkan lagu nasional dan lagu anak-anak. Beberapa karyanya yang terkenal adalah "Syukur," mars "Hari Merdeka," dan hymne "Pramuka."',
        },
        {
          name: "Ainun Habibie",
          img: "tokohM/Ainunhabibie.jpeg",
          desc: 'Hasri Ainun Besari, lahir di Semarang, Jawa Tengah, pada 11 Agustus 1937, dan wafat di München, Jerman, pada...',
          more: 'Hasri Ainun Besari, lahir di Semarang, Jawa Tengah, pada 11 Agustus 1937, dan wafat di München, Jerman, pada 22 Mei 2010. Ia pernah menjabat sebagai Ibu Negara Indonesia ketiga dari 1998 hingga 1999. Untuk menghormati jasanya, namanya diabadikan sebagai nama Klinik Mata Dr. Hasrie Ainun Habibie di Bogor.',
        },
        {
          name: "Raden Saleh",
          img: "tokohM/Raden saleh.jpeg",
          desc: 'Raden Saleh Sjarif Boestaman, seorang pelukis berdarah campuran Arab-Jawa, lahir di Semarang pada 23 April 1880...',
          more: 'Raden Saleh Sjarif Boestaman, seorang pelukis berdarah campuran Arab-Jawa, lahir di Semarang pada 23 April 1880. Ia dikenal sebagai pelopor seni lukis modern di Indonesia (saat itu Hindia Belanda). Karya-karyanya menggabungkan gaya Romantisisme Eropa dengan nuansa budaya Jawa yang khas.',
        },
        {
          name: "Zheng He/Cheng Ho",
          img: "tokohM/Zheng gue_ cheng ho.jpeg",
          desc: 'Laksamana Muslim asal Tiongkok, Zheng He atau Cheng Ho, pernah singgah dan mendarat di tempat yang kini...',
          more: 'Laksamana Muslim asal Tiongkok, Zheng He atau Cheng Ho, pernah singgah dan mendarat di tempat yang kini dikenal sebagai Sam Poo Kong, yang terletak di daerah Simongan, barat daya Kota Semarang. Jejak keislamannya dapat dilihat dari sebuah tulisan yang berbunyi, "Marilah kita mengheningkan cipta dengan mendengarkan bacaan Al-Quran.',
        },
      ];

      // Render Cards
      function renderCards() {
        const cardSection = document.getElementById("card-section");
        cardSection.innerHTML = "";

        profiles.forEach((profile, index) => {
          const card = document.createElement("div");
          card.className =
            "bg-white text-gray-800 rounded-lg p-6 shadow-lg flex flex-col items-center w-80 lg:w-1/3 mb-10";

          card.innerHTML = `
            <img
              alt="Portrait of ${profile.name}"
              class="w-32 h-40 rounded-full -mt-16 mb-4 border-4 border-gray-200"
              src="${profile.img}"
            />
            <h2 class="text-xl font-bold mb-4">${profile.name}</h2>
            <p class="text-sm leading-relaxed text-justify">
              <span class="line-clamp-3 text-xl" id="desc-${index}">
                ${profile.desc}
              </span>
              <span class="hidden" id="full-desc-${index}">
                ${profile.more}
              </span>
            </p>
            <div class="w-full text-left mt-4 text-xl">
              <button
                id="btn-${index}"
                onclick="toggleReadMore(${index})"
                class="text-blue-600 font-semibold hover:underline"
              >
                Read More
              </button>
            </div>
          `;

          cardSection.appendChild(card);
        });
      }

      // Toggle Read More
      function toggleReadMore(index) {
        const desc = document.getElementById(`desc-${index}`);
        const fullDesc = document.getElementById(`full-desc-${index}`);
        const btn = document.getElementById(`btn-${index}`);

        if (fullDesc.classList.contains("hidden")) {
          desc.classList.add("hidden");
          fullDesc.classList.remove("hidden");
          btn.innerText = "Show Less";
        } else {
          desc.classList.remove("hidden");
          fullDesc.classList.add("hidden");
          btn.innerText = "Read More";
        }
      }

      // Search Cards
      function searchCards() {
        const query = document.getElementById("search-bar").value.toLowerCase();
        const filteredProfiles = profiles.filter((profile) =>
          profile.name.toLowerCase().includes(query)
        );

        const cardSection = document.getElementById("card-section");
        cardSection.innerHTML = "";

        filteredProfiles.forEach((profile, index) => {
          cardSection.innerHTML += `
            <div class="bg-white text-gray-800 rounded-lg p-6 shadow-lg flex flex-col items-center w-80 lg:w-1/3 mb-10">
              <img
                alt="Portrait of ${profile.name}"
                class="w-32 h-32 rounded-full -mt-16 mb-4 border-4 border-gray-200"
                src="${profile.img}"
              />
              <h2 class="text-xl font-bold mb-4">${profile.name}</h2>
              <p class="text-sm leading-relaxed text-justify">${profile.desc}</p>
            </div>
          `;
        });
      }

      // Initial Render
      renderCards();
    </script>
  </body>
</html>
