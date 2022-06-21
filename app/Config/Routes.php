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
$routes->post('/profile/edit', 'Profile::editProfile');
$routes->post('/profile/changepassword', 'Profile::changePassword');

// controller transaksi user
// keranjang
$routes->get('/cart', 'Transaction::cart');
$routes->get('/beli/(:num)', 'Transaction::beli/$1');
$routes->post('/addcart', 'Transaction::addCart');
// checkout
$routes->get('/transaction', 'Transaction::index');
$routes->get('/transaction/pesan', 'Transaction::pesan');
$routes->get('/riwayat', 'Transaction::riwayat');
$routes->get('/invoice', 'Transaction::invoice');
// bukti pembayaran
$routes->get('/transaction/bukti/(:num)', 'Transaction::buktiBayar/$1');
$routes->get('/transaction/upload/(:num)', 'Transaction::upload/$1');

// transaksi admin
$routes->get('/transaksi', 'Transaksi::index');
$routes->get('/transaksi/(:num)', 'Transaksi::show/$1');
$routes->get('/transaksi/kirim/(:num)', 'Transaksi::kirim/$1');

// auth
$routes->get('/login', 'AuthController::index');
$routes->post('/login', 'AuthController::login');
$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::save');
$routes->get('/logout', 'AuthController::logout');

// dashboard
$routes->get('/dashboard', 'DashboardController::index');

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
$routes->get('stock/min', 'Stock::min');
$routes->post('stock', 'Stock::create');
$routes->post('stock/min', 'Stock::save');


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
