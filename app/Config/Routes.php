<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


// Home :

$routes->get('/', 'Home::index');

// Auth :

$routes->get('sign-in-user', 'Auth::user_signin');
$routes->post('auth-user', 'Auth::user_auth');

$routes->get('sign-in-admin', 'Auth::admin_signin');
$routes->post('auth-admin', 'Auth::admin_auth');

// Root :

$routes->get('root', 'Root::root', ['filter' => 'admin-auth']);
$routes->get('root-tambah-admin', 'Root::admin_tambah', ['filter' => 'admin-auth']);
$routes->post('root-admin-a', 'Root::admin_a', ['filter' => 'admin-auth']);
$routes->get('root-admin-d/(:num)', 'Root::admin_d/$1', ['filter' => 'admin-auth']);

$routes->get('pengaturan-reward', 'Root::reward', ['filter' => 'admin-auth']);
$routes->get('edit-reward/(:num)', 'Root::reward_edit/$1', ['filter' => 'admin-auth']);
$routes->post('reward-a-golongan', 'Root::reward_a_golongan', ['filter' => 'admin-auth']);
$routes->get('reward-d-golongan/(:num)', 'Root::reward_d_golongan/$1', ['filter' => 'admin-auth']);
$routes->post('reward-u-berat/(:num)', 'Root::reward_u_berat/$1', ['filter' => 'admin-auth']);
$routes->post('reward-a-barang', 'Root::reward_a_barang', ['filter' => 'admin-auth']);
$routes->post('reward-u-barang/(:num)', 'Root::reward_u_barang/$1', ['filter' => 'admin-auth']);
$routes->get('reward-d-barang/(:num)/(:num)', 'Root::reward_d_barang/$1/$2', ['filter' => 'admin-auth']);

$routes->get('manajemen-konten', 'Root::konten', ['filter' => 'admin-auth']);
$routes->get('edit-about-us', 'Root::edit_aboutus', ['filter' => 'admin-auth']);
$routes->post('simpan-pembaharuan-about-us', 'Root::save_aboutus', ['filter' => 'admin-auth']);

//Admin :

$routes->get('dashboard', 'Admin::index', ['filter' => 'admin-auth']);
$routes->get('admin-logout', 'Admin::logout', ['filter' => 'admin-auth']);

$routes->get('setoran', 'Admin::setoran', ['filter' => 'admin-auth']);
$routes->get('setoran/(:num)', 'Admin::setoran_detail/$1', ['filter' => 'admin-auth']);
$routes->get('catat-setoran', 'Admin::catat_setoran', ['filter' => 'admin-auth']);
$routes->get('tambah-setoran/(:num)', 'Admin::tambah_setoran/$1', ['filter' => 'admin-auth']);
$routes->post('setoran-a', 'Admin::setoran_a', ['filter' => 'admin-auth']);
$routes->get('setoran-d/(:num)', 'Admin::setoran_d/$1', ['filter' => 'admin-auth']);
$routes->get('setoran-d-halaman-peserta/(:num)/(:num)', 'Admin::setoran_d_halaman_peserta/$1/$2', ['filter' => 'admin-auth']);

$routes->get('peserta', 'Admin::peserta', ['filter' => 'admin-auth']);
$routes->get('peserta/(:num)', 'Admin::peserta_detail/$1', ['filter' => 'admin-auth']);
$routes->get('tambah-peserta', 'Admin::tambah_peserta', ['filter' => 'admin-auth']);
$routes->get('edit-peserta/(:num)', 'Admin::edit_peserta/$1', ['filter' => 'admin-auth']);
$routes->get('peserta-s', 'Admin::peserta_s', ['filter' => 'admin-auth']);
$routes->get('peserta-ss', 'Admin::peserta_ss', ['filter' => 'admin-auth']);
$routes->post('peserta-a', 'Admin::peserta_a', ['filter' => 'admin-auth']);
$routes->get('peserta-a', 'Admin::peserta_a', ['filter' => 'admin-auth']);
$routes->post('peserta-e/(:num)', 'Admin::peserta_e/$1', ['filter' => 'admin-auth']);
$routes->get('peserta-d/(:num)', 'Admin::peserta_d/$1', ['filter' => 'admin-auth']);

$routes->get('atur-berita', 'Berita::index', ['filter' => 'admin-auth']);
$routes->get('tambah-berita', 'Berita::tambah', ['filter' => 'admin-auth']);
$routes->get('lihat-berita/(:segment)', 'Berita::lihat/$1', ['filter' => 'admin-auth']);
$routes->post('simpan-berita', 'Berita::simpan', ['filter' => 'admin-auth']);

$routes->get('analitik', 'Admin::analitik', ['filter' => 'admin-auth']);
$routes->get('analitik/download-analisis-bulanan/(:num)/(:num)', 'Admin::analitik_download_analisisbulanan/$1/$2', ['filter' => 'admin-auth']);

$routes->get('aturan-reward', 'Admin::aturan_reward', ['filter' => 'admin-auth']);

// User
$routes->get('user', 'User::index', ['filter' => 'user-auth']);
$routes->get('user-logout', 'User::logout', ['filter' => 'user-auth']);

$routes->get('profil-user', 'User::profil', ['filter' => 'user-auth']);
