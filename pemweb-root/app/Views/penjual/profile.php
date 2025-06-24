<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profil - <?= esc($kantin['nama_kantin']) ?></title>
  <link rel="stylesheet" href="<?= base_url('style/homepage_pedagang.css'); ?>">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
  
  <style>
    body {
        background-color: #f8f9fa; 
    }
    .container {
        padding-top: 20px;
        padding-bottom: 40px;
    }
    .profile-card {
        background-color: #ffffff;
        border-radius: 16px;
        box-shadow: 0 8px 16px rgba(0,0,0,0.05);
        margin: 20px auto;
        max-width: 800px;
        overflow: hidden;
        border: 1px solid #e9ecef;
    }
    .profile-card-header {
        padding: 25px 30px;
        border-bottom: 1px solid #e9ecef;
        display: flex;
        align-items: center;
        gap: 20px;
    }
    .profile-card-img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #fff;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .profile-card-info h1 {
        font-size: 1.75rem;
        font-weight: 600;
        color: #343a40;
        margin: 0;
    }
    .profile-card-info p {
        margin: 5px 0 0;
        color: #6c757d;
        font-size: 1rem;
    }
    /* Body form */
    .form-body {
        padding: 30px;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    .form-group {
        display: flex;
        flex-direction: column;
    }
    .form-group label {
        font-weight: 500;
        margin-bottom: 8px;
        color: #495057;
        font-size: 0.95rem;
    }
    .form-group input[type="text"],
    .form-group input[type="file"] {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ced4da;
        border-radius: 8px;
        font-size: 1rem;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .form-group input[type="text"]:focus,
    .form-group input[type="file"]:focus {
        border-color: #ffc107;
        box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.25);
        outline: none;
    }
    .form-group input[readonly] {
        background-color: #e9ecef;
        cursor: not-allowed;
    }
    .form-group small {
        margin-top: 8px;
        color: #6c757d;
        font-size: 0.85rem;
    }
    .form-footer {
        padding: 20px 30px;
        text-align: right;
        background-color: #f8f9fa;
        border-top: 1px solid #e9ecef;
    }
    .btn-save {
        background-color: #ffc107;
        color: #333;
        padding: 12px 30px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 1rem;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        transition: background-color 0.3s, transform 0.2s;
    }
    .btn-save:hover {
        background-color: #e0a800;
        transform: translateY(-2px);
    }
    .alert-success {
        padding: 15px 20px; 
        background-color: #d1e7dd; 
        color: #0f5132; 
        border: 1px solid #badbcc; 
        border-radius: 8px; 
        margin: 0 auto 20px; 
        max-width: 800px;
        text-align: center;
        font-weight: 500;
    }

    .header {
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
  </style>
</head>
<body>

  <header class="header">
    <div class="header-left">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
    </div>
    <nav class="header-nav">
      <a href="<?= site_url('penjual/dashboard') ?>" class="nav-link">Home</a>
      <a href="#" class="nav-link active">Profile</a>
      <a href="#" class="nav-link">Report</a>
    </nav>
    <div class="header-right">
      <img src="<?= base_url('images/profile.jpg') ?>" alt="Profil" class="profile-pic" />
    </div>
  </header>

  <main class="container">

    <?php if (isset($success) && $success): ?>
        <div class="alert-success"><?= esc($success) ?></div>
    <?php endif; ?>

    <form action="<?= site_url('penjual/profile/update') ?>" method="post" enctype="multipart/form-data">
      <?= csrf_field() ?>
      <section class="profile-card">

        <div class="profile-card-header">
          <img src="<?= base_url($kantin['gambar_kantin'] ?? 'images/kantin.jpg') ?>" alt="Foto Kantin" class="profile-card-img" />
          <div class="profile-card-info">
            <h1>Profil Akun & Kantin</h1>
            <p>Perbarui informasi Anda di bawah ini</p>
          </div>
        </div>

        <div class="form-body">
          
          <div class="form-group">
            <label for="nama_penjual">Nama Penjual</label>
            <input type="text" id="nama_penjual" name="nama_penjual" value="<?= esc($penjual['nama_penjual']) ?>">
          </div>
          
          <div class="form-group">
            <label for="nama_kantin">Nama Kantin</label>
            <input type="text" id="nama_kantin" name="nama_kantin" value="<?= esc($kantin['nama_kantin']) ?>">
          </div>

          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?= esc($penjual['username']) ?>" readonly>
          </div>
          
          <div class="form-group">
            <label for="gambar_kantin">Ganti Gambar Kantin</label>
            <input type="file" id="gambar_kantin" name="gambar_kantin">
            <small>Kosongkan jika tidak ingin mengganti gambar.</small>
          </div>

        </div>

        <div class="form-footer">
          <button type="submit" class="btn-save">Simpan Perubahan</button>
        </div>
        
      </section>
    </form>
    
  </main>

</body>
</html>