<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/register', 'Auth::register');
$routes->post('/auth/register', 'Auth::processRegister');

$routes->get('/login', 'Auth::login'); // Show the login page
$routes->post('/auth/processLogin', 'Auth::processLogin'); // Process login
$routes->get('/logout', 'Auth::logout'); // Logout user

// Route Admin
$routes->get('/admin/dashboard', 'Admin::index');
$routes->get('/admin/edit_profile', 'Admin::editProfile');
$routes->post('/admin/update-profile', 'Admin::updateProfile');
$routes->get('/admin/change_password', 'Admin::changePassword');
$routes->post('/admin/update-password', 'Admin::updatePassword');
$routes->post('/admin/save_kantin', 'Admin::save_kantin');
$routes->post('/admin/save_admin', 'Admin::save_admin');



//Route Penjual
$routes->get('/penjual/dashboard', 'Penjual::dashboard');


//Route mahasiswa
$routes->get('/mahasiswa/dashboard', 'Mahasiswa::dashboard');


