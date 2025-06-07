<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<header class="bg-white py-2 px-6 flex justify-between items-center text-white">
    <div>
      <!-- <h1 class="text-2xl font-bold text-gray-800">
        Welcome back, Jenny
      </h1>
      <p class="text-gray-500">
        Here's what's happening with your store today.
      </p> -->
    </div>

    <!-- Navigation & User Profile -->
    <div class="flex items-center space-x-6">

        <!-- User Dropdown -->
        <div class="relative">
            <button id="user-menu-button" class="flex items-center space-x-2 focus:outline-none">
                <img src="{{ asset('img/icon.png') }}" alt="Logo" class="w-8 h-8">
                <div class="flex items-center space-x-2">
                    <span class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                </div>
                <i class="fas fa-chevron-down text-gray-500"></i>
            </button>

            <!-- Dropdown Menu -->
            <div id="user-menu" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-md py-2 hidden transition">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Profil</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Pengaturan</a>
                <form action="{{ url('logout') }}" method="POST" class="border-t dark:border-gray-600">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700">
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

</body>
</html>