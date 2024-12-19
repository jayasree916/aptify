<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/login', 'Home::login');
$routes->get('/contact', 'Home::contact');
$routes->get('/login', 'Login::index');
$routes->post('/authenticate', 'Login::authenticate');
$routes->get('/logout', 'Login::logout');
$routes->get('/dashboard', 'Dashboard::index'); // Optional: Protected route
$routes->get('/add-user', 'Users::addUser');

$routes->group('apartment', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Apartment::index');
    $routes->get('add', 'Apartment::add');
    $routes->post('add', 'Apartment::create');
    $routes->get('edit/(:num)', 'Apartment::edit/$1');
    $routes->put('edit/(:num)', 'Apartment::update/$1');
    $routes->get('delete/(:num)', 'Apartment::delete/$1');
});

$routes->group('tenants', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Tenants::index');
    $routes->get('add', 'Tenants::add');
    $routes->post('add', 'Tenants::create');
    $routes->get('edit/(:num)', 'Tenants::edit/$1');
    $routes->post('edit/(:num)', 'Tenants::update/$1');
    $routes->get('delete/(:num)', 'Tenants::delete/$1');
});

$routes->group('billing-types', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'BillingTypes::index');
    $routes->get('create', 'BillingTypes::add');
    $routes->post('store', 'BillingTypes::store');
    $routes->get('edit/(:num)', 'BillingTypes::edit/$1');
    $routes->post('update/(:num)', 'BillingTypes::update/$1');
    $routes->get('delete/(:num)', 'BillingTypes::delete/$1');
});

$routes->group('billing', function ($routes) {
    $routes->get('/', 'Bills::index');
    $routes->get('add', 'Bills::add');
    $routes->post('generate-bill', 'Bills::generateMonthlyBills');
    $routes->get('edit/(:num)', 'Bills::edit/$1');
    $routes->post('update/(:num)', 'Bills::update/$1');
    $routes->get('delete/(:num)', 'Bills::delete/$1');
});

$routes->group('user-roles', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'UserRoles::index');
    $routes->get('add', 'UserRoles::add');
    $routes->post('add', 'UserRoles::create');
    $routes->get('edit/(:num)', 'UserRoles::edit/$1');
    $routes->put('edit/(:num)', 'UserRoles::update/$1');
    $routes->get('delete/(:num)', 'UserRoles::delete/$1');
});

$routes->group('users', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'User::index');
    $routes->get('add', 'User::add');
    $routes->post('add', 'User::create');
    $routes->get('edit/(:num)', 'User::edit/$1');
    $routes->put('edit/(:num)', 'User::update/$1');
    $routes->get('delete/(:num)', 'User::delete/$1');
});