<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('BaseController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/login', 'Auth::index', ['namespace' => 'App\Controllers\Main']);
$routes->post('/auth/login', 'Auth::index', ['namespace' => 'App\Controllers\AJAX']);
$routes->get('/auth/logout', 'Auth::logout', ['namespace' => 'App\Controllers\AJAX']);

$routes->get('/user', 'User::index', ['namespace' => 'App\Controllers\Main', 'role' => '1', 'ajax' => true]);
$routes->get('/user/getUser', 'User::index', ['namespace' => 'App\Controllers\AJAX', 'role' => '1', 'ajax' => true]);
$routes->get('/user/add', 'User::add', ['namespace' => 'App\Controllers\Main', 'role' => 1, 'ajax' => false]);
$routes->post('/user/insertData', 'User::insertData', ['namespace' => 'App\Controllers\AJAX', 'role' => 1, 'ajax' => true]);
$routes->post('/user/deleteData', 'User::deleteData', ['namespace' => 'App\Controllers\AJAX', 'role' => 1, 'ajax' => true]);
$routes->get('/user/getDetail/(:num)', 'User::getDetail/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);
$routes->post('/user/updateData/(:num)', 'User::updateData/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);

$routes->get('/bank', 'Bank::index', ['namespace' => 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' => false]);
$routes->get('/bank/getBank', 'Bank::index', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);
$routes->get('/bank/add', 'Bank::add', ['namespace' => 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' => false]);
$routes->post('/bank/insertData', 'Bank::insertData', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);
$routes->post('/bank/deleteData', 'Bank::deleteData', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);
$routes->get('/bank/getDetail/(:num)', 'Bank::getDetail/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);
$routes->post('/bank/updateData/(:num)', 'Bank::updateData/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);

$routes->get('/customer', 'Customer::index', ['namespace' => 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' => false]);
$routes->get('/customer/getCustomer', 'Customer::index', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);
$routes->get('/customer/add', 'Customer::add', ['namespace' => 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' => false]);
$routes->post('/customer/insertData', 'Customer::insertData', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);
$routes->post('/customer/deleteData', 'Customer::deleteData', ['namespace' => 'App\Controllers\AJAX', 'role' => 1, 'ajax' => true]);
$routes->get('/customer/getDetail/(:num)', 'Customer::getDetail/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);
$routes->post('/customer/updateData/(:num)', 'Customer::updateData/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);

$routes->get('/invoice', 'Invoice::index', ['namespace' => 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' => false]);
$routes->get('/invoice/getInvoice', 'Invoice::index', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);
$routes->get('/invoice/add', 'Invoice::add', ['namespace' => 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' => false]);
$routes->post('/invoice/insertData', 'Invoice::insertData', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);
$routes->post('/invoice/deleteData', 'Invoice::deleteData', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);
$routes->get('/invoice/getDetail/(:num)', 'Invoice::getDetail/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);
$routes->post('/invoice/updateData/(:num)', 'Invoice::updateData/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);

$routes->get('/piutang', 'Piutang::index', ['namespace' => 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' => false]);
$routes->get('/piutang/getPiutang/(:any)', 'Piutang::index/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);
$routes->get('/piutang/getDetailHutang/(:num)', 'Piutang::getDetailHutang/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);
$routes->get('/piutang/getDetailInvoice/(:num)/(:any)', 'Piutang::getDetailInvoice/$1/$2', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);
$routes->get('/piutang/getNotifikasi', 'Piutang::getNotifikasi', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);

$routes->get('/payment', 'Payment::index', ['namespace' => 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' => false]);
$routes->get('/payment/getPayment/(:any)/(:any)/(:any)', 'Payment::index/$1/$2/$3', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);
$routes->post('/payment/payment/(:num)/(:any)', 'Payment::payment/$1/$2', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);
$routes->get('/payment/getDetail/(:num)', 'Payment::getDetail/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);
$routes->get('/payment/getInvoiceDetail/(:num)', 'Payment::getInvoiceDetail/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);
$routes->post('/payment/updateData/(:num)', 'Payment::updateData/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);
$routes->post('/payment/verification', 'Payment::verification', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);
$routes->post('/payment/deleteData', 'Payment::deleteData', ['namespace' => 'App\Controllers\AJAX', 'role' => 1, 'ajax' => true]);
$routes->get('/payment/cetakPayment/(:any)/(:any)/(:any)', 'Payment::cetakPayment/$1/$2/$3', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => false]);
$routes->get('/payment/buktiPembayaran/(:any)', 'Payment::cetakPayment/$1/$2/$3', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => false]);

$routes->get('/retur', 'Retur::index', ['namespace' => 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' => true]);
$routes->get('/retur/getRetur/(:any)', 'Retur::index/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);
$routes->get('/retur/add', 'Retur::add', ['namespace' => 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' => false]);
$routes->post('/retur/insertData', 'Retur::insertData', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);
$routes->get('/retur/getDetail/(:num)', 'Retur::getDetail/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);
$routes->post('/retur/updateData/(:num)', 'Retur::updateData/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);
$routes->post('/retur/deleteData', 'Retur::deleteData', ['namespace' => 'App\Controllers\AJAX', 'role' => 1, 'ajax' => true]);

$routes->get('/rekpenerima', 'RekPenerima::index', ['namespace' => 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' => false]);
$routes->get('/rekpenerima/getRekPenerima/(:any)', 'RekPenerima::index/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);
$routes->get('/rekpenerima/add', 'RekPenerima::add', ['namespace' => 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' => false]);
$routes->post('/rekpenerima/insertData', 'RekPenerima::insertData', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);
$routes->get('/rekpenerima/getDetail/(:num)', 'RekPenerima::getDetail/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);
$routes->post('/rekpenerima/updateData/(:num)', 'RekPenerima::updateData/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);
$routes->post('/rekpenerima/deleteData', 'RekPenerima::deleteData', ['namespace' => 'App\Controllers\AJAX', 'role' => 1, 'ajax' => true]);

$routes->get('/laporan', 'Laporan::index', ['namespace' => 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' => false]);
$routes->get('/laporan/getLaporanSum/(:any)/(:any)/(:any)', 'Laporan::getLaporanSumPayment/$1/$2/$3', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);
$routes->get('/laporan/cetakLaporan/(:any)/(:any)/(:any)', 'Laporan::cetakLaporan/$1/$2/$3', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => false]);
$routes->get('/laporan/invoice', 'Laporan::invoice', ['namespace' => 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' => true]);
$routes->get('/laporan/getLapinvoice/(:any)/(:any)/(:any)/(:any)', 'Laporan::getLapInvoice/$1/$2/$3/$4', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);
$routes->get('/laporan/getLaporanSumInvoice/(:any)/(:any)/(:any)/(:any)', 'Laporan::getLaporanSumInvoice/$1/$2/$3/$4', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => true]);
$routes->get('/laporan/cetakLaporanInvoice/(:any)/(:any)/(:any)/(:any)', 'Laporan::cetakLaporanInvoice/$1/$2/$3/$4', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => false]);

$routes->get('/dashboard', 'Dashboard::index', ['namespace' => 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' => false]);
$routes->get('/dashboard/getChartPiutang', 'Dashboard::getChartPiutang', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => false]);
$routes->get('/dashboard/getChartTransaksi', 'Dashboard::getChartTransaksi', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => false]);
$routes->get('/dashboard/getDataBoxDash', 'Dashboard::getDataBoxDash', ['namespace' => 'App\Controllers\AJAX', 'role' => [1,2,3], 'ajax' => false]);
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
