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

// Route dashboard masing-masing
$routes->get('/admin/dashboard', 'Admin::dashboard');
$routes->get('/penjual/dashboard', 'Penjual::dashboard');
$routes->get('/mahasiswa/dashboard', 'Mahasiswa::dashboard');


