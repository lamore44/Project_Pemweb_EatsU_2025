<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProdukModel;
use App\Models\MahasiswaModel;

class Mahasiswa extends BaseController
{
    public function dashboard()
    {
        // Check if user is a mahasiswa
        if (session()->get('role') !== 'mahasiswa') {
            return redirect()->to('/login'); // Redirect if not a mahasiswa
        }
        
        $produkModel = new ProdukModel();
        
        // Retrieve all products with additional details (like category and price)
        $produk = $produkModel->findAll();

        // Passing data to the view
        return view('mahasiswa/dashboard', ['produk' => $produk]);
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

        session()->set([
            'nama_mahasiswa' => $nama_mahasiswa,
            'email' => $email
        ]);

        return redirect()->to('/mahasiswa/edit-profile')->with('success', 'Profil berhasil diperbarui!');
    }
}
