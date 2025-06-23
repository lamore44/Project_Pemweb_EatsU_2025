  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard <?= esc($kantin['nama_kantin']) ?></title>
    <link rel="stylesheet" href="<?= base_url('style/homepage_pedagang.css'); ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
  </head>
  <body>

    <?php if (!$kantin): ?>
      <p style="color: red; text-align:center;">Kantin tidak ditemukan untuk penjual ini.</p>
    <?php else: ?>

    <header class="header">
      <div class="header-left">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
      </div>
      <nav class="header-nav">
        <a href="#" class="nav-link active">Home</a>
        <a href="<?= base_url('penjual/profile')?>" class="nav-link">Profile</a>
        <a href="#" class="nav-link">Report</a>
      </nav>
      <div class="header-right">
        <img src="<?= base_url('images/profile.jpg') ?>" alt="Profil" class="profile-pic" />
      </div>
    </header>

    <main class="container">
      <section class="canteen-info">
        <div class="canteen-details">
          <img class="canteen-img" src="<?= base_url('images/kantin.jpg') ?>" alt="Foto Kantin">
          <div class="canteen-text">
            <h1><?= esc($kantin['nama_kantin']) ?></h1>
            Rating: <?= isset($ratings[$kantin['id_kantin']]) ? $ratings[$kantin['id_kantin']] : 'No rating yet' ?> ★
          </div>
        </div>
        <div class="canteen-actions">
          <button onclick="location.href='<?= base_url('penjual/tambah-menu') ?>'" class="btn btn-add">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Tambah Menu
          </button>
          <button onclick="location.href='<?= base_url('penjual/pesanan') ?>'" class="btn btn-check-order">Cek Pesanan</button>
        </div>
      </section>

      <?php foreach ($produkByKategori as $kategori => $produk): ?>
        <section class="menu-category">
          <h2><?= esc($kategori) ?></h2>
          <div class="menu-grid">
            <?php foreach ($produk as $item): ?>
              <div class="menu-card">
                <div class="card-icons">
                  <a href="<?= base_url('penjual/edit-menu/' . $item['id_produk']) ?>" class="edit-icon" title="Edit Menu">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                  </a>
                  <button class="options-icon" title="Opsi">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                  </button>
                </div>
                <img class="menu-img" src="<?= base_url('uploads/' . $item['gambar']) ?>" alt="<?= esc($item['nama_produk']) ?>">
                <div class="menu-info">
                  <p class="menu-name"><?= esc($item['nama_produk']) ?></p>
                  <p class="menu-price">Rp <?= number_format($item['harga'], 0, ',', '.') ?></p>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
          <div class="show-more-container">
              <button class="show-more">SHOW MORE ↓</button>
          </div>
        </section>
      <?php endforeach; ?>
    </main>

    <?php endif; ?>

  </body>
  </html>