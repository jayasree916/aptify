<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/login', 'Home::login');
$routes->get('/contact', 'Home::contact');
// $routes->get('/login', 'Login::index');
$routes->post('/authenticate', 'Login::authenticate');
$routes->get('/logout', 'Login::logout');
$routes->get('/dashboard', 'Dashboard::index'); // Optional: Protected route
$routes->get('/add-user', 'Users::addUser');

$routes->group('owners', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Owners::index');
    $routes->get('add', 'Owners::add');
    $routes->post('add', 'Owners::create');
    $routes->get('edit/(:num)', 'Owners::edit/$1');
    $routes->put('edit/(:num)', 'Owners::update/$1');
    $routes->get('delete/(:num)', 'Owners::delete/$1');
    $routes->get('view/(:num)', 'Owners::view/$1');
    $routes->get('owner-details/(:num)', 'Owners::ownerDetails/$1');
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
    $routes->get('/', 'Users::index');
    $routes->get('add', 'Users::add');
    $routes->post('add', 'Users::create');
    $routes->get('edit/(:num)', 'Users::edit/$1');
    $routes->post('edit/(:num)', 'Users::update/$1');
    $routes->get('delete/(:num)', 'Users::delete/$1');
});

// Receipt Module
$routes->group('receipts', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Receipts::index'); // List all receipts
    $routes->get('add', 'Receipts::add'); // Form to add a new receipt
    $routes->post('store', 'Receipts::store'); // Save the new receipt
    $routes->get('view/(:num)', 'Receipts::view/$1'); // View details of a specific receipt
    $routes->get('edit/(:num)', 'Receipts::edit/$1'); // Form to edit a specific receipt
    $routes->post('update/(:num)', 'Receipts::update/$1'); // Update a specific receipt
    $routes->get('delete/(:num)', 'Receipts::delete/$1'); // Delete a specific receipt
});

// Payment Module
$routes->group('payments', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Collections::index'); // List all payments
    $routes->get('add', 'Collections::add'); // Form to add a new payment
    $routes->post('store', 'Collections::store'); // Save the new payment
    //$routes->get('store', 'Collections::store'); // Save the new payment
    $routes->get('view/(:num)', 'Payments::view/$1'); // View details of a specific payment
    $routes->get('edit/(:num)', 'Payments::edit/$1'); // Form to edit a specific payment
    $routes->post('update/(:num)', 'Payments::update/$1'); // Update a specific payment
    $routes->get('delete/(:num)', 'Payments::delete/$1'); // Delete a specific payment
});

$routes->post('billing/process-payment', 'Collections::processPayment');
$routes->post('billing/advance-payment', 'Collections::advancePayment');

$routes->group('blocks', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Blocks::index');
    $routes->get('add', 'Blocks::add');
    $routes->post('add', 'Blocks::create');
    $routes->get('edit/(:num)', 'Blocks::edit/$1');
    $routes->post('edit/(:num)', 'Blocks::update/$1');
    $routes->get('delete/(:num)', 'Blocks::delete/$1');
});

$routes->group('apartments', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Apartments::index');
    $routes->get('add', 'Apartments::add');
    $routes->post('add', 'Apartments::create');
    $routes->get('edit/(:num)', 'Apartments::edit/$1');
    $routes->post('edit/(:num)', 'Apartments::update/$1');
    $routes->get('delete/(:num)', 'Apartments::delete/$1');
});

