<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

$routes->get('/', 'Auth::index', ['filter' => 'noauth']);
$routes->post('/login', 'Auth::login', ['filter' => 'noauth']);
$routes->get('/logout', 'Auth::logout', ['filter' => 'auth']);

// Admin Routes
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');
    
    // Users
    $routes->group('users', function ($routes) {
        $routes->get('/', 'Admin\Users::index');
        $routes->get('add', 'Admin\Users::add');
        $routes->post('save', 'Admin\Users::save');
        $routes->get('edit/(:num)', 'Admin\Users::edit/$1');
        $routes->post('update/(:num)', 'Admin\Users::update/$1');
        $routes->get('delete/(:num)', 'Admin\Users::delete/$1');
    });
    
    // Categories
    $routes->group('categories', function ($routes) {
        $routes->get('/', 'Admin\Categories::index');
        $routes->get('add', 'Admin\Categories::add');
        $routes->post('save', 'Admin\Categories::save');
        $routes->get('edit/(:num)', 'Admin\Categories::edit/$1');
        $routes->post('update/(:num)', 'Admin\Categories::update/$1');
        $routes->get('delete/(:num)', 'Admin\Categories::delete/$1');
    });
    
    // Item Types
    $routes->group('item-types', function ($routes) {
        $routes->get('/', 'Admin\ItemTypes::index');
        $routes->get('add', 'Admin\ItemTypes::add');
        $routes->post('save', 'Admin\ItemTypes::save');
        $routes->get('edit/(:num)', 'Admin\ItemTypes::edit/$1');
        $routes->post('update/(:num)', 'Admin\ItemTypes::update/$1');
        $routes->get('delete/(:num)', 'Admin\ItemTypes::delete/$1');
    });
    
    // Power Types
    $routes->group('power-types', function ($routes) {
        $routes->get('/', 'Admin\PowerTypes::index');
        $routes->get('add', 'Admin\PowerTypes::add');
        $routes->post('save', 'Admin\PowerTypes::save');
        $routes->get('edit/(:num)', 'Admin\PowerTypes::edit/$1');
        $routes->post('update/(:num)', 'Admin\PowerTypes::update/$1');
        $routes->get('delete/(:num)', 'Admin\PowerTypes::delete/$1');
    });
    
    // Item Kinds
    $routes->group('item-kinds', function ($routes) {
        $routes->get('/', 'Admin\ItemKinds::index');
        $routes->get('add', 'Admin\ItemKinds::add');
        $routes->post('save', 'Admin\ItemKinds::save');
        $routes->get('edit/(:num)', 'Admin\ItemKinds::edit/$1');
        $routes->post('update/(:num)', 'Admin\ItemKinds::update/$1');
        $routes->get('delete/(:num)', 'Admin\ItemKinds::delete/$1');
    });
    
    // Units
    $routes->group('units', function ($routes) {
        $routes->get('/', 'Admin\Units::index');
        $routes->get('add', 'Admin\Units::add');
        $routes->post('save', 'Admin\Units::save');
        $routes->get('edit/(:num)', 'Admin\Units::edit/$1');
        $routes->post('update/(:num)', 'Admin\Units::update/$1');
        $routes->get('delete/(:num)', 'Admin\Units::delete/$1');
    });
    
    // Locations
    $routes->group('locations', function ($routes) {
        $routes->get('/', 'Admin\Locations::index');
        $routes->get('add', 'Admin\Locations::add');
        $routes->post('save', 'Admin\Locations::save');
        $routes->get('edit/(:num)', 'Admin\Locations::edit/$1');
        $routes->post('update/(:num)', 'Admin\Locations::update/$1');
        $routes->get('delete/(:num)', 'Admin\Locations::delete/$1');
    });
    
    // Conditions
    $routes->group('conditions', function ($routes) {
        $routes->get('/', 'Admin\Conditions::index');
        $routes->get('add', 'Admin\Conditions::add');
        $routes->post('save', 'Admin\Conditions::save');
        $routes->get('edit/(:num)', 'Admin\Conditions::edit/$1');
        $routes->post('update/(:num)', 'Admin\Conditions::update/$1');
        $routes->get('delete/(:num)', 'Admin\Conditions::delete/$1');
    });
    
    // Items
    $routes->group('items', function ($routes) {
        $routes->get('/', 'Admin\Items::index');
        $routes->get('add', 'Admin\Items::add');
        $routes->post('save', 'Admin\Items::save');
        $routes->get('edit/(:num)', 'Admin\Items::edit/$1');
        $routes->post('update/(:num)', 'Admin\Items::update/$1');
        $routes->get('delete/(:num)', 'Admin\Items::delete/$1');
        $routes->get('view/(:num)', 'Admin\Items::view/$1');
        $routes->get('get-items', 'Admin\Items::getItems');
    });
    
    // Item Incomings
    $routes->group('item-incomings', function ($routes) {
        $routes->get('/', 'Admin\ItemIncomings::index');
        $routes->get('add', 'Admin\ItemIncomings::add');
        $routes->post('save', 'Admin\ItemIncomings::save');
        $routes->get('edit/(:num)', 'Admin\ItemIncomings::edit/$1');
        $routes->post('update/(:num)', 'Admin\ItemIncomings::update/$1');
        $routes->get('delete/(:num)', 'Admin\ItemIncomings::delete/$1');
        $routes->get('view/(:num)', 'Admin\ItemIncomings::view/$1');
        $routes->get('print/(:num)', 'Admin\ItemIncomings::print/$1');
        $routes->get('pdf/(:num)', 'Admin\ItemIncomings::pdf/$1');
        $routes->get('report', 'Admin\ItemIncomings::report');
        $routes->get('export-pdf', 'Admin\ItemIncomings::exportPdf');
        $routes->get('export-excel', 'Admin\ItemIncomings::exportExcel');
    });
    
    // Item Outgoings
    $routes->group('item-outgoings', function ($routes) {
        $routes->get('/', 'Admin\ItemOutgoings::index');
        $routes->get('add', 'Admin\ItemOutgoings::add');
        $routes->post('save', 'Admin\ItemOutgoings::save');
        $routes->get('edit/(:num)', 'Admin\ItemOutgoings::edit/$1');
        $routes->post('update/(:num)', 'Admin\ItemOutgoings::update/$1');
        $routes->get('delete/(:num)', 'Admin\ItemOutgoings::delete/$1');
        $routes->get('view/(:num)', 'Admin\ItemOutgoings::view/$1');
        $routes->get('print/(:num)', 'Admin\ItemOutgoings::print/$1');
        $routes->get('pdf/(:num)', 'Admin\ItemOutgoings::pdf/$1');
        $routes->get('report', 'Admin\ItemOutgoings::report');
        $routes->get('export-pdf', 'Admin\ItemOutgoings::exportPdf');
        $routes->get('export-excel', 'Admin\ItemOutgoings::exportExcel');
    });
    
    // Stock Opnames
    $routes->group('stock-opnames', function ($routes) {
        $routes->get('/', 'Admin\StockOpnames::index');
        $routes->get('add', 'Admin\StockOpnames::add');
        $routes->post('save', 'Admin\StockOpnames::save');
        $routes->get('edit/(:num)', 'Admin\StockOpnames::edit/$1');
        $routes->post('update/(:num)', 'Admin\StockOpnames::update/$1');
        $routes->get('delete/(:num)', 'Admin\StockOpnames::delete/$1');
        $routes->get('view/(:num)', 'Admin\StockOpnames::view/$1');
        $routes->get('print/(:num)', 'Admin\StockOpnames::print/$1');
        $routes->get('report', 'Admin\StockOpnames::report');
    });
    
    // Profile
    $routes->group('profile', function ($routes) {
        $routes->get('/', 'Admin\Users::profile');
        $routes->post('update', 'Admin\Users::updateProfile');
        $routes->post('change-password', 'Admin\Users::changePassword');
    });
});