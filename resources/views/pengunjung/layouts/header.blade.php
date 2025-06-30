<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>Kota Semarang</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/3.4.1/tailwind.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
      .header {
        transition: background-color 0.3s, color 0.3s;
        background-color: rgba(196, 34, 23, 0.8); /* Warna merah dengan transparansi */
        backdrop-filter: blur(8px); /* Efek blur pada latar */
      }
      .header.scrolled {
        background-color: white;
        color: #c42217;
      }
    @media (max-width: 768px) {
      .mobile-menu {
        transform: translateX(-100%);
        transition: transform 0.3s ease-in-out;
      }
      .mobile-menu.active {
        transform: translateX(0);
      }
      .html {
      scroll-behavior: smooth;
  }
    }
  </style>
</head>
<body class="bg-white">
  <!-- Header -->
  <header id="header" class="header bg-red-800 text-white fixed w-full p-4 flex justify-between items-center z-50 shadow-md">
    <!-- Logo and Title -->
    <div class="flex items-center space-x-3">
      <img alt="Logo Dinas Arsip dan Perpustakaan Kota Semarang" class="w-8 md:w-12" src="/img/logo.png"/>
      <a class="text-sm md:text-base font-bold leading-tight" href="/">
        DINAS ARSIP DAN <br> PERPUSTAKAAN KOTA SEMARANG
      </a>
    </div>

    <!-- Desktop Navigation -->
    <nav class="hidden lg:flex space-x-6 text-sm font-medium">
      <a class="hover:text-gray-300 transition-colors duration-200" href="{{ url('/') }}#pemerintahan">Pemerintahan</a>
      <a class="hover:text-gray-300 transition-colors duration-200" href="/arsitektur">Arsitektur</a>
      <a class="hover:text-gray-300 transition-colors duration-200" href="/tempatibadah">Tempat Ibadah</a>
      <a class="hover:text-gray-300 transition-colors duration-200" href="/budaya">Budaya</a>
      <a class="hover:text-gray-300 transition-colors duration-200" href="/tokoh">Tokoh</a>
      <a class="hover:text-gray-300 transition-colors duration-200" href="/situs-kota-lama">Situs Kota Lama</a>
      <a class="hover:text-gray-300 transition-colors duration-200" href="/makan">Makanan</a>
      <a class="hover:text-gray-300 transition-colors duration-200" href="/wisata">Pariwisata</a>
    
      @foreach ($additional_sections as $section)
        <a class="hover:text-gray-300 transition-colors duration-200" href="{{ url('/section/' . $section->slug) }}">
          {{ $section->name }}
        </a>
      @endforeach

    </nav>

    <!-- Mobile Menu Button -->
    <button class="lg:hidden text-2xl" id="menuButton">
      <i class="fas fa-bars"></i>
    </button>

    <button onclick="scrollToFooter()" 
    class="hidden lg:block bg-red-600 hover:bg-red-800 text-white px-4 py-2 rounded-lg shadow-md transition-transform transform hover:scale-105">
    Contact
</button>

<script>
    function scrollToFooter() {
        const footer = document.getElementById('footer');
        if (footer) {
            footer.scrollIntoView({ behavior: 'smooth' });
        } else {
            window.location.href = "#footer"; // Jika footer belum termuat
        }
    }
</script>
  </header>

  <!-- Mobile Navigation Menu -->
  <div class="mobile-menu fixed top-0 left-0 h-full w-64 bg-red-800 text-white z-50 p-4 shadow-lg lg:hidden">
    <div class="flex justify-between items-center mb-8">
      <span class="font-bold">Menu</span>
      <button class="text-2xl" id="closeMenu">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <nav class="flex flex-col space-y-4">
      <a class="hover:text-gray-300 transition-colors duration-200" href="/pemerintahan">Pemerintahan</a>
      <a class="hover:text-gray-300 transition-colors duration-200" href="/arsitektur">Arsitektur</a>
      <a class="hover:text-gray-300 transition-colors duration-200" href="/tempatibadah">Tempat Ibadah</a>
      <a class="hover:text-gray-300 transition-colors duration-200" href="/budaya">Budaya</a>
      <a class="hover:text-gray-300 transition-colors duration-200" href="/tokoh">Tokoh</a>
      <a class="hover:text-gray-300 transition-colors duration-200" href="/situs-kota-lama">Situs Kota Lama</a>
      <a class="hover:text-gray-300 transition-colors duration-200" href="/makan">Makanan</a>
      <a class="hover:text-gray-300 transition-colors duration-200" href="/wisatasmg">Pariwisata</a>
    </nav>
    <button class="mt-8 w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md transition-transform transform hover:scale-105">
      Contact
    </button>
  </div>

  <script>
    // Header scroll effect
    window.addEventListener('scroll', () => {
      const header = document.getElementById('header');
      if (window.scrollY > 50) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    });

    // Mobile menu functionality
    const menuButton = document.getElementById('menuButton');
    const closeMenu = document.getElementById('closeMenu');
    const mobileMenu = document.querySelector('.mobile-menu');

    menuButton.addEventListener('click', () => {
      mobileMenu.classList.add('active');
    });

    closeMenu.addEventListener('click', () => {
      mobileMenu.classList.remove('active');
    });
  </script>
</body>
</html>