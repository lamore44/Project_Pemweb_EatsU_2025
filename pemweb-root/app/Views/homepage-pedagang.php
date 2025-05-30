<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Halaman Pedagang</title>
    <link rel="stylesheet" href="homepage-pedagang.css">
</head>
<body>

<?php
$kategoriList = ['Makanan', 'Minuman', 'Snack'];
foreach ($kategoriList as $kategori):
    $stmt = $conn->prepare("SELECT * FROM menu WHERE kategori = ?");
    $stmt->bind_param("s", $kategori);
    $stmt->execute();
    $result = $stmt->get_result();
?>
    <div class="section">
        <h2 class="section-title"><?= $kategori ?></h2>
        <div class="menu-grid">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="menu-card">
                    <img src="uploads/<?= $row['gambar'] ?? 'menu.png' ?>" alt="Menu Image" class="menu-image">
                    <div class="menu-info">
                        <p class="menu-name"><?= htmlspecialchars($row['nama']) ?></p>
                        <p class="menu-price">Rp <?= number_format($row['harga'], 0, ',', '.') ?></p>
                        <a href="edit_menu.php?id=<?= $row['id'] ?>" class="edit-button">Edit Menu</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
<?php endforeach; ?>

</body>
</html>