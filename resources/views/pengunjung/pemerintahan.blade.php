<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline Wali Kota Semarang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media (max-width: 768px) {
            .timeline-responsive {
                padding-left: 2.5rem;
            }
            
            .timeline-responsive .absolute {
                left: 1.25rem;
            }
            
            .timeline-responsive .w-6\/12 {
                width: calc(100% - 3.5rem);
                padding-left: 2.5rem !important;
                padding-right: 0 !important;
            }
            
            .timeline-responsive .justify-end {
                justify-content: flex-start !important;
            }
        }

        .timeline-image {
            object-fit: cover;
            width: 100%;
            height: 100%;
        }

        .timeline-placeholder {
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
        }
    </style>
</head>
<body>
    <!-- Section Pemerintahan -->
    <section id="pemerintahan" class="bg-grey-50 py-16 opacity-0 translate-y-10 transition-all duration-700">
        <div class="min-h-screen bg-gradient-to-br from-grey-50 to-grey-100 py-8">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="text-center mb-12">
                    <h1 class="text-4xl font-bold text-red-900 mb-4">
                        Timeline Wali Kota Semarang
                    </h1>
                    <p class="text-lg text-red-700 max-w-3xl mx-auto">
                        Perjalanan kepemimpinan Kota Semarang dari masa ke masa
                    </p>
                    <div class="mt-6 inline-flex items-center bg-white px-4 py-2 rounded-full shadow-sm border border-red-200">
                        <span class="text-sm font-medium text-red-800">📍 Kota Semarang, Jawa Tengah</span>
                    </div>
                </div>

                <!-- Timeline -->
                <div class="relative timeline-responsive">
                    <!-- Vertical Line -->
                    <div class="absolute left-1/2 transform -translate-x-1/2 w-1 bg-red-300 h-full"></div>
                    
                    @if($pemerintahan && count($pemerintahan) > 0)
                        @foreach ($pemerintahan as $index => $item)
                            <!-- Timeline Item {{ $index + 1 }} -->
                            <div class="relative mb-24 flex items-center {{ $index % 2 == 1 ? 'justify-end' : '' }}">
                                <!-- Timeline Dot -->
                                <div class="absolute left-1/2 transform -translate-x-1/2 w-6 h-6 bg-red-600 rounded-full border-4 border-white shadow-lg z-10"></div>
                                
                                <!-- Content Card -->
                                <div class="w-6/12 {{ $index % 2 == 1 ? 'pl-12' : 'pr-12' }}">
                                    <div class="bg-white rounded-lg shadow-lg p-8 hover:shadow-xl transition-shadow duration-300 border border-red-100">
                                        
                                        @if($item->nama_wakil_walikota)
                                            <!-- Period Header for dual leadership -->
                                            <div class="text-center mb-6">
                                                <h2 class="text-2xl font-bold text-red-900 mb-1">Periode {{ $item->periode }}</h2>
                                                <div class="w-full h-px bg-red-200 mb-4"></div>
                                            </div>

                                            <!-- Photos Side by Side -->
                                            <div class="flex justify-center gap-8 mb-6">
                                                <!-- Walikota -->
                                                <div class="text-center">
                                                    <div class="w-48 h-64 rounded-lg shadow-lg border-2 border-red-300 overflow-hidden">
                                                        @if($item->foto_walikota)
                                                            <img src="{{ route('pengunjung.pemerintahan.foto', ['periode' => $item->periode, 'type' => 'walikota']) }}" 
                                                                 alt="Foto {{ $item->nama_walikota }}" 
                                                                 class="timeline-image">
                                                        @else
                                                            <div class="timeline-placeholder w-full h-full flex items-center justify-center text-white font-bold text-5xl">
                                                                {{ strtoupper(substr($item->nama_walikota, 0, 2)) }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="mt-4 space-y-1">
                                                        <p class="text-base text-red-600 font-medium">Wali Kota</p>
                                                        <p class="text-lg font-bold text-red-900 leading-tight">{{ $item->nama_walikota }}</p>
                                                    </div>
                                                </div>

                                                <!-- Wakil Walikota -->
                                                <div class="text-center">
                                                    <div class="w-48 h-64 rounded-lg shadow-lg border-2 border-red-300 overflow-hidden">
                                                        @if($item->foto_wakil_walikota)
                                                            <img src="{{ route('admin.pemerintah.foto', ['periode' => $item->periode, 'type' => 'wakil']) }}" 
                                                                 alt="Foto {{ $item->nama_wakil_walikota }}" 
                                                                 class="timeline-image">
                                                        @else
                                                            <div class="timeline-placeholder w-full h-full flex items-center justify-center text-white font-bold text-5xl">
                                                                {{ strtoupper(substr($item->nama_wakil_walikota, 0, 2)) }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="mt-4 space-y-1">
                                                        <p class="text-base text-red-600 font-medium">Wakil Wali Kota</p>
                                                        <p class="text-lg font-bold text-red-900 leading-tight">{{ $item->nama_wakil_walikota }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <!-- Single leadership layout -->
                                            <!-- Period Badge -->
                                            <div class="text-center mb-4">
                                                <span class="bg-red-100 text-red-800 px-4 py-2 rounded-full text-xl font-semibold">
                                                    {{ $item->periode }}
                                                </span>
                                            </div>

                                            <!-- Single Photo -->
                                            <div class="flex justify-center mb-6">
                                                <div class="w-40 h-52 rounded-lg shadow-md overflow-hidden">
                                                    @if($item->foto_walikota)
                                                        <img src="{{ route('admin.pemerintah.foto', ['periode' => $item->periode, 'type' => 'walikota']) }}" 
                                                             alt="Foto {{ $item->nama_walikota }}" 
                                                             class="timeline-image">
                                                    @else
                                                        <div class="timeline-placeholder w-full h-full flex items-center justify-center text-white font-bold text-4xl">
                                                            {{ strtoupper(substr($item->nama_walikota, 0, 2)) }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Leader Info -->
                                            <div class="text-center mb-4">
                                                <h3 class="font-bold text-red-900 text-xl">{{ $item->nama_walikota }}</h3>
                                                <p class="text-red-600 font-medium text-base">Wali Kota</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- No data message -->
                        <div class="text-center py-12">
                            <div class="bg-white rounded-lg shadow-lg p-8 border border-red-100">
                                <div class="text-red-400 text-6xl mb-4">📋</div>
                                <h3 class="text-xl font-bold text-red-900 mb-2">Belum Ada Data</h3>
                                <p class="text-red-600">Data pemerintahan belum tersedia. Silakan hubungi administrator.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show the main section
            document.getElementById('pemerintahan').style.opacity = '1';
            document.getElementById('pemerintahan').style.transform = 'translateY(0)';

            // Add scroll animation
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -100px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe all timeline cards
            document.querySelectorAll('.bg-white.rounded-lg.shadow-lg').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });

            // Handle image loading errors
            document.querySelectorAll('.timeline-image').forEach(img => {
                img.onerror = function() {
                    const placeholder = document.createElement('div');
                    placeholder.className = 'timeline-placeholder w-full h-full flex items-center justify-center text-white font-bold text-4xl';
                    
                    // Extract initials from alt text
                    const altText = this.alt || 'NA';
                    const nameMatch = altText.match(/Foto (.+)/);
                    const name = nameMatch ? nameMatch[1] : 'NA';
                    const initials = name.split(' ').map(word => word[0]).join('').substring(0, 2).toUpperCase();
                    
                    placeholder.textContent = initials;
                    this.parentNode.replaceChild(placeholder, this);
                };
            });
        });
    </script>
</body>
</html>