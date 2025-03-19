<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');

$routes->get('/login', 'Auth::login');
$routes->post('/auth/doLogin', 'Auth::doLogin');
$routes->get('/logout', 'Auth::logout');

$routes->get('/offer', 'Offer::index');
$routes->post('/offer/submit', 'Offer::submit');
$routes->get('/offer/history', 'Offer::history');

$routes->get('/pdf/printOffer/(:num)', 'PdfGenerator::printOffer/$1');

$routes->get('/offer/edit/(:num)', 'Offer::edit/$1');
$routes->post('/offer/update/(:num)', 'Offer::update/$1');
$routes->get('/offer/delete/(:num)', 'Offer::delete/$1');

$routes->get('/offer/search', 'Offer::search');

$routes->get('/user', 'User::index');
$routes->get('/user/create', 'User::create');
$routes->post('/user/store', 'User::store');
$routes->get('/user/edit/(:num)', 'User::edit/$1');
$routes->post('/user/update/(:num)', 'User::update/$1');
$routes->get('/user/delete/(:num)', 'User::delete/$1');
