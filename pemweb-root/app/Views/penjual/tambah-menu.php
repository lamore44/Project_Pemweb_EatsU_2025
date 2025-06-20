<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tambah Menu</title>
  <link rel="stylesheet" href="tambah-menu.css" />
</head>
<body>
  <div class="form-wrapper">
    <header class="form-head">
      <h2>Tambah Menu</h2>
    </header>

    <form class="form-body">
      <label>Nama Menu :
        <input type="text" placeholder="Isi nama menu…">
      </label>

      <label>Tipe Menu :
        <input type="text" placeholder="Makanan / Minuman / Snack">
      </label>

      <label>Harga Menu :
        <input type="number" placeholder="Contoh : 25000">
      </label>

      <p class="img-label">Tambahkan Gambar</p>
      <div class="img-box">
        <input type="file" accept="image/*">
      </div>

      <footer class="form-foot">
        <button type="submit">Simpan</button>
      </footer>
    </form>
  </div>
</body>
</html>
