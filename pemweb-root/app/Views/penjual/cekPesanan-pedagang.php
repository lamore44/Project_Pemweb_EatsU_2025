<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Cek Pesanan - <?= esc($kantin['nama_kantin'] ?? 'Kantin') ?></title>
    <!-- Pastikan path CSS benar -->
    <link rel="stylesheet" href="<?= base_url('style/cekPesanan-pedagang.css')?>">
    <style>
        /* Tambahan style untuk pesan notifikasi dan tombol */
        .alert { padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px; }
        .alert-success { color: #155724; background-color: #d4edda; border-color: #c3e6cb; }
        .alert-danger { color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; }
        .pesanan { display: flex; justify-content: space-between; align-items: center; }
        .info-pesanan { text-align: left; }
        .info-pesanan p { margin: 2px 0; }
        .info-pesanan .waktu { font-size: 0.8em; color: #666; }
        .aksi-pesanan { text-align: right; }
        .btn-konfirmasi { background-color: #28a745; color: white; padding: 8px 12px; border: none; border-radius: 5px; cursor: pointer; }
        .btn-konfirmasi:hover { background-color: #218838; }
    </style>
</head>
<body>
    <header>
        <!-- Anda bisa melengkapi header ini dengan navigasi yang benar -->
        <div class="logo">EATSU</div>
        <nav>
            <a href="<?= base_url('penjual/dashboard') ?>"><button>Home</button></a>
            <a href="<?= base_url('penjual/profile') ?>"><button>Profile</button></a>
            <a href="#"><button>Report</button></a>
        </nav>
        <div class="avatar"></div>
    </header>

    <section class="kantin-info">
        <img src="<?= base_url('images/kantin.jpg') ?>" alt="<?= esc($kantin['nama_kantin'] ?? '') ?>">
        <div>
            <h1><?= esc($kantin['nama_kantin'] ?? 'Nama Kantin Tidak Ditemukan') ?></h1>
            <!-- Logika rating bisa ditambahkan di sini jika perlu -->
        </div>
    </section>

    <section class="antrian">
        <h2>Antrian Pemesanan</h2>

        <!-- Menampilkan pesan sukses atau error dari session -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <!-- Cek jika ada pesanan atau tidak -->
        <?php if (empty($pesanan)): ?>
            <div class="pesanan" style="justify-content: center;">
                <p>Belum ada pesanan yang masuk.</p>
            </div>
        <?php else: ?>
            <!-- Loop untuk setiap pesanan -->
            <?php foreach ($pesanan as $item): ?>
                <div class="pesanan">
                    <div class="info-pesanan">
                        <p><strong><?= esc($item['nama_mahasiswa'] ?? 'Tanpa Nama') ?></strong> memesan:</p>
                        <p><?= esc($item['jumlah']) ?>x <?= esc($item['nama_produk']) ?></p>
                        <p class="waktu"><?= date('d M Y, H:i', strtotime($item['waktu_pesan'])) ?> WITA</p>
                    </div>
                    
                    <div class="aksi-pesanan">
                        <!-- Cek status pembayaran -->
                        <?php if ($item['status'] == 'pending'): ?>
                            <span class="status-menunggu">Menunggu Pembayaran</span>
                            <!-- Form untuk konfirmasi pembayaran -->
                            <form action="<?= base_url('penjual/konfirmasiPembayaran') ?>" method="post" style="display:inline; margin-left: 10px;">
                                <?= csrf_field() ?>
                                <input type="hidden" name="id_pembayaran" value="<?= $item['id_pembayaran'] ?>">
                                <button type="submit" class="btn-konfirmasi">Konfirmasi</button>
                            </form>
                        <?php else: ?>
                            <span class="status-berhasil">Pembayaran Berhasil</span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>
</body>
</html>
