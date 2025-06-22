<?php

namespace App\Controllers;

use App\Models\KantinModel;
use App\Models\MemesanModel;
use App\Models\AdminModel;
use App\Models\ReviewModel;
use App\Models\PenjualModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Admin extends BaseController
{
    public function index()
    {
        $kantinModel = new KantinModel();
        $memesanModel = new MemesanModel();
        $adminModel = new AdminModel();
        $reviewModel = new ReviewModel();
        $penjualModel = new PenjualModel();
        $db = \Config\Database::connect();

        $data['jumlahKantin'] = $kantinModel->countAll();
        $data['jumlahPesanan'] = $memesanModel->countAll();
        $data['jumlahAdmin'] = $adminModel->countAll();

        $data['orders'] = $db->table('memesan')
            ->select('memesan.id_pesan, mahasiswa.user_id AS mhs_id, produk.nama_produk, pembayaran.status, memesan.waktu_pesan')
            ->join('pembayaran', 'pembayaran.id_pesan = memesan.id_pesan')
            ->join('mahasiswa',  'mahasiswa.id_mhs = memesan.id_mhs')
            ->join('produk',     'produk.id_produk = memesan.id_produk')
            ->orderBy('memesan.waktu_pesan', 'DESC')
            ->limit(5)
            ->get()
            ->getResult();

        $data['reviews'] = $reviewModel
            ->select('review.id_review, mahasiswa.user_id AS mhs_id, produk.nama_produk, review.rating')
            ->join('mahasiswa', 'mahasiswa.id_mhs = review.id_mhs')
            ->join('produk', 'produk.id_produk = review.id_produk')
            ->orderBy('review.id_review', 'DESC')
            ->limit(5)
            ->findAll();

        $penjualList = $db->table('penjual')
            ->select('penjual.*')
            ->join('kantin', 'kantin.id_penjual = penjual.id_penjual', 'left')
            ->where('kantin.id_kantin IS NULL') // hanya penjual yang belum punya kantin
            ->get()->getResultArray();

        $data['penjualList'] = $penjualList;


        return view('admin/dashboard', $data);
    }

    public function save_kantin()
    {
        $kantinModel = new KantinModel();

        $data = [
            'nama_kantin' => $this->request->getPost('name'),
            'deskripsi'   => $this->request->getPost('description'),
            'id_penjual'  => $this->request->getPost('id_penjual')
        ];

        $kantinModel->insert($data);
        return redirect()->to('/admin/dashboard')->with('success', 'Kantin berhasil ditambahkan.');
    }

    public function save_admin()
    {
        $userModel = new UserModel();
        $adminModel = new AdminModel();

        $userData = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => 'admin'
        ];

        $userModel->insert($userData);
        $userId = $userModel->getInsertID();

        $adminModel->insert([
            'user_id'     => $userId,
            'nama_admin'  => $this->request->getPost('nama_admin'),
            'email'       => $this->request->getPost('email')
        ]);

        return redirect()->to('/admin/dashboard')->with('success', 'Admin berhasil ditambahkan.');
    }

    public function editProfile()
    {
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

        $admin = $adminModel->find($id_admin);
        if (!$admin) {
            return redirect()->back()->with('error', 'Admin tidak ditemukan.');
        }

        $adminModel->update($id_admin, [
            'nama_admin' => $nama_admin,
            'email' => $email
        ]);

        session()->set([
            'admin_name' => $nama_admin,
            'email' => $email
        ]);

        return redirect()->to('/admin/edit-profile')->with('success', 'Profil berhasil diperbarui!');
    }

    public function changePassword()
    {
        return view('admin/change_password');
    }

    public function updatePassword()
    {
        $userModel = new UserModel();
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
