<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('/', 'Dashboard::index', ['filter' => 'auth']);
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attemptLogin');
$routes->get('logout', 'Auth::logout');

$routes->group('', ['filter' => 'auth'], static function ($routes) {
    $routes->get('dashboard', 'Dashboard::index');

    $routes->resource('products', [
        'controller' => 'ProductController'
    ]);

    $routes->resource('customers', [
        'controller' => 'CustomerController'
    ]);

    $routes->resource('users', [
        'controller' => 'UserController'
    ]);

    $routes->get('sales', 'SalesController::index');
    $routes->get('sales/create', 'SalesController::create');
    $routes->post('sales/store', 'SalesController::store');
});
