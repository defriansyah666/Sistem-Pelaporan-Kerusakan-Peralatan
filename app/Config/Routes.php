<?php
namespace Config;

$routes->get('/', 'PublicReport::index');
$routes->post('/laporan', 'PublicReport::store');

$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::attempt');
$routes->get('/logout', 'Auth::logout');

$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'Dashboard::index');

    $routes->get('reports', 'Reports::index');
    $routes->get('reports/view/(:num)', 'Reports::view/$1');
    $routes->get('reports/delete/(:num)', 'Reports::delete/$1', ['filter' => 'role:admin']);

    // User Management – hanya admin
    $routes->group('users', ['filter' => 'role:admin'], function($routes) {
        $routes->get('/', 'Users::index');
        $routes->get('create', 'Users::create');
        $routes->post('store', 'Users::store');
        $routes->get('edit/(:num)', 'Users::edit/$1');
        $routes->post('update/(:num)', 'Users::update/$1');
        $routes->get('delete/(:num)', 'Users::delete/$1');
    });

    // Tim IT
    $routes->get('it/estimation/(:num)', 'ItEstimation::edit/$1', ['filter' => 'role:it,admin']);
    $routes->post('it/estimation/(:num)', 'ItEstimation::update/$1', ['filter' => 'role:it,admin']);

    // Atasan
    $routes->get('approval/form/(:num)', 'Approval::form/$1', ['filter' => 'role:atasan,admin']);
    $routes->post('approval/submit/(:num)', 'Approval::submit/$1', ['filter' => 'role:atasan,admin']);
});