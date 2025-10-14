<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register - Admin Panel</title>
  <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
        font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-200 bg-cover bg-center" style="background-image: url('sampul.jpg');">
  <main class="w-full max-w-md p-8 space-y-6 bg-white/60 backdrop-blur-sm rounded-xl shadow-md">
    <form action="{{ route('auth.register') }}" method="POST">
      @csrf
      <!-- Logo -->
      <div class="flex justify-center mb-6">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-16 h-16">
      </div>
      <h1 class="text-2xl font-bold text-center">Daftar Admin</h1>

      <div class="space-y-4">
        <!-- NIP -->
        <div>
          <label for="nip" class="block text-sm font-medium text-gray-700">NIP (18 Digit)</label>
          <input type="text" id="nip" name="nip" value="{{ old('nip') }}" maxlength="18"
            class="w-full px-3 py-2 mt-1 border rounded-md focus:ring focus:ring-blue-300 @error('nip') border-red-500 @enderror"
            placeholder="Masukkan 18 digit NIP">
          @error('nip')
          <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
          @enderror
        </div>

        <!-- Nama -->
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
          <input type="text" id="name" name="name" value="{{ old('name') }}"
            class="w-full px-3 py-2 mt-1 border rounded-md focus:ring focus:ring-blue-300 @error('name') border-red-500 @enderror"
            placeholder="Nama Lengkap">
          @error('name')
          <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
          @enderror
        </div>

        <!-- Email -->
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input type="email" id="email" name="email" value="{{ old('email') }}"
            class="w-full px-3 py-2 mt-1 border rounded-md focus:ring focus:ring-blue-300 @error('email') border-red-500 @enderror"
            placeholder="name@example.com">
          @error('email')
          <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
          @enderror
        </div>

        <!-- Password -->
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input type="password" id="password" name="password"
            class="w-full px-3 py-2 mt-1 border rounded-md focus:ring focus:ring-blue-300 @error('password') border-red-500 @enderror"
            placeholder="Password">
          @error('password')
          <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
          @enderror
        </div>

        <!-- Confirm Password -->
        <div>
          <label for="confirm-password" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
          <input type="password" id="confirm-password" name="confirm-password"
            class="w-full px-3 py-2 mt-1 border rounded-md focus:ring focus:ring-blue-300 @error('confirm-password') border-red-500 @enderror"
            placeholder="Konfirmasi Password">
          @error('confirm-password')
          <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
          @enderror
        </div>
      </div>

      <button type="submit" class="w-full px-4 py-2 mt-6 text-white bg-red-800 rounded-lg hover:bg-red-600">
        Daftar
      </button>

      <p class="mt-4 text-sm text-center text-gray-700">
        Sudah punya akun?
        <a href="/login" class="font-bold text-blue-500 hover:underline">MASUK</a>
      </p>
    </form>
  </main>
</body>
</html>