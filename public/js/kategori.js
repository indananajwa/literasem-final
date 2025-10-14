// Global variables
let kategoriData = {};
let fieldRules = {};
let tourData = [];
let detailSection = null;
let templateType = 'default';

// Export functions
window.changeContent = changeContent;
window.handleSearch = handleSearch;
window.performSearch = performSearch;
window.scrollToMenuSection = scrollToMenuSection;
window.scrollToSection = scrollToSection;
window.scrollLeft = scrollLeft;
window.scrollRight = scrollRight;
window.updateScrollButtons = updateScrollButtons;
window.toggleReadMore = toggleReadMore;

// Initialize data
function initializeData(kategoriDataFromPHP, fieldRulesFromPHP, tourDataFromPHP) {
    kategoriData = kategoriDataFromPHP || {};
    fieldRules = fieldRulesFromPHP || {};
    tourData = tourDataFromPHP || [];
    
    templateType = (fieldRules.tampilan === '1') ? 'card' : 'default';
    
    if (templateType === 'card') {
        detailSection = document.getElementById("food-list");
    } else {
        detailSection = document.getElementById("detail-section");
    }
    
    console.log('=== DEBUG DATA ===');
    console.log('kategoriData:', kategoriData);
    console.log('fieldRules:', fieldRules);
    console.log('tourData:', tourData);
    console.log('templateType:', templateType);
}

// YouTube video ID extractor
function getYouTubeVideoId(url) {
    if (!url) return null;
    let videoId = null;
    if (url.includes('youtu.be/')) {
        videoId = url.split('youtu.be/')[1];
    } else if (url.includes('youtube.com/')) {
        const urlParams = new URLSearchParams(new URL(url).search);
        videoId = urlParams.get('v');
    }
    if (videoId) {
        videoId = videoId.split('?')[0];
        videoId = videoId.split('&')[0];
    }
    return videoId;
}

// Create main content (video or image)
function createMainContent(tour) {
    const hasVideo = tour.video && getYouTubeVideoId(tour.video);
    const hasImage = tour.images && tour.images.length > 0;

    if (hasVideo) {
        const videoId = getYouTubeVideoId(tour.video);
        return `
            <div class="relative w-full pt-[56.25%]">
                <iframe
                    id="largeContent-${tour.id}"
                    class="absolute inset-0 w-full h-full rounded-lg"
                    src="https://www.youtube.com/embed/${videoId}"
                    title="${tour.name} Video"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                ></iframe>
            </div>
        `;
    } else if (hasImage) {
        return `
            <img 
                id="largeContent-${tour.id}"
                src="${tour.images[0]}"
                alt="${tour.name}"
                class="w-full h-auto max-h-[300px] object-contain rounded-lg"
            >
        `;
    } else {
        return `
            <div class="w-full h-64 flex flex-col items-center justify-center bg-gray-50 border-2 border-dashed border-gray-300 rounded-xl shadow-sm mx-auto text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mb-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l6 6-6 6M21 7l-6 6 6 6"/>
                </svg>
                <span class="text-lg font-medium text-gray-600">Tidak ada gambar atau video</span>
            </div>
        `;
    }
}

// ===== HELPER: Create tour card HTML (consistent for both render & search)
function createTourCardHTML(tour) {
    const hasVideo = tour.video && getYouTubeVideoId(tour.video);
    const hasImages = tour.images && tour.images.length > 0;
    const totalContent = (hasImages ? tour.images.length : 0) + (hasVideo ? 1 : 0);
    const shouldShowThumbnails = totalContent > 1;
    
    const mainContent = createMainContent(tour);
    const showMedia = hasImages || hasVideo || fieldRules.image === 'required';
    
    // Create tour JSON safely (escaped)
    const tourJsonEscaped = encodeURIComponent(JSON.stringify(tour));
    
    return `
    <div class="flex flex-col md:flex-row items-start gap-6 bg-white shadow-lg rounded-lg p-6">
        <div class="grid grid-cols-1 md:grid-cols-[480px_1fr] gap-6 items-start w-full">
            ${showMedia ? `
            <div class="flex flex-col w-full">
                <div class="w-full max-w-full rounded-lg overflow-hidden bg-white">
                    <div id="content-container-${tour.id}">
                        ${mainContent}
                    </div>
                </div>
            
                ${shouldShowThumbnails ? `
                <div class="flex flex-wrap gap-2 mt-3">
                    ${hasVideo ? `
                        <div 
                            class="thumbnail w-20 h-20 rounded-md border border-gray-300 shadow-md cursor-pointer hover:scale-105 hover:border-blue-500 transition-transform relative overflow-hidden"
                            data-change-content
                            data-tour-id="${tour.id}"
                            data-type="video"
                            data-src="${tour.video}"
                        >
                            <img 
                                src="https://img.youtube.com/vi/${getYouTubeVideoId(tour.video)}/mqdefault.jpg"
                                alt="Video Thumbnail"
                                class="w-full h-full object-cover"
                            >
                            <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                        </div>
                    ` : ''}
                    
                    ${hasImages ? tour.images.map((img, index) => `
                        <img 
                            class="thumbnail w-20 h-20 rounded-md border border-gray-300 shadow-md cursor-pointer hover:scale-105 hover:border-blue-500 transition-transform object-cover" 
                            src="${img}" 
                            alt="${tour.name} ${index + 1}"
                            data-change-content
                            data-tour-id="${tour.id}"
                            data-type="image"
                            data-src="${img}"
                        >
                    `).join('') : ''}
                </div>
                ` : ''}
            </div>
            ` : ''}
                    
            <div class="flex flex-col justify-start">
                <h3 class="text-3xl font-semibold text-red-800 mb-4">${tour.name}</h3>
                <p class="text-lg text-gray-700 text-justify mb-8">${tour.description}</p>
                
                <button 
                    class="flex items-center gap-2 px-4 py-2 bg-amber-500 text-white rounded-lg hover:bg-amber-600 transition-colors duration-200 w-fit bookmark-btn"
                    data-tour-json="${tourJsonEscaped}"
                >
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2z"/>
                    </svg>
                    Bookmark
                </button>
            </div>
        </div>
    </div>
    `;
}


function changeContent(tourId, type, src) {
    const container = document.getElementById(`content-container-${tourId}`);
    if (!container) return;
    
    if (type === 'video') {
        const videoId = getYouTubeVideoId(src);
        container.innerHTML = `
            <div class="relative w-full pb-[56.25%]">
                <iframe
                    id="largeContent-${tourId}"
                    class="absolute inset-0 w-full h-full rounded-lg shadow-md"
                    src="https://www.youtube.com/embed/${videoId}"
                    title="YouTube Video"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                ></iframe>
            </div>
        `;
    } else {
        container.innerHTML = `
            <img 
                id="largeContent-${tourId}"
                src="${src}"
                alt="Main Image"
                class="w-full h-auto max-h-[300px] object-contain rounded-lg"
            >
        `;
    }
}


function renderTourData() {
    if (!tourData || !detailSection || templateType === 'card') return;
    
    detailSection.innerHTML = "";

    tourData.forEach(tour => {
        const detailItem = document.createElement("div");
        detailItem.innerHTML = createTourCardHTML(tour);
        detailSection.appendChild(detailItem);
    });
    
    // Attach event listeners AFTER DOM is created
    attachDefaultTemplateListeners();
}


function attachDefaultTemplateListeners() {
    if (!detailSection) return;
    
    // Delegate: Change content on thumbnail click
    detailSection.addEventListener('click', (e) => {
        const thumbnail = e.target.closest('[data-change-content]');
        if (thumbnail) {
            const tourId = thumbnail.dataset.tourId;
            const type = thumbnail.dataset.type;
            const src = thumbnail.dataset.src;
            changeContent(tourId, type, src);
        }
    });
    
    // Delegate: Bookmark button
    detailSection.addEventListener('click', (e) => {
        const bookmarkBtn = e.target.closest('.bookmark-btn');
        if (bookmarkBtn) {
            const tourJson = decodeURIComponent(bookmarkBtn.dataset.tourJson);
            const tour = JSON.parse(tourJson);
            addToBookmark(tour);
        }
    });
}

// Render card grid (untuk template card)
function renderCardGrid() {
    if (!tourData || !detailSection || templateType !== 'card') return;
    
    detailSection.innerHTML = '';

    tourData.forEach(tour => {
        const tourCard = document.createElement("div");
        tourCard.classList.add("bg-white", "p-4", "rounded-lg", "shadow-md", "hover:bg-red-800", "hover:text-white", "transition", "group");

        const imageUrl = tour.images && tour.images.length > 0 
            ? tour.images[0] 
            : 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjY2NjIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxOCIgZmlsbD0iIzk5OSIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPk5vIEltYWdlPC90ZXh0Pjwvc3ZnPg==';

        const shortDesc = tour.description ? 
            (tour.description.length > 100 ? tour.description.substring(0, 100) + '...' : tour.description) : 
            'No description available';
        
        const fullDesc = tour.description || 'No description available';
        const tourJsonEscaped = encodeURIComponent(JSON.stringify(tour));

        tourCard.innerHTML = `
            <img src="${imageUrl}" alt="${tour.name || 'Tour Item'}" class="w-full h-48 object-cover rounded-md">
            <h2 class="text-xl font-bold mt-4 group-hover:text-white">${tour.name || 'Unnamed Tour'}</h2>
            <p class="text-gray-700 mt-2 short-desc group-hover:text-white">${shortDesc}</p>
            <p class="text-gray-700 mt-2 full-desc hidden group-hover:text-white text-justify">${fullDesc}</p>
            <button class="text-blue-500 mt-2 read-more group-hover:text-white" onclick="toggleReadMore(this)">Read More</button>
            <div class="flex justify-end">
                <button 
                    class="flex items-center gap-1.5 px-3 py-1.5 bg-amber-500 text-white rounded-lg hover:bg-amber-600 transition-colors duration-200 w-fit text-sm bookmark-btn-card"
                    data-tour-json="${tourJsonEscaped}"
                >
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2z"/>
                    </svg>
                    Bookmark
                </button>
            </div>
        `;

        detailSection.appendChild(tourCard);
    });
    
    // Attach listeners for card template
    attachCardTemplateListeners();
}

function attachCardTemplateListeners() {
    if (!detailSection) return;
    
    detailSection.addEventListener('click', (e) => {
        const bookmarkBtn = e.target.closest('.bookmark-btn-card');
        if (bookmarkBtn) {
            const tourJson = decodeURIComponent(bookmarkBtn.dataset.tourJson);
            const tour = JSON.parse(tourJson);
            addToBookmark(tour);
        }
    });
}

// Toggle read more for card template
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

// Load tour items untuk highlight section
function loadTourItems() {
    const tourItemsContainer = document.getElementById("tour-items");
    if (!tourItemsContainer) return;
    
    tourItemsContainer.innerHTML = tourData.map(tour => {
        const imageUrl = tour.images && tour.images.length > 0 
            ? tour.images[0] 
            : 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjY2NjIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxOCIgZmlsbD0iIzk5OSIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPk5vIEltYWdlPC90ZXh0Pjwvc3ZnPg==';
        
        return `
        <div class="tour-item relative h-80 min-w-[300px] flex-shrink-0 rounded-lg transform transition-transform duration-300 hover:scale-105 hover:shadow-xl">
            <img 
                src="${imageUrl}" 
                alt="${tour.name}" 
                class="absolute inset-0 w-full h-full object-cover rounded-lg cursor-pointer" 
                onclick="scrollToSection('${tour.id}')"
            >
            <div class="absolute inset-0 bg-black bg-opacity-50 rounded-lg"></div>
            <div class="absolute inset-0 flex flex-col items-center justify-end pb-4 z-10">
                <h2 class="text-xl font-bold text-white mb-2 text-center px-4">${tour.name}</h2>
                <button 
                    onclick="scrollToSection('${tour.id}')"
                    class="text-white underline hover:text-yellow-400 transition-colors duration-300 font-medium"
                >
                    View Detail
                </button>
            </div>
        </div>
    `;
    }).join('');

    updateScrollButtons();
}

function handleSearch() {
    const searchTerm = document.getElementById('search-bar').value.toLowerCase();
    
    const filteredData = tourData.filter(tour => 
        tour.name.toLowerCase().includes(searchTerm) || 
        tour.description.toLowerCase().includes(searchTerm)
    );
    
    if (templateType === 'card') {
        handleCardSearch();
    } else {
        handleDefaultSearch(filteredData);
    }
}

function handleCardSearch() {
    const searchBar = document.getElementById('search-bar');
    if (!searchBar) return;
    
    const searchValue = searchBar.value.toLowerCase();
    const tourCards = document.querySelectorAll('#food-list > div');
    
    tourCards.forEach(item => {
        const itemName = item.querySelector('h2').textContent.toLowerCase();
        const itemDesc = item.querySelector('.short-desc').textContent.toLowerCase();
        
        if (itemName.includes(searchValue) || itemDesc.includes(searchValue)) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}

function handleDefaultSearch(filteredData) {
    if (!detailSection) return;
    
    detailSection.innerHTML = "";
    
    filteredData.forEach(tour => {
        const detailItem = document.createElement("div");
        detailItem.innerHTML = createTourCardHTML(tour);
        detailSection.appendChild(detailItem);
    });
    
    // Re-attach event listeners for search results
    attachDefaultTemplateListeners();
}

function performSearch() {
    handleSearch();
}

// Navigation functions
function scrollToMenuSection() {
    const menuSection = document.getElementById("menu-section");
    if (menuSection) {
        menuSection.scrollIntoView({ behavior: 'smooth' });
    } else {
        const detailElement = document.getElementById("detail-section") || document.getElementById("menu-section");
        if (detailElement) {
            detailElement.scrollIntoView({ behavior: 'smooth' });
        }
    }
}

function scrollToSection(sectionId) {
    const element = document.getElementById(sectionId);
    if (element) {
        element.scrollIntoView({ 
            behavior: 'smooth',
            block: 'center'
        });
    }
}

// Scroll button functions
function updateScrollButtons() {
    const container = document.getElementById("tour-items");
    if (!container) return;
    
    const leftButton = document.getElementById("scroll-left");
    const rightButton = document.getElementById("scroll-right");
    
    if (leftButton) {
        leftButton.style.display = container.scrollLeft <= 0 ? "none" : "block";
    }
    
    if (rightButton) {
        const canScrollRight = container.scrollWidth > (container.scrollLeft + container.clientWidth);
        rightButton.style.display = canScrollRight ? "block" : "none";
    }
}

function scrollLeft() {
    const container = document.getElementById("tour-items");
    if (!container) return;
    
    const scrollAmount = container.clientWidth * 0.8;
    container.scrollBy({
        left: -scrollAmount,
        behavior: 'smooth'
    });
    
    setTimeout(updateScrollButtons, 300);
}

function scrollRight() {
    const container = document.getElementById("tour-items");
    if (!container) return;
    
    const scrollAmount = container.clientWidth * 0.8;
    container.scrollBy({
        left: scrollAmount,
        behavior: 'smooth'
    });
    
    setTimeout(updateScrollButtons, 300);
}

// Initialize the page
function initializePage() {
    if (templateType === 'card') {
        renderCardGrid();
    } else {
        renderTourData();
    }
    loadTourItems();
    
    const container = document.getElementById("tour-items");
    if (container) {
        container.addEventListener('scroll', updateScrollButtons);
        updateScrollButtons();
    }
}

// Event listener
document.addEventListener('DOMContentLoaded', () => {
    if (typeof window.kategoriDataFromPHP !== 'undefined') {
        initializeData(
            window.kategoriDataFromPHP,
            window.fieldRulesFromPHP,
            window.tourDataFromPHP
        );
        initializePage();
    }
});

// Bookmark functionality (tetap sama seperti sebelumnya)
function addToBookmark(tour) {
    initializeModal();
    
    try {
        let bookmarks = JSON.parse(localStorage.getItem('literasem_bookmarks')) || [];

        const exists = bookmarks.some(b => b.id === tour.id);
        if (exists) {
            showErrorModal('Konten ini sudah ada di daftar bookmark Anda.', 'duplicate');
            return;
        }

        const newBookmark = {
            id: tour.id,
            name: tour.name,
            description: tour.description || '',
            url: window.location.href + '#' + tour.id,
            category: kategoriData.nama_kategori || 'Tidak Diketahui',
            dateAdded: new Date().toISOString(),
            images: tour.images || [],
            video: tour.video || null
        };

        bookmarks.push(newBookmark);
        localStorage.setItem('literasem_bookmarks', JSON.stringify(bookmarks));
        
        showSuccessModal(tour);
        
    } catch (error) {
        console.error('Gagal menyimpan bookmark:', error);
        showErrorModal('Gagal menyimpan bookmark. Silakan coba lagi.', 'error');
    }
}

function createModalHTML() {
    return `
        <div id="bookmark-modal" class="fixed inset-0 z-50 hidden">
            <div class="absolute inset-0 bg-black bg-opacity-50 backdrop-blur-sm transition-opacity duration-300"></div>
            <div class="flex items-center justify-center min-h-screen p-4">
                <div id="modal-content" class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all duration-300 scale-95 opacity-0">
                    <button id="close-modal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                    <div id="modal-body" class="p-8"></div>
                </div>
            </div>
        </div>
    `;
}

function initializeModal() {
    if (!document.getElementById('bookmark-modal')) {
        document.body.insertAdjacentHTML('beforeend', createModalHTML());
        
        const modal = document.getElementById('bookmark-modal');
        const closeBtn = document.getElementById('close-modal');
        const backdrop = modal.querySelector('.absolute.inset-0');
        
        closeBtn.addEventListener('click', closeModal);
        backdrop.addEventListener('click', closeModal);
        
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeModal();
            }
        });
    }
}

function showModal() {
    const modal = document.getElementById('bookmark-modal');
    const modalContent = document.getElementById('modal-content');
    
    modal.classList.remove('hidden');
    
    setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeModal() {
    const modal = document.getElementById('bookmark-modal');
    const modalContent = document.getElementById('modal-content');
    
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

function showSuccessModal(tour) {
    const modalBody = document.getElementById('modal-body');
    modalBody.innerHTML = `
        <div class="text-center">
            <div class="mx-auto flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                <svg class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2z"/>
                </svg>
            </div>
            
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Bookmark Berhasil Disimpan!</h3>
            
            <p class="text-gray-600 mb-6">
                <strong>${tour.name}</strong> telah berhasil ditambahkan ke daftar bookmark Anda.
            </p>
            
            <div class="flex gap-3">
                <button onclick="closeModal()" class="flex-1 bg-gray-100 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-200 transition-colors">
                    Tutup
                </button>
                <button onclick="viewBookmarks()" class="flex-1 bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 transition-colors">
                    Lihat Bookmark
                </button>
            </div>
        </div>
    `;
    showModal();
}

function showErrorModal(message, type = 'duplicate') {
    const modalBody = document.getElementById('modal-body');
    
    const iconColor = type === 'duplicate' ? 'text-amber-500' : 'text-red-500';
    const bgColor = type === 'duplicate' ? 'bg-amber-100' : 'bg-red-100';
    const title = type === 'duplicate' ? 'Sudah Ada di Bookmark' : 'Terjadi Kesalahan';
    
    modalBody.innerHTML = `
        <div class="text-center">
            <div class="mx-auto flex items-center justify-center w-16 h-16 ${bgColor} rounded-full mb-4">
                ${type === 'duplicate' ? `
                    <svg class="w-8 h-8 ${iconColor}" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                ` : `
                    <svg class="w-8 h-8 ${iconColor}" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                    </svg>
                `}
            </div>
            
            <h3 class="text-xl font-semibold text-gray-900 mb-2">${title}</h3>
            
            <p class="text-gray-600 mb-6">${message}</p>
            
            <div class="flex gap-3">
                <button onclick="closeModal()" class="flex-1 bg-gray-100 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-200 transition-colors">
                    Tutup
                </button>
                ${type === 'duplicate' ? `
                    <button onclick="viewBookmarks()" class="flex-1 bg-amber-500 text-white py-2 px-4 rounded-lg hover:bg-amber-600 transition-colors">
                        Lihat Bookmark
                    </button>
                ` : ''}
            </div>
        </div>
    `;
    showModal();
}

function viewBookmarks() {
    closeModal();
    window.location.href = '/bookmark';
}

// Make functions globally available
window.addToBookmark = addToBookmark;
window.closeModal = closeModal;
window.viewBookmarks = viewBookmarks;

// Initialize modal when DOM is loaded
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeModal);
} else {
    initializeModal();
}

