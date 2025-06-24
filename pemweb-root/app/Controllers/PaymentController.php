<?php
namespace App\Controllers;

use App\Models\PembayaranModel;

class PaymentController extends BaseController
{
    public function processPayment()
    {
        // Mendapatkan data yang dikirimkan dari form pembayaran
        $paymentMethod = $this->request->getPost('paymentMethod');
        $id_pesan = $this->request->getPost('id_pesan'); // Pastikan Anda mengirimkan id_pesan yang relevan

        // Membuat instance model untuk pembayaran
        $pembayaranModel = new PembayaranModel();

        // Update status pembayaran di tabel pembayaran
        $dataPembayaran = [
            'metode' => $paymentMethod,
            'status' => 'selesai' // Anda dapat mengubah status ini setelah pembayaran selesai
        ];  

        $pembayaranModel->update($id_pesan, $dataPembayaran);

        // Mengarahkan pengguna ke halaman sukses atau halaman terima kasih
        return redirect()->to('/penjual/payment_view'); // Sesuaikan URL jika diperlukan
    }
}
