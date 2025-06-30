function changeVideo(videoNumber) {
    const videoFrame = document.getElementById('videoFrame');
    const videoTitle = document.getElementById('videoTitle');
    const videoDescription = document.getElementById('videoDescription');

    if (videoNumber === 1) {
        videoFrame.src = "https://www.youtube.com/embed/79fpUpJFtXM";
        videoTitle.textContent = "Pertempuran 5 Hari Semarang";
        videoDescription.textContent = "Mengupas kisah heroik di balik Pertempuran 5 Hari di Semarang, perjuangan rakyat mempertahankan kemerdekaan dari ancaman penjajah. Saksikan bagaimana semangat juang para pahlawan tetap dikenang hingga hari ini.";
    } else if (videoNumber === 2) {
        videoFrame.src = "https://www.youtube.com/embed/placeholder"; // Placeholder YouTube URL
        videoTitle.textContent = "Kota Lama Dinas Arsip dan Perpustakaan Kota Semarang";
        videoDescription.textContent = "Mengungkap sejarah dan pesona Kota Lama Semarang, sebuah kawasan bersejarah yang penuh cerita dan keindahan.";
    }
}

const description = document.getElementById('description');
const readMoreBtn = document.getElementById('readMoreBtn');
const fullText = description.textContent;
const truncatedText = fullText.substring(0, 150) + '...';

description.textContent = truncatedText;

function toggleReadMore() {
    if (description.textContent === truncatedText) {
        description.textContent = fullText;
        readMoreBtn.textContent = 'Read Less';
    } else {
        description.textContent = truncatedText;
        readMoreBtn.textContent = 'Read More';
    }
}

function showSection(sectionId) {
    const pastPresentSection = document.getElementById('past-present-section');
    const futureSection = document.getElementById('future-section');
    const btnPastPresent = document.getElementById('btnPastPresent');
    const btnFuture = document.getElementById('btnFuture');

    if (sectionId === 'past-present') {
        pastPresentSection.classList.remove('hidden');
        futureSection.classList.add('hidden');
        btnPastPresent.classList.remove('bg-gray-200', 'text-gray-700');
        btnPastPresent.classList.add('bg-red-800', 'text-white');
        btnFuture.classList.remove('bg-red-800', 'text-white');
        btnFuture.classList.add('bg-gray-200', 'text-gray-700');
    } else {
        pastPresentSection.classList.add('hidden');
        futureSection.classList.remove('hidden');
        btnFuture.classList.remove('bg-gray-200', 'text-gray-700');
        btnFuture.classList.add('bg-red-800', 'text-white');
        btnPastPresent.classList.remove('bg-red-800', 'text-white');
        btnPastPresent.classList.add('bg-gray-200', 'text-gray-700');
    }
}

let currentSlide = 0;
const slides = [
    {
        past: {
            img: "/smg-masa-lalu-sekarang/lawangsewutahun1930.jpg",
            caption: "Lawang Sewu 1930"
        },
        present: {
            img: "/smg-masa-lalu-sekarang/lawangsewu2024.jpg",
            caption: "Lawang Sewu 2024"
        },
        title: "Lawang Sewu",
        description: "Lawang Sewu adalah gedung bersejarah milik PT Kereta Api Indonesia (Persero) yang awalnya digunakan sebagai Kantor Pusat perusahaan kereta api swasta Nederlandsch-Indische Spoorweg Maatschappij (NISM). Gedung Lawang Sewu dibangun secara bertahap di atas lahan seluas 18.232 m2. Bangunan utama dimulai pada 27 Februari 1904 dan selesai pada Juli 1907. Sedangkan bangunan tambahan dibangun sekitar tahun 1916 dan selesai tahun 1918."
    },
    {
        past: {
            img: "/smg-masa-lalu-sekarang/stasiunsemarangnis1905.png",
            caption: "Stasiun Semarang NIS 1905"
        },
        present: {
            img: "/smg-masa-lalu-sekarang/KampungSpoorland2024.jpg",
            caption: "Sekarang Menjadi Kampung Spoorland"
        },
        title: "Stasiun Semarang NIS",
        description: "Stasiun Samarang NIS atau disebut juga Stasiun Kemidjen NIS dibangun pada 17 Juni 1864 dan dibuka untuk umum pada 10 Agustus 1867. Ini merupakan jalur pertama kereta api di Indonesia dengan rute Semarang-Tanggoeng. Kini, stasiun tersebut sudah tidak ada lagi bangunan fisik yang tersisa dan menjadi kompleks perkampungan."
    },
    {
        past: {
            img: "/smg-masa-lalu-sekarang/",
            caption: "Mercusuar Willem Tahun 1915"
        },
        present: {
            img: "/smg-masa-lalu-sekarang/",
            caption: "Mercusuar Willem Tahun 2024"
        },
        title: "Mercusuar Willem",
        description: "Menara mercusuar ini didirikan pada masa kolonial Belanda antara tahun 1879 hingga 1884. Saat ini, pengelolaannya berada di bawah Kementerian Perhubungan dan masih berfungsi secara aktif."
    },
    {
        past: {
            img: "/smg-masa-lalu-sekarang/",
            caption: "Wisma Perdamaian Tahun 1920"
        },
        present: {
            img: "/smg-masa-lalu-sekarang/",
            caption: "Wisma Perdamaian Tahun 2024"
        },
        title: "Wisma Perdamaian Semarang",
        description: "Wisma Perdamaian, dahulu dikenal sebagai Residence de Gubernur van Java’s Noordoosthoek, merupakan bangunan kolonial abad ke-19 yang menjadi tempat tinggal resmi Residen Belanda di Semarang. Setelah kemerdekaan Indonesia, bangunan ini diambil alih pemerintah dan difungsikan untuk kegiatan administrasi serta pertemuan resmi."
    },
    {
        past: {
            img: "/smg-masa-lalu-sekarang/",
            caption: "Stasiun Poncol Semarang Tahun 1927"
        },
        present: {
            img: "/smg-masa-lalu-sekarang/",
            caption: "Stasiun Poncol Semarang Tahun 2024"
        },
        title: "Stasiun Poncol Semarang",
        description: "Stasiun Semarang Poncol, yang berlokasi di daerah Poncol, Semarang, secara resmi bernama 'Semarang West' karena terletak di bagian barat kota. Dibangun untuk menggantikan Stasiun Pendrikan, stasiun ini kini melayani kereta kelas ekonomi dan campuran, melengkapi Stasiun Tawang yang melayani kereta kelas eksekutif. Stasiun ini menjadi salah satu stasiun utama di Semarang."
    },
    {
        past: {
            img: "/smg-masa-lalu-sekarang/",
            caption: "Tugu Muda"
        },
        present: {
            img: "/smg-masa-lalu-sekarang/",
            caption: "Tugu Muda"
        },
        title: "Tugu Muda",
        description: "Tugu Muda terletak di pusat Kota Semarang, di persimpangan lima jalan utama: Jalan Pandanaran, Mgr. Sugiopranoto, Imam Bonjol, Pemuda, dan dr. Sutomo. Pembangunannya dimulai pada 1951 dan diresmikan oleh Presiden Soekarno pada 20 Mei 1953. Tugu ini didirikan untuk mengenang jasa pemuda yang gugur dalam peristiwa heroik di Semarang."
    },
    {
        past: {
            img: "/smg-masa-lalu-sekarang/",
            caption: "Balai Kota Semarang"
        },
        present: {
            img: "/smg-masa-lalu-sekarang/",
            caption: "Balai Kota Semarang"
        },
        title: "Balai Kota Semarang",
        description: "Gedung Balai Kota Semarang, yang awalnya merupakan villa milik keluarga Gimberg di Jalan Pemuda No. 148, sempat digunakan sebagai kantor utama Stadsgemeente (Kotapraja) Semarang, tempat Walikota Semarang berkantor. Pada 1960-an, gedung ini dialihfungsikan untuk Dinas Pekerjaan Umum Kotamadya Semarang dengan renovasi tambahan dinding berjendela di bagian depan. Pada 1980-an, dilakukan perombakan besar dengan menutup pilar-pilar dan menambahkan kanopi bergaya Romawi kuno di bagian depan gedung."
    },
    {
        past: {
            img: "/smg-masa-lalu-sekarang/",
            caption: "Jalan Pahlawan"
        },
        present: {
            img: "/smg-masa-lalu-sekarang/",
            caption: "Jalan Pahlawan"
        },
        title: "Jalan Pahlawan",
        description: "Oei Tiong Ham weg di kawasan Candi Baru, Semarang. Sejak 1950-an seruas marga itu berganti nama menjadi jalan Pahlawan. Oei Tiong Ham, Sang Raja Candu Terakhir Dia adalah konglomerat fenomenal, sohor dengan julukan 'Raja Gula dari Semarang'. Namun, jarang orang yang mengenangnya sebagai Raja Candu Terakhir di Semarang."
    },
    {
        past: {
            img: "/smg-masa-lalu-sekarang/",
            caption: "Jalan Tanjakan Gombel"
        },
        present: {
            img: "/smg-masa-lalu-sekarang/",
            caption: "Jalan Tanjakan Gombel"
        },
        title: "Jalan Tanjakan Gombel",
        description: "Gombel pada awalnya merupakan suatu kawasan makam pecinan leluhur para etnis Tionghoa, lalu pada masa penjajahan Belanda dibangunlah jalan tersebut dengan mendapatkan perlawanan dari etnis Tionghoa karena dianggap merusak warisan leluhur."
    },
];

function showSlide(index) {
    const slide = slides[index];
    
    const pastImg = document.getElementById('pastImage');
    const presentImg = document.getElementById('presentImage');
    const pastCaption = document.getElementById('pastCaption');
    const presentCaption = document.getElementById('presentCaption');
    const slideTitle = document.getElementById('slideTitle');
    const slideDescription = document.getElementById('slideDescription');

    pastImg.style.opacity = 0;
    presentImg.style.opacity = 0;

    setTimeout(() => {
        pastImg.src = slide.past.img;
        presentImg.src = slide.present.img;
        pastCaption.innerText = slide.past.caption;
        presentCaption.innerText = slide.present.caption;
        slideTitle.innerText = slide.title;
        slideDescription.innerText = slide.description;

        pastImg.style.opacity = 1;
        presentImg.style.opacity = 1;
    }, 250);
}

function prevSlide() {
    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
    showSlide(currentSlide);
}

function nextSlide() {
    currentSlide = (currentSlide + 1) % slides.length;
    showSlide(currentSlide);
}

function playVideo(videoId) {
    const modal = document.getElementById('videoModal');
    const videoFrame = document.getElementById('videoFrame');
    
    videoFrame.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0`;
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeVideo() {
    const modal = document.getElementById('videoModal');
    const videoFrame = document.getElementById('videoFrame');
    videoFrame.src = '';
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

document.getElementById('videoModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeVideo();
    }
});

function scrollCarousel(direction) {
    const carousel = document.querySelector('.carousel');
    const carouselItems = carousel.querySelectorAll('.carousel-item');

    const itemWidth = carouselItems[0].offsetWidth;
    const scrollAmount = itemWidth * 2;

    carousel.scrollBy({
        left: direction * scrollAmount,
        behavior: 'smooth'
    });
}

document.addEventListener("DOMContentLoaded", () => {
    const sections = document.querySelectorAll("section");
    console.log("Sections found:", Array.from(sections).map(s => s.id));

    // Tambahkan kelas awal dengan penundaan
    setTimeout(() => {
        sections.forEach(section => {
            section.classList.add("opacity-0", "translate-y-10");
            section.style.overflowX = "hidden";
        });
    }, 50);

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach(entry => {
                console.log("Section:", entry.target.id, "Visible:", entry.isIntersecting);
                if (entry.isIntersecting) {
                    entry.target.classList.remove("opacity-0", "translate-y-10", "hidden");
                    entry.target.classList.add("opacity-100", "translate-y-0");
                }
            });
        },
        {
            threshold: 0.1,
            rootMargin: "50px"
        }
    );

    // Observasi section setelah penundaan
    setTimeout(() => {
        sections.forEach(section => {
            observer.observe(section);
        });
    }, 100);

    showSlide(currentSlide);
    showSection("past-present");
});