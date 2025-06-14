<?php
// app/Controllers/Mahasiswa.php
namespace App\Controllers;

use CodeIgniter\Controller;

class Mahasiswa extends BaseController
{
    public function dashboard()
    {
        // Check if user is a mahasiswa
        if (session()->get('role') !== 'mahasiswa') {
            return redirect()->to('/login'); // Redirect if not a mahasiswa
        }

        return view('mahasiswa/dashboard'); // Render mahasiswa dashboard
    }
}
