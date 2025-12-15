<?php

use App\Controllers\admin\User;
use App\Controllers\ProjekController;
use App\Controllers\PerolehanController;
use App\Controllers\KontraktorController;
use App\Controllers\BonController;
use App\Controllers\InsuransController;
use App\Controllers\PelaksanaanController;
use App\Controllers\KontrakController;
// use App\Controllers\UserController;
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
$routes->post('projek/archive/(:num)', 'ProjekController::archive/$1');
$routes->post('projek/unarchive/(:num)', 'ProjekController::unarchive/$1');
$routes->get('projek/archived', 'ProjekController::archivedList');

$routes->get('perolehan', 'PerolehanController::index');
$routes->get('perolehan/create/(:num)','PerolehanController::create/$1');
$routes->get('perolehan/show/(:num)', 'PerolehanController::show/$1');
$routes->get('perolehan/edit/(:num)', 'PerolehanController::edit/$1');
$routes->post('perolehan/store', 'PerolehanController::store');
$routes->post('perolehan/update/(:num)', 'PerolehanController::update/$1'); // Route for update
$routes->get('perolehan/delete/(:num)', 'PerolehanController::delete/$1'); // Route for delete
$routes->get('/perolehan/view-file/(:num)/(:any)', 'PerolehanController::viewFile/$1/$2');
$routes->get('/perolehan/download-file/(:num)/(:any)', 'PerolehanController::downloadFile/$1/$2');


$routes->get('kontraktor', 'KontraktorController::index');
$routes->get('kontraktor/create/', 'KontraktorController::create');
$routes->post('kontraktor/save', 'KontraktorController::save');
$routes->get('kontraktor/edit/(:num)', 'KontraktorController::edit/$1');
$routes->post('kontraktor/update/(:num)', 'KontraktorController::update/$1');
$routes->get('kontraktor/delete/(:num)', 'KontraktorController::delete/$1'); // Route for delete

$routes->get('kontrak', 'KontrakController::index');
$routes->get('kontrak/create', 'KontrakController::create');
$routes->post('kontrak/store', 'KontrakController::store');
$routes->get('kontrak/edit/(:num)', 'KontrakController::edit/$1');
$routes->post('kontrak/update/(:num)', 'KontrakController::update/$1');
$routes->get('kontrak/delete/(:num)', 'KontrakController::delete/$1');

$routes->get('bon', 'BonController::index');
$routes->get('bon/create/(:num)','BonController::create/$1');
$routes->post('bon/store', 'BonController::store');
$routes->get('bon/edit/(:num)', 'BonController::edit/$1');
$routes->post('bon/update/(:num)', 'BonController::update/$1');
$routes->get('bon/delete/(:num)', 'BonController::delete/$1');

$routes->get('insurans/create/(:num)','InsuransController::create/$1');
$routes->post('insurans/store', 'InsuransController::store');

$routes->get('pelaksanaan/create/(:num)','PelaksanaanController::create/$1');
$routes->post('pelaksanaan/store', 'PelaksanaanController::store');

$routes->get('users', 'UserController::index');
$routes->get('users/create', 'UserController::create');
$routes->post('users/store', 'UserController::store');
$routes->get('users/edit/(:num)', 'UserController::edit/$1');
$routes->post('users/update/(:num)', 'UserController::update/$1');
$routes->get('users/delete/(:num)', 'UserController::delete/$1');

$routes->get('/test/home', 'Test::index');
$routes->get('/test/projek_list', 'Test::projek_list');
$routes->get('/test/projek_add', 'Test::projek_add');
$routes->get('/test/projek_detail', 'Test::projek_detail');
$routes->get('/test/perolehan_add', 'Test::perolehan_add');
$routes->get('test/kontraktor', 'Test::kontraktor');
$routes->get('/test/kontraktor_add', 'Test::kontraktor_add');
$routes->get('/test/kontrak', 'Test::kontrak');
$routes->get('/test/kontrak_add', 'Test::kontrak_add');
$routes->get('/test/kontrak_detail', 'Test::kontrak_detail');
$routes->get('/test/bon', 'Test::bon');
$routes->get('/test/bon_add', 'Test::bon_add');
$routes->get('/test/insurans', 'Test::insurans');
$routes->get('/test/insurans_add', 'Test::insurans_add');


$routes->setAutoRoute(true);

$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function($routes) {
    $routes->get('dashboard', 'User::index', ['filter' => 'auth']);
    // Other admin routes
});