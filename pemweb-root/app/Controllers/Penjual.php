<?php

namespace App\Controllers;

use App\Models\KantinModel;
use App\Models\ProdukModel;
use App\Models\ReviewModel;

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
}
