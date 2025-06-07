<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - Tailwind CSS</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
        font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="h-screen bg-cover bg-center flex items-center justify-center" style="background-image: url('sampul.jpg');">

  <main class="w-full max-w-sm p-6 bg-white/30 backdrop-blur-md rounded-xl shadow-2xl">
    <form action="{{ route('auth.authenticate') }}" method="POST">
      @csrf

      <!-- Logo -->
      <div class="flex justify-center mb-6">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-16 h-16">
      </div>

      <!-- Title -->
      <h1 class="text-xl font-semibold text-center text-white mb-4">Please sign in</h1>

      <!-- Email -->
      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-white">Email address</label>
        <input type="email" id="email" name="email"
          class="w-full px-4 py-2 border border-white/30 rounded-lg bg-white/60 text-black placeholder-gray-700 focus:ring focus:ring-blue-300 @error('email') border-red-500 @enderror"
          value="{{ old('email') }}" placeholder="name@example.com">
        @error('email')
        <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
        @enderror
      </div>

      <!-- Password -->
      <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-white">Password</label>
        <input type="password" id="password" name="password"
          class="w-full px-4 py-2 border border-white/30 rounded-lg bg-white/60 text-black placeholder-gray-700 focus:ring focus:ring-blue-300 @error('password') border-red-500 @enderror"
          placeholder="Password">
        @error('password')
        <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
        @enderror
      </div>

      <!-- Remember Me -->
      <div class="flex items-center mb-4">
        <input type="checkbox" id="remember" class="text-blue-500">
        <label for="remember" class="ml-2 text-sm text-white">Remember me</label>
      </div>

      <!-- Submit -->
      <button type="submit" class="w-full px-4 py-2 text-white bg-red-800 rounded-lg hover:bg-red-600 transition-all">
        Sign in
      </button>

      <!-- Link -->
      <p class="mt-4 text-xs text-center text-white">
        Don't have an account?
        <a href="/register" class="font-bold text-blue-200 hover:underline">SIGN UP</a>
      </p>

    </form>
  </main>

</body>
</html>
