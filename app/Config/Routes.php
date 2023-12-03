<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->match(['get', 'post'], '/register', 'AuthContr::index');
$routes->get('/login', 'AuthContr::login');
$routes->get('/', 'LelangContr::index');
$routes->match(['get', 'post'], '/regist', 'AuthContr::registStore');
$routes->match(['get', 'post'], '/loginStep', 'AuthContr::logPros');
$routes->get('/dashboard', 'LelangContr::dashboard');
$routes->get('/user', 'UserContr::index');
$routes->put('/editUser/data/(:any)', 'UserContr::editProfile/$1');
$routes->put('/editUser/pass/(:any)', 'UserContr::editPassword/$1');
$routes->get('/logout', 'AuthContr::logout');
$routes->get('/cari', 'LelangContr::search');
$routes->get('/info/(:any)', 'LelangContr::infoBarang/$1');
$routes->get('/participate/(:any)', 'LelangContr::auctionPage/$1');
$routes->put('/participateProcess/(:any)', 'LelangContr::auctionProcess/$1');
$routes->get('/histori', 'LelangContr::history');
$routes->get('/infohistori/(:any)', 'LelangContr::infohistory/$1');
$routes->get('/lelOnProcess', 'LelangContr::lelonprocess');
$routes->delete('/batal/(:any)', 'LelangContr::cancel/$1');