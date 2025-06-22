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
}
