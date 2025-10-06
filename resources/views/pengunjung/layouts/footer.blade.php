<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
</head>
<body>
<!-- Success Popup Alert - Professional Design -->
@if(session('success'))
    <div id="successAlert" class="fixed top-8 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-lg px-4">
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden border border-gray-100">
            <div class="flex items-start p-6">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4 flex-1">
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Message Sent Successfully!</h3>
                    <p class="text-sm text-gray-600">{{ session('success') }}</p>
                </div>
                <button type="button" onclick="closeAlert('successAlert')" class="flex-shrink-0 ml-4 text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <!-- Progress bar -->
            <div class="h-1 bg-gray-100">
                <div id="progressBar" class="h-full bg-green-500 transition-all duration-300" style="width: 100%"></div>
            </div>
        </div>
    </div>
@endif

<!-- Error Alert - Professional Inline Design -->
<footer id="footer" class="mt-16 py-10 bg-gray-800 text-white transition-all duration-700">
    <div class="container mx-auto p-4">
        <h2 class="text-3xl font-bold text-center mb-2">Contact Us</h2>
        <p class="text-center text-gray-300 mb-8">Got a question or want to get in touch? Fill out the form below!</p>
        
        @if(session('error'))
            <div id="errorAlert" class="max-w-2xl mx-auto mb-8">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-red-100">
                    <div class="flex items-start p-6">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">Something Went Wrong</h3>
                            <p class="text-sm text-gray-600">{{ session('error') }}</p>
                        </div>
                        <button type="button" onclick="closeAlert('errorAlert')" class="flex-shrink-0 ml-4 text-gray-400 hover:text-gray-600 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Contact Information -->
            <div class="w-full lg:w-1/2">
                <h3 class="text-xl font-bold mb-4">Our Office</h3>
                <p class="text-gray-300 mb-2"><i class="fas fa-map-marker-alt mr-2"></i> Jl. Prof. Sudarto No.116 , Sumurboto , Kec. Banyumanik, </br> Kota Semarang, Jawa Tengah 50269</p>
                <p class="text-gray-300 mb-2"><i class="fas fa-phone mr-2"></i> Telepon : 024 7466215 </br> Whatsapp : +6281222233860</p>
                <p class="text-gray-300 mb-4"><i class="fas fa-envelope mr-2"></i> dinas_arpus@semarangkota.go.id</p>
                <h3 class="text-xl font-bold mb-4">Follow Us</h3>
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center hover:bg-red-600 transition">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center hover:bg-blue-500 transition">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.instagram.com/dinasarpus_semarang/?hl=en" class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center hover:bg-pink-500 transition">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://youtube.com/@dinasarpuskotasemarang2232?si=oM4spO4Z8XWFWrhx" class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center hover:bg-red-500 transition">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
            <!-- Contact Form -->
            <div class="w-full lg:w-1/2 bg-gray-700 p-6 rounded-lg shadow-lg">
                <form id="feedbackForm" action="{{ route('feedback.store') }}" method="POST" class="space-y-4" novalidate>
                    @csrf
                    <div>
                        <label for="nama_pengunjung" class="block text-gray-300 mb-2">Full Name <span class="text-red-400">*</span></label>
                        <input type="text" id="nama_pengunjung" name="nama_pengunjung" 
                               class="w-full p-3 rounded bg-gray-800 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-red-600 @error('nama_pengunjung') border-red-500 @enderror" 
                               placeholder="Your Name" 
                               value="{{ old('nama_pengunjung') }}">
                        @error('nama_pengunjung')
                            <p class="text-red-400 text-sm mt-2 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                        <p id="nama_error" class="text-red-400 text-sm mt-2 hidden flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <span></span>
                        </p>
                    </div>
                    <div>
                        <label for="email" class="block text-gray-300 mb-2">Email Address</label>
                        <input type="email" id="email" name="email" 
                               class="w-full p-3 rounded bg-gray-800 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-red-600 @error('email') border-red-500 @enderror" 
                               placeholder="Your Email" 
                               value="{{ old('email') }}">
                        @error('email')
                            <p class="text-red-400 text-sm mt-2 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                        <p id="email_error" class="text-red-400 text-sm mt-2 hidden flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <span></span>
                        </p>
                    </div>
                    <div>
                        <label for="pesan" class="block text-gray-300 mb-2">Message <span class="text-red-400">*</span></label>
                        <textarea id="pesan" name="pesan" rows="4" 
                                  class="w-full p-3 rounded bg-gray-800 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-red-600 @error('pesan') border-red-500 @enderror" 
                                  placeholder="Your Message">{{ old('pesan') }}</textarea>
                        @error('pesan')
                            <p class="text-red-400 text-sm mt-2 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                        <p id="pesan_error" class="text-red-400 text-sm mt-2 hidden flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <span></span>
                        </p>
                    </div>
                    <button type="submit" class="w-full py-3 bg-red-800 text-white font-bold rounded-lg hover:bg-red-700 transition">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</footer>

<script>
    // Function to close alert
    function closeAlert(alertId) {
        const alert = document.getElementById(alertId);
        if (alert) {
            alert.style.opacity = '0';
            alert.style.transform = 'translate(-50%, -20px)';
            setTimeout(function() {
                alert.remove();
            }, 300);
        }
    }

    // Custom form validation
    document.getElementById('feedbackForm').addEventListener('submit', function(e) {
        let isValid = true;
        
        // Validate nama_pengunjung
        const nama = document.getElementById('nama_pengunjung');
        const namaError = document.getElementById('nama_error');
        if (!nama.value.trim()) {
            e.preventDefault();
            isValid = false;
            nama.classList.add('border-red-500');
            namaError.classList.remove('hidden');
            namaError.querySelector('span').textContent = 'Name is required';
        } else if (nama.value.length > 32) {
            e.preventDefault();
            isValid = false;
            nama.classList.add('border-red-500');
            namaError.classList.remove('hidden');
            namaError.querySelector('span').textContent = 'Name cannot exceed 32 characters';
        } else {
            nama.classList.remove('border-red-500');
            namaError.classList.add('hidden');
        }
        
        // Validate email (if filled)
        const email = document.getElementById('email');
        const emailError = document.getElementById('email_error');
        if (email.value.trim()) {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email.value)) {
                e.preventDefault();
                isValid = false;
                email.classList.add('border-red-500');
                emailError.classList.remove('hidden');
                emailError.querySelector('span').textContent = 'Please enter a valid email address';
            } else if (email.value.length > 64) {
                e.preventDefault();
                isValid = false;
                email.classList.add('border-red-500');
                emailError.classList.remove('hidden');
                emailError.querySelector('span').textContent = 'Email cannot exceed 64 characters';
            } else {
                email.classList.remove('border-red-500');
                emailError.classList.add('hidden');
            }
        } else {
            email.classList.remove('border-red-500');
            emailError.classList.add('hidden');
        }
        
        // Validate pesan
        const pesan = document.getElementById('pesan');
        const pesanError = document.getElementById('pesan_error');
        if (!pesan.value.trim()) {
            e.preventDefault();
            isValid = false;
            pesan.classList.add('border-red-500');
            pesanError.classList.remove('hidden');
            pesanError.querySelector('span').textContent = 'Message is required';
        } else {
            pesan.classList.remove('border-red-500');
            pesanError.classList.add('hidden');
        }
    });
    
    // Remove error styling on input
    document.querySelectorAll('input, textarea').forEach(function(element) {
        element.addEventListener('input', function() {
            this.classList.remove('border-red-500');
            const errorId = this.id + '_error';
            const errorElement = document.getElementById(errorId);
            if (errorElement) {
                errorElement.classList.add('hidden');
            }
        });
    });

    // Auto close alerts and scroll to footer for error
    document.addEventListener('DOMContentLoaded', function() {
        const successAlert = document.getElementById('successAlert');
        const errorAlert = document.getElementById('errorAlert');
        
        // Progress bar animation for success alert
        if (successAlert) {
            const progressBar = document.getElementById('progressBar');
            let width = 100;
            const interval = setInterval(function() {
                width -= 100 / 150; // 15 seconds = 150 intervals (100ms each)
                progressBar.style.width = width + '%';
                if (width <= 0) {
                    clearInterval(interval);
                }
            }, 100);
        }
        
        // Auto scroll to footer only if there's an error alert
        if (errorAlert) {
            setTimeout(function() {
                const footer = document.getElementById('footer');
                if (footer) {
                    footer.scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'start' 
                    });
                }
            }, 100);
        }
        
        // Auto close alerts after 15 seconds
        setTimeout(function() {
            if (successAlert) {
                closeAlert('successAlert');
            }
            
            if (errorAlert) {
                closeAlert('errorAlert');
            }
        }, 10000);
    });
</script>
</body>
</html>