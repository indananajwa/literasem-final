<!-- resources/views/admin/kategori/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Kategori</title>
</head>
<body>
    <h1>Daftar Kategori</h1>

    <ul>
        @foreach ($kategoris as $kategori)
            <li>{{ $kategori->kode_kategori }} - {{ $kategori->nama_kategori }}</li>
        @endforeach
    </ul>
</body>
</html>
