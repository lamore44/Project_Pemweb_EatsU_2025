<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rincian Pesanan</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

  <div class="receipt-box">
    <h3>Item</h3>
    <div class="order-details">
      <p><strong>Kantin A</strong></p>
      <div class="item-row">
        <span>Nasgor Pedas</span>
        <span>Rp. 15.000,00</span>
      </div>
      <hr>
      <div class="item-row total">
        <span>Total</span>
        <span>Rp. 15.000,00</span>
      </div>
    </div>
    <button id="payBtn">Bayar</button>
  </div>

  <!-- Modal Pembayaran -->
  <div id="paymentModal" class="modal">
    <div class="modal-content">
      <div class="modal-drag-bar"></div>
      <h2>PAYMENT METHODS</h2>

      <div class="payment-method">
        <img src="GoPay-Logo" alt="Gopay">
        <span>Rp 25.000<br><small>+pajak</small></span>
      </div>

      <div class="payment-method">
        <img src="Dana-Logo" alt="DANA">
        <span>Rp 25.000<br><small>+pajak</small></span>
      </div>

      <div class="payment-method">
        <img src="QRIS-Logo" alt="QRIS">
        <span>Rp 25.000<br><small>+pajak</small></span>
      </div>
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>
