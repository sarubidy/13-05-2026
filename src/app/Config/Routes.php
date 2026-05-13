<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Login;
/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');

$routes->group('employe', ['filter' => 'employeAuth'], function($routes) {
    $routes->get('/', 'EmployeController::dashboard');             // Liste
    $routes->get('create', 'EmployeController::create');       // Formulaire création
    $routes->post('store', 'EmployeController::store');        // Traitement création
    $routes->get('edit/(:num)', 'EmployeController::edit/$1'); // Formulaire édition
    $routes->post('update/(:num)', 'EmployeController::update/$1'); // Traitement édition
});
