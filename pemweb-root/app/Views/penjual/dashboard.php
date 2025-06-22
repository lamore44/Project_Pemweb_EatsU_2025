<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Kantin</title>
  <link rel="stylesheet" href="<?= base_url('style/homepage_pedagang.css'); ?>">
</head>
<body>

<?php if (!$kantin): ?>
  <p style="color: red; text-align:center;">Kantin tidak ditemukan untuk penjual ini.</p>
<?php else: ?>

  <!-- Header -->
  <div class="header">
    <div class="logo"></div>
    <div class="nav-buttons">
      <button onclick="location.href='<?= base_url('penjual/tambah-produk') ?>'" class="add-menu">Tambah Menu</button>
      <button onclick="location.href='<?= base_url('penjual/pesanan') ?>'" class="check-order">Cek Pesanan</button>
    </div>
    <div class="profile-pic">
      <img src="<?= base_url('images/profile.jpg') ?>" alt="Profil" />
    </div>
  </div>

  <!-- Info Kantin -->
  <div class="info-kantin">
    <img class="kantin-img" src="<?= base_url('images/kantin.jpg') ?>" alt="Foto Kantin">
    <div class="kantin-detail">
      <h2><?= esc($kantin['nama_kantin']) ?></h2>
      <div class="rating">
        Rating: <?= isset($ratings[$kantin['id_kantin']]) ? $ratings[$kantin['id_kantin']] : 'No rating yet' ?> ★
      </div>
    </div>
  </div>

  <!-- Daftar Produk per Kategori -->
  <?php foreach ($produkByKategori as $kategori => $produk): ?>
    <div class="menu-section">
      <h3><?= esc($kategori) ?></h3>
      <div class="menu-grid">
        <?php foreach ($produk as $item): ?>
          <div class="menu-card">
            <a href="<?= base_url('penjual/edit-menu/' . $item['id_produk']) ?>" class="edit-icon">✎</a>
            <img src="<?= base_url('images/' . $item['gambar']) ?>" alt="<?= esc($item['nama_produk']) ?>">
            <div class="menu-name"><?= esc($item['nama_produk']) ?></div>
            <div class="price">Rp <?= number_format($item['harga'], 0, ',', '.') ?></div>
            <div class="product-rating">
              Rating: <?= isset($ratings[$item['id_produk']]) ? $ratings[$item['id_produk']] . " ★" : "No reviews yet" ?>
            </div>
          </div>
        <?php endforeach ?>
      </div>
      <div class="show-more">SHOW MORE</div>
    </div>
  <?php endforeach ?>

<?php endif; ?>

  <footer>
    <p>Contact us at: email@example.com</p>
  </footer>

</body>
</html>
