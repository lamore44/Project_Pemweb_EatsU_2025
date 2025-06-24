<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Homepage Mahasiswa | EATSU</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Pastikan path CSS sudah benar -->
    <link rel="stylesheet" href="<?= base_url('style/homepage-mahasiswa.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    <nav class="navbar">
        <div class="nav-left">
            <h1 class="logo">EATSU</h1>
        </div>
        <div class="nav-right">
            <div class="cart-icon" onclick="toggleCart()">
                <i class="fa-solid fa-cart-shopping"></i>
                <!-- Badge notifikasi akan di-handle oleh JavaScript -->
                <span id="cart-badge" class="cart-badge hidden">0</span>
            </div>

            <div class="profile-container">
                <img src="<?= base_url('images/profile-icon.png') ?>" alt="Profile" class="profile-icon" onclick="toggleProfileMenu()" />
                <div id="profile-menu" class="profile-menu hidden">
                    <p class="username">
                        Signed in as<br>
                        <strong><?= esc(session()->get('username') ?? 'Bagus') ?></strong>
                    </p>
                    <?php if (session()->get('username')): ?>
                        <form action="<?= base_url('logout') ?>" method="post">
                            <button type="submit" class="logout-btn">Logout</button>
                        </form>
                    <?php else: ?>
                        <a href="<?= base_url('login') ?>" class="login-btn">Login</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <section class="hero">
        <h1 class="title">WELCOME to EATSU</h1>
        <p class="subtitle">Find your favorite food at <br> Unram Cafeteria</p>
        <div class="scroll-down"><i class="fas fa-chevron-down"></i></div>
    </section>

    <main class="main-content">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <section class="menu-section">
            <div class="section-header">
                <h2>Menu</h2>
            </div>
            <div class="cards-container">
                <?php if ($produk): ?>
                    <?php foreach ($produk as $p): ?>
                        <div class="menu-card"
                             onclick="openModal(
                                 '<?= esc($p['id_produk']) ?>',
                                 '<?= esc($p['nama_produk']) ?>',
                                 '<?= number_format($p['harga'], 0, ',', '.') ?>',
                                 '<?= $p['harga'] ?>',
                                 '<?= base_url('images/placeholder_menu.png') ?>'
                             )">
                            <img src="<?= base_url('images/placeholder_menu.png') ?>" alt="<?= esc($p['nama_produk']) ?>">
                            <div class="card-content">
                                <h3><?= esc($p['nama_produk']) ?></h3>
                                <p class="price">Rp <?= number_format($p['harga'], 0, ',', '.') ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Belum ada menu yang tersedia.</p>
                <?php endif; ?>
            </div>
        </section>

        <section class="pesanan-section">
            <div class="section-header">
                <h2>Pesanan Saya</h2>
            </div>
            <div class="pesanan-container">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Waktu Pesan</th>
                            <th>Status Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($pesanan)): ?>
                            <?php foreach ($pesanan as $item): ?>
                                <tr>
                                    <td><?= esc($item['nama_produk']) ?></td>
                                    <td><?= esc($item['waktu_pesan']) ?></td>
                                    <td><?= esc($item['status']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3">Belum ada pesanan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <footer class="footer">
        <p>&copy; <?= date('Y') ?> EATSU. All Rights Reserved.</p>
    </footer>

    <!-- Modal Kuantitas Produk -->
    <div class="modal-overlay" id="quantityModal">
        <div class="modal-content">
            <img src="" alt="Gambar Makanan" class="modal-img">
            <h2 class="modal-title">Nama Makanan</h2>
            <p class="modal-price">Rp 0</p>
            <p>Jumlah:</p>
            <div class="quantity-selector">
                <button class="quantity-btn" id="modal-minus-btn">-</button>
                <input type="text" class="quantity-input" id="modal-quantity-input" value="1" readonly>
                <button class="quantity-btn" id="modal-plus-btn">+</button>
            </div>
            <button class="btn-add-to-cart" id="addToCartBtn">Tambahkan ke Keranjang</button>
            <button class="btn-close-modal" onclick="closeModal()">Tutup</button>
        </div>
    </div>

    <!-- Modal Pembayaran -->
    <div class="modal-overlay" id="paymentModal">
        <div class="modal-content">
            <h2 class="modal-title">Pembayaran</h2>
            <p class="modal-price" id="payment-total">Total: Rp 0</p>
            <p>Pilih Metode Pembayaran:</p>
            <select id="payment-method" style="width:100%;padding:8px;border-radius:5px;margin-bottom:18px;">
                <option value="QRIS">QRIS</option>
                <option value="Cash">Cash</option>
                <option value="Transfer">Transfer</option>
            </select>
            <button class="btn-add-to-cart" id="payNowBtn">Bayar Sekarang</button>
            <button class="btn-close-modal" onclick="closePaymentModal()">Batal</button>
        </div>
    </div>

    <!-- Sidebar Keranjang -->
    <aside class="cart-sidebar" id="cartSidebar">
        <div class="cart-header">
            <h3>Keranjang Anda</h3>
            <button class="btn-close-cart" onclick="toggleCart()">x</button>
        </div>
        <div class="cart-body" id="cart-items-container">
            <div id="cart-empty-msg" class="cart-empty-msg">
                <p>Keranjang Anda masih kosong.</p>
            </div>
        </div>
        <div class="cart-footer">
            <div class="cart-total">
                <span>Total</span>
                <span id="cart-total-price">Rp 0</span>
            </div>
            <button class="btn-checkout" id="checkoutBtn">Pesan Sekarang</button>
        </div>
    </aside>

    <script>
        // --- Global State & Element References ---
        let currentModalData = {};
        // Inisialisasi keranjang dari data session PHP, menggunakan id_produk sebagai key
        // Ini akan disinkronkan dengan server setiap ada perubahan
        let cart = <?= json_encode(array_values(session('cart') ?? [])); ?>;

        const quantityModal = document.getElementById('quantityModal');
        const paymentModal = document.getElementById('paymentModal');
        const cartSidebar = document.getElementById('cartSidebar');
        const cartBadge = document.getElementById('cart-badge');
        const cartItemsContainer = document.getElementById('cart-items-container');
        const cartEmptyMsg = document.getElementById('cart-empty-msg');
        const cartTotalPriceEl = document.getElementById('cart-total-price');

        // --- Core Functions ---
        function toggleProfileMenu() {
            document.getElementById('profile-menu').classList.toggle('hidden');
        }

        function toggleCart() {
            cartSidebar.classList.toggle('open');
        }

        function openModal(id_produk, name, formattedPrice, rawPrice, image) {
            currentModalData = { id_produk, name, price: parseInt(rawPrice), image };
            quantityModal.querySelector('.modal-title').textContent = name;
            quantityModal.querySelector('.modal-price').textContent = `Rp ${formattedPrice}`;
            quantityModal.querySelector('.modal-img').src = image;
            quantityModal.querySelector('#modal-quantity-input').value = 1;
            quantityModal.classList.add('show');
        }

        function closeModal() {
            quantityModal.classList.remove('show');
        }
        
        function openPaymentModal() {
            const total = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
            if (total <= 0) {
                 // Ganti alert dengan notifikasi yang lebih baik jika ada
                 alert('Keranjang Anda kosong!');
                 return;
            }
            document.getElementById('payment-total').textContent = `Total: Rp ${total.toLocaleString('id-ID')}`;
            paymentModal.classList.add('show');
            toggleCart();
        }

        function closePaymentModal() {
            paymentModal.classList.remove('show');
        }

        // --- Cart Rendering ---
        function renderCart() {
            cartItemsContainer.innerHTML = ''; 
            let total = 0;
            let totalItems = 0;

            if (cart.length === 0) {
                cartItemsContainer.appendChild(cartEmptyMsg);
                cartEmptyMsg.style.display = 'block';
            } else {
                cartEmptyMsg.style.display = 'none';
                cart.forEach(item => {
                    total += item.price * item.quantity;
                    totalItems += parseInt(item.quantity);
                    const itemEl = document.createElement('div');
                    itemEl.className = 'cart-item';
                    itemEl.innerHTML = `
                        <img src="${item.image}" alt="${item.name}" class="cart-item-img">
                        <div class="cart-item-details">
                            <p class="item-name">${item.name}</p>
                            <p class="item-price">Rp ${item.price.toLocaleString('id-ID')}</p>
                        </div>
                        <div class="cart-item-quantity">
                            <button onclick="updateCartItem('${item.id_produk}', -1)">-</button>
                            <span>${item.quantity}</span>
                            <button onclick="updateCartItem('${item.id_produk}', 1)">+</button>
                        </div>
                        <button class="cart-item-remove" onclick="updateCartItem('${item.id_produk}', -item.quantity)">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>`;
                    cartItemsContainer.appendChild(itemEl);
                });
            }

            cartTotalPriceEl.textContent = `Rp ${total.toLocaleString('id-ID')}`;
            document.getElementById('checkoutBtn').disabled = cart.length === 0;

            if (totalItems > 0) {
                cartBadge.textContent = totalItems;
                cartBadge.classList.remove('hidden');
            } else {
                cartBadge.classList.add('hidden');
            }
        }
        
        // --- Asynchronous Cart Operations (Communicates with PHP Backend) ---
        async function updateCartItem(produk_id, quantityChange, itemData = null) {
            const formData = new FormData();
            formData.append('id_produk', produk_id);
            formData.append('quantity', quantityChange);
            
            if (itemData) {
                formData.append('name', itemData.name);
                formData.append('price', itemData.price);
                formData.append('image', itemData.image);
            }

            try {
                const response = await fetch('<?= base_url('order/update_cart') ?>', {
                    method: 'POST',
                    headers: { 'X-Requested-With': 'XMLHttpRequest' },
                    body: formData
                });
                const data = await response.json();

                if (data.success) {
                    cart = data.cart; 
                    renderCart();
                } else {
                    alert(data.message || 'Gagal memperbarui keranjang.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan koneksi.');
            }
        }
        
        // --- Event Listeners ---
        document.getElementById('modal-plus-btn').addEventListener('click', () => {
            const input = document.getElementById('modal-quantity-input');
            input.value = parseInt(input.value) + 1;
        });

        document.getElementById('modal-minus-btn').addEventListener('click', () => {
            const input = document.getElementById('modal-quantity-input');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        });

        document.getElementById('addToCartBtn').addEventListener('click', () => {
            const quantity = parseInt(document.getElementById('modal-quantity-input').value);
            updateCartItem(currentModalData.id_produk, quantity, currentModalData);
            closeModal();
            if (!cartSidebar.classList.contains('open')) {
                toggleCart();
            }
        });

        document.getElementById('checkoutBtn').addEventListener('click', openPaymentModal);

        document.getElementById('payNowBtn').addEventListener('click', async () => {
             const paymentMethod = document.getElementById('payment-method').value;
             const orderData = {
                 cart: cart,
                 payment_method: paymentMethod
             };
             
             try {
                const response = await fetch('<?= base_url('order/checkout') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify(orderData)
                });
                const data = await response.json();

                if (data.success) {
                    alert('Pesanan berhasil dibuat! Halaman akan dimuat ulang.');
                    window.location.reload(); 
                } else {
                    alert(data.message || 'Gagal membuat pesanan.');
                }
             } catch(error) {
                console.error('Checkout Error:', error);
                alert('Terjadi kesalahan saat checkout.');
             }
        });
        
        window.addEventListener('click', (event) => {
            if (event.target === quantityModal) closeModal();
            if (event.target === paymentModal) closePaymentModal();
        });

        document.addEventListener('DOMContentLoaded', renderCart);
    </script>
</body>
</html>
