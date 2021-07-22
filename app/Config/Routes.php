<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */
// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->post('auth/register', 'Auth::register', ['filter' => 'cors']);
$routes->options('auth', 'Auth::options', ['filter' => 'cors']);
$routes->post('auth', 'Auth::login', ['filter' => 'cors']);

$routes->add('helper/route', 'RouteDisplay::getRoutes', ['filter' => 'cors']);
$routes->get('log', 'Log::index', ['filter' => 'cors']);
$routes->get('log/stat', 'Log::stats', ['filter' => 'cors']);
$routes->get('log/stat/useragent', 'Log::getUserAgent', ['filter' => 'cors']);
$routes->get('database', 'Database::index', ['filter' => 'cors']);
$routes->get('database/describe', 'Database::describeTable', ['filter' => 'cors']);
$routes->get('database/tables', 'Database::getDatabaseTables', ['filter' => 'cors']);
$routes->get('database/table/content', 'Database::getTableContent', ['filter' => 'cors']);

/**
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
