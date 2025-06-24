<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tambah Menu</title>
  <link rel="stylesheet" href="<?= base_url('style/tambah-menu.css') ?>" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
  <div class="form-wrapper">
    <header class="form-head">
      <a href="javascript:history.back()" class="back-button"><i class="fas fa-arrow-left"></i> Kembali</a>
      <h2>Tambah Menu</h2>
    </header>

    <div class="status-message">
      <?php

      use App\Controllers\Penjual;

      // Cek apakah form disubmit
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Koneksi ke database
        $conn = new mysqli("localhost", "root", "", "unram_eats_db");
        if ($conn->connect_error) {
          die("Koneksi gagal: " . $conn->connect_error);
        }

        // Ambil id_kantin dari fungsi getIdKantin
        $penjualController = new Penjual();
        $id_kantin = $penjualController->getIdKantin();

        $nama = $_POST['nama_menu'];
        $tipe = $_POST['tipe_menu'];
        $harga = $_POST['harga_menu'];
        $gambar = '';
        $jumlah = 100; // Default stok awal

        // Upload gambar
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
          $target_dir = FCPATH . 'uploads/';
          if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
          }

          $namaFile = time() . '_' . basename($_FILES["gambar"]["name"]);
          $gambar = 'uploads/' . $namaFile;
          move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_dir . $namaFile);
        }


        // Simpan ke tabel produk
        $stmt = $conn->prepare("INSERT INTO produk (nama_produk, harga, id_kantin, jumlah_produk, kategori, gambar) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sdiiss", $nama, $harga, $id_kantin, $jumlah, $tipe, $gambar);
        if ($stmt->execute()) {
          echo "<p class='success'>Menu berhasil ditambahkan!</p>";
        } else {
          echo "<p class='error'>Gagal menambah menu: {$stmt->error}</p>";
        }
        $stmt->close();
        $conn->close();
      }
      ?>
    </div>

    <form class="form-body" method="POST" enctype="multipart/form-data">
      <label>Nama Menu:
        <input type="text" name="nama_menu" placeholder="Isi nama menu…" required>
      </label>

      <label>Tipe Menu:
        <input type="text" name="tipe_menu" placeholder="Contoh: Makanan, Minuman, atau Snack" required>
      </label>

      <label>Harga Menu:
        <input type="number" name="harga_menu" placeholder="Contoh: 25000 (tanpa titik atau koma)" required>
      </label>

      <p class="img-label">Tambahkan Gambar</p>
      <div class="img-box">
        <label for="file-upload" class="file-upload-label">
          <i class="fas fa-cloud-upload-alt"></i>
          <span>Pilih file untuk diunggah</span>
        </label>
        <input id="file-upload" type="file" name="gambar" accept="image/*" required>
      </div>

      <footer class="form-foot">
        <button type="submit" class="save-button">Simpan</button>
      </footer>
    </form>
  </div>
</body>

</html>