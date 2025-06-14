<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Admin</title>
  <link rel="stylesheet" href="<?= base_url('style/homepage-admin.css') ?>"/>
</head>
<body>
  <header>
    <div class="logo"></div>
    <button class="home-btn">Home</button>
    <div class="profile-icon"></div>
  </header>

  <main>
    <section class="summary">
      <div class="card">
        <p>Jumlah Kantin</p>
        <h2>11</h2>
      </div>
      <div class="card">
        <p>Jumlah Pesanan</p>
        <h2>21</h2>
      </div>
      <div class="card">
        <p>Jumlah Admin</p>
        <h2>3</h2>
      </div>
    </section>

    <section class="report-section">
      <h3>Report Pemesanan</h3>
      <div class="order">
        <span>Pesanan A</span>
        <span class="status pending">Menunggu Pembayaran</span>
      </div>
      <div class="order">
        <span>Pesanan B</span>
        <span class="status success">Pembayaran Berhasil</span>
      </div>
      <div class="order">
        <span>Pesanan C</span>
        <span class="status pending">Menunggu Pembayaran</span>
      </div>
    </section>

    <section class="actions">
      <button class="add-btn">Tambah Kantin</button>
      <button class="add-btn">Tambah Admin</button>
    </section>

    <section class="report-section">
      <h3>Report Response</h3>
      <div class="order">
        <span>Laporan A</span>
        <button class="detail-btn">Cek Detail</button>
      </div>
      <div class="order">
        <span>Laporan B</span>
        <button class="detail-btn">Cek Detail</button>
      </div>
    </section>
  </main>
</body>
</html>
