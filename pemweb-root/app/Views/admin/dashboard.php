<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Admin</title>
  <link rel="stylesheet" href="<?= base_url('style/homepage-admin.css') ?>"/>

</head>
<body>

  <header style="display: flex; justify-content: space-between; align-items: center; padding: 10px;">
    <div class="logo"></div>
    <button class="home-btn">Home</button>
    <div style="display: flex; align-items: center; gap: 10px;">
    <span style="font-weight: bold; color: white;">
      <?= esc(session()->get('admin_name')) ?>
    </span>
    <div class="profile-container">
      <div class="profile-icon"></div>
        <div class="dropdown-content">
          <a href="<?= base_url('/admin/edit_profile') ?>">Edit Profile</a>
          <a href="<?= base_url('/admin/change_password') ?>">Change Password</a>
          <a href="<?= base_url('/logout') ?>">Logout</a>
        </div>
      </div>
    </div>
  </header>



  <main>
    <section class="summary">
      <div class="card">
        <p>Jumlah Kantin</p>
        <h2><?= $jumlahKantin ?></h2>
      </div>
      <div class="card">
        <p>Jumlah Pesanan</p>
        <h2><?= $jumlahPesanan ?></h2>
      </div>
      <div class="card">
        <p>Jumlah Admin</p>
        <h2><?= $jumlahAdmin ?></h2>
      </div>
    </section>

    <section class="report-section">
    <h3>Report Pemesanan</h3>
      <?php if (!empty($orders)): ?>
        <?php foreach($orders as $o): ?>
          <div class="order">
            <span><?= $o->nama_produk ?> (ID <?= $o->id_pesan ?>)</span>
            <span class="status <?= $o->status==='pending' ? 'pending' : 'success' ?>">
              <?= $o->status==='pending' ? 'Menunggu Pembayaran' : 'Pembayaran Berhasil' ?>
            </span>
          </div>
        <?php endforeach ?>
      <?php else: ?>
      <p>Tidak ada data pemesanan.</p>
    <?php endif ?>
    </section>

    <section class="actions">
      <button class="add-btn" data-type="Kantin">Tambah Kantin</button>
      <button class="add-btn" data-type="Admin">Tambah Admin</button>
    </section>

    <section class="report-section">
      <h3>Review Terbaru</h3>
      <?php if (! empty($reviews)): ?>
        <?php foreach($reviews as $r): ?>
          <div class="order">
            <span><?= esc($r['mhs_id']) ?> memberi rating <?= esc($r['rating']) ?> untuk produk <strong><?= esc($r['nama_produk']) ?></strong></span>
            <button 
              class="detail-btn"
              onclick="window.location='<?= site_url('review/detail/'.$r['id_review']) ?>'">
              Cek Detail
            </button>
          </div>
        <?php endforeach ?>
      <?php else: ?>
        <p>Tidak ada review.</p>
      <?php endif ?>
    </section>

  </main>

  <!-- Popup Modal -->
  <div id="popupForm" class="popup hidden">
    <div class="popup-content">
      <span id="closePopup" class="close">&times;</span>
      <h3 id="popupTitle">Tambah Data</h3>
      <form id="dataForm">
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" required />

        <label for="description">Deskripsi:</label>
        <input type="text" id="description" name="description" required />

        <button type="submit">Simpan</button>
      </form>
    </div>
  </div>

<<<<<<< HEAD
  <script src="<?= base_url('script/homepage-admin.js')?>"></script>
=======
  <script src="homepage-admin.js"></script>
>>>>>>> 2a2f33f5d86d7d1813fef339fd59cec1f3eff52f
</body>
</html>
