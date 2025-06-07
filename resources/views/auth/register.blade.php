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
<body class="flex items-center justify-center min-h-screen bg-gray-200 bg-cover bg-center" style="background-image: url('sampul.jpg');">
  <main class="w-full max-w-md p-8 space-y-6 bg-white/60 backdrop-blur-sm rounded-xl shadow-md">
    <form action="{{ route('auth.register') }}" method="POST">
      @csrf
      <!-- Logo -->
      <div class="flex justify-center mb-6">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-16 h-16">
      </div>
      <h1 class="text-2xl font-bold text-center">Please Sign Up</h1>

      <div class="space-y-4">
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
          <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full px-3 py-2 mt-1 border rounded-md focus:ring focus:ring-blue-300 @error('email') border-red-500 @enderror" placeholder="name@example.com">
          @error('email')
          <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="name" class="block text-sm font-medium text-gray-700">Your Name</label>
          <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full px-3 py-2 mt-1 border rounded-md focus:ring focus:ring-blue-300 @error('name') border-red-500 @enderror" placeholder="Your Name">
          @error('name')
          <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input type="password" id="password" name="password" class="w-full px-3 py-2 mt-1 border rounded-md focus:ring focus:ring-blue-300 @error('password') border-red-500 @enderror" placeholder="Password">
          @error('password')
          <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="confirm-password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
          <input type="password" id="confirm-password" name="confirm-password" class="w-full px-3 py-2 mt-1 border rounded-md focus:ring focus:ring-blue-300 @error('confirm-password') border-red-500 @enderror" placeholder="Confirm Password">
          @error('confirm-password')
          <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
          @enderror
        </div>
      </div>

      <div class="flex items-center mt-4 mb-4">
        <input type="checkbox" id="remember" class="text-blue-500">
        <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
      </div>

      <button type="submit" class="w-full px-4 py-2 text-white bg-red-800 rounded-lg hover:bg-red-600">Sign up</button>

      <p class="mt-4 text-sm text-center text-gray-700">
        Already have an account?
        <a href="/login" class="font-bold text-blue-500 hover:underline">SIGN IN</a>
      </p>
    </form>
  </main>
</body>
