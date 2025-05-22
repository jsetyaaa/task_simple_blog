<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>403 - Akses Ditolak</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen px-4 bg-gray-100">
    <div class="text-center">
        <img src="https://www.lucushost.com/blog/wp-content/uploads/2020/06/error-403-forbbiden.png" alt="Akses Ditolak" class="mx-auto mb-8 w-72">
        <h1 class="mb-4 text-4xl font-bold text-red-600 md:text-5xl">403 - Akses Ditolak</h1>
        <p class="mb-6 text-lg text-gray-700">Ups! Kamu tidak memiliki izin untuk membuka halaman ini.</p>
        <a href="{{ url()->previous() }}"
           class="inline-block px-6 py-3 text-white transition bg-blue-600 rounded-lg shadow hover:bg-blue-700">
           ⬅️ Kembali ke halaman sebelumnya
        </a>
    </div>
</body>
</html>
