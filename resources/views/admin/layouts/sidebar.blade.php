<script src="https://unpkg.com/lucide@latest"></script>

<style>
  .sidebar-menu-item {
    transition: all 0.25s ease;
    border-radius: 14px;
  }
  .sidebar-menu-item:hover {
    background-color: rgba(153, 27, 27, 0.08);
  }
  .sidebar-menu-item.active {
    background: linear-gradient(90deg, #991B1B 0%, #7F1D1D 100%);
    color: white !important;
    box-shadow: 0 3px 6px rgba(0,0,0,0.12);
  }
  .sidebar-menu-item.active i,
  .sidebar-menu-item.active svg {
    color: white !important;
    stroke: white !important;
  }
  .sidebar-menu-item:not(.active):hover {
    color: #991B1B;
  }
</style>

<div class="w-64 fixed top-0 left-0 h-screen bg-white flex flex-col justify-between py-6 px-5 border-r border-gray-200 shadow-sm overflow-y-auto">
  <!-- Logo & Brand -->
  <div>
    <div class="flex items-center space-x-3 mb-10 px-2">
      <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-700 to-red-900 flex items-center justify-center shadow-md">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-7 h-7">
      </div>
      <div>
        <p class="text-gray-800 font-semibold text-base leading-tight">
          <span class="text-red-700">LITERASEM</span>
        </p>
        <p class="text-xs text-gray-500">Literasi Arsip Semarang</p>
      </div>
    </div>

    <!-- MENU -->
    <nav class="space-y-2 text-sm font-medium">
      <a href="{{ route('admin.dashboard') }}" 
         class="sidebar-menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 text-gray-700 group">
        <i data-lucide="layout-dashboard" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
        <span>Dashboard</span>
      </a>
      
      <a href="{{ route('admin.kategori.index') }}" 
         class="sidebar-menu-item {{ request()->routeIs('admin.kategori.*') || request()->routeIs('admin.konten.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 text-gray-700 group">
        <i data-lucide="file-pen-line" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
        <span>Manajemen Konten</span>
      </a>
      
      <a href="{{ route('admin.feedback.index') }}" 
         class="sidebar-menu-item {{ request()->routeIs('admin.feedback.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 text-gray-700 group">
        <i data-lucide="megaphone" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
        <span>Umpan Balik</span>
      </a>
    </nav>
  </div>
  
 
</div>

<script>
  lucide.createIcons();
</script>