<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Daftar Section</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-gray-100 flex">

  <!-- Sidebar -->
  <aside class="w-64 bg-gray-800 text-white min-h-screen">
      @include('admin.layouts.sidebar')
  </aside>

  <!-- Main Content -->
  <div class="flex-1 p-6">
    @include('admin.layouts.header')

    <!-- Form Section -->
    <div class="bg-white rounded-xl shadow p-6">
      <h2 class="text-xl font-semibold mb-4 text-gray-800">Tambah Section</h2>

      <form action="{{ route('admin.sections.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Nama Section -->
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Section</label>
          <input type="text" id="name" name="name" placeholder="Contoh: Makanan Khas Semarang"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            required>
        </div>

        <!-- Aturan Field -->
        <div>
          <h3 class="text-lg font-medium text-gray-800 mb-3">Aturan Field Konten</h3>
          <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 text-center text-sm">
              <thead class="bg-gray-100 text-gray-600">
                <tr>
                  <th class="text-left px-4 py-2 font-semibold border-b border-gray-200">Field</th>
                  <th class="px-4 py-2 border-b border-gray-200">Wajib</th>
                  <th class="px-4 py-2 border-b border-gray-200">Opsional</th>
                  <th class="px-4 py-2 border-b border-gray-200">Tidak Digunakan</th>
                </tr>
              </thead>
              <tbody class="text-gray-700">
                @php
                  $fields = ['title' => 'Judul', 'description' => 'Deskripsi', 'image' => 'Gambar', 'video_url' => 'Video'];
                @endphp
                @foreach ($fields as $key => $label)
                <tr class="hover:bg-gray-50">
                  <td class="text-left px-4 py-2 font-medium border-t border-gray-200">{{ $label }}</td>
                  <td class="py-2 border-t border-gray-200">
                    <input type="radio" name="rule_{{ $key }}" value="required" required>
                  </td>
                  <td class="py-2 border-t border-gray-200">
                    <input type="radio" name="rule_{{ $key }}" value="optional">
                  </td>
                  <td class="py-2 border-t border-gray-200">
                    <input type="radio" name="rule_{{ $key }}" value="not_used">
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <!-- Submit Button -->
        <div class="text-end">
          <button type="submit" id="SubmitButton"
            class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-6 rounded-lg shadow transition duration-150">
            Simpan Section
          </button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('success'))
    <script>
      Swal.fire({
      title: "Section Berhasil Disimpan!",
      icon: "success",
      draggable: true
    }).then(() => {
        window.location.href = "{{ route('dashboard') }}"; // Arahkan ke dashboard setelah klik OK
      });
    </script>
    @endif

    @if(session('error'))
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Oops!',
        text: '{{ session('error') }}',
      });
    </script>
    @endif
  </script>


</body>
</html>
