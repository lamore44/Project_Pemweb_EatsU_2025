<?php
// app/Controllers/Penjual.php
namespace App\Controllers;

use CodeIgniter\Controller;

class Penjual extends BaseController
{
    public function dashboard()
    {
        // Check if user is a penjual
        if (session()->get('role') !== 'penjual') {
            return redirect()->to('/login'); // Redirect if not a penjual
        }

        return view('penjual/dashboard'); // Render penjual dashboard
    }
}
