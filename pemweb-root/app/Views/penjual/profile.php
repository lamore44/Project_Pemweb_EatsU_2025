  <!DOCTYPE html>
  <html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Profil <?= esc($penjual['nama_penjual']) ?></title>
    <link rel="stylesheet" href="<?= base_url('style/profil-pedagang.css')?>" />
    <style>
      .form-card {
          background-color: #fff;
          border-radius: 8px;
          box-shadow: 0 4px 8px rgba(0,0,0,0.1);
          margin: 20px auto;
          max-width: 800px;
          overflow: hidden;
      }
      .form-header {
          background-color: #ffc107;
          color: #333;
          padding: 20px;
          font-size: 1.25rem;
          font-weight: bold;
          text-align: center;
      }
      .form-body {
          padding: 20px 30px;
          display: flex;
          flex-direction: column;
          gap: 15px; /* Memberi jarak antar grup form */
      }
      .form-group {
          display: flex;
          flex-direction: column;
      }
      .form-group label {
          font-weight: bold;
          margin-bottom: 5px;
          color: #555;
      }
      .form-group input[type="text"],
      .form-group input[type="file"] {
          width: 100%;
          padding: 10px;
          border: 1px solid #ccc;
          border-radius: 5px;
          font-size: 1rem;
          box-sizing: border-box; /* Penting untuk padding */
      }
      .form-group input[readonly] {
          background-color: #e9ecef;
          cursor: not-allowed;
      }
      .form-footer {
          padding: 20px;
          text-align: right;
          background-color: #f8f9fa;
      }
      .btn-simpan {
          background-color: #dc3545;
          color: white;
          padding: 12px 25px;
          border: none;
          border-radius: 5px;
          cursor: pointer;
          font-size: 1rem;
          font-weight: bold;
          transition: background-color 0.3s;
      }
      .btn-simpan:hover {
          background-color: #c82333;
      }
      .alert-success {
          padding: 15px; 
          background-color: #d4edda; 
          color: #155724; 
          border: 1px solid #c3e6cb; 
          border-radius: 5px; 
          margin: 20px auto; 
          max-width: 800px;
          text-align: center;
      }
    </style>
  </head>
  <body>

    <header>
      <!-- Pastikan link navigasi sudah benar -->
      <div class="logo"></div>
      <nav>
        <a href="<?= site_url('penjual/dashboard') ?>"><button>Home</button></a>
        <a href="<?= site_url('penjual/profile') ?>"><button>Profile</button></a>
        <button>Report</button>
      </nav>
      <div class="avatar"></div>
    </header>

    <section class="profil-header">
      <img src="<?= base_url($kantin['gambar_kantin'] ?? 'assets/images/default-kantin.jpg') ?>" alt="Foto Kantin" class="profil-img" />
      <div class="profil-info">
        <h1><?= esc($kantin['nama_kantin']) ?></h1>
        <p><span class="rating"> Rating: <?= isset($ratings[$kantin['id_kantin']]) ? $ratings[$kantin['id_kantin']] : 'No rating yet' ?></span> ⭐</p>
      </div>
    </section>

    <?php if (isset($success)): ?>
        <div class="alert-success"><?= esc($success) ?></div>
    <?php endif; ?>

    <form action="<?= site_url('penjual/profile/update') ?>" method="post" enctype="multipart/form-data">
      <?= csrf_field() ?>
      <section class="form-card">
        <div class="form-header">Informasi Akun</div>
        <div class="form-body">
          
          <div class="form-group">
            <label for="nama_penjual">Nama Penjual:</label>
            <input type="text" id="nama_penjual" name="nama_penjual" value="<?= esc($penjual['nama_penjual']) ?>">
          </div>
          
          <div class="form-group">
            <label for="nama_kantin">Nama Kantin:</label>
            <input type="text" id="nama_kantin" name="nama_kantin" value="<?= esc($kantin['nama_kantin']) ?>">
          </div>

          <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?= esc($penjual['username']) ?>" readonly>
          </div>
          
          <div class="form-group">
            <label for="gambar_kantin">Ganti Gambar Kantin:</label>
            <input type="file" id="gambar_kantin" name="gambar_kantin">
            <small style="margin-top: 5px; color: #6c757d;">Kosongkan jika tidak ingin mengganti gambar.</small>
          </div>

        </div>
        <div class="form-footer">
          <button type="submit" class="btn-simpan">Simpan Perubahan</button>
        </div>
      </section>
    </form>

  </body>
  </html>