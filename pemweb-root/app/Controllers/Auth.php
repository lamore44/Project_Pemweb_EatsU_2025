<?php

// app/Controllers/Auth.php
namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AdminModel;
use App\Models\MahasiswaModel;
use App\Models\PenjualModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function register()
    {
        // Tampilkan form registrasi
        return view('auth/register');
    }
    public function processRegister()
    {
        try {
            // Debugging: Log or print input data
            log_message('debug', 'Form Data: ' . print_r($this->request->getPost(), true));
            
            // Ambil data dari form
            $username = $this->request->getPost('username');
            $email = $this->request->getPost('email');
            $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);  // Amankan password
            $role = $this->request->getPost('role');
            
            // Inisialisasi model
            $userModel = new UserModel();

            // Validasi apakah username atau email sudah ada
            if ($userModel->where('username', $username)->first()) {
                log_message('error', 'Username already exists: ' . $username);
                return redirect()->back()->with('error', 'Username sudah terdaftar!');
            }
            if ($userModel->where('email', $email)->first()) {
                log_message('error', 'Email already exists: ' . $email);
                return redirect()->back()->with('error', 'Email sudah terdaftar!');
            }

            // Simpan data pengguna ke tabel user
            $userData = [
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'role' => $role
            ];

            // Simpan data pengguna ke dalam database
            $userId = $userModel->insert($userData);

            // Tambahkan entri ke tabel terkait berdasarkan role
            if ($role == 'admin') {
                $adminModel = new AdminModel();
                $adminData = [
                    'nama_admin' => $username,  // Bisa ditambahkan field untuk nama admin jika diperlukan
                    'email' => $email,
                    'user_id' => $userId
                ];
                $adminModel->insert($adminData);
            } elseif ($role == 'mahasiswa') {
                $mahasiswaModel = new MahasiswaModel();
                $mahasiswaData = [
                    'user_id' => $userId
                ];
                $mahasiswaModel->insert($mahasiswaData);
            } elseif ($role == 'penjual') {
                $penjualModel = new PenjualModel();
                $penjualData = [
                    'user_id' => $userId
                ];
                $penjualModel->insert($penjualData);
            }

            // Redirect setelah registrasi sukses
            return redirect()->to('/login')->with('success', 'Registrasi berhasil, silakan login.');
        } catch (\Exception $e) {
            log_message('error', 'Registration Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan, coba lagi.');
        }
    }

    // app/Controllers/Auth.php
    public function login()
    {
        return view('auth/login');
    }

    public function processLogin()
    {
        // Get form data
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        
        // Load the UserModel
        $userModel = new UserModel();
        
        // Get the user from the database by email
        $user = $userModel->where('email', $email)->first();
        
        // Check if user exists and if the password matches
        if ($user && password_verify($password, $user['password'])) {
            // Store session data
            session()->set('user_id', $user['id']);
            session()->set('role', $user['role']);

            // Redirect based on role
            if ($user['role'] == 'admin') {
                return redirect()->to('/admin/dashboard');
            } elseif ($user['role'] == 'penjual') {
                return redirect()->to('/penjual/dashboard');
            } elseif ($user['role'] == 'mahasiswa') {
                return redirect()->to('/mahasiswa/dashboard');
            }
        } else {
            // If login fails, redirect back with an error message
            return redirect()->back()->with('error', 'Invalid email or password.');
        }
    }

    public function logout()
    {
        session()->destroy();  // Destroy the session
        return redirect()->to('/login');
    }

}
