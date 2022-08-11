<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/allproduk', 'Home::allproduk');
$routes->get('/about', 'Home::about');
$routes->get('/contact', 'Home::contact');

// profile
$routes->get('/profile', 'Profile::index');
$routes->get('/profile/edit', 'Profile::edit');
$routes->get('/profile/change', 'Profile::change');
$routes->post('/profile/editprofile', 'Profile::editProfile');
$routes->post('/profile/changepassword', 'Profile::changePassword');

// controller transaksi user
// keranjang
$routes->get('/cart', 'Transaction::cart');
$routes->get('/transaction/editjumlah/(:num)', 'Transaction::editJumlah/$1');
$routes->get('/beli/(:num)', 'Transaction::beli/$1');
$routes->post('/addcart', 'Transaction::addCart');
$routes->get('/transaction/deletecart/(:num)', 'Transaction::deleteCart/$1');
// checkout
$routes->get('/transaction/transaksi/(:num)', 'Transaction::transaksi/$1');
$routes->get('/transaction/pesan/(:num)', 'Transaction::pesan/$1');
$routes->get('/riwayat', 'Transaction::riwayat');
$routes->get('/riwayatpesan', 'Transaction::riwayatPesan');
$routes->get('/invoice/(:num)', 'Transaction::invoice/$1');
$routes->get('/hapus/(:num)', 'Transaction::hapus/$1');
// bukti pembayaran
$routes->get('/transaction/bukti/(:num)', 'Transaction::buktiBayar/$1');
$routes->get('/transaction/upload/(:num)', 'Transaction::upload/$1');

// auth
$routes->get('/login', 'AuthController::index');
$routes->post('/login', 'AuthController::login');
$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::save');
$routes->get('/logout', 'AuthController::logout');

$routes->post('/forgot', 'AuthController::forgot');
$routes->get('/forgot_password', 'AuthController::forgot_password');
$routes->get('/verify/(:any)', 'AuthController::verify/$1');
$routes->get('/resetpassword/(:any)', 'AuthController::resetpassword/$1');
$routes->get('/change_password', 'AuthController::change_password', ['filter' => 'isEmail']);
$routes->post('/reset', 'AuthController::reset', ['filter' => 'isEmail']);

// dashboard
$routes->get('/dashboard', 'DashboardController::index', ['filter' => 'isAdmin']);

// produk
$routes->get('product/new', 'Product::new');
$routes->post('product', 'Product::create');
$routes->get('product', 'Product::index');
$routes->get('product/(:num)', 'Product::show/$1');
$routes->get('product/(:num)/edit', 'Product::edit/$1');
$routes->put('product/(:num)', 'Product::update/$1');
$routes->delete('product/(:num)', 'Product::delete/$1');

// kategori
$routes->get('category', 'Category::index');
$routes->get('category/new', 'Category::new');
$routes->post('category', 'Category::create');
$routes->delete('category/(:num)', 'Category::delete/$1');

// stok
$routes->get('/stock', 'Stock::index');
$routes->get('stock/new', 'Stock::new');
$routes->post('stock', 'Stock::create');

// transaksi admin
$routes->get('/transaksi', 'Transaksi::index');
$routes->get('/transaksi/(:num)', 'Transaksi::show/$1');
$routes->get('/transaksi/kirim/(:num)', 'Transaksi::kirim/$1');

// komentar
$routes->get('/komentar/tulis/(:num)', 'Komentar::tulis/$1');
$routes->post('/komentar/create', 'Komentar::create');
$routes->get('/komentar/edit/(:num)/(:num)', 'Komentar::edit/$1/$2');
$routes->get('/komentar/update/(:num)', 'Komentar::update/$1');
$routes->get('/komentar/delete/(:num)', 'Komentar::delete/$1');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
