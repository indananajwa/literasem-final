<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>{{ $section->name }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
    .hidden {
      display: none;
    }
  </style>
</head>
<body class="bg-gray-100">

  @include('pengunjung.layouts.header')

  <div class="relative h-[50vh] bg-cover bg-center" style="background-image: url('{{ $section->cover_image ?? 'https://via.placeholder.com/1920x800' }}');">
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    <div class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white px-4">
      <h1 class="text-4xl font-bold">{{ $section->name }}</h1>
      @if(!empty($section->subtitle))
        <p class="text-xl mt-2">{{ $section->subtitle }}</p>
      @endif
    </div>
  </div>

  <div class="max-w-6xl mx-auto px-4 py-10">
    @if(!empty($section->description))
      <div class="text-center mb-8">
        <p class="text-gray-700 text-lg">{{ $section->description }}</p>
      </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="content-list">
      @foreach($contents as $content)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
          @if(($fieldRules['image'] ?? '') != 'not_used' && !empty($content->image))
            <img src="{{ asset('storage/' . $content->image) }}" alt="{{ $content->title }}" class="w-full h-48 object-cover">
          @endif
          <div class="p-4">
            @if(($fieldRules['title'] ?? '') != 'not_used')
              <h2 class="text-xl font-semibold mb-2">{{ $content->title }}</h2>
            @endif

            @if(($fieldRules['description'] ?? '') != 'not_used')
              <p class="text-gray-600 mb-4">{{ $content->description }}</p>
            @endif

            @if(($fieldRules['video_url'] ?? '') != 'not_used' && !empty($content->video_url))
              <div class="aspect-w-16 aspect-h-9 mb-2">
                <iframe class="w-full h-48" src="{{ $content->video_url }}" frameborder="0" allowfullscreen></iframe>
              </div>
            @endif
          </div>
        </div>
      @endforeach
    </div>
  </div>

</body>
</html>
