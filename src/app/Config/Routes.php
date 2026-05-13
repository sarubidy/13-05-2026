<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Login;
/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');


