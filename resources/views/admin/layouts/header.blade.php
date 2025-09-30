<header class="px-6 py-3 flex justify-between items-center">  <!-- Left section (optional greeting / breadcrumb) -->
  <div class="flex items-center space-x-2 pl-2">
    <h1 class="text-lg font-semibold text-gray-800">
        Selamat datang, {{ Auth::user()->name }} 👋
    </h1>
</div>


  <!-- Right section (profile dropdown) -->
  <div class="flex items-center space-x-6">
    <!-- Notif Icon -->
    <button class="relative text-gray-600 hover:text-red-700 transition">
      <i data-lucide="bell" class="w-5 h-5"></i>
      <span class="absolute -top-1 -right-1 w-2 h-2 bg-red-600 rounded-full"></span>
    </button>

    <!-- User Dropdown -->
    <div class="relative">
      <button id="user-menu-button" class="flex items-center space-x-2 focus:outline-none">
        <img src="{{ asset('img/icon.png') }}" alt="User Avatar" class="w-9 h-9 rounded-full border border-gray-300 shadow-sm">
        <div class="hidden sm:flex flex-col items-start leading-tight">
          <span class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</span>
          <span class="text-[11px] text-gray-500">Administrator</span>
        </div>
        <i data-lucide="chevron-down" class="w-4 h-4 text-gray-500"></i>
      </button>

      <!-- Dropdown Menu -->
      <div id="user-menu" class="absolute right-0 mt-3 w-48 bg-white rounded-lg shadow-lg py-2 hidden z-50">
        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil</a>
        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pengaturan</a>
        <form action="{{ url('logout') }}" method="POST" class="border-t">
          @csrf
          <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
            Logout
          </button>
        </form>
      </div>
    </div>
  </div>
</header>

<script>
  document.getElementById("user-menu-button").addEventListener("click", function () {
    document.getElementById("user-menu").classList.toggle("hidden");
  });
</script>
