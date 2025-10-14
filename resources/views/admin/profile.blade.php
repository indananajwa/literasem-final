<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Saya - Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-gray-50 flex min-h-screen">

  <!-- Sidebar -->
  <aside class="w-64 bg-white border-r border-gray-200">
    @include('admin.layouts.sidebar')
  </aside>

  <!-- Main Content -->
  <div class="flex-1 flex flex-col">
    @include('admin.layouts.header')

    <!-- Content -->
    <div class="p-6 flex-1">
      <!-- Page Title -->
      <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Profil Saya</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola informasi profil dan keamanan akun Anda</p>
      </div>

      <!-- Profile Content -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Left Column - Profile Card -->
        <div class="lg:col-span-1">
          <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex flex-col items-center">
              <!-- Avatar -->
              <div class="relative mb-4">
                <img src="{{ Auth::user()->avatar ?? asset('img/icon.png') }}" 
                     alt="Avatar" 
                     class="w-32 h-32 rounded-full border-4 border-gray-100 shadow-lg object-cover">
                <button class="absolute bottom-0 right-0 bg-blue-600 text-white p-2 rounded-full shadow-lg hover:bg-blue-700 transition">
                  <i class="fas fa-camera text-sm"></i>
                </button>
              </div>

              <!-- User Info -->
              <h2 class="text-xl font-bold text-gray-800 mb-1">{{ Auth::user()->name }}</h2>
              <p class="text-sm text-gray-500 mb-2">{{ Auth::user()->email }}</p>
              <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">
                Administrator
              </span>

              <!-- Stats -->
              <div class="w-full mt-6 pt-6 border-t border-gray-200">
                <div class="grid grid-cols-2 gap-4 text-center">
                  <div>
                    <p class="text-2xl font-bold text-gray-800">12</p>
                    <p class="text-xs text-gray-500">Konten</p>
                  </div>
                  <div>
                    <p class="text-2xl font-bold text-gray-800">5</p>
                    <p class="text-xs text-gray-500">Kategori</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Right Column - Forms -->
        <div class="lg:col-span-2 space-y-6">
          
          <!-- Personal Information -->
          <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
              <h3 class="text-lg font-semibold text-gray-800">Informasi Pribadi</h3>
              
            </div>

           
              <div class="space-y-4">
                <!-- Nama dan Email (Side by Side) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent disabled:bg-gray-50 disabled:text-gray-500"
                           disabled>
                  </div>

                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ Auth::user()->email }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent disabled:bg-gray-50 disabled:text-gray-500"
                           disabled>
                  </div>
                </div>

                <!-- Role (Full Width) -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                  <input type="text" value="Administrator" 
                         class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-500"
                         disabled>
                </div>
              </div>

              <!-- Save & Cancel Buttons -->
              <div id="save-profile-btn" class="hidden mt-6 flex gap-3">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                  <i class="fas fa-save mr-2"></i> Simpan Perubahan
                </button>
                <button type="button" id="cancel-edit-btn" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-medium">
                  <i class="fas fa-times mr-2"></i> Batal
                </button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>

  <script>
    // Edit Profile Toggle
    const editBtn = document.getElementById('edit-profile-btn');
    const saveBtn = document.getElementById('save-profile-btn');
    const cancelBtn = document.getElementById('cancel-edit-btn');
    const formInputs = document.querySelectorAll('#profile-form input:not([type="hidden"]), #profile-form textarea');

    editBtn.addEventListener('click', () => {
      formInputs.forEach(input => {
        if (!input.hasAttribute('readonly')) {
          input.disabled = false;
          input.classList.remove('disabled:bg-gray-50', 'disabled:text-gray-500');
        }
      });
      saveBtn.classList.remove('hidden');
      editBtn.classList.add('hidden');
    });

    cancelBtn.addEventListener('click', () => {
      formInputs.forEach(input => {
        input.disabled = true;
        input.classList.add('disabled:bg-gray-50', 'disabled:text-gray-500');
      });
      saveBtn.classList.add('hidden');
      editBtn.classList.remove('hidden');
    });

    // Toggle Password Visibility
    document.querySelectorAll('button[type="button"]').forEach(btn => {
      btn.addEventListener('click', function() {
        const input = this.previousElementSibling || this.parentElement.querySelector('input');
        const icon = this.querySelector('i');
        
        if (input && input.type === 'password') {
          input.type = 'text';
          icon.classList.remove('fa-eye');
          icon.classList.add('fa-eye-slash');
        } else if (input) {
          input.type = 'password';
          icon.classList.remove('fa-eye-slash');
          icon.classList.add('fa-eye');
        }
      });
    });
  </script>
</body>
</html>