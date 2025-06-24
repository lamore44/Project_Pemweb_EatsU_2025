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

ALTER TABLE penjual ADD COLUMN nama_penjual VARCHAR(100) AFTER user_id;

ALTER TABLE produk ADD COLUMN kategori VARCHAR(50) AFTER jumlah_produk;
UPDATE produk SET kategori='Makanan' WHERE id_produk=1;
UPDATE produk SET kategori='Minuman' WHERE id_produk=2;
UPDATE produk SET kategori='Snack' WHERE id_produk=3;   

ALTER TABLE kantin ADD COLUMN deskripsi TEXT;



INSERT INTO user (username, email, password, role) VALUES
('admin01', 'admin01@gmail.com', 'admin123', 'admin'),
('penjual01', 'penjual01@gmail.com', 'penjual123', 'penjual'),
('mhs01', 'mhs01@gmail.com', 'mhs1', 'mahasiswa'),
('mhs02', 'mhs02@gmail.com', 'mhs2', 'mahasiswa'),
('mhs03', 'mhs03@gmail.com', 'mhs3', 'mahasiswa');

INSERT INTO admin (nama_admin, email, user_id) VALUES
('Admin01', 'admin01@example.com', 1);

INSERT INTO penjual (user_id, nama_penjual) VALUES
(1, 'Pak Budi');

INSERT INTO mahasiswa (user_id) VALUES
(3),
(4),
(5);

INSERT INTO kantin (nama_kantin, id_penjual, deskripsi) VALUES
('Kantin Pak Budi', 1, 'Menjual makanan berat dan ringan.');

INSERT INTO produk (nama_produk, harga, id_kantin, jumlah_produk, kategori) VALUES
('Menu A', 25000, 1, 100, 'Makanan'),
('Menu B', 25000, 1, 150, 'Minuman'),
('Nasi Goreng', 20000, 1, 50, 'Makanan');

INSERT INTO review (id_mhs, id_produk, rating) 
VALUES 
(1, 1, 4),
(2, 2, 5),
(3, 3, 3);

INSERT INTO memesan (id_mhs, id_produk, waktu_pesan) VALUES
(1, 1, '2025-06-22 10:00:00'),
(2, 1, '2025-06-22 10:30:00'),
(3, 1, '2025-06-22 11:00:00');

INSERT INTO pembayaran (id_pesan, metode, status) VALUES
(1, 'QRIS', 'selesai'),
(2, 'Cash', 'pending'),
(3, 'Transfer', 'selesai');

ALTER TABLE mahasiswa
ADD COLUMN nama_mahasiswa VARCHAR(100) NOT NULL,
ADD COLUMN email VARCHAR(100) NOT NULL;



