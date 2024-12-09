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
    // List Apartments
    $routes->get('/', 'Apartment::index');

    // Add Apartment
    $routes->get('add', 'Apartment::add');
    $routes->post('add', 'Apartment::create');

    // Edit Apartment
    $routes->get('edit/(:num)', 'Apartment::edit/$1');
    $routes->put('edit/(:num)', 'Apartment::update/$1');

    // Delete Apartment
    $routes->get('delete/(:num)', 'Apartment::delete/$1');
});
