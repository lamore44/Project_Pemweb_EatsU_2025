<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Payment extends Controller
{
    public function index()
    {
        // Menampilkan halaman keranjang atau halaman checkout
        return view('mahasiswa/payment_view');
    }

    public function processPayment()
    {
        // Ambil data keranjang dari session (atau database jika perlu)
        $cart = session()->get('cart') ?? [];

        // Validasi jika keranjang kosong
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Keranjang Anda kosong!');
        }

        // Ambil data dari form (atau AJAX)
        $paymentMethod = $this->request->getPost('paymentMethod');

        // Hitung total harga
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        // Proses pembayaran (misalnya dengan QRIS, Cash, atau Transfer)
        if ($paymentMethod === 'QRIS') {
            // Proses pembayaran QRIS (misalnya, menggunakan API atau simulasi)
            $paymentStatus = 'Pembayaran dengan QRIS berhasil';
        } elseif ($paymentMethod === 'Cash') {
            // Proses pembayaran Cash
            $paymentStatus = 'Pembayaran dengan Cash berhasil';
        } elseif ($paymentMethod === 'Transfer') {
            // Proses pembayaran Transfer
            $paymentStatus = 'Pembayaran dengan Transfer berhasil';
        } else {
            return redirect()->back()->with('error', 'Metode pembayaran tidak valid!');
        }

        // Simulasi pembayaran berhasil
        session()->remove('cart'); // Menghapus keranjang setelah pembayaran

        // Redirect ke halaman konfirmasi atau berikan pesan sukses
        return redirect()->to('mahasiswa/payment-success')->with('success', $paymentStatus);
    }

    public function paymentSuccess()
    {
        // Menampilkan halaman sukses setelah pembayaran berhasil
        return view('mahasiswa/payment_success');
    }
}
