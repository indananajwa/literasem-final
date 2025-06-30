<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookmark Saya - Literasem</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .bookmark-card {
            transition: all 0.3s ease;
        }
        .bookmark-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .bookmark-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.5rem;
        }
        .filter-btn {
            transition: all 0.2s ease;
        }
        .filter-btn.active {
            background-color: #dc2626;
            color: white;
        }
        .empty-state {
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        }
        .modal {
            transition: all 0.3s ease;
        }
        .modal-backdrop {
            backdrop-filter: blur(4px);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen pt-12">
    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 bg-white shadow-sm border-b z-50">
        <div class="container mx-auto px-4 py-2">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <button onclick="window.history.back()" class="text-gray-600 hover:text-gray-800 transition-colors">
                        <i class="fas fa-arrow-left text-lg"></i>
                    </button>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">Bookmark Saya</h1>
                        <p class="text-xs text-gray-600">
                            <span class="bookmark-count">0</span> item tersimpan
                        </p>
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="flex items-center space-x-2">
                    <button id="clear-all-btn" class="px-2 py-1 text-xs bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                        <i class="fas fa-trash mr-1"></i>Hapus Semua
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Search and Filter -->
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <!-- Search Bar -->
            <div class="flex flex-col sm:flex-row gap-4 mb-4">
                <div class="flex-1">
                    <div class="relative">
                        <input 
                            type="text" 
                            id="search-input" 
                            placeholder="Cari bookmark Anda..." 
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                        >
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>
                <button id="search-btn" class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    Cari
                </button>
            </div>

            <!-- Category Filter -->
            <div class="flex flex-wrap gap-2" id="category-filters">
                <button class="filter-btn active px-4 py-2 text-sm border border-gray-300 rounded-full hover:bg-gray-100" data-category="all">
                    Semua Kategori
                </button>
                <!-- Dynamic category buttons will be inserted here -->
            </div>
        </div>

        <!-- Bookmarks Grid -->
        <div id="bookmarks-container">
            <div id="bookmarks-grid" class="bookmark-grid">
                <!-- Bookmark cards will be inserted here -->
            </div>

            <!-- Empty State -->
            <div id="empty-state" class="empty-state rounded-lg p-12 text-center hidden">
                <div class="max-w-md mx-auto">
                    <div class="w-24 h-24 bg-gray-300 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-bookmark text-3xl text-gray-500"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Bookmark</h3>
                    <p class="text-gray-500 mb-6">Mulai jelajahi dan simpan destinasi serta konten favorit Anda!</p>
                    <button onclick="window.location.href='/'" class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                        Jelajahi Konten
                    </button>
                </div>
            </div>

            <!-- No Results State -->
            <div id="no-results-state" class="text-center py-12 hidden">
                <div class="max-w-md mx-auto">
                    <i class="fas fa-search text-4xl text-gray-400 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Tidak Ada Hasil</h3>
                    <p class="text-gray-500">Coba sesuaikan kata kunci pencarian atau filter Anda.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Popup -->
    <div id="modal" class="fixed inset-0 z-50 hidden modal">
        <div class="modal-backdrop fixed inset-0 bg-black bg-opacity-50"></div>
        <div class="relative max-w-md mx-auto mt-20 bg-white rounded-lg shadow-xl p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 id="modal-title" class="text-lg font-semibold text-gray-800"></h3>
                <button id="modal-close" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <p id="modal-message" class="text-gray-600 mb-6"></p>
            <div class="flex justify-end space-x-3">
                <button id="modal-cancel" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    Batal
                </button>
                <button id="modal-confirm" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    Konfirmasi
                </button>
            </div>
        </div>
    </div>

    <!-- Hidden File Input -->
    <input type="file" id="import-file-input" accept=".json" style="display: none;">

    <!-- Scripts -->
    <script>
        class BookmarkPage {
            constructor() {
                this.bookmarks = this.loadBookmarks();
                this.filteredBookmarks = [...this.bookmarks];
                this.currentCategory = 'all';
                this.currentSearch = '';
                
                this.initializeEventListeners();
                this.renderCategories();
                this.renderBookmarks();
                this.updateBookmarkCount();
            }

            loadBookmarks() {
                try {
                    const saved = localStorage.getItem('literasem_bookmarks');
                    return saved ? JSON.parse(saved) : [];
                } catch (error) {
                    console.error('Error memuat bookmark:', error);
                    return [];
                }
            }

            saveBookmarks() {
                try {
                    localStorage.setItem('literasem_bookmarks', JSON.stringify(this.bookmarks));
                } catch (error) {
                    console.error('Error menyimpan bookmark:', error);
                }
            }

            initializeEventListeners() {
                // Search
                const searchInput = document.getElementById('search-input');
                const searchBtn = document.getElementById('search-btn');
                
                searchInput.addEventListener('input', () => {
                    clearTimeout(this.searchTimeout);
                    this.searchTimeout = setTimeout(() => {
                        this.handleSearch();
                    }, 300);
                });
                
                searchBtn.addEventListener('click', () => this.handleSearch());

                // Category filters
                document.addEventListener('click', (e) => {
                    if (e.target.classList.contains('filter-btn')) {
                        this.handleCategoryFilter(e.target);
                    }
                });

                // Actions
                document.getElementById('clear-all-btn').addEventListener('click', () => this.showConfirmModal(
                    'Hapus Semua Bookmark',
                    'Apakah Anda yakin ingin menghapus semua bookmark? Tindakan ini tidak dapat dibatalkan.',
                    () => this.clearAllBookmarks()
                ));
                document.getElementById('import-file-input').addEventListener('change', (e) => this.handleFileImport(e));

                // Remove bookmark
                document.addEventListener('click', (e) => {
                    if (e.target.closest('.remove-bookmark-btn')) {
                        const bookmarkId = e.target.closest('.remove-bookmark-btn').dataset.bookmarkId;
                        this.showConfirmModal(
                            'Hapus Bookmark',
                            'Apakah Anda yakin ingin menghapus bookmark ini?',
                            () => this.removeBookmark(bookmarkId)
                        );
                    }
                });

                // Modal controls
                document.getElementById('modal-close').addEventListener('click', () => this.hideModal());
                document.getElementById('modal-cancel').addEventListener('click', () => this.hideModal());
            }

            handleSearch() {
                this.currentSearch = document.getElementById('search-input').value.trim();
                this.filterBookmarks();
            }

            handleCategoryFilter(button) {
                document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
                
                this.currentCategory = button.dataset.category;
                this.filterBookmarks();
            }

            filterBookmarks() {
                let filtered = [...this.bookmarks];
                
                if (this.currentCategory !== 'all') {
                    filtered = filtered.filter(bookmark => 
                        bookmark.category.toLowerCase() === this.currentCategory.toLowerCase()
                    );
                }
                
                if (this.currentSearch) {
                    const searchTerm = this.currentSearch.toLowerCase();
                    filtered = filtered.filter(bookmark => 
                        bookmark.name.toLowerCase().includes(searchTerm) ||
                        bookmark.description.toLowerCase().includes(searchTerm) ||
                        bookmark.category.toLowerCase().includes(searchTerm)
                    );
                }
                
                this.filteredBookmarks = filtered;
                this.renderBookmarks();
            }

            renderCategories() {
                const categories = [...new Set(this.bookmarks.map(b => b.category))];
                const categoryFilters = document.getElementById('category-filters');
                
                const allButton = categoryFilters.querySelector('[data-category="all"]');
                categoryFilters.innerHTML = '';
                categoryFilters.appendChild(allButton);
                
                categories.forEach(category => {
                    if (category && category !== 'Tidak Diketahui') {
                        const button = document.createElement('button');
                        button.className = 'filter-btn px-4 py-2 text-sm border border-gray-300 rounded-full hover:bg-gray-100';
                        button.setAttribute('data-category', category);
                        button.textContent = category;
                        categoryFilters.appendChild(button);
                    }
                });
            }

            renderBookmarks() {
                const container = document.getElementById('bookmarks-grid');
                const emptyState = document.getElementById('empty-state');
                const noResultsState = document.getElementById('no-results-state');
                
                container.innerHTML = '';
                emptyState.classList.add('hidden');
                noResultsState.classList.add('hidden');
                
                if (this.bookmarks.length === 0) {
                    emptyState.classList.remove('hidden');
                    return;
                }
                
                if (this.filteredBookmarks.length === 0) {
                    noResultsState.classList.remove('hidden');
                    return;
                }
                
                this.filteredBookmarks.forEach(bookmark => {
                    const card = this.createBookmarkCard(bookmark);
                    container.appendChild(card);
                });
            }

            createBookmarkCard(bookmark) {
                const card = document.createElement('div');
                card.className = 'bookmark-card bg-white rounded-lg shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden';
                
                const imageUrl = bookmark.images && bookmark.images.length > 0 
                    ? bookmark.images[0] 
                    : 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjY2NjIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxOCIgZmlsbD0iIzk5OSIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPlRpbWFkYSBHYW1iYXI8L3RleHQ+PC9zdmc+';
                
                const shortDescription = bookmark.description.length > 120 
                    ? bookmark.description.substring(0, 120) + '...' 
                    : bookmark.description;
                
                const dateAdded = new Date(bookmark.dateAdded).toLocaleDateString('id-ID', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric'
                });
                
                card.innerHTML = `
                    <div class="relative">
                        <img src="${imageUrl}" alt="${bookmark.name}" class="w-full h-48 object-cover">
                        <div class="absolute top-3 right-3 flex space-x-2">
                            <button class="remove-bookmark-btn bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition" 
                                    data-bookmark-id="${bookmark.id}" title="Hapus bookmark">
                                <i class="fas fa-times text-sm"></i>
                            </button>
                        </div>
                        ${bookmark.video ? `
                            <div class="absolute top-3 left-3 bg-black bg-opacity-50 text-white px-2 py-1 rounded text-xs">
                                <i class="fas fa-play mr-1"></i>Video
                            </div>
                        ` : ''}
                    </div>
                    
                    <div class="p-4">
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="text-lg font-semibold text-gray-800 line-clamp-2">${bookmark.name}</h3>
                        </div>
                        
                        <p class="text-gray-600 text-sm mb-3 line-clamp-3">${shortDescription}</p>
                        
                        <div class="flex items-center justify-between text-xs text-gray-500 mb-3">
                            <span class="bg-gray-100 px-2 py-1 rounded">${bookmark.category}</span>
                            <span>${dateAdded}</span>
                        </div>
                        
                        <div class="flex space-x-2">
                            <button onclick="window.open('${bookmark.url}', '_blank')" 
                                    class="flex-1 bg-red-600 text-white py-2 px-3 rounded text-sm hover:bg-red-700 transition">
                                <i class="fas fa-external-link-alt mr-1"></i>
                                Kunjungi
                            </button>
                            ${bookmark.images && bookmark.images.length > 0 ? `
                                <button onclick="this.parentElement.parentElement.querySelector('.bookmark-images').classList.toggle('hidden')" 
                                        class="bg-gray-100 text-gray-600 py-2 px-3 rounded text-sm hover:bg-gray-200 transition">
                                    <i class="fas fa-images"></i>
                                </button>
                            ` : ''}
                        </div>
                        
                        ${bookmark.images && bookmark.images.length > 1 ? `
                            <div class="bookmark-images hidden mt-3 pt-3 border-t">
                                <div class="grid grid-cols-3 gap-2">
                                    ${bookmark.images.slice(0, 6).map(img => `
                                        <img src="${img}" alt="Gambar bookmark" 
                                             class="w-full h-16 object-cover rounded cursor-pointer hover:opacity-80 transition"
                                             onclick="window.open('${img}', '_blank')">
                                    `).join('')}
                                </div>
                            </div>
                        ` : ''}
                    </div>
                `;
                
                return card;
            }

            showConfirmModal(title, message, confirmCallback) {
                const modal = document.getElementById('modal');
                document.getElementById('modal-title').textContent = title;
                document.getElementById('modal-message').textContent = message;
                
                const confirmBtn = document.getElementById('modal-confirm');
                const newConfirmBtn = confirmBtn.cloneNode(true);
                confirmBtn.parentNode.replaceChild(newConfirmBtn, confirmBtn);
                
                newConfirmBtn.addEventListener('click', () => {
                    confirmCallback();
                    this.hideModal();
                });
                
                modal.classList.remove('hidden');
                modal.classList.add('flex', 'items-center', 'justify-center');
            }

            hideModal() {
                const modal = document.getElementById('modal');
                modal.classList.add('hidden');
                modal.classList.remove('flex', 'items-center', 'justify-center');
            }

            removeBookmark(id) {
                this.bookmarks = this.bookmarks.filter(b => b.id != id);
                this.saveBookmarks();
                this.filterBookmarks();
                this.updateBookmarkCount();
                this.showNotification('Bookmark berhasil dihapus!', 'success');
            }

            updateBookmarkCount() {
                document.querySelector('.bookmark-count').textContent = this.bookmarks.length;
            }

            
            clearAllBookmarks() {
                this.bookmarks = [];
                this.filteredBookmarks = [];
                this.saveBookmarks();
                this.renderCategories();
                this.renderBookmarks();
                this.updateBookmarkCount();
                this.showNotification('Semua bookmark berhasil dihapus!', 'success');
            }

            showNotification(message, type = 'info') {
                const existing = document.querySelector('.bookmark-notification');
                if (existing) {
                    existing.remove();
                }

                const notification = document.createElement('div');
                notification.className = `bookmark-notification fixed top-4 right-4 z-50 px-4 py-3 rounded-lg shadow-lg transition-all duration-300 ${
                    type === 'success' ? 'bg-green-500 text-white' : 
                    type === 'error' ? 'bg-red-500 text-white' : 
                    'bg-blue-500 text-white'
                }`;
                notification.textContent = message;

                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.style.opacity = '0';
                    notification.style.transform = 'translateX(100%)';
                    setTimeout(() => notification.remove(), 300);
                }, 3000);
            }
        }

        const bookmarkPage = new BookmarkPage();
    </script>
</body>
</html>