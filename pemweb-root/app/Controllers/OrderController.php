<?php

namespace App\Controllers;

use App\Models\MemesanModel;
use App\Models\PembayaranModel;

// Ganti nama class menjadi OrderController sesuai nama file
class OrderController extends BaseController
{
    /**
     * Menangani penambahan/pembaruan/penghapusan item di keranjang melalui AJAX.
     * Ini adalah endpoint utama untuk semua modifikasi keranjang secara real-time.
     */
    public function update_cart()
    {
        // Hanya izinkan request AJAX
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403, 'Forbidden');
        }

        $session = session();
        // Ambil keranjang dari session, atau buat array kosong jika belum ada
        $cart = $session->get('cart') ?? [];

        $id_produk = $this->request->getPost('id_produk');
        // Kuantitas bisa positif (menambah) atau negatif (mengurangi)
        $quantityChange = (int)$this->request->getPost('quantity');

        if (empty($id_produk)) {
            return $this->response->setJSON(['success' => false, 'message' => 'ID Produk tidak valid.']);
        }
        
        $itemExists = isset($cart[$id_produk]);
        
        // Jika item sudah ada di keranjang, ubah kuantitasnya
        if ($itemExists) {
            $cart[$id_produk]['quantity'] += $quantityChange;
        } 
        // Jika item belum ada dan kuantitas positif, tambahkan sebagai item baru
        else if ($quantityChange > 0) {
            $cart[$id_produk] = [
                'id_produk' => $id_produk,
                'name'      => $this->request->getPost('name'),
                'price'     => (float)$this->request->getPost('price'),
                'image'     => $this->request->getPost('image'),
                'quantity'  => $quantityChange
            ];
        }

        // Jika kuantitas menjadi 0 atau kurang, hapus item dari keranjang
        if (isset($cart[$id_produk]) && $cart[$id_produk]['quantity'] <= 0) {
            unset($cart[$id_produk]);
        }
        
        // Simpan kembali keranjang yang sudah diperbarui ke session
        $session->set('cart', $cart);

        // Kirim response JSON ke JavaScript
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Keranjang diperbarui!',
            // Kirim state keranjang yang baru. array_values() untuk reset keys agar menjadi array di JS
            'cart'    => array_values($cart) 
        ]);
    }

    /**
     * Menangani proses checkout final setelah user menekan "Bayar Sekarang".
     */
    public function checkout()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403, 'Forbidden');
        }

        $session = session();
        $id_user = $session->get('user_id');
        if (!$id_user) {
            return $this->response->setJSON(['success' => false, 'message' => 'Sesi login tidak ditemukan. Silakan login kembali.']);
        }

        // Ambil id_mhs dari tabel mahasiswa
        $db = \Config\Database::connect();
        $mhs = $db->table('mahasiswa')->where('user_id', $id_user)->get()->getRow();
        if (!$mhs) {
            return $this->response->setJSON(['success' => false, 'message' => 'Akun mahasiswa tidak ditemukan.']);
        }
        $id_mhs = $mhs->id_mhs;

        // Ambil data dari body request JSON yang dikirim JavaScript
        $json = $this->request->getJSON();
        $cart = $json->cart ?? [];
        $metode_pembayaran = $json->payment_method ?? 'Cash'; // Ambil metode pembayaran

        if (empty($cart)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Keranjang kosong.']);
        }

        $memesanModel = new MemesanModel();
        $pembayaranModel = new PembayaranModel();

        // Gunakan database transaction untuk memastikan semua data berhasil disimpan
        $db->transStart();

        foreach ($cart as $item) {
            $dataPesan = [
                'id_mhs'    => $id_mhs,
                'id_produk' => $item->id_produk, // Pastikan nama properti sesuai
                'jumlah'    => $item->quantity,
                'waktu_pesan' => date('Y-m-d H:i:s')
            ];
            // Insert data pesan dan dapatkan ID nya
            $memesanModel->insert($dataPesan);
            $id_pesan = $memesanModel->getInsertID();

            // Insert data pembayaran
            $pembayaranModel->insert([
                'id_pesan' => $id_pesan,
                'metode'   => $metode_pembayaran, // Gunakan metode dari pilihan user
                'status'   => 'pending' // atau 'Belum Bayar'
            ]);
        }

        $db->transComplete();

        // Cek apakah transaksi berhasil
        if ($db->transStatus() === false) {
            return $this->response->setJSON(['success' => false, 'message' => 'Terjadi kesalahan saat menyimpan pesanan ke database.']);
        }
        
        // Jika berhasil, kosongkan keranjang di session
        $session->remove('cart');

        return $this->response->setJSON(['success' => true, 'message' => 'Pesanan berhasil dibuat!']);
    }

    /**
     * Fungsi create lama tidak lagi digunakan dalam alur AJAX ini,
     * bisa dihapus atau diabaikan agar tidak membingungkan.
     */
    // public function create() { ... }
}
