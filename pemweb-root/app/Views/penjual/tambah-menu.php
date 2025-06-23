<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tambah Menu</title>
  <link rel="stylesheet" href="<?= base_url('style/tambah-menu.css')?>" />
</head>
<body>
  <div class="form-wrapper">
    <header class="form-head">
      <h2>Tambah Menu</h2>
    </header>

    <?php
    use App\Controllers\Penjual;

    // Koneksi ke database
    $conn = new mysqli("localhost", "root", "adhiet", "unram_eats_db");
    if ($conn->connect_error) {
      die("Koneksi gagal: " . $conn->connect_error);
    }

    // Ambil id_kantin dari fungsi getIdKantin
    $penjualController = new Penjual();
    $id_kantin = $penjualController->getIdKantin(); // Pastikan ini mengembalikan ID yang valid

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $nama = $_POST['nama_menu'];
      $tipe = $_POST['tipe_menu'];
      $harga = $_POST['harga_menu'];
      $gambar = '';
      $jumlah = 100; // Default stok awal

      // Upload gambar
      if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
        $gambar = $target_dir . basename($_FILES["gambar"]["name"]);
        move_uploaded_file($_FILES["gambar"]["tmp_name"], $gambar);
      }

      // Simpan ke tabel produk
      $stmt = $conn->prepare("INSERT INTO produk (nama_produk, harga, id_kantin, jumlah_produk, kategori, gambar) VALUES (?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("sdiiss", $nama, $harga, $id_kantin, $jumlah, $tipe, $gambar);
      if ($stmt->execute()) {
        echo "<p style='color:green'>Menu berhasil ditambahkan!</p>";
      } else {
        echo "<p style='color:red'>Gagal menambah menu: {$stmt->error}</p>";
      }
      $stmt->close();
    }
    ?>

    <form class="form-body" method="POST" enctype="multipart/form-data">
      <label>Nama Menu:
        <input type="text" name="nama_menu" placeholder="Isi nama menu…" required>
      </label>

      <label>Tipe Menu:
        <input type="text" name="tipe_menu" placeholder="Makanan/Minuman/Snack" required>
      </label>

      <label>Harga Menu:
        <input type="number" name="harga_menu" placeholder="Contoh:25000" required>
      </label>

      <p class="img-label">Tambahkan Gambar</p>
      <div class="img-box">
        <input type="file" name="gambar" accept="image/*" required>
      </div>

      <footer class="form-foot">
        <button type="submit">Simpan</button>
      </footer>
    </form>
  </div>
</body>
</html>
