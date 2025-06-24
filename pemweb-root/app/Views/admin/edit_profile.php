<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Profil Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-yellow-200 font-mono m-0 p-0">

  <!-- Header -->
  <header class="bg-orange-400 flex items-center justify-between p-4">
    <div class="w-10 h-10 bg-gray-300 rounded"></div>
    <h2 class="text-white text-lg font-bold">Edit Profil</h2>
    <div class="w-10 h-10 bg-white rounded-full bg-center bg-no-repeat bg-[length:60%]"></div>
  </header>

  <!-- Main content -->
  <main class="flex items-center justify-center min-h-[calc(100vh-80px)] p-4">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
      
      <?php if (session()->getFlashdata('success')): ?>
        <div class="mb-4 bg-green-200 text-green-800 p-3 rounded text-center">
          <?= session()->getFlashdata('success') ?>
        </div>
      <?php endif; ?>

      <!-- Form -->
      <form action="<?= base_url('/admin/update-profile') ?>" method="post" class="space-y-4">
        <h3 class="text-orange-400 text-lg font-bold mb-4">Edit Informasi</h3>

        <div>
          <label for="nama_admin" class="block font-bold mb-1">Nama:</label>
          <input type="text" id="nama_admin" name="nama_admin" value="<?= esc($admin['nama_admin']) ?>" required
                 class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-300">
        </div>

        <div>
          <label for="email" class="block font-bold mb-1">Email:</label>
          <input type="email" id="email" name="email" value="<?= esc($admin['email']) ?>" required
                 class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-300">
        </div>

        <button type="submit"
                class="w-full bg-orange-400 text-white font-bold py-2 px-4 rounded hover:bg-orange-500 transition">
          Simpan Perubahan
        </button>
      </form>

      <!-- Back link -->
      <div class="text-center mt-4">
        <a href="<?= base_url('/admin/dashboard') ?>"
           class="inline-block bg-orange-400 text-black text-sm font-bold py-1 px-3 rounded hover:bg-orange-500 transition">
          Kembali ke Dashboard
        </a>
      </div>
    </div>
  </main>

</body>
</html>
