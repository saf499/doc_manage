<?php

use App\Controllers\admin\User;
use App\Controllers\ProjekController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('projek', 'ProjekController::index');
$routes->get('projek/create','ProjekController::create');
$routes->get('projek/show/(:num)', 'ProjekController::show/$1');
$routes->get('projek/edit/(:num)', 'ProjekController::edit/$1');
$routes->post('projek/store', 'ProjekController::store');
$routes->post('projek/update/(:num)', 'ProjekController::update/$1'); // Route for update
$routes->get('projek/delete/(:num)', 'ProjekController::delete/$1'); // Route for delete

$routes->get('perolehan', 'PerolehanController::index');
$routes->get('perolehan/create','PerolehanController::create');
$routes->get('perolehan/show/(:num)', 'PerolehanController::show/$1');
$routes->get('perolehan/edit/(:num)', 'PerolehanController::edit/$1');
$routes->post('perolehan/store', 'PerolehanController::store');
$routes->post('perolehan/update/(:num)', 'PerolehanController::update/$1'); // Route for update
$routes->get('perolehan/delete/(:num)', 'PerolehanController::delete/$1'); // Route for delete
$routes->get('/perolehan/view-file/(:any)', 'PerolehanController::viewFile/$1');
$routes->get('/perolehan/download-file/(:any)', 'PerolehanController::downloadFile/$1');

$routes->get('/test/create', 'Test::create');
$routes->post('test/store', 'Test::store');
$routes->get('test/test', 'Test::index');

$routes->setAutoRoute(true);

$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function($routes) {
    $routes->get('dashboard', 'User::index', ['filter' => 'auth']);
    // Other admin routes
});
