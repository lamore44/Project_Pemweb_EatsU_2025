<?php
// app/Controllers/Admin.php
namespace App\Controllers;

use App\Models\KantinModel;
use App\Models\MemesanModel;
use App\Models\AdminModel;
use App\Models\ReviewModel;
use CodeIgniter\Controller;

class Admin extends BaseController
{
    public function index()
    {
        // Load model
        $kantinModel = new KantinModel();
        $memesanModel = new MemesanModel();
        $adminModel  = new AdminModel();
        $reviewModel = new ReviewModel();
        $db          = \Config\Database::connect();

        // Hitung jumlah baris
        $data['jumlahKantin']  = $kantinModel->countAll();
        $data['jumlahPesanan'] = $memesanModel->countAll();
        $data['jumlahAdmin']   = $adminModel->countAll();
        // $data['orders'] = $memesanModel->getRecentWithStatus(); 
        
        // Ambil data pemesanan terbaru beserta status pembayaran
        $data['orders'] = $db->table('memesan')
            ->select('memesan.id_pesan, mahasiswa.user_id AS mhs_id, produk.nama_produk, pembayaran.status, memesan.waktu_pesan')
            ->join('pembayaran', 'pembayaran.id_pesan = memesan.id_pesan')
            ->join('mahasiswa',  'mahasiswa.id_mhs   = memesan.id_mhs')
            ->join('produk',     'produk.id_produk  = memesan.id_produk')
            ->orderBy('memesan.waktu_pesan', 'DESC')
            ->limit(5)
            ->get()
            ->getResult();
        // ambil semua response terbaru, misal limit 5
        $data['reviews'] = $reviewModel
            ->select('review.id_review, mahasiswa.user_id AS mhs_id, produk.nama_produk, review.rating')
            ->join('mahasiswa', 'mahasiswa.id_mhs = review.id_mhs')
            ->join('produk', 'produk.id_produk = review.id_produk')
            ->orderBy('review.id_review', 'DESC')
            ->limit(5)
            ->findAll();

        return view('admin/dashboard', $data);
    }

    // Menampilkan form edit profil admin
    public function editProfile()
    {
        // Ambil data dari session
        $data = [
            'admin' => [
                'id_admin'    => session()->get('id_admin'),
                'nama_admin'  => session()->get('admin_name'),
                'email'       => session()->get('email'),
            ]
        ];

        return view('admin/edit_profile', $data);
    }

    public function updateProfile()
    {
        $adminModel = new AdminModel();

        $id_admin = session()->get('id_admin');
        $nama_admin = $this->request->getPost('nama_admin');
        $email = $this->request->getPost('email');

        if (!$id_admin) {
            return redirect()->back()->with('error', 'ID admin tidak ditemukan di session.');
        }

        // Cek dulu apakah data admin memang ada di DB
        $admin = $adminModel->find($id_admin);
        if (!$admin) {
            return redirect()->back()->with('error', 'Admin tidak ditemukan di database.');
        }

        // Lanjut update
        $updated = $adminModel->update($id_admin, [
            'nama_admin' => $nama_admin,
            'email' => $email
        ]);

        if ($updated === false) {
            return redirect()->back()->with('error', 'Gagal menyimpan ke database.');
        }

        // Update session
        session()->set([
            'admin_name' => $nama_admin,
            'email' => $email
        ]);

        return redirect()->to('/admin/edit-profile')->with('success', 'Profil berhasil diperbarui!');
    }


    // Menampilkan form ganti password
    public function changePassword()
    {
        return view('admin/change_password');
    }

    // Menyimpan password baru
    public function updatePassword()
    {
        $userModel = new \App\Models\UserModel();
        $userId = session()->get('user_id');

        $current = $this->request->getPost('current_password');
        $new     = $this->request->getPost('new_password');

        $user = $userModel->find($userId);

        if ($user && password_verify($current, $user['password'])) {
            $userModel->update($userId, ['password' => password_hash($new, PASSWORD_DEFAULT)]);
            return redirect()->to('/admin/change-password')->with('success', 'Password berhasil diubah.');
        } else {
            return redirect()->back()->with('error', 'Password lama salah.');
        }
    }
}
