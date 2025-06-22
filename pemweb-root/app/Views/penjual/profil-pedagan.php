<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Profil Pedagang</title>
  <link rel="stylesheet" href="<?= base_url('style/profil-pedagang.css')?>" />
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

  <section class="profil-header">
    <img src="kantin.jpg" alt="Kantin" class="profil-img" />
    <div class="profil-info">
      <h1>Kantin Pak Budi</h1>
      <p><span class="rating">4.3/5</span> ⭐</p>
    </div>
  </section>

  <section class="form-card">
    <div class="form-header">Informasi Akun</div>
    <div class="form-body">
      <p>Nama Penjual : <strong>Pak Budi</strong></p>
      <p>Nama Kantin : <strong>Kantin Serba Ada</strong></p>
      <p>Username : <strong>SerbaAda2705</strong></p>
      <p>Tambahkan Gambar</p>
      <div class="gambar-upload"></div>
    </div>
    <div class="form-footer">
      <button class="btn-simpan">Simpan</button>
    </div>
  </section>

</body>
</html>