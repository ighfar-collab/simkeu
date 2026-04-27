<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>SIMKEU - Sistem Informasi Keuangan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">

<!-- HERO -->
<section class="bg-blue-600 text-white py-20">
  <div class="max-w-6xl mx-auto px-6 text-center">
    <h1 class="text-4xl font-bold mb-4">
      SIMKEU
    </h1>
    <p class="text-lg mb-6">
      Sistem Informasi Keuangan untuk mengelola pemasukan, pengeluaran, dan laporan secara efisien.
    </p>
    <a href="{{ route('login') }}" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold">
      Login
    </a>
  </div>
</section>

<!-- FEATURES -->
<section class="py-16">
  <div class="max-w-6xl mx-auto px-6 text-center">
    <h2 class="text-3xl font-bold mb-10">Fitur Utama</h2>

    <div class="grid md:grid-cols-3 gap-8">
      <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="font-bold text-xl mb-2">💸 Pemasukan & Pengeluaran</h3>
        <p>Catat semua transaksi keuangan dengan mudah.</p>
      </div>

      <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="font-bold text-xl mb-2">📊 Cash Flow</h3>
        <p>Pantau arus kas secara real-time.</p>
      </div>

      <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="font-bold text-xl mb-2">📈 Laporan</h3>
        <p>Generate laporan harian, bulanan, dan tahunan.</p>
      </div>
    </div>
  </div>
</section>

<!-- PREVIEW -->
<section class="bg-gray-100 py-16">
  <div class="max-w-6xl mx-auto px-6 text-center">
    <h2 class="text-3xl font-bold mb-6">Preview Sistem</h2>
    <img src="https://via.placeholder.com/800x400" class="rounded-lg shadow mx-auto">
  </div>
</section>

<!-- ADVANTAGE -->
<section class="py-16">
  <div class="max-w-6xl mx-auto px-6 text-center">
    <h2 class="text-3xl font-bold mb-10">Kenapa SIMKEU?</h2>

    <div class="grid md:grid-cols-3 gap-8">
      <div>
        <h3 class="font-bold">⚡ Cepat</h3>
        <p>Akses data secara instan</p>
      </div>

      <div>
        <h3 class="font-bold">🔒 Aman</h3>
        <p>Data tersimpan dengan aman</p>
      </div>

      <div>
        <h3 class="font-bold">📱 Responsif</h3>
        <p>Bisa diakses dari semua device</p>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="bg-blue-600 text-white py-16 text-center">
  <h2 class="text-3xl font-bold mb-4">
    Mulai Kelola Keuangan Anda Sekarang
  </h2>
  <a href="#" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold">
    Coba Sekarang
  </a>
</section>

<!-- FOOTER -->
<footer class="bg-gray-800 text-white py-6 text-center">
  <p>© 2026 SIMKEU - Sistem Informasi Keuangan</p>
</footer>

</body>
</html>