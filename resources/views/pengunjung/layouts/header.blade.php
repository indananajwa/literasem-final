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
      @foreach($sections as $section)
        <a class="hover:text-gray-300 transition-colors duration-200" href="{{ url('/section/' . Str::slug($section->name)) }}">
          {{ $section->name }}
        </a>
      @endforeach
    </nav>

    <!-- Mobile Navigation Menu -->
    <nav class="flex flex-col space-y-4">
      @foreach($sections as $section)
        <a class="hover:text-gray-300 transition-colors duration-200" href="{{ url('/section/' . Str::slug($section->name)) }}">
          {{ $section->name }}
        </a>
      @endforeach
    </nav>


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