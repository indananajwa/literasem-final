<!-- Tambahkan Lucide Icons -->
<script src="https://unpkg.com/lucide@latest"></script>

<div class="w-64 fixed top-0 left-0 h-screen bg-red-800 text-white flex flex-col justify-between py-8 px-5 z-50">
  <!-- Logo & Judul -->
  <div>
    <div class="flex items-center space-x-3 mb-7">
      <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-10 h-10">
      <div>
        <p class="text-sm">Admin <span class="font-bold">LITERASEM</span></p>
        <p class="text-xs">Literasi Arsip Semarang</p>
      </div>
    </div>
    <hr class="border-gray-300 mb-8">

    <!-- MENU -->
    <ul class="space-y-5 text-sm pl-2">
      <li>
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 hover:translate-x-1 transition-all duration-200">
          <i data-lucide="layout-dashboard" class="w-5 h-5 text-white"></i>
          Dashboard
        </a>
      </li>
      <li>
        <a href="{{ route('manajemen_konten') }}" class="flex items-center gap-3 hover:translate-x-1 transition-all duration-200">
          <i data-lucide="file-pen-line" class="w-5 h-5 text-white"></i>
          Manajemen Konten
        </a>
      </li>
      <li>
        <a href="{{ route('admin.feedback.index') }}" class="flex items-center gap-3 hover:translate-x-1 transition-all duration-200">
          <i data-lucide="megaphone" class="w-5 h-5 text-white"></i>
          Laporan Aduan
        </a>
      </li>
    </ul>
  </div>

  <!-- Logout & Footer -->
  <div>
    <ul class="space-y-5 text-sm pl-2 mb-6">
      <li>
        <a  onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center gap-3 hover:translate-x-1 transition-all duration-200">
          <i data-lucide="log-out" class="w-5 h-5 text-white"></i>
          Logout
        </a>
      </li>
    </ul>
    <p class="text-[10px] text-gray-200 leading-snug">DINAS ARSIP DAN PERPUSTAKAAN<br>KOTA SEMARANG</p>

    
  </div>
</div>

<!-- Aktifkan ikon -->
<script>
  lucide.createIcons();
</script>
