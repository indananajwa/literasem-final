<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Timeline Wali Kota Semarang</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-inter">
    <!-- Menambahkan judul utama -->
    <div class="text-center mt-10 mb-8">
      <h2 class="text-3xl font-bold text-center text-red-800 mb-4">Pemerintahan Kota Semarang</h2>
      <div class="border-t-2 border-red-800 w-16 mx-auto my-4"></div>    </div>
    <div class="container mx-auto flex flex-col items-start md:flex-row my-12 md:my-24 space-y-8 md:space-y-0">
        <!-- Sisi kiri -->
        <div class="flex flex-col w-full sticky md:top-36 lg:w-2/5 mt-2 md:mt-12 px-8">
            <p class="text-3xl md:text-4xl leading-normal md:leading-relaxed mb-2">Daftar Wali Kota dan Wakil Wali Kota Semarang</p>
        </div>

        <!-- Sisi kanan timeline -->
        <div class="ml-12 sm:ml-24 md:ml-34 lg:w-3/5 relative">
            <div class="relative border-l-4 border-red-800" id="timeline">
                <!-- Elemen timeline akan diisi secara dinamis oleh JavaScript -->
            </div>
        </div>
    </div>

  


  <script>
    // Data Wali Kota dan Wakil Wali Kota

    const timelineData = [
      {
        periode: "1945 - 1949",
        namaWalikota: "Mr. Moch.lchsan",
        namaWakilWalikota: null,
        fotoWalikota: "pemerintah/MrMochlchsan.jpg",
        fotoWakilWalikota: null
      },
      {
        periode: "1949 - 1951",
        namaWalikota: "Mr. Koesoebiyono Tjondrowibowo",
        namaWakilWalikota: null,
        fotoWalikota: "pemerintah/MrKoesoebiyonoTjondrowibowo.jpg",
        fotoWakilWalikota: null
      },
      {
        periode: "1951 - 1958",
        namaWalikota: "RM. Hadisoebeno Sosrowerdoyo",
        namaWakilWalikota: null,
        fotoWalikota: "pemerintah/RMHadisoebenoSosrowerdoyo.jpg",
        fotoWakilWalikota: null
      },
      {
        periode: "1958 - 1960",
        namaWalikota: "Mr. Abdulmadjid Djojoadiningrat",
        namaWakilWalikota: null,
        fotoWalikota: "pemerintah/MrAbdulmadjidDjojoadiningrat.jpg",
        fotoWakilWalikota: null
      },
      {
        periode: "1961 - 1964",
        namaWalikota: "RM Soebagyono Tjondrokoesoemo",
        namaWakilWalikota: null,
        fotoWalikota: "pemerintah/RMSoebagyonoTjondrokoesoemo.jpg",
        fotoWakilWalikota: null
      },
      {
        periode: "1964 - 1966",
        namaWalikota: "Mr. Wuryanto",
        namaWakilWalikota: null,
        fotoWalikota: "pemerintah/MrWuryanto.jpg",
        fotoWakilWalikota: null
      },
      {
        periode: "1966 - 1967",
        namaWalikota: "Letkol. Soeparno",
        namaWakilWalikota: null,
        fotoWalikota: "pemerintah/LetkolSoeparno.jpg",
        fotoWakilWalikota: null
      },
      {
        periode: "1966 - 1967",
        namaWalikota: "Letkol. R.Warsito Soegiarto",
        namaWakilWalikota: null,
        fotoWalikota: "pemerintah/LetkolRWarsitoSoegiarto.jpg",
        fotoWakilWalikota: null
      },
      {
        periode: "1973 - 1980",
        namaWalikota: "Kolonel Hadijanto",
        namaWakilWalikota: null,
        fotoWalikota: "pemerintah/KolonelHadijanto.jpg",
        fotoWakilWalikota: null
      },
      {
        periode: "1980 - 1990",
        namaWalikota: "Kol. H. Iman Soeparto Tjakrajoeda SH",
        namaWakilWalikota: null,
        fotoWalikota: "pemerintah/KolHImanSoepartoTjakrajoedaSH.jpg",
        fotoWakilWalikota: null
      },
      {
        periode: "1990 - 2000",
        namaWalikota: "Kolonel H. Soetrisno Suharto",
        namaWakilWalikota: null,
        fotoWalikota: "pemerintah/KolonelHSoetrisnoSuharto.jpg",
        fotoWakilWalikota: null
      },
      {
        periode: "2000 - 2010",
        namaWalikota: "H. Sukawi Sutarip SH.",
        namaWakilWalikota: "Drs. Mahfudz Ali, M.Si.",
        fotoWalikota: "pemerintah/HSukawiSutaripSH.jpg",
        fotoWakilWalikota: "pemerintah/DrsMahfudzAliMSi.jpg"
      },
      {
        periode: "2010 - 2013",
        namaWalikota: "Drs. H. Soemarmo HS, MSi.",
        namaWakilWalikota: "Dr. Hendrar Prihadi, S. E., M.M.",
        fotoWalikota: "pemerintah/DrsHSoemarmoHSMSi.jpg",
        fotoWakilWalikota: "pemerintah/DrHendrarPrihadiSEMM.jpg"
      },
      {
        periode: "2013 - 2022",
        namaWalikota: "Dr. Hendrar Prihadi, S. E., M.M.",
        namaWakilWalikota: "Ir. Hj. Hevearita Gunaryanti Rahayu",
        fotoWalikota: "pemerintah/DrHendrarPrihadiSEMM.jpg",
        fotoWakilWalikota: "pemerintah/IrHjHevearitaGunaryantiRahayu.jpg"
      },
      {
        periode: "2023 - Sekarang",
        namaWalikota: "Ir. Hj. Hevearita Gunaryanti Rahayu",
        namaWakilWalikota: null,
        fotoWalikota: "pemerintah/IrHjHevearitaGunaryantiRahayu.jpg",
        fotoWakilWalikota: null
      }
    ];



    const createTimelineItem = (data) => {
  const hasWakil = data.namaWakilWalikota !== null;
  const isSpecialWalikota = data.namaWalikota === "Mr. Moch.lchsan"; // Kondisi untuk menambahkan link
  const tahunAwal = data.periode.split(" - ")[0]; // Ambil tahun awal dari periode

  return `
    <div class="mb-12 ml-10 max-w-lg">
      <!-- Tahun di atas titik timeline -->
      <div class="absolute -left-20 text-red-800 text-3xl font-bold">${tahunAwal}</div>
      <div class="absolute w-6 h-6 bg-red-800 rounded-full -left-3 border-4 border-white"></div>
      <div class="bg-white p-6 rounded-lg shadow-lg flex flex-col space-y-4">
      
      <!-- Periode Tahun -->
      <div class="text-black text-xl font-semibold">Periode Tahun ${data.periode}</div>

      <!-- Paket Wali Kota dan Wakil Wali Kota (Horizontal) -->
      <div class="flex items-center space-x-6">
        <!-- Gambar dan Nama Wali Kota -->
        <div class="flex flex-col items-center">
          <img src="${data.fotoWalikota}" alt="Foto Wali Kota" class="w-28 h-28 rounded-full object-cover">
          <div class="flex items-center space-x-2 mt-2"> <!-- Flex untuk nama dan link di samping -->
            <h2 class="text-lg font-bold text-center text-red-800">${data.namaWalikota}</h2>
            <!-- Jika Wali Kota adalah Mr. Moch.lchsan, tampilkan link di samping nama -->
            ${isSpecialWalikota ? `
              <a href="https://link-anda.com" class="text-blue-600 hover:underline text-sm">View Sertifikat</a>
            ` : ``}
          </div>
        </div>

        <!-- Jika ada Wakil Wali Kota -->
        ${hasWakil ? `
          <div class="flex flex-col items-center">
            <img src="${data.fotoWakilWalikota}" alt="Foto Wakil Wali Kota" class="w-28 h-28 rounded-full object-cover">
            <h3 class="text-lg font-bold text-center text-red-800 mt-2">${data.namaWakilWalikota}</h3>
          </div>
        ` : ``}
      </div>
    </div>
  </div>
  `;
};



    // Render data ke elemen timeline
    const timelineContainer = document.getElementById("timeline");
    timelineData.forEach(item => {
      timelineContainer.innerHTML += createTimelineItem(item);
    });
  </script>
</body>
</html>