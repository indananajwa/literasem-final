<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Makanan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
    .hidden {
      display: none;
    }
  </style>
</head>
<body class="bg-gray-100">

  @include('pengunjung.layouts.header')

  <div id="hero-section" class="relative h-screen bg-cover bg-center z-10" style="background-image: url('https://via.placeholder.com/1920x1080');">
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>

    <div id="hero-content" class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white">
      <h1 class="text-5xl font-bold mb-4">
        <span class="text-red-800">{{ $sectionTitle ?? 'Ragam Kuliner Nusantara' }}:</span><br>
        <span class="text-red-800 font-normal text-3xl">{{ $sectionSubtitle ?? 'Kenikmatan yang Tak Terlupakan' }}</span>
      </h1>
      <button class="bg-red-800 text-white px-6 py-3 rounded-full shadow-lg flex items-center hover:bg-yellow-600" onclick="scrollToMenu()">
        View Menu
      </button>
    </div>

    <!-- Search bar -->
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 bg-white rounded-full shadow-lg px-6 py-4 flex space-x-4 items-center z-30">
      <input
        id="search-bar"
        type="text"
        placeholder="Search by name or description..."
        class="flex-1 border-none bg-gray-100 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500"
        style="width: 300px;"
      />
      <button class="bg-red-800 text-white font-bold rounded-md px-6 py-2 hover:bg-yellow-600">Search</button>
    </div>
  </div>

  <!-- Menu Section -->
  <div id="menu-section" class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4 text-red-800">{{ $sectionTitle ?? 'Daftar Item' }}</h1>

    <div id="food-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach ($items as $item)
        <div class="bg-white p-4 rounded-lg shadow-md hover:bg-red-800 hover:text-white transition group">
          <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-48 object-cover rounded-md">
          <h2 class="text-xl font-bold mt-4 group-hover:text-white">{{ $item->title }}</h2>
          <p class="text-gray-700 mt-2 short-desc group-hover:text-white">{{ \Illuminate\Support\Str::limit($item->description, 100) }}</p>
          <p class="text-gray-700 mt-2 full-desc hidden group-hover:text-white text-justify">{{ $item->description }}</p>
          <button class="text-blue-500 mt-2 read-more group-hover:text-white" onclick="toggleReadMore(this)">Read More</button>
        </div>
      @endforeach
    </div>
  </div>

  <script>
    function toggleReadMore(button) {
      const card = button.parentElement;
      const shortDesc = card.querySelector('.short-desc');
      const fullDesc = card.querySelector('.full-desc');

      if (fullDesc.classList.contains('hidden')) {
        shortDesc.classList.add('hidden');
        fullDesc.classList.remove('hidden');
        button.textContent = 'Read Less';
      } else {
        shortDesc.classList.remove('hidden');
        fullDesc.classList.add('hidden');
        button.textContent = 'Read More';
      }
    }

    function scrollToMenu() {
      const menuSection = document.getElementById('menu-section');
      menuSection.scrollIntoView({ behavior: 'smooth' });
    }

    document.getElementById('search-bar').addEventListener('input', function () {
      const searchValue = this.value.toLowerCase();
      const foodCards = document.querySelectorAll('#food-list > div');
      foodCards.forEach(item => {
        const itemName = item.querySelector('h2').textContent.toLowerCase();
        const itemDesc = item.querySelector('.full-desc').textContent.toLowerCase();
        if (itemName.includes(searchValue) || itemDesc.includes(searchValue)) {
          item.style.display = 'block';
        } else {
          item.style.display = 'none';
        }
      });
    });
  </script>
</body>
</html>
