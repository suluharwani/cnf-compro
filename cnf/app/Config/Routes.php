<?php

namespace Config;

$routes = Services::routes();

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

$routes->get('/', 'Home::index');
$routes->get('career', 'Home::career');
$routes->get('lang/(:segment)', 'Home::switchLanguage/$1');
$routes->get('download-catalog', 'Home::downloadCatalog');

// Admin routes (optional)
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('translations', 'Admin\TranslationController::index');
    $routes->post('translations/save', 'Admin\TranslationController::save');
});