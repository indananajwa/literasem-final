<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kota Semarang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        .header {
            transition: all 0.3s ease;
            background-color: rgba(196, 34, 23, 0.9);
            backdrop-filter: blur(8px);
        }
        .header.scrolled {
            background-color: white;
            color: #c42217;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header.scrolled a:not(.btn-bookmark, .btn-contact) {
            color: #c42217;
        }
        .header.scrolled a:not(.btn-bookmark, .btn-contact):hover {
            color: #a51b14;
        }
        .header.scrolled .dropdown-menu {
            border: 1px solid #e5e7eb;
        }
        .dropdown-menu {
            transition: all 0.3s ease;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
        }
        .dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
            width: min(80vw, 320px);
        }
        .mobile-menu.active {
            transform: translateX(0);
        }
        html {
            scroll-behavior: smooth;
        }
        .nav-link {
            position: relative;
            padding: 0.5rem 0;
            transition: color 0.3s ease;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: currentColor;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        .nav-link:hover::after {
            width: 100%;
        }
        .mobile-dropdown {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }
        .mobile-dropdown.active {
            max-height: 500px;
            transition: max-height 0.5s ease;
        }
        .nav-container {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 0.25rem; /* Further reduced gap for tighter alignment */
        }
        @media (max-width: 1024px) {
            .header {
                padding: 0.5rem 0; /* Reduced padding further for mobile */
            }
            .nav-container {
                display: none;
            }
        }
        @media (min-width: 1025px) {
            .mobile-menu {
                display: none;
            }
            .mobile-menu-button {
                display: none;
            }
        }
        .btn-bookmark, .btn-contact {
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
        }
        .mobile-menu .btn-bookmark, .mobile-menu .btn-contact {
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
        }
    </style>
</head>
<body class="bg-white">
    <header id="header" class="header bg-red-800 text-white fixed w-full z-50 shadow-md">
        <div class="flex items-center justify-between h-16 md:h-20 px-2"> <!-- Reduced px-2 to px-1 -->
            <div class="flex items-center space-x-2 pl-2"> <!-- Reduced space-x-2 to space-x-1, pl-2 to pl-1 -->
                <img alt="Logo Dinas Arsip dan Perpustakaan Kota Semarang" class="w-8 md:w-12" src="{{ asset('img/logo.png') }}">
                <a class="text-sm md:text-base font-bold leading-tight" href="{{ route('home') }}">
                    DINAS ARSIP DAN <br> PERPUSTAKAAN KOTA SEMARANG
                </a>
            </div>

            <div class="nav-container flex-1 hidden lg:flex pr-1"> <!-- Reduced pr-2 to pr-1 -->
                <nav class="flex items-center space-x-4 text-sm font-medium"> <!-- Reduced space-x-6 to space-x-4 -->
                    <a class="nav-link hover:text-gray-300" onclick="scrollToSection('pemerintahan')">
                        Pemerintah
                    </a>
                    <a class="nav-link hover:text-gray-300" href="{{ route('situs-kota-lama') }}">
                        Situs Kota Lama
                    </a>
                    <a class="nav-link hover:text-gray-300" href="{{ route('pariwisata.index') }}">
                        Pariwisata
                    </a>
                    <div class="relative dropdown">
                        <button class="nav-link hover:text-gray-300 flex items-center">
                            Kategori
                            <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        <div class="dropdown-menu absolute right-0 mt-2 w-64 bg-white text-gray-800 rounded-lg shadow-lg border max-h-80 overflow-y-auto">
                            @php
                                $kategoris = \App\Models\Kategori::all();
                            @endphp
                            @forelse($kategoris as $kategori)
                                <a href="{{ route('kategori.show', $kategori->kode_kategori) }}" 
                                   class="block px-4 py-3 hover:bg-red-50 hover:text-red-600 transition-colors border-b border-gray-100">
                                    <i class="fas fa-folder mr-2"></i>{{ $kategori->nama_kategori }}
                                </a>
                            @empty
                                <div class="px-4 py-3 text-gray-500">
                                    <i class="fas fa-info-circle mr-2"></i>Belum ada kategori
                                </div>
                            @endforelse
                        </div>
                    </div>
                </nav>
                <div class="flex items-center space-x-1 ml-1"> <!-- Reduced space-x-2 to space-x-1, ml-2 to ml-1 -->
                    <a href="{{ route('bookmark') }}"
                       class="btn-bookmark flex items-center bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all transform hover:scale-105 shadow-md">
                        <i class="fas fa-bookmark mr-1"></i>Bookmark
                    </a>
                    <button onclick="scrollToFooter()"
                            class="btn-contact bg-red-600 hover:bg-red-700 text-white rounded-lg shadow-md transition-all transform hover:scale-105">
                        Kontak
                    </button>
                </div>
            </div>

            <button class="mobile-menu-button lg:hidden text-xl p-2 rounded-lg hover:bg-red-700 transition-colors" id="menuButton">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <div class="mobile-menu fixed top-0 left-0 h-full bg-red-800 text-white z-50 shadow-2xl lg:hidden">
        <div class="p-4">
            <div class="flex justify-between items-center mb-6 pb-4 border-b border-red-700">
                <div class="flex items-center space-x-2">
                    <img alt="Logo" class="w-8" src="{{ asset('img/logo.png') }}">
                    <span class="font-bold text-lg">Menu</span>
                </div>
                <button class="text-xl p-2 rounded-lg hover:bg-red-700 transition-colors" id="closeMenu">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <nav class="flex flex-col space-y-2">
                <a class="flex items-center px-3 py-3 rounded-lg hover:bg-red-700 transition-colors" onclick="scrollToSection('pemerintahan'); closeMobileMenu();">
                    <i class="fas fa-landmark mr-3 w-5"></i>Pemerintah
                </a>
                <a class="flex items-center px-3 py-3 rounded-lg hover:bg-red-700 transition-colors" href="{{ route('situs-kota-lama') }}">
                    <i class="fas fa-landmark mr-3 w-5"></i>Situs Kota Lama
                </a>
                <a class="flex items-center px-3 py-3 rounded-lg hover:bg-red-700 transition-colors" href="{{ route('pariwisata.index') }}">
                    <i class="fas fa-map-marked-alt mr-3 w-5"></i>Pariwisata
                </a>
                <div class="mb-2">
                    <button class="flex items-center justify-between w-full px-3 py-3 rounded-lg hover:bg-red-700 transition-colors" onclick="toggleMobileDropdown('kategori')">
                        <span class="flex items-center">
                            <i class="fas fa-th-large mr-3 w-5"></i>Kategori
                        </span>
                        <i class="fas fa-chevron-down transition-transform" id="kategori-icon"></i>
                    </button>
                    <div class="mobile-dropdown bg-red-900 rounded-lg mt-1" id="kategori-dropdown">
                        @forelse($kategoris ?? \App\Models\Kategori::all() as $kategori)
                            <a class="block px-6 py-2 hover:bg-red-700 transition-colors" href="{{ route('kategori.show', $kategori->kode_kategori) }}">
                                <i class="fas fa-folder mr-2"></i>{{ $kategori->nama_kategori }}
                            </a>
                        @empty
                            <div class="px-6 py-2 text-gray-300">
                                <i class="fas fa-info-circle mr-2"></i>Belum ada kategori
                            </div>
                        @endforelse
                    </div>
                </div>
                <a href="{{ route('bookmark') }}"
                   class="flex items-center mt-4 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors shadow-md btn-bookmark">
                    <i class="fas fa-bookmark mr-3 w-5"></i>Bookmark
                </a>
                <button onclick="scrollToFooter(); closeMobileMenu();"
                        class="flex items-center mt-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-md transition-colors btn-contact">
                    <i class="fas fa-envelope mr-3 w-5"></i>Kontak
                </button>
            </nav>
        </div>
    </div>

    <div class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden" id="mobileOverlay"></div>

    <script>
        // Header scroll effect
        window.addEventListener('scroll', () => {
            const header = document.getElementById('header');
            header.classList.toggle('scrolled', window.scrollY > 50);
        });

        // Mobile menu functionality
        const menuButton = document.getElementById('menuButton');
        const closeMenu = document.getElementById('closeMenu');
        const mobileMenu = document.querySelector('.mobile-menu');
        const mobileOverlay = document.getElementById('mobileOverlay');

        function openMobileMenu() {
            mobileMenu.classList.add('active');
            mobileOverlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeMobileMenu() {
            mobileMenu.classList.remove('active');
            mobileOverlay.classList.add('hidden');
            document.body.style.overflow = '';
            document.querySelectorAll('.mobile-dropdown').forEach(dd => dd.classList.remove('active'));
            document.querySelectorAll('[id$="-icon"]').forEach(icon => icon.style.transform = 'rotate(0deg)');
        }

        menuButton.addEventListener('click', openMobileMenu);
        closeMenu.addEventListener('click', closeMobileMenu);
        mobileOverlay.addEventListener('click', closeMobileMenu);

        // Touch support for mobile menu swipe
        let touchStartX = 0;
        mobileMenu.addEventListener('touchstart', e => {
            touchStartX = e.changedTouches[0].screenX;
        });
        mobileMenu.addEventListener('touchend', e => {
            const touchEndX = e.changedTouches[0].screenX;
            if (touchStartX - touchEndX > 50) {
                closeMobileMenu();
            }
        });

        // Mobile dropdown functionality
        function toggleMobileDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId + '-dropdown');
            const icon = document.getElementById(dropdownId + '-icon');
            const isActive = dropdown.classList.contains('active');
            
            document.querySelectorAll('.mobile-dropdown').forEach(dd => {
                if (dd !== dropdown) dd.classList.remove('active');
            });
            document.querySelectorAll('[id$="-icon"]').forEach(ic => {
                if (ic !== icon) ic.style.transform = 'rotate(0deg)';
            });

            dropdown.classList.toggle('active', !isActive);
            icon.style.transform = isActive ? 'rotate(0deg)' : 'rotate(180deg)';
        }

        // Scroll to section function
        function scrollToSection(sectionId) {
            const element = document.getElementById(sectionId);
            if (element) {
                const headerHeight = document.getElementById('header').offsetHeight;
                const elementPosition = element.getBoundingClientRect().top + window.pageYOffset - headerHeight - 20;
                window.scrollTo({
                    top: elementPosition,
                    behavior: 'smooth'
                });
            }
        }

        // Scroll to footer
        function scrollToFooter() {
            const footer = document.getElementById('footer');
            if (footer) {
                const headerHeight = document.getElementById('header').offsetHeight;
                const footerPosition = footer.getBoundingClientRect().top + window.pageYOffset - headerHeight - 20;
                window.scrollTo({
                    top: footerPosition,
                    behavior: 'smooth'
                });
            }
        }

        // Close mobile menu on link click
        document.querySelectorAll('.mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                closeMobileMenu();
            });
        });

        // Handle escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
                closeMobileMenu();
            }
        });

        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth > 1024 && mobileMenu.classList.contains('active')) {
                closeMobileMenu();
            }
        });
    </script>
</body>
</html>