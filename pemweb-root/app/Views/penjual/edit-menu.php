<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Menu</title>
  <link rel="stylesheet" href="edit-menu.css" />
</head>
<body>
  <div class="form-wrapper">
    <header class="form-head">
      <h2>Edit Menu</h2>
    </header>

    <form class="form-body">
      <label>Nama Menu :
        <input type="text" value="Nasi Goreng">
      </label>

      <label>Tipe Menu :
        <input type="text" value="Makanan">
      </label>

      <label>Harga Menu :
        <input type="number" value="25000">
      </label>

      <p class="img-label">Tambahkan Gambar untuk Mengubah Gambar Awal</p>
      <div class="img-box">
        <input type="file" accept="image/*">
      </div>

      <footer class="form-foot">
        <button type="submit">Ubah</button>
      </footer>
    </form>
  </div>
</body>
</html>
