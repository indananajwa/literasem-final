<header class="px-6 py-3 flex justify-between items-center bg-white border-b border-gray-200">
  <!-- Left section (greeting) -->
  <div class="flex items-center space-x-2 pl-2">
    <h1 class="text-lg font-semibold text-gray-800">
      Selamat datang, {{ Auth::guard('web')->user()->name ?? 'Admin' }} 👋
    </h1>
  </div>

  <!-- Right section (profile dropdown) -->
  <div class="flex items-center space-x-6">
    <!-- Notif Icon -->
    <button class="relative text-gray-600 hover:text-red-700 transition">
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
      </svg>
      <span class="absolute -top-1 -right-1 w-2 h-2 bg-red-600 rounded-full"></span>
    </button>

    <!-- User Dropdown -->
    <div class="relative">
      <button id="user-menu-button" class="flex items-center space-x-2 focus:outline-none hover:opacity-80 transition">
        <img src="{{ asset('img/icon.png') }}" alt="User Avatar" class="w-9 h-9 rounded-full border border-gray-300 shadow-sm object-cover">
        <div class="hidden sm:flex flex-col items-start leading-tight">
          <span class="text-sm font-medium text-gray-800">{{ Auth::guard('web')->user()->name ?? 'Admin' }}</span>
          <span class="text-[11px] text-gray-500">Administrator</span>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-500">
          <polyline points="6 9 12 15 18 9"></polyline>
        </svg>
      </button>

      <!-- Dropdown Menu -->
      <div id="user-menu" class="absolute right-0 mt-3 w-48 bg-white rounded-lg shadow-xl py-2 hidden z-50 border border-gray-200">
        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
          <span class="font-medium">👤 Profil</span>
        </a>
        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
          <span class="font-medium">⚙️ Pengaturan</span>
        </a>
        
        <div class="border-t border-gray-200 my-1"></div>

        <form action="{{ route('auth.logout') }}" method="POST">
          @csrf
          <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 font-medium hover:bg-red-50 transition">
            🚪 Logout
          </button>
        </form>
      </div>
    </div>
  </div>
</header>

<script>
  // Toggle dropdown menu
  document.getElementById("user-menu-button").addEventListener("click", function (e) {
    e.preventDefault();
    const menu = document.getElementById("user-menu");
    menu.classList.toggle("hidden");
  });

  // Close dropdown saat klik di luar
  document.addEventListener("click", function (e) {
    const button = document.getElementById("user-menu-button");
    const menu = document.getElementById("user-menu");
    
    if (!button.contains(e.target) && !menu.contains(e.target)) {
      menu.classList.add("hidden");
    }
  });
</script>