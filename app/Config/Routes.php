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

/*
|--------------------------------------------------------------------------
| PATIENT REQUESTS
|--------------------------------------------------------------------------
*/

$routes->get('/triage', 'TriageController::index');

$routes->get('/triage/show/(:num)', 'TriageController::show/$1');

$routes->post('/triage/store', 'TriageController::store');

$routes->post('/triage/observation/store', 'TriageController::storeObservation');

$routes->post('/triage/store-request', 'TriageController::storeRequest');

$routes->post('/triage/update-request', 'TriageController::updateRequest');

$routes->post('/triage/finalize-request', 'TriageController::finalizeRequest');

$routes->post('/triage/delete-request', 'TriageController::deleteRequest');

$routes->post('/triage/transfer-patient', 'TriageController::transferPatient');

$routes->get('/triage/edit/(:num)', 'TriageController::edit/$1');

$routes->post('triage/update-patient', 'TriageController::updatePatient');

$routes->get('/triage/pdf/(:num)', 'TriageController::generatePdf/$1');

// REQUESTS REQUESTS

$routes->get('settings/requests', 'Settings\RequestsController::index');

$routes->get('/settings/users/', 'Settings\UsersController::index');

$routes->post('/settings/requests/store', 'Settings\RequestsController::store');

$routes->post('/settings/requests/update/(:num)', 'Settings\RequestsController::update/$1');

$routes->get('/settings/requests/delete/(:num)', 'Settings\RequestsController::delete/$1');

$routes->post('/settings/requests/update/(:num)', 'Settings\RequestsController::update/$1');

$routes->get('/settings/requests/delete/(:num)', 'Settings\RequestsController::delete/$1');

// REQUESTS SPECIALTIES

$routes->get('/settings/specialties', 'Settings\SpecialtiesController::index');

$routes->post('/settings/specialties/store', 'Settings\SpecialtiesController::store');

$routes->post('/settings/specialties/update/(:num)', 'Settings\SpecialtiesController::update/$1');

$routes->get('/settings/specialties/delete/(:num)', 'Settings\SpecialtiesController::delete/$1');


// DOMPDF

$routes->get('triage/pdf/(:num)', 'TriageController::generatePdf/$1');
