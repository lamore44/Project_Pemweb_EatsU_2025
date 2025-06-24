<?php

namespace App\Controllers;

use App\Models\KantinModel;
use App\Models\ProdukModel;
use App\Models\PenjualModel;
use App\Models\ReviewModel;
use App\Models\PembayaranModel;
use App\Models\MemesanModel;

class Penjual extends BaseController
{
    public function dashboard()
    {
        // Memeriksa apakah penjual sudah login
        if (
            !session()->has('id_penjual') ||
            session()->get('role') !== 'penjual'
        ) {
            return redirect()->to('/login');
        }


        $id_penjual = session()->get('id_penjual'); // Mendapatkan ID penjual dari sesi login

        // Inisialisasi model
        $kantinModel = new KantinModel();
        $produkModel = new ProdukModel();
        $reviewModel = new ReviewModel(); // Menambahkan model untuk review

        // Ambil data kantin milik penjual
        $kantin = $kantinModel->where('id_penjual', $id_penjual)->first();

        // Jika kantin tidak ditemukan
        if (!$kantin) {
            return view('penjual/no_kantin');
        }

        // Ambil produk berdasarkan kategori
        $kategoriList = ['Makanan', 'Minuman', 'Snack'];
        $produkByKategori = [];
        $ratings = [];

        foreach ($kategoriList as $kategori) {
            $produkByKategori[$kategori] = $produkModel
                ->where('id_kantin', $kantin['id_kantin'])
                ->where('kategori', $kategori)
                ->findAll();

            // Mengambil rating untuk setiap produk dalam kategori
            foreach ($produkByKategori[$kategori] as $produk) {
                $reviews = $reviewModel->getProductReviews($produk['id_produk']); // Ambil review untuk setiap produk
                $ratings[$produk['id_produk']] = $reviewModel->getRating($reviews); // Dapatkan rata-rata rating
            }
        }

        // Kirim data ke view
        return view('penjual/dashboard', [
            'kantin' => $kantin,
            'produkByKategori' => $produkByKategori,
            'ratings' => $ratings // Menyertakan data ratings
        ]);
    }
    public function tambahMenu()
    {
        // Memeriksa apakah penjual sudah login
        if (
            !session()->has('id_penjual') ||
            session()->get('role') !== 'penjual'
        ) {
            return redirect()->to('/login');
        }

        $id_penjual = session()->get('id_penjual'); // Mendapatkan ID penjual dari sesi login

        // Inisialisasi model
        $kantinModel = new KantinModel();
        $produkModel = new ProdukModel();

        // Ambil data kantin milik penjual
        $kantin = $kantinModel->where('id_penjual', $id_penjual)->first();

        // Jika kantin tidak ditemukan
        if (!$kantin) {
            return view('penjual/no_kantin');
        }

        if ($this->request->getMethod() === 'post') {
            // Proses penambahan menu
            $data = [
                'id_kantin' => $kantin['id_kantin'],
                'nama_produk' => $this->request->getPost('nama_produk'),
                'harga' => $this->request->getPost('harga'),
                'kategori' => $this->request->getPost('kategori'),
                'gambar' => $this->request->getFile('gambar')->getName(),
            ];

            // Simpan gambar ke direktori yang sesuai
            $gambarFile = $this->request->getFile('gambar');
            $namaFile = time() . '_' . $gambarFile->getName();
            $gambarFile->move(FCPATH . 'uploads', $namaFile);

            $data = [
                'id_kantin' => $kantin['id_kantin'],
                'nama_produk' => $this->request->getPost('nama_produk'),
                'harga' => $this->request->getPost('harga'),
                'kategori' => $this->request->getPost('kategori'),
                'gambar' => 'uploads/' . $namaFile, // simpan path relatif ke database
            ];


            // Simpan produk ke database
            if ($produkModel->save($data)) {
                return redirect()->to('/penjual/dashboard')->with('success', 'Menu berhasil ditambahkan.');
            } else {
                return redirect()->back()->withInput()->with('errors', $produkModel->errors());
            }
        }

        return view('penjual/tambah-menu', ['kantin' => $kantin]);
    }

    public function getIdKantin()
    {
        $session = session();
        $userId = $session->get('user_id'); // Pastikan user_id disimpan saat login

        if (!$userId) {
            return null; // atau bisa redirect ke login
        }

        // Ambil ID penjual dari tabel penjual
        $penjualModel = new \App\Models\PenjualModel();
        $penjual = $penjualModel->where('user_id', $userId)->first();

        if (!$penjual) {
            return null;
        }

        // Ambil ID kantin dari tabel kantin
        $kantinModel = new \App\Models\KantinModel();
        $kantin = $kantinModel->where('id_penjual', $penjual['id_penjual'])->first();

        return $kantin ? $kantin['id_kantin'] : null;
    }

    public function profile()
    {
        // Memeriksa apakah penjual sudah login
        if (!session()->has('id_penjual') || session()->get('role') !== 'penjual') {
            return redirect()->to('/login');
        }

        $id_penjual = session()->get('id_penjual');

        // Inisialisasi model
        $penjualModel = new PenjualModel();
        $kantinModel = new KantinModel();

        // Mengambil data penjual beserta username dari tabel user menggunakan JOIN
        $penjual = $penjualModel->getPenjualWithUser($id_penjual);

        // Ambil data kantin milik penjual
        $kantin = $kantinModel->where('id_penjual', $id_penjual)->first();

        // Jika data penjual atau kantin tidak ditemukan
        if (!$penjual || !$kantin) {
            // Anda bisa menampilkan pesan error atau halaman khusus
            return view('penjual/no_kantin');
        }

        return view('penjual/profile', [
            'penjual' => $penjual,
            'kantin' => $kantin,
            'success' => session()->getFlashdata('success') // Untuk notifikasi sukses
        ]);
    }

    /**
     * Memproses pembaruan data profil penjual dan kantin.
     */
    public function updateProfile()
    {
        if (!session()->has('id_penjual') || session()->get('role') !== 'penjual') {
            return redirect()->to('/login');
        }

        $id_penjual = session()->get('id_penjual');
        $penjualModel = new PenjualModel();
        $kantinModel = new KantinModel();

        // Ambil ID Kantin
        $kantinData = $kantinModel->where('id_penjual', $id_penjual)->first();
        if (!$kantinData) {
            return redirect()->back()->with('error', 'Kantin tidak ditemukan.');
        }

        // Data untuk diupdate
        $dataPenjual = [
            'nama_penjual' => $this->request->getPost('nama_penjual'),
        ];

        $dataKantin = [
            'nama_kantin' => $this->request->getPost('nama_kantin'),
        ];

        // Proses upload gambar jika ada
        $gambarFile = $this->request->getFile('gambar_kantin');
        if ($gambarFile->isValid() && !$gambarFile->hasMoved()) {
            $namaFile = $gambarFile->getRandomName();
            $gambarFile->move(FCPATH . 'uploads/kantin', $namaFile);
            $dataKantin['gambar_kantin'] = 'uploads/kantin/' . $namaFile;
        }

        // Update data
        $penjualModel->update($id_penjual, $dataPenjual);
        $kantinModel->update($kantinData['id_kantin'], $dataKantin);

        return redirect()->to('/penjual/profile')->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Menampilkan halaman daftar pesanan yang masuk
     * untuk produk-produk milik penjual yang sedang login.
     */
    public function cekPesanan()
    {
        $session = session();
        // Pastikan hanya penjual yang bisa akses
        if ($session->get('role') !== 'penjual') {
            return redirect()->to('/login');
        }

        $penjual_user_id = $session->get('user_id');
        if (!$penjual_user_id) {
            return redirect()->to('/login')->with('error', 'Sesi tidak valid.');
        }

        $db = \Config\Database::connect();

        // Query utama untuk mengambil semua pesanan yang relevan
        $builder = $db->table('penjual pnj');
        $builder->select('
            mhs.nama_mahasiswa,
            pr.nama_produk,
            ms.jumlah,
            ms.waktu_pesan,
            pm.status,
            pm.id_pembayaran
        ');
        $builder->join('kantin k', 'k.id_penjual = pnj.id_penjual');
        $builder->join('produk pr', 'pr.id_kantin = k.id_kantin');
        $builder->join('memesan ms', 'ms.id_produk = pr.id_produk');
        $builder->join('pembayaran pm', 'pm.id_pesan = ms.id_pesan');
        $builder->join('mahasiswa mhs', 'mhs.id_mhs = ms.id_mhs');
        $builder->where('pnj.user_id', $penjual_user_id);
        $builder->orderBy('ms.waktu_pesan', 'DESC');

        $data['pesanan'] = $builder->get()->getResultArray();

        // Ambil info kantin untuk ditampilkan di view
        $kantin_builder = $db->table('penjual pnj');
        $kantin_builder->select('k.nama_kantin');
        $kantin_builder->join('kantin k', 'k.id_penjual = pnj.id_penjual');
        $kantin_builder->where('pnj.user_id', $penjual_user_id);
        $data['kantin'] = $kantin_builder->get()->getRowArray();

        // Ganti nama view jika berbeda
        return view('penjual/cekPesanan-pedagang', $data);
    }

    /**
     * Menangani permintaan untuk mengonfirmasi pembayaran.
     * Mengubah status dari 'pending' menjadi 'selesai'.
     */
    public function konfirmasiPembayaran()
    {
        // Pastikan hanya penjual yang bisa akses
        if (session()->get('role') !== 'penjual') {
            return redirect()->to('/login');
        }

        $id_pembayaran = $this->request->getPost('id_pembayaran');
        if (!$id_pembayaran) {
            return redirect()->back()->with('error', 'ID Pembayaran tidak valid.');
        }

        // Gunakan PembayaranModel untuk update
        $pembayaranModel = new PembayaranModel();

        // Update status di database
        $pembayaranModel->update($id_pembayaran, ['status' => 'selesai']);

        // Redirect kembali ke halaman cek pesanan dengan pesan sukses
        return redirect()->to('penjual/cekPesanan-pedagang')->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }
}
