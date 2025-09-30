<!-- resources/views/admin/feedback/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Umpan Balik Pengunjung</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">
<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white min-h-screen">
        @include('admin.layouts.sidebar')
    </aside>

    <!-- Main -->
    <div class="flex-1">
        <div class="px-6 py-4">
            <!-- Header -->
            @include('admin.layouts.header')
            
            <div class="flex justify-between items-center mb-6 px-6 py-3">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Umpan Balik Pengunjung Website</h1>
                    <i class="fas fa-info-circle text-gray-400 ml-2 cursor-help" 
                       title="Berisi daftar aduan dan feedback dari pengunjung website LITERASEM."></i>
                </div>
            </div>

            <!-- Search -->
            <div class="flex justify-between items-center mb-6 ml-4">
                <div class="relative w-72">
                    <i class="fas fa-search absolute left-4 top-3 text-gray-400"></i>
                    <input 
                        type="text" 
                        id="searchInput"
                        placeholder="Cari nama atau email..." 
                        class="w-full pl-12 pr-4 py-2 rounded-full border border-gray-300 focus:ring-2 focus:ring-red-500 focus:outline-none text-sm"
                    >
                </div>
            </div>

            <!-- Table Container -->
            <div class="bg-white rounded-lg shadow-sm">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama <i class="fas fa-sort text-gray-400 ml-1"></i>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email <i class="fas fa-sort text-gray-400 ml-1"></i>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pesan <i class="fas fa-sort text-gray-400 ml-1"></i>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal <i class="fas fa-sort text-gray-400 ml-1"></i>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100" id="tableBody">
                            @foreach ($feedback as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-900 nama-pengunjung">{{ $item->nama_pengunjung }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 email-pengunjung">{{ $item->email }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        <div class="max-w-md truncate" title="{{ $item->pesan }}">
                                            {{ Str::limit($item->pesan, 50) }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($item->tanggal_kirim)->format('d M Y, H:i') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <form action="{{ route('feedback.destroy', $item->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn-delete text-gray-500 hover:text-red-600" title="Hapus">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- No Result Message -->
                <div id="noResult" class="hidden text-center py-8">
                    <i class="fas fa-search text-gray-300 text-4xl mb-2"></i>
                    <p class="text-gray-500">Tidak ada hasil yang ditemukan</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
Swal.fire({
    title: "Berhasil!",
    text: "{{ session('success') }}",
    icon: "success",
    timer: 2000,
    showConfirmButton: false
});
</script>
@endif

<script>
// Search functionality
const searchInput = document.getElementById('searchInput');
const tableBody = document.getElementById('tableBody');
const noResult = document.getElementById('noResult');

searchInput.addEventListener('keyup', function() {
    const searchValue = this.value.toLowerCase();
    const rows = tableBody.getElementsByTagName('tr');
    let hasResult = false;

    for (let i = 0; i < rows.length; i++) {
        const nama = rows[i].querySelector('.nama-pengunjung');
        const email = rows[i].querySelector('.email-pengunjung');
        
        if (nama && email) {
            const namaText = nama.textContent || nama.innerText;
            const emailText = email.textContent || email.innerText;
            
            if (namaText.toLowerCase().indexOf(searchValue) > -1 || 
                emailText.toLowerCase().indexOf(searchValue) > -1) {
                rows[i].style.display = '';
                hasResult = true;
            } else {
                rows[i].style.display = 'none';
            }
        }
    }

    // Show/hide no result message
    if (hasResult || searchValue === '') {
        noResult.classList.add('hidden');
        tableBody.parentElement.parentElement.classList.remove('hidden');
    } else {
        noResult.classList.remove('hidden');
        tableBody.parentElement.parentElement.classList.add('hidden');
    }
});

// Delete confirmation
document.querySelectorAll('.btn-delete').forEach(button => {
    button.addEventListener('click', function() {
        const form = this.closest('form');

        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Data akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>
</body>
</html>