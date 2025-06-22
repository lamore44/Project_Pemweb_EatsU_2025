<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Cek Pesanan Pedagang</title>
  <link rel="stylesheet" href="<?= base_url('style/cekPesanan-pedagang.css')?>">
</head>
<body>
  <header>
    <div class="logo"></div>
    <nav>
      <button>Home</button>
      <button>Profile</button>
      <button>Report</button>
    </nav>
    <div class="avatar"></div>
  </header>

  <section class="kantin-info">
    <img src="kantin.jpg" alt="Kantin Pak Budi">
    <div>
      <h1>Kantin Pak Budi</h1>
      <p><span>4.3/5</span> ⭐</p>
    </div>
  </section>

  <section class="antrian">
    <h2>Antrian Pemesanan</h2>

    <div class="pesanan">
      <span>Pesanan A</span>
      <button class="btn-detail">Cek Detail</button>
      <span class="status-menunggu">Menunggu Pembayaran</span>
    </div>

    <div class="pesanan">
      <span>Pesanan B</span>
      <button class="btn-detail">Cek Detail</button>
      <span class="status-berhasil">Pembayaran Berhasil</span>
    </div>
  </section>
</body>
</html>
