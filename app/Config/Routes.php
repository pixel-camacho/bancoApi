<?php

namespace Config;

use App\Controllers\API\Clientes;

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

//http://localhost:8080/api/
$routes->group('api', ['namespace' => 'App\Controllers\API'], function ($routes){

    $routes->get('clientes','Clientes::index');
    $routes->post('clientes/create','Clientes::createClient');
    $routes->get('clientes/getClientById/(:num)', 'Clientes::getClientById/$1');
    $routes->put('clientes/update/(:num)', 'Clientes::updateClient/$1');
    $routes->delete('clientes/delete/(:num)', 'Clientes::deleteClient/$1');

    $routes->get('cuentas', 'Cuenta::index');
    $routes->post('cuenta/create','Cuenta::create');
    $routes->put('cuenta/update/(:num)','Cuenta::update/$1');
    $routes->delete('cuenta/delete/(:num)','Cuenta::delete/$1');

    $routes->get('transacciones', 'Transaccion::index');
    $routes->post('transacciones/create', 'Transaccion::create');
    $routes->put('transacciones/update/(:num)', 'Transaccion::update/$1');
    $routes->delete('transacciones/delete/(:num)', 'Transaccion::delete/$1');

    $routes->get('tipoTransacciones', 'TiposTransaccion::index');
    $routes->post('tipoTransacciones/create','TiposTransaccion::create');
    $routes->put('tipoTransacciones/update/(:num)','TiposTransaccion::update/$1');
    $routes->delete('tipoTransacciones/delete/(:num)','TiposTransaccion::delete/$1');
});

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
