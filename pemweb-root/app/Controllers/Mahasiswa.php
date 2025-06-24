<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProdukModel;
use App\Models\MahasiswaModel;
use App\Models\MemesanModel;

class Mahasiswa extends BaseController
{
    /**
     * Menampilkan dashboard utama untuk mahasiswa,
     * termasuk daftar produk dan riwayat pesanan mereka.
     */
    public function dashboard()
    {
        // 1. Validasi sesi: Pastikan pengguna adalah mahasiswa
        if (session()->get('role') !== 'mahasiswa') {
            return redirect()->to('/login'); // Redirect jika bukan mahasiswa
        }

        $session = session();
        $produkModel = new ProdukModel();

        // 2. Ambil semua data produk untuk ditampilkan di menu
        $data['produk'] = $produkModel->findAll();

        // 3. Ambil riwayat pesanan milik user yang sedang login
        $mahasiswa_user_id = $session->get('user_id'); 
        $data['pesanan'] = []; // Inisialisasi sebagai array kosong

        if ($mahasiswa_user_id) {
            $db = \Config\Database::connect();
            
            // Query untuk mengambil riwayat pesanan user dengan menggabungkan beberapa tabel
            $builder = $db->table('mahasiswa mhs');
            $builder->select('p.nama_produk, ms.waktu_pesan, pm.status, ms.jumlah');
            $builder->join('memesan ms', 'ms.id_mhs = mhs.id_mhs');
            $builder->join('produk p', 'p.id_produk = ms.id_produk');
            $builder->join('pembayaran pm', 'pm.id_pesan = ms.id_pesan');
            $builder->where('mhs.user_id', $mahasiswa_user_id); // Filter berdasarkan user_id yang login
            $builder->orderBy('ms.waktu_pesan', 'DESC'); // Urutkan dari pesanan terbaru

            $query = $builder->get();
            $data['pesanan'] = $query->getResultArray();
        }

        // 4. Ambil data keranjang dari session untuk di-pass ke JavaScript
        // Ini penting untuk inisialisasi keranjang saat halaman dimuat
        $data['cart'] = $session->get('cart') ?? [];

        // 5. Kirim semua data yang terkumpul ke view
        // Pastikan nama view ini ('mahasiswa/dashboard') sesuai dengan file view Anda
        return view('mahasiswa/dashboard', $data);
    }

    public function editProfile()
    {
        $data = [
            'mahasiswa' => [
                'id_mahasiswa'   => session()->get('id_mahasiswa'),
                'nama_mahasiswa' => session()->get('nama_mahasiswa'),
                'email'          => session()->get('email'),
            ]
        ];
        return view('mahasiswa/edit_profile', $data);
    }

    public function updateProfile()
    {
        $mahasiswaModel = new MahasiswaModel();
        $id_mahasiswa = session()->get('id_mahasiswa');

        $nama_mahasiswa = $this->request->getPost('nama_mahasiswa');
        $email = $this->request->getPost('email');

        if (!$id_mahasiswa) {
            return redirect()->back()->with('error', 'ID mahasiswa tidak ditemukan di session.');
        }

        $mahasiswa = $mahasiswaModel->find($id_mahasiswa);
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan.');
        }

        $mahasiswaModel->update($id_mahasiswa, [
            'nama_mahasiswa' => $nama_mahasiswa,
            'email' => $email
        ]);

        // Perbarui juga data di session agar langsung tampil
        session()->set([
            'nama_mahasiswa' => $nama_mahasiswa,
            'email' => $email
        ]);

        return redirect()->to('/mahasiswa/edit-profile')->with('success', 'Profil berhasil diperbarui!');
    }
}
    