-- TABEL USER (induk)
CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'penjual', 'mahasiswa') NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


-- TABEL ADMIN
CREATE TABLE admin (
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    nama_admin VARCHAR(100),
    email VARCHAR(100),
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
);

-- TABEL MAHASISWA
CREATE TABLE mahasiswa (
    id_mhs INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
);

-- TABEL PENJUAL
CREATE TABLE penjual (
    id_penjual INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
);

-- TABEL KANTIN
CREATE TABLE kantin (
    id_kantin INT AUTO_INCREMENT PRIMARY KEY,
    nama_kantin VARCHAR(100),
    id_penjual INT,
    FOREIGN KEY (id_penjual) REFERENCES penjual(id_penjual) ON DELETE CASCADE
);

-- TABEL PRODUK
CREATE TABLE produk (
    id_produk INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(100),
    harga DECIMAL(10,2),
    id_kantin INT,
    jumlah_produk INT,
    FOREIGN KEY (id_kantin) REFERENCES kantin(id_kantin) ON DELETE CASCADE
);

-- TABEL REVIEW
CREATE TABLE review (
    id_review INT AUTO_INCREMENT PRIMARY KEY,
    id_mhs INT,
    id_produk INT,
    rating INT CHECK (rating >= 1 AND rating <= 5),
    FOREIGN KEY (id_mhs) REFERENCES mahasiswa(id_mhs) ON DELETE CASCADE,
    FOREIGN KEY (id_produk) REFERENCES produk(id_produk) ON DELETE CASCADE
);

-- TABEL PEMESANAN (banyak ke banyak antara mahasiswa dan produk)
CREATE TABLE memesan (
    id_pesan INT AUTO_INCREMENT PRIMARY KEY,
    id_mhs INT,
    id_produk INT,
    waktu_pesan DATETIME,
    FOREIGN KEY (id_mhs) REFERENCES mahasiswa(id_mhs) ON DELETE CASCADE,
    FOREIGN KEY (id_produk) REFERENCES produk(id_produk) ON DELETE CASCADE
);

-- TABEL PEMBAYARAN
CREATE TABLE pembayaran (
    id_pembayaran INT AUTO_INCREMENT PRIMARY KEY,
    id_pesan INT,
    metode VARCHAR(50),
    status ENUM('pending', 'selesai') DEFAULT 'pending',
    FOREIGN KEY (id_pesan) REFERENCES memesan(id_pesan) ON DELETE CASCADE
);
