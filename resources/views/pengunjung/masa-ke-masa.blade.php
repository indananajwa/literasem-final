<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semarang dari Masa ke Masa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <style>
        .font-roboto {
            font-family: 'Roboto', sans-serif;
        }
        .masa-ke-masa-section {
            position: relative;
            background: linear-gradient(135deg, #0f172a 0%, #7f1d1d 30%, #0f172a 60%, #7f1d1d 100%);
            background-size: 400% 400%;
            animation: gradientFlow 20s ease infinite;
            font-family: 'Roboto', sans-serif;
        }
        @keyframes gradientFlow {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        .floating-shapes {
            position: absolute;
            inset: 0;
            overflow: hidden;
        }
        .shape {
            position: absolute;
            background: linear-gradient(45deg, rgba(239, 68, 68, 0.1), rgba(248, 113, 113, 0.05));
            border-radius: 50%;
            animation: float 15s ease-in-out infinite;
        }
        .shape-1 {
            width: 200px;
            height: 200px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }
        .shape-2 {
            width: 150px;
            height: 150px;
            top: 60%;
            right: 15%;
            animation-delay: 5s;
        }
        .shape-3 {
            width: 100px;
            height: 100px;
            bottom: 20%;
            left: 60%;
            animation-delay: 10s;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        .timeline-container {
            position: relative;
            max-width: 100%;
            margin: 0 auto;
            padding: 0 4px;
        }
        .timeline-slider-wrapper {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        .timeline-slider-wrapper::-webkit-scrollbar {
            display: none;
        }
        .timeline-slider {
            position: relative;
            z-index: 2;
            display: flex;
            flex-wrap: nowrap;
            min-width: max-content;
            padding: 10px 0;
        }
        .timeline-item {
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 3;
            flex: 0 0 auto;
            width: 120px;
            text-align: center;
            padding: 0 10px;
        }
        .timeline-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #374151;
            border: 2px solid #6b7280;
            margin: 0 auto 10px;
            transition: all 0.3s ease;
            position: relative;
            z-index: 4;
        }
        .timeline-item.active .timeline-dot,
        .timeline-item:hover .timeline-dot {
            background: #ef4444;
            border-color: #fca5a5;
            transform: scale(1.2);
            box-shadow: 0 0 15px rgba(239, 68, 68, 0.5);
        }
        .timeline-content {
            text-align: center;
            opacity: 0.7;
            transition: all 0.3s ease;
        }
        .timeline-item.active .timeline-content,
        .timeline-item:hover .timeline-content {
            opacity: 1;
            transform: translateY(-3px);
        }
        .timeline-content .year {
            display: block;
            font-size: 1rem;
            font-weight: 700;
            color: #fca5a5;
        }
        .timeline-content .location {
            display: block;
            font-size: 0.65rem;
            color: #d1d5db;
            font-weight: 400;
        }
        .timeline-line-wrapper {
            position: absolute;
            top: 0;
            left: 10%;
            right: 10%;
            height: 100%;
            z-index: 1;
            pointer-events: none;
        }
        .timeline-line {
            position: absolute;
            top: 16px;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(to right, transparent, #ef4444, transparent);
            z-index: 1;
        }
        .location-display {
            display: none;
            animation: fadeInUp 0.8s ease forwards;
        }
        .location-display.active {
            display: block;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .story-text p {
            margin-bottom: 1rem;
            font-size: 0.95rem;
            line-height: 1.6;
        }
        .story-text strong {
            color: #fca5a5;
            font-weight: 700;
        }
        .image-container {
            height: 300px;
        }
        @media (min-width: 768px) {
            .timeline-slider {
                flex-wrap: wrap;
                justify-content: center;
                padding: 20px 0;
            }
            .timeline-item {
                width: auto;
                min-width: 100px;
                padding: 0 15px;
            }
            .timeline-dot {
                width: 15px;
                height: 15px;
            }
            .timeline-content .year {
                font-size: 1.25rem;
            }
            .timeline-content .location {
                font-size: 0.75rem;
            }
            .image-container {
                height: 400px;
            }
            .timeline-line-wrapper {
                left: 5%;
                right: 5%;
            }
            .timeline-line {
                top: 22px;
            }
        }
        @media (max-width: 767px) {
            .masa-ke-masa-section {
                padding: 2rem 1rem;
            }
            .text-4xl {
                font-size: 2rem;
            }
            .text-5xl {
                font-size: 2.5rem;
            }
            .text-xl {
                font-size: 0.9rem;
            }
            .w-32 {
                width: 5rem;
            }
            .w-24 {
                width: 3.5rem;
            }
            .comparison-container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            .story-title {
                font-size: 1.75rem;
            }
            .timeline-item {
                margin: 0 5px;
            }
            .image-container {
                height: 250px;
            }
            .timeline-line-wrapper {
                left: 10px;
                right: 10px;
            }
            .timeline-line {
                top: 14px;
            }
        }
    </style>
</head>
<body>
    <section class="masa-ke-masa-section relative bg-gradient-to-br from-slate-900 via-red-900 to-slate-900 rounded-xl shadow-2xl overflow-hidden py-12 px-6 min-h-screen transition-all duration-700">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.03\"%3E%3Ccircle cx=\"30\" cy=\"30\" r=\"2\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] animate-pulse"></div>
            <div class="floating-shapes">
                <div class="shape shape-1"></div>
                <div class="shape shape-2"></div>
                <div class="shape shape-3"></div>
            </div>
        </div>
        <div class="relative z-10 container mx-auto px-4">
            <div class="text-center mb-12">
                <h1 class="text-4xl md:text-5xl font-roboto font-bold text-white mb-4 tracking-tight">
                    Semarang dari Masa ke Masa
                </h1>
                <div class="w-24 h-1 bg-gradient-to-r from-transparent via-red-500 to-transparent mx-auto mb-6"></div>
                <p class="text-lg text-gray-300 max-w-2xl mx-auto leading-relaxed font-roboto font-normal">
                    Jelajahi sejarah dan transformasi Kota Semarang dari masa lalu, masa kini, hingga masa depan.
                </p>
                <div class="mt-6 flex justify-center space-x-4">
                    <button id="btnPastPresent" class="bg-red-800 text-white px-6 py-3 rounded-lg font-roboto font-medium hover:bg-red-700 transition-all duration-300" onclick="showSection('past-present')">
                        Semarang Dulu dan Kini
                    </button>
                    <button id="btnFuture" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-roboto font-medium hover:bg-gray-300 transition-all duration-300" onclick="showSection('future')">
                        Semarang Masa Depan
                    </button>
                </div>
            </div>
            <div id="past-present-section" class="mb-12">
                <div class="text-center mb-12">
                    <div class="inline-block">
                        <h2 class="text-4xl md:text-5xl font-roboto font-bold text-white mb-6 tracking-tight">
                            Semarang Masa Lampau dan Kini
                        </h2>
                        <div class="w-32 h-1 bg-gradient-to-r from-transparent via-red-500 to-transparent mx-auto mb-8"></div>
                    </div>
                    <p class="text-lg md:text-xl text-gray-300 max-w-3xl mx-auto leading-relaxed font-roboto font-normal">
                        Jelajahi perjalanan Kota Semarang dari masa ke masa 
                        <span class="text-red-400 font-medium">Dari masa kolonial hingga era modern</span>, 
                        setiap sudut kota menceritakan kisah transformasi yang menakjubkan.
                    </p>
                </div>
                <div class="mb-12">
                    <div class="timeline-container relative max-w-3xl mx-auto px-4">
                        <div class="timeline-line-wrapper">
                            <div class="timeline-line" id="timeline-line"></div>
                        </div>
                        <div class="timeline-slider-wrapper">
                            <div id="timeline-slider" class="timeline-slider"></div>
                        </div>
                    </div>
                </div>
                <div id="comparison-display" class="max-w-7xl mx-auto"></div>
            </div>
            <div id="future-section" class="hidden mb-20">
                <div class="text-center mb-12">
                    <h2 class="text-4xl md:text-5xl font-roboto font-bold text-white mb-4 tracking-tight">
                        Semarang Masa Depan
                    </h2>
                    <div class="w-24 h-1 bg-gradient-to-r from-transparent via-red-500 to-transparent mx-auto mb-6"></div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg group">
                        <div class="relative aspect-video">
                            <img src="https://i3.ytimg.com/vi/B4mLKcVIERs/maxresdefault.jpg" alt="Transportasi Modern" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                            <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <button class="p-3 bg-blue-500 rounded-full text-white" onclick="playVideo('B4mLKcVIERs')">
                                    <i class="fas fa-play"></i>
                                </button>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-roboto font-bold text-gray-800 mb-2">Transportasi Modern</h3>
                            <p class="text-gray-600 text-sm font-roboto font-normal">Sistem MRT dan LRT terintegrasi yang akan menghubungkan seluruh wilayah Semarang.</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg group">
                        <div class="relative aspect-video">
                            <img src="https://i3.ytimg.com/vi/c48g-XFcLcU/maxresdefault.jpg" alt="Smart City" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                            <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <button class="p-3 bg-blue-500 rounded-full text-white" onclick="playVideo('c48g-XFcLcU')">
                                    <i class="fas fa-play"></i>
                                </button>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-roboto font-bold text-gray-800 mb-2">Smart City Infrastructure</h3>
                            <p class="text-gray-600 text-sm font-roboto font-normal">Implementasi teknologi pintar untuk sistem manajemen kota yang lebih efisien.</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg group">
                        <div class="relative aspect-video">
                            <img src="https://i3.ytimg.com/vi/RYMQOcxeg6U/maxresdefault.jpg" alt="Green Building" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                            <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <button class="p-3 bg-blue-500 rounded-full text-white" onclick="playVideo('RYMQOcxeg6U')">
                                    <i class="fas fa-play"></i>
                                </button>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-roboto font-bold text-gray-800 mb-2">Green Building Development</h3>
                            <p class="text-gray-600 text-sm font-roboto font-normal">Pembangunan gedung ramah lingkungan dengan teknologi hemat energi.</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg group">
                        <div class="relative aspect-video">
                            <img src="https://i3.ytimg.com/vi/c48g-XFcLcU/maxresdefault.jpg" alt="Digital Tourism" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                            <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <button class="p-3 bg-blue-500 rounded-full text-white" onclick="playVideo('c48g-XFcLcU')">
                                    <i class="fas fa-play"></i>
                                </button>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-roboto font-bold text-gray-800 mb-2">Digital Tourism</h3>
                            <p class="text-gray-600 text-sm font-roboto font-normal">Pengembangan wisata digital dengan teknologi AR/VR untuk eksplorasi sejarah kota.</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg group">
                        <div class="relative aspect-video">
                            <img src="https://i3.ytimg.com/vi/B4mLKcVIERs/maxresdefault.jpg" alt="Waterfront City" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                            <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <button class="p-3 bg-blue-500 rounded-full text-white" onclick="playVideo('B4mLKcVIERs')">
                                    <i class="fas fa-play"></i>
                                </button>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-roboto font-bold text-gray-800 mb-2">Waterfront City</h3>
                            <p class="text-gray-600 text-sm font-roboto font-normal">Pengembangan kawasan pesisir dengan konsep modern dan berkelanjutan.</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg group">
                        <div class="relative aspect-video">
                            <img src="https://i3.ytimg.com/vi/RYMQOcxeg6U/maxresdefault.jpg" alt="Cultural Preservation" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                            <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <button class="p-3 bg-blue-500 rounded-full text-white" onclick="playVideo('RYMQOcxeg6U')">
                                    <i class="fas fa-play"></i>
                                </button>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-roboto font-bold text-gray-800 mb-2">Cultural Preservation</h3>
                            <p class="text-gray-600 text-sm font-roboto font-normal">Pelestarian budaya dengan teknologi modern untuk generasi mendatang.</p>
                        </div>
                    </div>
                </div>
                <div id="videoModal" class="fixed inset-0 bg-black bg-opacity-75 hidden items-center justify-center z-50">
                    <div class="relative w-full max-w-4xl mx-4">
                        <button class="absolute -top-10 right-0 text-white text-xl" onclick="closeVideo()">
                            <i class="fas fa-times"></i>
                        </button>
                        <div class="aspect-video bg-black">
                            <iframe id="videoFrame" class="w-full h-full" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        const locations = [
            {
                id: "tugu-muda",
                year: "1953",
                location: "Tugu Muda",
                beforeImage: "{{ asset('smg-masa-lalu-sekarang/tugu-muda-1953.jpg') }}",
                afterImage: "{{ asset('smg-masa-lalu-sekarang/tugu-muda-2024.jpg') }}",
                beforeLabel: "Vrijheidsmonument",
                afterLabel: "Tugu Muda",
                beforeYear: "1953",
                afterYear: "2024",
                title: "Tugu Muda",
                description: [
                    "<strong>Tugu Muda</strong> terletak di pusat Kota Semarang, di persimpangan lima jalan utama, menjadi monumen ikonik yang mengenang perjuangan kemerdekaan. Dibangun pada tahun 1953, tugu ini awalnya dikenal sebagai \"Vrijheidsmonument\" pada masa kolonial.",
                    "Monumen ini didedikasikan untuk mengenang <strong>Pertempuran Lima Hari Semarang</strong> (14-19 Oktober 1945), di mana para pemuda berjuang melawan penjajah. Transformasi fisik dan maknanya mencerminkan semangat kemerdekaan Indonesia."
                ]
            },
            {
                id: "lawang-sewu",
                year: "1930",
                location: "Lawang Sewu",
                beforeImage: "{{ asset('smg-masa-lalu-sekarang/lawangsewutahun1930.jpg') }}",
                afterImage: "{{ asset('smg-masa-lalu-sekarang/lawangsewu2024.jpg') }}",
                beforeLabel: "Kantor NIS",
                afterLabel: "Museum Heritage",
                beforeYear: "1930",
                afterYear: "2024",
                title: "Lawang Sewu",
                description: [
                    "<strong>Lawang Sewu</strong> adalah gedung bersejarah milik PT Kereta Api Indonesia (Persero), dibangun sebagai kantor pusat Nederlandsch-Indische Spoorweg Maatschappij (NIS). Dikenal dengan ratusan pintu dan jendelanya, bangunan ini adalah mahakarya arsitektur Art Nouveau.",
                    "Dari masa kolonial hingga menjadi museum heritage, Lawang Sewu telah menyaksikan berbagai era, termasuk pendudukan Jepang dan perjuangan kemerdekaan, menjadikannya simbol ketahanan dan keindahan sejarah."
                ]
            },
            {
                id: "kota-lama",
                year: "1900",
                location: "Kota Lama",
                beforeImage: "{{ asset('img/kota-lama-sejarah.jpg') }}",
                afterImage: "{{ asset('img/kota-lama-sekarang.jpg') }}",
                beforeLabel: "Pusat Dagang",
                afterLabel: "Little Netherlands",
                beforeYear: "1900",
                afterYear: "2024",
                title: "Kota Lama",
                description: [
                    "<strong>Kawasan Kota Lama</strong> adalah jantung perekonomian masa kolonial yang kini menjelma menjadi destinasi wisata heritage terpopuler. Dengan arsitektur Eropa yang autentik dan penataan kota yang terencana, kawasan ini dijuluki \"Little Netherlands\".",
                    "Transformasi dari pusat perdagangan kolonial menjadi kawasan wisata budaya menunjukkan bagaimana warisan sejarah dapat dilestarikan sambil memberikan nilai ekonomi bagi masyarakat modern."
                ]
            },
            {
                id: "stasiun-tawang",
                year: "1868",
                location: "Stasiun Tawang",
                beforeImage: "{{ asset('img/stasiun-tawang-lama.jpg') }}",
                afterImage: "{{ asset('img/stasiun-tawang-sekarang.jpg') }}",
                beforeLabel: "Stasiun Pertama",
                afterLabel: "Heritage Station",
                beforeYear: "1868",
                afterYear: "2024",
                title: "Stasiun Tawang",
                description: [
                    "<strong>Stasiun Tawang</strong> adalah pionir transportasi kereta api di Jawa Tengah, menjadi saksi hidup revolusi transportasi yang mengubah wajah perekonomian Nusantara. Sebagai stasiun tertua di Semarang, ia menjadi penghubung vital jalur Semarang-Yogyakarta-Solo.",
                    "Keunikan Stasiun Tawang terletak pada kemampuannya mempertahankan fungsi operasional sambil melestarikan nilai historis. Hingga kini, stasiun ini tetap melayani perjalanan sambil menjadi destinasi wisata heritage yang memikat."
                ]
            },
            {
                id: "stasiun-semarang-nis",
                year: "1905",
                location: "Stasiun Semarang NIS",
                beforeImage: "{{ asset('smg-masa-lalu-sekarang/stasiunsemarangnis1905.png') }}",
                afterImage: "{{ asset('smg-masa-lalu-sekarang/KampungSpoorland2024.jpg') }}",
                beforeLabel: "Stasiun Semarang NIS",
                afterLabel: "Kampung Spoorland",
                beforeYear: "1905",
                afterYear: "2024",
                title: "Stasiun Semarang NIS",
                description: [
                    "<strong>Stasiun Samarang NIS</strong>, atau dikenal sebagai Stasiun Kemidjen NIS, dibangun pada 17 Juni 1864 sebagai salah satu stasiun kereta api tertua di Indonesia. Stasiun ini menjadi pusat penting transportasi pada masa kolonial Belanda.",
                    "Kini, lokasi ini telah bertransformasi menjadi <strong>Kampung Spoorland</strong>, sebuah kawasan wisata yang menggabungkan nilai sejarah dengan daya tarik modern, menawarkan pengalaman budaya dan edukasi bagi pengunjung."
                ]
            },
            {
                id: "mercusuar-willem",
                year: "1915",
                location: "Mercusuar Willem",
                beforeImage: "{{ asset('smg-masa-lalu-sekarang/mercusuar-willem-1915.jpg') }}",
                afterImage: "{{ asset('smg-masa-lalu-sekarang/mercusuar-willem-2024.jpg') }}",
                beforeLabel: "Mercusuar Willem",
                afterLabel: "Mercusuar Willem",
                beforeYear: "1915",
                afterYear: "2024",
                title: "Mercusuar Willem",
                description: [
                    "<strong>Mercusuar Willem</strong> didirikan pada masa kolonial Belanda antara tahun 1879 hingga 1884, berfungsi sebagai penanda navigasi penting di pantai Semarang. Struktur ini menjadi saksi perkembangan pelabuhan kota.",
                    "Hingga kini, mercusuar ini tetap berdiri sebagai simbol ketahanan maritim, menarik wisatawan yang ingin menelusuri warisan bahari Semarang."
                ]
            },
            {
                id: "wisma-perdamaian",
                year: "1920",
                location: "Wisma Perdamaian",
                beforeImage: "{{ asset('smg-masa-lalu-sekarang/wisma-perdamaian-1920.jpg') }}",
                afterImage: "{{ asset('smg-masa-lalu-sekarang/wisma-perdamaian-2024.jpg') }}",
                beforeLabel: "Residence de Gubernur",
                afterLabel: "Wisma Perdamaian",
                beforeYear: "1920",
                afterYear: "2024",
                title: "Wisma Perdamaian",
                description: [
                    "<strong>Wisma Perdamaian</strong>, dahulu dikenal sebagai Residence de Gubernur van Java’s Noordoosthoek, adalah bangunan kolonial abad ke-19 yang mencerminkan keanggunan arsitektur Belanda.",
                    "Kini, bangunan ini menjadi simbol warisan budaya, sering digunakan untuk acara resmi dan kunjungan wisata, mempertahankan pesona sejarahnya sambil relevan di era modern."
                ]
            },
            {
                id: "stasiun-poncol",
                year: "1927",
                location: "Stasiun Poncol",
                beforeImage: "{{ asset('smg-masa-lalu-sekarang/stasiun-poncol-1927.jpg') }}",
                afterImage: "{{ asset('smg-masa-lalu-sekarang/stasiun-poncol-2024.jpg') }}",
                beforeLabel: "Stasiun Poncol",
                afterLabel: "Stasiun Poncol",
                beforeYear: "1927",
                afterYear: "2024",
                title: "Stasiun Poncol Semarang",
                description: [
                    "<strong>Stasiun Semarang Poncol</strong>, yang secara resmi bernama 'Semarang West', terletak di daerah Poncol, Semarang. Stasiun ini menjadi bagian penting dari jaringan kereta api sejak awal abad ke-20.",
                    "Dengan arsitektur klasiknya, stasiun ini terus beroperasi sebagai penghubung transportasi sambil mempertahankan nilai historis sebagai salah satu warisan kolonial."
                ]
            },
            {
                id: "balai-kota",
                year: "1920",
                location: "Balai Kota",
                beforeImage: "{{ asset('smg-masa-lalu-sekarang/balai-kota-1920.jpg') }}",
                afterImage: "{{ asset('smg-masa-lalu-sekarang/balai-kota-2024.jpg') }}",
                beforeLabel: "Villa Gimberg",
                afterLabel: "Balai Kota",
                beforeYear: "1920",
                afterYear: "2024",
                title: "Balai Kota Semarang",
                description: [
                    "<strong>Balai Kota Semarang</strong> awalnya merupakan villa milik keluarga Gimberg di Jalan Pemuda No. 148, dibangun pada era kolonial. Bangunan ini kemudian diubah menjadi pusat pemerintahan kota.",
                    "Dengan arsitektur klasiknya, Balai Kota tetap menjadi landmark penting yang memadukan fungsi administratif dengan nilai sejarah yang kaya."
                ]
            },
            {
                id: "jalan-pahlawan",
                year: "1920",
                location: "Jalan Pahlawan",
                beforeImage: "{{ asset('smg-masa-lalu-sekarang/jalan-pahlawan-1920.jpg') }}",
                afterImage: "{{ asset('smg-masa-lalu-sekarang/jalan-pahlawan-2024.jpg') }}",
                beforeLabel: "Oei Tiong Ham Weg",
                afterLabel: "Jalan Pahlawan",
                beforeYear: "1920",
                afterYear: "2024",
                title: "Jalan Pahlawan",
                description: [
                    "<strong>Jalan Pahlawan</strong>, yang dulu dikenal sebagai Oei Tiong Ham Weg di kawasan Candi Baru, Semarang, adalah salah satu arteri penting kota pada masa kolonial.",
                    "Kini, jalan ini menjadi simbol modernitas dan sejarah, menghubungkan berbagai landmark penting sambil menyimpan kenangan masa lalu."
                ]
            },
            {
                id: "jalan-gombel",
                year: "1920",
                location: "Jalan Tanjakan Gombel",
                beforeImage: "{{ asset('smg-masa-lalu-sekarang/jalan-gombel-1920.jpg') }}",
                afterImage: "{{ asset('smg-masa-lalu-sekarang/jalan-gombel-2024.jpg') }}",
                beforeLabel: "Makam Pecinan",
                afterLabel: "Jalan Tanjakan Gombel",
                beforeYear: "1920",
                afterYear: "2024",
                title: "Jalan Tanjakan Gombel",
                description: [
                    "<strong>Jalan Tanjakan Gombel</strong> awalnya merupakan kawasan makam pecinan leluhur para etnis Tionghoa di Semarang, mencerminkan kekayaan budaya masyarakat Tionghoa pada masa itu.",
                    "Kini, jalan ini dikenal sebagai salah satu jalur ikonik dengan pemandangan kota yang menakjubkan, menjadi destinasi populer bagi warga lokal dan wisatawan."
                ]
            }
        ];
        function renderTimeline() {
            const timelineSlider = document.getElementById('timeline-slider');
            timelineSlider.innerHTML = locations.map((loc, index) => `
                <div class="timeline-item ${index === 0 ? 'active' : ''}" data-location="${loc.id}">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <span class="year font-roboto font-bold">${loc.year}</span>
                        <span class="location font-roboto font-normal">${loc.location}</span>
                    </div>
                </div>
            `).join('');
        }
        function renderLocationDisplays() {
            const comparisonDisplay = document.getElementById('comparison-display');
            comparisonDisplay.innerHTML = locations.map((loc, index) => `
                <div id="${loc.id}" class="location-display ${index === 0 ? 'active' : ''}">
                    <div class="comparison-container grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="comparison-slider-wrapper">
                            <div class="image-comparison-slider relative rounded-xl overflow-hidden shadow-2xl bg-black">
                                <div class="image-container relative w-full">
                                    <img class="image-before absolute top-0 left-0 w-full h-full object-cover" src="${loc.beforeImage}" alt="${loc.title} ${loc.beforeYear}" />
                                    <img class="image-after absolute top-0 left-0 w-full h-full object-cover" src="${loc.afterImage}" alt="${loc.title} ${loc.afterYear}" style="clip-path: polygon(50% 0%, 100% 0%, 100% 100%, 50% 100%)" />
                                    <div class="slider-handle absolute top-0 left-50% w-1 h-full bg-red-500 cursor-ew-resize transform -translate-x-1/2 z-10">
                                        <div class="slider-line w-full h-full bg-gradient-to-b from-transparent via-red-500 to-transparent"></div>
                                        <div class="slider-button absolute top-1/2 left-1/2 w-8 h-8 bg-red-500 rounded-full flex items-center justify-center shadow-lg transform -translate-x-1/2 -translate-y-1/2 hover:bg-red-600">
                                            <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
                                                <path d="M8 4l8 8-8 8V4z"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="image-labels absolute top-3 left-0 right-0 flex justify-between px-3 z-5">
                                    <div class="label label-before bg-black/80 backdrop-blur-md p-1.5 rounded-lg text-center border border-white/10">
                                        <span class="label-year block text-xs font-roboto font-bold text-red-300">${loc.beforeYear}</span>
                                        <span class="label-desc block text-xs font-roboto font-normal text-gray-300">${loc.beforeLabel}</span>
                                    </div>
                                    <div class="label label-after bg-black/80 backdrop-blur-md p-1.5 rounded-lg text-center border border-white/10">
                                        <span class="label-year block text-xs font-roboto font-bold text-red-300">${loc.afterYear}</span>
                                        <span class="label-desc block text-xs font-roboto font-normal text-gray-300">${loc.afterLabel}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="story-content">
                            <div class="story-header mb-6">
                                <h3 class="story-title text-2xl md:text-3xl font-roboto font-bold text-red-300">${loc.title}</h3>
                            </div>
                            <div class="story-text">
                                ${loc.description.map(p => `<p class="mb-4 text-base leading-relaxed font-roboto font-normal text-gray-200">${p}</p>`).join('')}
                            </div>
                        </div>
                    </div>
                </div>
            `).join('');
        }
        document.addEventListener('DOMContentLoaded', () => {
            renderTimeline();
            renderLocationDisplays();
            const timelineItems = document.querySelectorAll('.timeline-item');
            const locationDisplays = document.querySelectorAll('.location-display');
            timelineItems.forEach(item => {
                item.addEventListener('click', () => {
                    timelineItems.forEach(i => i.classList.remove('active'));
                    locationDisplays.forEach(d => d.classList.remove('active'));
                    item.classList.add('active');
                    const location = item.getAttribute('data-location');
                    document.getElementById(location).classList.add('active');
                    item.scrollIntoView({ behavior: 'smooth', inline: 'center' });
                });
            });
            const sliders = document.querySelectorAll('.image-comparison-slider');
            sliders.forEach(slider => {
                const handle = slider.querySelector('.slider-handle');
                const beforeImage = slider.querySelector('.image-after');
                let isDragging = false;
                const updateSlider = (x, rect) => {
                    x = Math.max(0, Math.min(x, rect.width));
                    const percentage = (x / rect.width) * 100;
                    beforeImage.style.clipPath = `polygon(${percentage}% 0%, 100% 0%, 100% 100%, ${percentage}% 100%)`;
                    handle.style.left = `${percentage}%`;
                };
                handle.addEventListener('mousedown', () => {
                    isDragging = true;
                });
                document.addEventListener('mousemove', (e) => {
                    if (!isDragging) return;
                    const rect = slider.getBoundingClientRect();
                    updateSlider(e.clientX - rect.left, rect);
                });
                document.addEventListener('mouseup', () => {
                    isDragging = false;
                });
                handle.addEventListener('touchstart', (e) => {
                    isDragging = true;
                    e.preventDefault();
                });
                document.addEventListener('touchmove', (e) => {
                    if (!isDragging) return;
                    const touch = e.touches[0];
                    const rect = slider.getBoundingClientRect();
                    updateSlider(touch.clientX - rect.left, rect);
                    e.preventDefault();
                });
                document.addEventListener('touchend', () => {
                    isDragging = false;
                });
            });
            document.getElementById('btnPastPresent').classList.add('bg-red-800', 'text-white');
        });
        function showSection(section) {
            const pastPresentSection = document.getElementById('past-present-section');
            const futureSection = document.getElementById('future-section');
            const btnPastPresent = document.getElementById('btnPastPresent');
            const btnFuture = document.getElementById('btnFuture');
            if (section === 'past-present') {
                pastPresentSection.classList.remove('hidden');
                futureSection.classList.add('hidden');
                btnPastPresent.classList.add('bg-red-800', 'text-white');
                btnPastPresent.classList.remove('bg-gray-200', 'text-gray-700');
                btnFuture.classList.add('bg-gray-200', 'text-gray-700');
                btnFuture.classList.remove('bg-red-800', 'text-white');
            } else {
                pastPresentSection.classList.add('hidden');
                futureSection.classList.remove('hidden');
                btnFuture.classList.add('bg-red-800', 'text-white');
                btnFuture.classList.remove('bg-gray-200', 'text-gray-700');
                btnPastPresent.classList.add('bg-gray-200', 'text-gray-700');
                btnPastPresent.classList.remove('bg-red-800', 'text-white');
            }
        }
        function playVideo(videoId) {
            const modal = document.getElementById('videoModal');
            const videoFrame = document.getElementById('videoFrame');
            videoFrame.src = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
        function closeVideo() {
            const modal = document.getElementById('videoModal');
            const videoFrame = document.getElementById('videoFrame');
            videoFrame.src = '';
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
</body>
</html>