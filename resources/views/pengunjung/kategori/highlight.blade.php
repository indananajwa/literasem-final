<!-- Menu Section (Highlight) -->
<div id="menu-section" class="container mx-auto px-4 py-6 mt-12 relative">
    <h2 class="text-4xl font-bold mb-8 text-center">
        Jelajah Budaya
        <span class="text-red-800">Semarang</span>
    </h2>
    
    <!-- Left Arrow Button -->
    <button id="scroll-left" onclick="scrollLeft()" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-red-800 text-white px-4 py-2 rounded-full hover:bg-yellow-600 transition-colors duration-300 shadow-lg z-20">
        <i class="fas fa-chevron-left"></i>
    </button>
    
    <!-- Tour Items Container -->
    <div id="tour-items" class="overflow-x-auto hide-scrollbar flex space-x-4 px-12">
        <!-- Dynamically generated tour items will go here -->
    </div>
    
    <!-- Right Arrow Button -->
    <button id="scroll-right" onclick="scrollRight()" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-red-800 text-white px-4 py-2 rounded-full hover:bg-yellow-600 transition-colors duration-300 shadow-lg z-20">
        <i class="fas fa-chevron-right"></i>
    </button>
</div>

<!-- Add Font Awesome CDN if not already included -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

