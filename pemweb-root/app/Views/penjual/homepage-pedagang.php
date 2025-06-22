<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Page Pedagang</title>
  <link rel="stylesheet" href="<?= base_url('style/homepage_pedagang.css')?>">
</head>
<body>

  <!-- Header -->
  <header class="header">
    <div class="logo"></div>
    <nav class="nav-buttons">
      <button>Home</button>
      <button>Profile</button>
      <button>Report</button>
    </nav>
    <div class="profile-pic">
      <img src="profile.jpg" alt="Profile">
    </div>
  </header>

  <!-- Informasi Kantin -->
  <section class="info-kantin">
    <img src="kantin.jpg" alt="Kantin" class="kantin-img">
    <div class="kantin-detail">
      <h2>Kantin Pak Budi</h2>
      <p><span class="rating">4.3/5</span> ⭐</p>
    </div>
    <div class="button-actions">
      <button class="add-menu">Tambah Menu ➕</button>
      <button class="check-order">Cek Pesanan</button>
    </div>
  </section>

  <!-- Menu Section -->
  <section class="menu-section">
    <h3>Makanan</h3>
    <div class="menu-grid">
      <div class="menu-card">
        <div class="edit-icon" title="Edit Menu">⋮</div>
        <img src="makanan.jpg" alt="Menu A">
        <p class="menu-name">Menu A</p>
        <p class="price">Rp 25.000</p>
      </div>
      <div class="menu-card">
        <div class="edit-icon">⋮</div>
        <img src="makanan.jpg" alt="Menu B">
        <p class="menu-name">Menu B</p>
        <p class="price">Rp 25.000</p>
      </div>
      <div class="menu-card">
        <div class="edit-icon">⋮</div>
        <img src="makanan.jpg" alt="Menu C">
        <p class="menu-name">Menu C</p>
        <p class="price">Rp 25.000</p>
      </div>
    </div>
    <div class="show-more">SHOW MORE ⬇</div>
  </section>

  <section class="menu-section">
    <h3>Minuman</h3>
    <div class="menu-grid">
      <div class="menu-card">
        <div class="edit-icon" title="Edit Menu">⋮</div>
        <img src="makanan.jpg" alt="Minuman A">
        <p class="menu-name">Minuman A</p>
        <p class="price">Rp 25.000</p>
      </div>
      <div class="menu-card">
        <div class="edit-icon">⋮</div>
        <img src="makanan.jpg" alt="Minuman B">
        <p class="menu-name">Minuman B</p>
        <p class="price">Rp 25.000</p>
      </div>
      <div class="menu-card">
        <div class="edit-icon">⋮</div>
        <img src="makanan.jpg" alt="Minuman C">
        <p class="menu-name">Minuman C</p>
        <p class="price">Rp 25.000</p>
      </div>
    </div>
    <div class="show-more">SHOW MORE ⬇</div>
  </section>

  <section class="menu-section">
    <h3>Snack</h3>
    <div class="menu-grid">
      <div class="menu-card">
        <div class="edit-icon" title="Edit Menu">⋮</div>
        <img src="makanan.jpg" alt="Snack A">
        <p class="menu-name">Snack A</p>
        <p class="price">Rp 25.000</p>
      </div>
      <div class="menu-card">
        <div class="edit-icon">⋮</div>
        <img src="makanan.jpg" alt="Snack B">
        <p class="menu-name">Snack B</p>
        <p class="price">Rp 25.000</p>
      </div>
      <div class="menu-card">
        <div class="edit-icon">⋮</div>
        <img src="makanan.jpg" alt="Snack C">
        <p class="menu-name">Snack C</p>
        <p class="price">Rp 25.000</p>
      </div>
    </div>
    <div class="show-more">SHOW MORE ⬇</div>
  </section>

  <footer>
    <input type="email" placeholder="type email...">
  </footer>

</body>
</html>
