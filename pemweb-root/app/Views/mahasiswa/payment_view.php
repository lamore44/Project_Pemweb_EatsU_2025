
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pembayaran - EATSU</title>
    <link rel="stylesheet" href="<?= base_url('style/homepage-mahasiswa.css') ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <h2>Metode Pembayaran</h2>
    <p>Total Pembayaran: Rp <?= number_format($totalPrice, 0, ',', '.') ?></p>
    <form action="<?= base_url('payment/processPayment') ?>" method="POST">
        <input type="hidden" name="id_pesan" value="<?= $id_pesan ?>"> <!-- Kirimkan ID pesanan -->
        <label for="paymentMethod">Pilih Metode Pembayaran:</label>
        <select id="paymentMethod" name="paymentMethod">
            <option value="QRIS">QRIS</option>
            <option value="Cash">Cash</option>
            <option value="Transfer">Transfer</option>
        </select>
        <button type="submit">Bayar Sekarang</button>
    </form>

</body>

</html>