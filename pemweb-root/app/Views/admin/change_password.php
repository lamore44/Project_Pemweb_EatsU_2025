<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Ganti Password</title>
  <link rel="stylesheet" href="<?= base_url('style/homepage-admin.css') ?>" />
</head>
<body>

  <header>
    <div class="logo"></div>
    <h2 style="color:white;">Ganti Password</h2>
    <div class="profile-icon"></div>
  </header>

  <main style="padding: 2rem; max-width: 500px; margin: auto;">
    <?php if (session()->getFlashdata('success')): ?>
      <div class="card" style="background: #a5d6a7; color: green; text-align:center;">
        <?= session()->getFlashdata('success') ?>
      </div>
    <?php elseif (session()->getFlashdata('error')): ?>
      <div class="card" style="background: #ef9a9a; color: darkred; text-align:center;">
        <?= session()->getFlashdata('error') ?>
      </div>
    <?php endif; ?>

    <form action="<?= base_url('/admin/update-password') ?>" method="post" class="popup-content">
      <h3>Ubah Password</h3>
      <label for="current_password">Password Lama:</label>
      <input type="password" id="current_password" name="current_password" required>

      <label for="new_password">Password Baru:</label>
      <input type="password" id="new_password" name="new_password" required>

      <button type="submit">Ubah Password</button>
    </form>

    <div style="text-align:center; margin-top: 1rem;">
      <a href="<?= base_url('/admin/dashboard') ?>" class="detail-btn">Kembali ke Dashboard</a>
    </div>
  </main>

</body>
</html>
