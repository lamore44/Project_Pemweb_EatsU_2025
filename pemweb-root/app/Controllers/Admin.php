<?php
// app/Controllers/Admin.php
namespace App\Controllers;

use CodeIgniter\Controller;

class Admin extends BaseController
{
    public function dashboard()
    {
        // Check if user is an admin
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/login'); // Redirect if not an admin
        }

        return view('admin/dashboard'); // Render admin dashboard
    }
}
