<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// AUTH

$routes->get('/', 'Auth\AuthController::login');

$routes->get('/login', 'Auth\AuthController::login');

$routes->post('/login/auth', 'Auth\AuthController::auth');

$routes->get('/logout', 'Auth\AuthController::logout');

$routes->get('/dashboard', 'Home::index');
$routes->get('/patients', 'PatientsController::index');
$routes->get('/patients/show/(:num)', 'PatientsController::show');
$routes->get('/hospitalization', 'hospitalizationController::index');
$routes->get('/appointments', 'AppointmentsController::index');
// REQUESTS

$routes->get('/settings/requests', 'Settings\RequestsController::index');

$routes->get('/settings/users/', 'Settings\UsersController::index');


$routes->get('/triage', 'TriageController::index');
$routes->get('/triage/show/(:num)', 'TriageController::show/$1');