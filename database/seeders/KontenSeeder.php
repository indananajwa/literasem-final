<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class KontenSeeder extends Seeder
{
    public function run(): void
    {
        // Contoh data untuk kategori BUD (Budaya)
        $budayaData = [
            [
                'judul' => 'Dugderan',
                'gambar' => 'budayaa/DUGDERAN .jpg',
                'video' => 'https://youtu.be/B4mLKcVIERs?si=M0_LI27XiNACFyqW',
                'deskripsi' => "Dugderan adalah festival tahunan di Semarang yang dimulai pada abad ke-19 untuk menyambut bulan Ramadan. Nama 'Dugderan' berasal dari suara drum..."
            ],
            [
                'judul' => 'Sesaji Rewanda',
                'gambar' => 'budayaa/SESAJI REWANDA.png',
                'video' => null,
                'deskripsi' => "Sesaji Rewanda adalah tradisi ritual syukur masyarakat Semarang, khususnya di Kampung Melayu..."
            ],
            [
                'judul' => 'Gebyuran',
                'gambar' => 'budayaa/GEBYURAN.jpg',
                'video' => null,
                'deskripsi' => "Gebyuran adalah tradisi unik di Semarang yang dilakukan pada Hari Raya Idul Fitri, di mana warga saling melemparkan air..."
            ],
            [
                'judul' => 'Semarang Night Carnival',
                'gambar' => 'budayaa/SEMARANG NIGHT CARNIVAL.jpg',
                'video' => 'https://youtu.be/fiufDc9AUWA?si=GWVIOAMEIf_8AwV6',
                'deskripsi' => "Semarang night carnival merupakan ajang karnaval pertama yang digelar malam hari..."
            ],
            [
                'judul' => 'Tari Gambang Semarangan',
                'gambar' => 'budayaa/TARI SEMARANGAN.jpg',
                'video' => null,
                'deskripsi' => "Tari Gambang Semarangan adalah seni tradisional Semarang yang memadukan budaya Tionghoa dan Jawa..."
            ],
        ];

        $arsitekturData = [
            [
                'judul' => 'Pasar Djohar',
                'gambar' => 'arsi/PasarDjohar1928.jpg',
                'video' => null,
                'deskripsi' => 'Pasar Johar adalah salah satu pasar tradisional di Kota Semarang yang pernah menjadi Pasar Terbesar se-Asia Tenggara. Karena lokasinya berdekatan dengan Penjara sehingga sering dijadikan tempat transit bagi orang yang sedang menjenguk kerabat di penjara. Nama Johar dipilih karena pada saat itu di sebelah timur Alun-alun Kota Semarang dan lokasinya dipagari pohon Johar di tepi jalan. Pasar Johar Kota Semarang dimulai tahun 1860 dan baru diresmikan kembali pada tahun 2022 setelah masa pemulihan karena sebelumnya mengalami kebakaran pada tahun 2015 dan baru di bangun kembali tahun 2017 dan selesai pada tahun 2021. Pasar Johar dirancang oleh insinyur Belanda, Ir. Thomas Kristen.'
            ],
            [
                'judul' => 'Lawang Sewu',
                'gambar' => 'arsi/LawangSewu40.jpg',
                'video' => null,
                'deskripsi' => 'Lawang Sewu, ikon wisata Semarang, dikenal karena arsitektur kolonialnya yang megah dan kisah sejarahnya yang kaya. Dibangun tahun 1904 sebagai kantor perusahaan kereta api NIS, nama "Lawang Sewu" merujuk pada banyaknya pintu dan jendela besar di bangunan ini. Selain menikmati keindahan arsitekturnya, pengunjung bisa belajar tentang sejarah transportasi kereta api Indonesia dan masa kelam saat bangunan ini menjadi penjara di era pendudukan Jepang. Lawang Sewu juga terkenal dengan cerita-cerita mistisnya, seperti ruang bawah tanah yang memikat pencinta wisata horor. Tempat ini kerap menjadi lokasi acara seni dan budaya, menjadikannya destinasi unik yang memadukan sejarah, seni, dan misteri.'
            ],
            [
                'judul' => 'Tangsi Militer',
                'gambar' => 'arsi/TangsiMiliter.jpg',
                'video' => null,
                'deskripsi' => 'Tangsi militer Belanda yang dibangun pada 1743 bernama De Werttenbergse Kazerne. Tempat ini menjadi markas bagi tentara bayaran dari berbagai daerah dan negara yang direkrut oleh penguasa Belanda, yang berawal dari pemberontakan orang Tionghoa di Batavia (Jakarta) pada 1740. Dalam peristiwa tersebut, banyak orang Tionghoa melarikan diri ke arah timur sepanjang jalur utara Pulau Jawa, sambil terus melawan tentara Belanda. Saat ini, lokasi ini telah menjadi Gedung Plaza Semarang.'
            ],
            [
                'judul' => 'Javasche Bank',
                'gambar' => 'arsi/JavascheBank.jpg',
                'video' => null,
                'deskripsi' => 'Javasche Bank, yang sekarang dikenal sebagai Bank Indonesia, merupakan kantor cabang pertama De Javasche Bank N.V di seluruh Hindia Belanda, yang dibuka pada 1 Maret 1829. Terletak di Jl. Letjen Suprapto, pembangunan gedung ini didasari oleh pertimbangan bahwa Kota Semarang, sebagai kota besar dengan pelabuhan utama di Jawa, memiliki potensi ekonomi dan perdagangan yang strategis. Setelah kemerdekaan Indonesia, pada 30 Juni 1958, DJB dinasionalisasi menjadi Bank Indonesia.'
            ],
            [
                'judul' => 'RSUP DR KARIYADI',
                'gambar' => 'arsi/RSUPKariadi.jpg',
                'video' => null,
                'deskripsi' => 'Pada 1919, dr. N.F. Liem mengusulkan untuk mengganti dan menggabungkan Rumah Sakit Kota di Tawang dengan Rumah Sakit Kota Pembantu di Alun-alun Semarang. Rencana ini diwujudkan dengan membangun rumah sakit yang lebih besar di Semarang. Pembangunannya dimulai pada 1920 dan selesai lima tahun kemudian. Pada 9 September 1925, lahirlah "Centrale Burgerlijke Ziekeninrichting" yang lebih dikenal dengan nama CBZ. Awalnya, rumah sakit ini fokus pada pelayanan medis berupa pengobatan kuratif dan pendidikan paramedis.'
            ],
            [
                'judul' => 'RSU ST. ELISABETH',
                'gambar' => 'arsi/RsuElisabeth.jpg',
                'video' => null,
                'deskripsi' => 'Pada tanggal 3 September 1923 dana tersebut digunakan untuk membeli sebidang tanah bekas kuburan Tionghoa seluas 34.000 m2 di daerah perbukitan candi baru, dengan pemandangan yang sangat indah, suatu kawasan yang tenang. Pembangunan dilaksanakan oleh 3 kontraktor yaitu Ir.Karsten, Ir.Zoetmulder, Ir.Peters dan Ir. Keliverda dan selesai pada tanggal 8 Agustus 1927. Pada masa pendudukan Jepang, RS St. Elisabeth diambil alih dan dijadikan kantor militer.'
            ],
            [
                'judul' => 'Gedung Balai Kota Semarang',
                'gambar' => null, //gambargaada
                'video' => null,
                'deskripsi' => 'Gedung Balai Kota Semarang, yang awalnya merupakan villa milik keluarga Gimberg, terletak di Jalan Pemuda No. 148. Gedung ini digunakan sebagai kantor utama Stadsgemeente (Kotapraja) Semarang, tempat Burgemeester (Walikota) Semarang berkantor. Pada 1960-an, gedung ini beralih fungsi menjadi Dinas Pekerjaan Umum (DPU) Kotamadya Semarang, dengan renovasi penambahan dinding berjendela di bagian depan. Kemudian, pada 1980-an, dilakukan perombakan besar dengan menutup pilar-pilar dan menambahkan kanopi bergaya Romawi kuno di bagian depan gedung.'
            ],
            [
                'judul' => 'Gedung Pertamina',
                'gambar' => 'arsi/GedungPertamina1938.jpg',
                'video' => null,
                'deskripsi' => 'Gedung Pertamina, yang sebelumnya dikenal sebagai Gedung BP Migas, adalah salah satu bangunan bersejarah yang terletak di Jalan Pemuda 114, Semarang. Bangunan ini masih terjaga keasliannya dengan baik. Meskipun di sisi kirinya telah dibangun Mall Paragon dan Hotel Crowne Plaza, sebagai bangunan tua, keberadaannya masih terlihat serasi berdampingan dengan bangunan-bangunan modern di sekitarnya.'
            ],
            [
                'judul' => 'Pasar Pedamaran Semarang',
                'gambar' => null, //gambargaada
                'video' => null,
                'deskripsi' => 'Pasar Pedamaran Semarang Pasar Pedamaran Johar Semarang, Pada foto tahun 1910. Situasi Pasar Pedamaran ini sebelum dibagunnya Pasar Johar pada tahun 1931. Pasar ini memiliki 240 buah dasarn sehingga pemerintah pada saat itu meminta Ir. Herman Thomas Karsten mendirikan pasar gede Semarang yang menggabungkan Pasar Pedamaran, Johar, Beteng, Jurnatan dan Pekojan.'
            ],
            [
                'judul' => 'Gedung Papak',
                'gambar' => 'arsi/GedungPapak.jpg',
                'video' => null,
                'deskripsi' => 'Gedung Papak, yang dibangun pada 1919 dengan arsitektur kolonial Belanda, awalnya berfungsi sebagai markas tentara Belanda dan tempat penyiksaan bagi pribumi yang melawan. Dengan desain kokoh dan sederhana, gedung ini akhirnya dikuasai oleh tentara Jepang.'
            ],
            [
                'judul' => 'Penjara Bulu',
                'gambar' => null,
                'video' => null,
                'deskripsi' => 'Penjara bulu adalah tempat terjadinya pembantaian Penjara Bulu pada Perang Dunia II. Saat itu Dr. Kariadi sebagai kepala laboratorium Rumah Sakit Purusara (Sekarang Rumah Sakit Kariadi) dipanggil untuk membuktikan kebenaran adanya racun pada tandon air Siranda, Candi Baru. Namun, Dr. Kariadi dan sopirnya ditembak oleh Jepang saat melewati Jl. Pandanaran. Hal ini memicu perlawanan dari warga Semarang untuk menyerang tahanan-tahanan jepang yang berada di penjara bulu.'
            ],
            [
                'judul' => 'Gedung Chinese English School Bodjong 1930',
                'gambar' => 'arsi/GedungChineseBodjong.jpg',
                'video' => null,
                'deskripsi' => 'Chinese English School "Hwa Ing" terletak di Bodjong Straat, yang kini dikenal sebagai Jalan Pemuda Semarang. Thio menjabat sebagai ketua sekolah ini pada tahun 1928. Saat ini, gedung tersebut digunakan sebagai SMA Negeri 5 Semarang.'
            ],
            [
                'judul' => 'Gedung Gris',
                'gambar' => 'arsi/GedungGRIS1925.jpg',
                'video' => null,
                'deskripsi' => 'GRIS, yang dulunya merupakan sebuah Sositet de Harmonie milik seorang Belanda, dibeli oleh masyarakat pribumi dengan membentuk panitia Fonds GRIS. Di masa keemasannya, GRIS selalu ramai dikunjungi masyarakat untuk menyaksikan pertunjukan Wayang Orang Ngesti Pandowo. Selain digunakan untuk menimba ilmu tentang kesenian serta hiburan murah, GRIS juga digunakan untuk acara resepsi, perpustakaan rakyat, gedung bioskop, kampus sebuah akademi bahasa, dan sebagainya (Gedung GRIS sekarang menjadi Paragon Mall).'
            ],
            [
                'judul' => 'Gedung Mega Eltra',
                'gambar' => 'arsi/GedungMegaEltra.jpg',
                'video' => null,
                'deskripsi' => 'Gedung Mega Eltra, dibangun sekitar tahun 1897. Penghuni gedung ini dulunya NV. Lindeteves yang menyediakan kelistrikan di wilayah pelabuhan Semarang. Pada masa pendudukan Jepang, gedung ini dikenal dengan nama Semarang Kikei Sesaku Syo. Mega Eltra sendiri adalah perusahaan yang bermula dari perusahaan Belanda yang kegiatan usaha di bidang listrik, mesin dan peralatan tehnik yang telah eksis sejak tahun 1930, dikenal dengan nama Electro Import NV. Perusahaan ini merupakan anak perusahaan Jacobson Vanden Berg & Co, sebuah perusahaan Belanda yang pada zamannya dikenal dalam kelompok perusahaan “The Big Five”.'
            ]
        ];

        $ibadahData = [
            [
                'judul' => 'Gereja Blenduk',
                'gambar' => 'ibadah/gereja_blenduk.jpg',
                'video' => null,
                'deskripsi' => "Gereja Blenduk, atau GPIB Immanuel, awalnya dibangun pada 1742 sebagai rumah panggung Jawa. Renovasi besar pada 1787-1794 mengubahnya menjadi gereja bergaya Eropa dengan elemen Barok dan Renaisans. Pada 1894-1895, H.P.A. De Wilde dan W. Westmaas melakukan renovasi kedua, menghasilkan bentuk Pseudo Barok yang dikenal saat ini, mencerminkan arsitektur klasik abad ke-17 hingga ke-19. Sejarah renovasinya terukir di batu marmer di bawah altar."
            ],
            [
                'judul' => 'Gereja Katedral Randusari',
                'gambar' => 'ibadah/gereja_katedral_randusari.jpg',
                'video' => null,
                'deskripsi' => "Pada 26 Januari 1927, dibelilah sebuah tanah dan bangunan di daerah Randusari, tepatnya di kaki Gunung Brintik. Bangunan yang awalnya digunakan sebagai gedung kesehatan 'Dienst voor Volkgezondheid' itu akan digunakan sebagai tempat ibadah yang baru. Setelah direnovasi pada tanggal 9 Oktober 1927, gedung gereja ini diberkati oleh Mgr. Antonius van Velsen, vicaris apostolic Batavia. Kemudian menjadi sebuah gereja paroki pada tahun 1930 dan menjadi katedral pada tahun 1937 ketika Albertus Soegijapranata diangkat sebagai vikaris apostolik pertama di Semarang. Gedung Gereja diarsiteki oleh T.H. van Oyen dan anemer Kleiverde."
            ],
            [
                'judul' => 'Sampokong',
                'gambar' => 'ibadah/sampokong.jpg',
                'video' => null,
                'deskripsi' => "Klenteng Sam Poo Kong dibangun berdasarkan sejarah kedatangan Laksamana Zheng He (Cheng Ho), atau Sam Po Tay Djien, di Semarang pada abad ke-15. Nama Sam Poo Kong berasal dari 'San Bao Dong,' yang berarti 'Gua Tiga Harta,' mengacu pada gua tempat Cheng Ho bermeditasi."
            ],
            [
                'judul' => 'Masjid Kauman',
                'gambar' => 'ibadah/masjid_kauman.jpg',
                'video' => null,
                'deskripsi' => "Masjid Kauman berdiri pada 13 November 1890. Masjid ini didesain oleh arsitek dari Belanda bernama Ir. G. A. Gambier. Atap masjid Kauman ini terbuat dari seng yang ada sejak masa pemerintahan Hindia Belanda. Masjid Kauman memiliki keunikan arsitektur dengan atap bertingkat tiga khas Jawa, yang mengandung makna filosofis mendalam."
            ],
            [
                'judul' => 'Pagoda Avalokitesvara',
                'gambar' => 'ibadah/pagoda_avalokitesvara.jpg',
                'video' => null,
                'deskripsi' => "Pagoda Avalokitesvara, atau Pagoda Metta Karuna, terletak di Vihara Buddhagaya Watugong, Semarang, Jawa Tengah, dan didedikasikan untuk Dewi Kwan Im (Avalokitesvara), simbol cinta kasih dan welas asih. Dibangun pada 2005, pagoda ini merupakan salah satu yang tertinggi di Indonesia, dengan ketinggian sekitar 45 meter dan tujuh tingkat. Desainnya bergaya Tiongkok, dengan atap bertingkat, ornamen naga, dan patung Dewi Kwan Im di dalamnya."
            ]
        ];

        $tokohData = [
            [
                'judul' => 'Jenderal Ahmad Yani',
                'gambar' => 'tokohM/AhmadYani.jpeg',
                'video' => null,
                'deskripsi' => "Jenderal TNI Anumerta Ahmad Yani lahir di Purworejo, Jawa Tengah, pada 19 Juni 1922. Ia wafat pada usia 43 tahun dalam tragedi Lubang Buaya, Jakarta, pada 1 Oktober 1965. Ahmad Yani, seorang komandan Tentara Nasional Indonesia Angkatan Darat, gugur dalam peristiwa yang dikenal sebagai tragedi genosida atau pembantaian massal. Menurut catatan sejarah, ia dibunuh oleh anggota Gerakan 30 September."
            ],
            [
                'judul' => 'K.R.M.T Wongsonegoro',
                'gambar' => 'tokohM/K.R.M.T WONGSONEGORO.png',
                'video' => null,
                'deskripsi' => "Mr. Wongsonegoro (20 April 1897 - 4 Maret 1978) pernah menjabat sebagai Wakil Perdana Menteri Indonesia dalam Kabinet Ali Sastroamidjojo I pada 1953-1955 dan Menteri Pendidikan dan Kebudayaan pada 1951-1952. Sebelum kemerdekaan, ia menjadi anggota BPUPKI sebagai perwakilan Surakarta bersama Wuryaningrat, Sosrodiningrat, dan Radjiman Wedyodiningrat. Untuk menghormatinya, nama K.R.M.T Wongsonegoro kini digunakan sebagai nama Rumah Sakit Umum Daerah di Kota Semarang."
            ],
            [
                'judul' => 'Dr. Tjipto Mangoenkoesoemo',
                'gambar' => 'tokohM/TJIPTO MANGOENKOESOEMO.jpeg',
                'video' => null,
                'deskripsi' => 'Dr. Tjipto Mangoenkoesoemo adalah tokoh pergerakan kemerdekaan Indonesia yang terkenal sebagai bagian dari "Tiga Serangkai" bersama Ernest Douwes Dekker dan Ki Hajar Dewantara. Sebagai tokoh terkemuka di Indische Partij, Tjipto kerap mengkritik pemerintahan kolonial Hindia-Belanda melalui tulisan-tulisannya yang dianggap radikal. Akibat aktivitasnya, ia diasingkan oleh pemerintah kolonial Belanda dan pada tahun 1927 dibuang ke Banda.'
            ],
            [
                'judul' => 'Dr. Kariadi',
                'gambar' => 'tokohM/DrKariadi.png',
                'video' => null,
                'deskripsi' => 'Dr. Kariadi adalah salah satu pahlawan yang turut berjuang dalam pertempuran lima hari di Semarang, yang terjadi antara rakyat Indonesia dan tentara Jepang pada Oktober 1945. Sebagai kepala laboratorium, ia gugur di usia 40 tahun saat hendak memeriksa kebenaran kabar tentang racun di reservoir Siranda. Dalam perjalanan tersebut, Dr. Kariadi ditembak hingga meninggal dunia.'
            ],
            [
                'judul' => 'Soemantri Brodjonegoro',
                'gambar' => 'tokohM/SOEMANTRI BRODJONEGORO.jpeg',
                'video' => null,
                'deskripsi' => 'Soemantri, yang lahir di Semarang, Jawa Tengah, pada 3 Juni 1926, meninggal dunia di Jakarta pada 18 Desember 1973 di usia 47 tahun. Ia pernah menjabat sebagai Menteri Energi dan Sumber Daya Mineral Republik Indonesia dari 1967 hingga 1973. Pada tahun 1973, ia juga menjabat sebagai Menteri Pendidikan dan Kebudayaan. Sumantri wafat saat masih menjabat sebagai Menteri Pendidikan dan Kebudayaan, dan posisinya kemudian digantikan oleh Syarief Thayeb.'
            ],
            [
                'judul' => 'MGR. Soegijapranata',
                'gambar' => 'tokohM/mgr soegijapranata.jpeg',
                'video' => null,
                'deskripsi' => 'Mgr. Albertus Soegijapranata, SJ, adalah seorang Vikaris Apostolik Semarang yang kemudian diangkat menjadi uskup agung. Ia dikenal sebagai uskup pribumi pertama dengan semangat nasionalisme yang kuat. Meski menempuh pendidikan di lingkungan Belanda, ia tidak terpengaruh oleh pemikiran kolonial. Sebaliknya, ia mengajarkan agama dengan pendekatan yang selaras dengan nilai-nilai keindonesiaan.'
            ],
            [
                'judul' => 'M. Mutahar',
                'gambar' => 'tokohM/M. Mutahar.png',
                'video' => null,
                'deskripsi' => 'Nama M. Husein Mutahar diabadikan sebagai nama jalan di Lampung. Lahir di Semarang, Jawa Tengah, pada 5 Agustus 1916, ia wafat di Jakarta pada 9 Juni 2004 di usia 87 tahun. Ia berjasa dalam mengembangkan lagu nasional dan lagu anak-anak. Beberapa karyanya yang terkenal adalah "Syukur," mars "Hari Merdeka," dan hymne "Pramuka."'
            ],
            [
                'judul' => 'Ainun Habibie',
                'gambar' => 'tokohM/Ainunhabibie.jpeg',
                'video' => null,
                'deskripsi' => 'Hasri Ainun Besari, lahir di Semarang, Jawa Tengah, pada 11 Agustus 1937, dan wafat di München, Jerman, pada 22 Mei 2010. Ia pernah menjabat sebagai Ibu Negara Indonesia ketiga dari 1998 hingga 1999. Untuk menghormati jasanya, namanya diabadikan sebagai nama Klinik Mata Dr. Hasrie Ainun Habibie di Bogor.'
            ],
            [
                'judul' => 'Raden Saleh',
                'gambar' => 'tokohM/Raden saleh.jpeg',
                'video' => null,
                'deskripsi' => 'Raden Saleh Sjarif Boestaman, seorang pelukis berdarah campuran Arab-Jawa, lahir di Semarang pada 23 April 1880. Ia dikenal sebagai pelopor seni lukis modern di Indonesia (saat itu Hindia Belanda). Karya-karyanya menggabungkan gaya Romantisisme Eropa dengan nuansa budaya Jawa yang khas.'
            ],
            [
                'judul' => 'Zheng He/Cheng Ho',
                'gambar' => 'tokohM/Zheng gue_ cheng ho.jpeg',
                'video' => null,
                'deskripsi' => 'Laksamana Muslim asal Tiongkok, Zheng He atau Cheng Ho, pernah singgah dan mendarat di tempat yang kini dikenal sebagai Sam Poo Kong, yang terletak di daerah Simongan, barat daya Kota Semarang. Jejak keislamannya dapat dilihat dari sebuah tulisan yang berbunyi, "Marilah kita mengheningkan cipta dengan mendengarkan bacaan Al-Quran.'
            ],
        ];
    
        $makananData = [
            [
                'judul' => 'Lumpia',
                'gambar' => 'makanan/lumpia.jpg',
                'video' => null,
                'deskripsi' => 'Lumpia merupakan kuliner khas Kota Semarang yang mencerminkan akulturasi budaya Jawa dan Tionghoa. Nama "lumpia" berasal dari gabungan kata "lun" (Bahasa Jawa, berarti gulung) dan "pia" (Bahasa Hokkien, berarti kue). Pada 2014, lumpia Semarang resmi diakui sebagai Warisan Budaya Tak Benda Indonesia. Sejarahnya bermula dari pasangan suami istri etnis Tionghoa dan Jawa yang menikah pada abad ke-19, yang kemudian menginspirasi berdirinya berbagai kedai lumpia di Kota Semarang.'
            ],
            [
                'judul' => 'Wingko Babat',
                'gambar' => 'makanan/wingkobabat.jpg',
                'video' => null,
                'deskripsi' => 'Sejarah Wingko Babat bermula dari kota Babat, Lamongan, Jawa Timur, tempat kudapan ini dikenal sebagai kue wingko oleh masyarakat setempat. Pada masa Perang Dunia II, sekitar tahun 1944, sebuah keluarga etnis Tionghoa pindah dari Babat ke Semarang. Pasangan suami istri bernama The Ek Tjong (D. Mulyono) dan Loe Lan Hwa membawa resep wingko babat sebagai warisan keluarga. Mereka melihat peluang bisnis karena kue wingko belum dikenal di Semarang.'
            ],
            [
                'judul' => 'Mie Kopyok',
                'gambar' => 'makanan/miekopyok.jpg',
                'video' => null,
                'deskripsi' => 'Mi kopyok adalah salah satu makanan legendaris khas Kota Semarang. Hidangan ini juga dikenal sebagai mi lontong, karena disajikan bersama lontong, atau mi teng-teng, merujuk pada suara "teng-teng-teng" yang dihasilkan saat penjual memukul piring untuk menarik perhatian pembeli. Nama "kopyok" sendiri berasal dari bahasa Jawa yang berarti diaduk, sesuai dengan cara terbaik menikmatinya, yaitu dengan mengaduk semua bahan di dalamnya.'
            ],
            [
                'judul' => 'Ganjel Rel',
                'gambar' => 'makanan/miekopyok.jpg',
                'video' => null,
                'deskripsi' => 'Roti ganjel rel adalah warisan kuliner dari masa kolonial Belanda yang terinspirasi oleh roti tradisional Belanda bernama ontbijtkoek. Awalnya, roti ini dikenal dengan nama asli roti gambang, namun masyarakat Semarang lebih akrab menyebutnya "ganjel rel" karena bentuknya menyerupai bantalan rel kereta api.'
            ],
            [
                'judul' => 'Wedhang Tahu',
                'gambar' => 'makanan/wedangtahu.jpg',
                'video' => null,
                'deskripsi' => 'Wedang tahu berasal dari Tiongkok dan dibawa ke Indonesia oleh seorang imigran pada akhir abad ke-19. Nama "Wedang Tahu" berasal dari bahan utamanya, yakni sari kedelai yang dibuat menyerupai tahu sutra, dicampur dengan kuah jahe hangat yang manis dan harum. Minuman ini dulunya dijajakan oleh pedagang keliling, terutama di pagi hari, karena dipercaya dapat memberikan kehangatan dan energi.'
            ],
            [
                'judul' => 'Tahu Gimbal',
                'gambar' => 'makanan/tahugimbal.jpg',
                'video' => null,
                'deskripsi' => 'Tahu Gimbal adalah salah satu makanan khas Semarang yang sudah ada sejak era kolonial. Hidangan ini terdiri dari tahu goreng, lontong, kol, tauge, dan gimbal udang (bakwan udang), disajikan dengan siraman bumbu kacang manis pedas yang khas. Awalnya dijual oleh pedagang keliling di kawasan pelabuhan dan Pecinan, Tahu Gimbal dikenal karena rasanya yang lezat dan harganya yang terjangkau. Kini, hidangan ini telah menjadi ikon kuliner Kota Semarang.'
            ],
            [
                'judul' => 'Tahu Petis',
                'gambar' => 'makanan/tahupetis.jpg',
                'video' => null,
                'deskripsi' => 'Asal-usul tahu petis di Semarang masih belum jelas, namun diperkirakan muncul pada akhir abad ke-19 atau awal abad ke-20, saat Kota Semarang sedang mengalami masa kejayaan sebagai pusat perdagangan dan pelabuhan penting di Jawa. Migrasi penduduk dari berbagai daerah, termasuk Tionghoa yang membawa tradisi kulinernya, turut mempengaruhi perkembangan kuliner Semarang. Tahu, bahan dasar tahu petis, sudah dikenal luas di Indonesia sejak lama, sementara petis, saus fermentasi udang khas Jawa Timur, kemungkinan masuk ke Semarang melalui jalur perdagangan. Perpaduan kedua bahan ini menciptakan tahu petis, camilan khas yang kemudian menjadi favorit di Semarang.'
            ],
            [
                'judul' => 'Tahu Pong',
                'gambar' => 'makanan/tahupong.jpg',
                'video' => null,
                'deskripsi' => 'Tahu pong adalah jenis tahu yang kosong di bagian dalam. Kata "kopong" dalam bahasa Jawa berarti kosong atau tanpa isi, sehingga dikenal sebagai tahu pong atau tahu kopong. Ada juga yang mengaitkan asal-usul namanya dengan kata "péng" dalam dialek Hokkian, yang diucapkan "phong", yang berarti menggelembung. Tahu pong memiliki tekstur yang berbeda dari tahu biasa. Ketika digoreng, tahu pong akan menggembung, dengan bagian dalam yang berongga, sementara kulitnya tipis dan kering.'
            ]
        ];

        $this->insertKonten('BUD', $budayaData);
        $this->insertKonten('ARS', $arsitekturData);
        $this->insertKonten('TEM', $ibadahData);
        $this->insertKonten('TOK', $tokohData);
        $this->insertKonten('MAK', $makananData);
    }

    /**
     * Fungsi reusable untuk memasukkan data konten berdasarkan kategori
     */
    private function insertKonten(string $kodeKategori, array $kontenList): void
    {
        $i = 1;

        foreach ($kontenList as $item) {
            $kodeKonten = $kodeKategori . str_pad($i++, 3, '0', STR_PAD_LEFT);

            $gambarPath = public_path($item['gambar']);
            $gambar = null;
            $mime = null;

            if (!is_null($item['gambar']) && File::exists($gambarPath)) {
                $gambar = File::get($gambarPath);
                $ext = strtolower(pathinfo($gambarPath, PATHINFO_EXTENSION));
                $mime = match ($ext) {
                    'jpg', 'jpeg' => 'image/jpeg',
                    'png' => 'image/png',
                    'gif' => 'image/gif',
                    default => null
                };
            }

            DB::table('konten')->insert([
                'kode_konten' => $kodeKonten,
                'kode_kategori' => $kodeKategori,
                'judul' => $item['judul'],
                'deskripsi' => $item['deskripsi'],
                'video_url' => $item['video'],
                'gambar' => $gambar,
                'mime_type' => $mime
            ]);
        }
    }
}
