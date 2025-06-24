<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Homepage Mahasiswa | EATSU</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                        <a href="<?= base_url('login') ?>" class="login-btn">logout</a>
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
                                 '<?= esc($p['nama_']) ?>',
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
    </main>

    <footer class="footer">
        <p>&copy; <?= date('Y') ?> EATSU. All Rights Reserved.</p>
    </footer>

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
            <button class="btn-checkout">Pesan Sekarang</button>
        </div>
    </aside>

    <script>
        // Fungsi lama untuk toggle menu profil
        function toggleProfileMenu() {
            document.getElementById('profile-menu').classList.toggle('hidden');
        }
        let currentModalData = {};
        let cart = []; // Format: [{ id, name, price, quantity, image }]

        // Referensi elemen-elemen DOM
        const modal = document.getElementById('quantityModal');
        const cartSidebar = document.getElementById('cartSidebar');
        const cartBadge = document.getElementById('cart-badge');
        const cartItemsContainer = document.getElementById('cart-items-container');
        const cartEmptyMsg = document.getElementById('cart-empty-msg');
        const cartTotalPriceEl = document.getElementById('cart-total-price');

        // Fungsi untuk membuka dan menutup keranjang
        function toggleCart() {
            cartSidebar.classList.toggle('open');
        }

        // Fungsi untuk membuka modal dengan data produk
        function openModal(id, name, formattedPrice, rawPrice, image) {
            currentModalData = {
                id,
                name,
                price: parseInt(rawPrice),
                image
            };

            modal.querySelector('.modal-title').textContent = name;
            modal.querySelector('.modal-price').textContent = `Rp ${formattedPrice}`;
            modal.querySelector('.modal-img').src = image;
            modal.querySelector('#modal-quantity-input').value = 1; // Reset jumlah
            modal.classList.add('show');
        }

        // Fungsi untuk menutup modal
        function closeModal() {
            modal.classList.remove('show');
        }

        // Fungsi untuk mengupdate tampilan keranjang
        function renderCart() {
            cartItemsContainer.innerHTML = ''; // Kosongkan kontainer
            let total = 0;
            let totalItems = 0;

            if (cart.length === 0) {
                cartItemsContainer.appendChild(cartEmptyMsg);
                cartEmptyMsg.style.display = 'block';
            } else {
                cartEmptyMsg.style.display = 'none';
                cart.forEach(item => {
                    total += item.price * item.quantity;
                    totalItems += item.quantity;
                    const itemEl = document.createElement('div');
                    itemEl.className = 'cart-item';
                    itemEl.innerHTML = `
                        <img src="${item.image}" alt="${item.name}" class="cart-item-img">
                        <div class="cart-item-details">
                            <p class="item-name">${item.name}</p>
                            <p class="item-price">Rp ${item.price.toLocaleString('id-ID')}</p>
                        </div>
                        <div class="cart-item-quantity">
                            <button onclick="updateQuantity('${item.id}', -1)">-</button>
                            <span>${item.quantity}</span>
                            <button onclick="updateQuantity('${item.id}', 1)">+</button>
                        </div>
                        <button class="cart-item-remove" onclick="removeFromCart('${item.id}')">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    `;
                    cartItemsContainer.appendChild(itemEl);
                });
            }

            // Update total harga dan badge notifikasi
            cartTotalPriceEl.textContent = `Rp ${total.toLocaleString('id-ID')}`;
            if (totalItems > 0) {
                cartBadge.textContent = totalItems;
                cartBadge.classList.remove('hidden');
            } else {
                cartBadge.classList.add('hidden');
            }
        }

        // Fungsi untuk menambah/mengurangi kuantitas di keranjang
        function updateQuantity(productId, change) {
            const itemIndex = cart.findIndex(item => item.id === productId);
            if (itemIndex > -1) {
                cart[itemIndex].quantity += change;
                if (cart[itemIndex].quantity <= 0) {
                    cart.splice(itemIndex, 1); // Hapus jika kuantitas jadi 0 atau kurang
                }
                renderCart();
            }
        }

        // Fungsi untuk menghapus item dari keranjang
        function removeFromCart(productId) {
            cart = cart.filter(item => item.id !== productId);
            renderCart();
        }

        // Event listener untuk tombol di modal
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
            const existingItem = cart.find(item => item.id === currentModalData.id);

            if (existingItem) {
                existingItem.quantity += quantity;
            } else {
                cart.push({
                    ...currentModalData,
                    quantity
                });
            }

            closeModal();
            renderCart(); // Perbarui tampilan keranjang
            if (!cartSidebar.classList.contains('open')) {
                toggleCart();
            }
        });

        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                closeModal();
            }
        });

        renderCart();
    </script>
</body>

</html>