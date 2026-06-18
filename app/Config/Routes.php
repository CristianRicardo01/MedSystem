<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
$routes->get('/', 'Auth\AuthController::login');

$routes->get('/login', 'Auth\AuthController::login');

$routes->post('/login/auth', 'Auth\AuthController::auth');

$routes->get('/logout', 'Auth\AuthController::logout');


/*
|--------------------------------------------------------------------------
| HOSPITALIZATION
|--------------------------------------------------------------------------
*/
$routes->group('hospitalization', ['filter' => ['auth', 'permission:hospitalization.view']], function ($routes) {

    $routes->get('/', 'hospitalizationController::index');
});

/*
|--------------------------------------------------------------------------
| APPOINTMENTS CALENDARIO
|--------------------------------------------------------------------------
*/
$routes->group('appointments', ['filter' => ['auth', 'permission:appointments.view']], function ($routes) {

    $routes->get('/', 'AppointmentsController::index');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

$routes->group('dashboard', ['filter' => ['auth', 'permission:dashboard.view']], function ($routes) {

    $routes->get('/', 'Home::index');
});

/*
|--------------------------------------------------------------------------
| USERS
|--------------------------------------------------------------------------
*/
$routes->group('users', ['filter' => ['auth', 'permission:users.view']], function ($routes) {

    $routes->post('store', 'Settings\UsersController::store');

    $routes->post('update', 'Settings\UsersController::update');

    $routes->post('delete', 'Settings\UsersController::delete');

    $routes->get('edit/(:num)', 'Settings\UsersController::edit/$1');
});

/*
|--------------------------------------------------------------------------
| SETTING USERS
|--------------------------------------------------------------------------
*/
$routes->get(
    'profile',
    'Settings\UsersController::profile',
    [
        'filter' => [
            'auth',
            'permission:profile.view'
        ]
    ]
);

$routes->post(
    'profile/change-password',
    'Settings\UsersController::changePassword',
    [
        'filter' => [
            'auth',
            'permission:profile.view'
        ]
    ]
);
/*
|--------------------------------------------------------------------------
| SETTINGS USERS SHOW
|--------------------------------------------------------------------------
*/
$routes->group('profile', ['filter' => ['auth', 'permission:profile.view']], function ($routes) {

    $routes->get('/', 'Settings\UsersController::profile',);
});


/*
|--------------------------------------------------------------------------
| PATIENT REQUESTS
|--------------------------------------------------------------------------
*/

$routes->group('patients', ['filter' => ['auth', 'permission:patients.view']], function ($routes) {

    $routes->get('/', 'PatientsController::index');

    $routes->post('store', 'PatientsController::store');

    $routes->post('update', 'PatientsController::update');

    $routes->post('update-data', 'PatientsController::updateData');

    $routes->get('show/(:num)', 'PatientsController::show/$1');

    $routes->post('observation/store', 'PatientsController::storeObservation');

    $routes->post('request/store', 'PatientsController::storeRequest');

    $routes->post('request/update', 'PatientsController::updateRequest');

    $routes->post('request/finalize', 'PatientsController::finalizeRequest');

    $routes->post('request/delete', 'PatientsController::deleteRequest');

    $routes->post('hospitalize', 'PatientsController::hospitalize');

    $routes->post('return', 'PatientsController::returnPatient');

    $routes->get('pdf/(:num)', 'PatientsController::generatePdf/$1');

    $routes->post('finalize', 'PatientsController::finalizePatient');
});

/*
|--------------------------------------------------------------------------
| TRIAGE REQUESTS
|--------------------------------------------------------------------------
*/
$routes->group('triage', ['filter' => ['auth', 'permission:triage.view']], function ($routes) {

    $routes->get('/', 'TriageController::index');

    $routes->get('show/(:num)', 'TriageController::show/$1');

    $routes->post('store', 'TriageController::store');

    $routes->post('observation/store', 'TriageController::storeObservation');

    $routes->post('store-request', 'TriageController::storeRequest');

    $routes->post('update-request', 'TriageController::updateRequest');

    $routes->post('finalize-request', 'TriageController::finalizeRequest');

    $routes->post('delete-request', 'TriageController::deleteRequest');

    $routes->post('transfer-patient', 'TriageController::transferPatient');

    $routes->get('edit/(:num)', 'TriageController::edit/$1');

    $routes->post('update-patient', 'TriageController::updatePatient');

    $routes->get('pdf/(:num)', 'TriageController::generatePdf/$1');
});

/*
|--------------------------------------------------------------------------
| REQUESTS REQUESTS
|--------------------------------------------------------------------------
*/
$routes->group('settings', ['filter' => ['auth', 'permission:settings.view']], function ($routes) {
    
    $routes->get('requests/', 'Settings\RequestsController::index');

    $routes->get('users/', 'Settings\UsersController::index');

    $routes->post('requests/store', 'Settings\RequestsController::store');

    $routes->post('requests/update/(:num)', 'Settings\RequestsController::update/$1');

    $routes->get('requests/delete/(:num)', 'Settings\RequestsController::delete/$1');

    $routes->post('requests/update/(:num)', 'Settings\RequestsController::update/$1');

    $routes->get('requests/delete/(:num)', 'Settings\RequestsController::delete/$1');
});

/*
|--------------------------------------------------------------------------
| REQUESTS SPECIALTIES
|--------------------------------------------------------------------------
*/
$routes->group('settings', ['filter' => ['auth', 'permission:settings.view']], function ($routes) {

    $routes->get('specialties', 'Settings\SpecialtiesController::index');

    $routes->post('specialties/store', 'Settings\SpecialtiesController::store');

    $routes->post('specialties/update/(:num)', 'Settings\SpecialtiesController::update/$1');

    $routes->get('specialties/delete/(:num)', 'Settings\SpecialtiesController::delete/$1');
});


/*
|--------------------------------------------------------------------------
| API LOCATION
|--------------------------------------------------------------------------
*/
$routes->group('api', ['filter' => 'auth'], function ($routes) {

    $routes->get('states', 'LocationController::states');
});

/*
|--------------------------------------------------------------------------
| LOCATION
|--------------------------------------------------------------------------
*/
$routes->group('location', ['filter' => 'auth'], function ($routes) {

    $routes->get('states', 'LocationController::states');

    $routes->post('/import-cities/(:num)', 'LocationController::importCities/$1');

    $routes->get('cities-by-state/(:num)', 'LocationController::citiesByState/$1');
});

/*
|--------------------------------------------------------------------------
| API PARA O IBGE. COMENTAR PARA NAO FAZER O INSERT NO BANCO 
|--------------------------------------------------------------------------
*/
$routes->group('location', ['filter' => 'auth'], function ($routes) {

    // $routes->get('import', 'LocationController::import');

    // $routes->get('import-states', 'LocationController::importStates');
});

/*
|--------------------------------------------------------------------------
| ALERTS
|--------------------------------------------------------------------------
*/

$routes->get('alerts', 'AlertsController::index', ['filter' => 'auth']);

/*
|--------------------------------------------------------------------------
| INDICADORES
|--------------------------------------------------------------------------
*/

$routes->group('reports', ['filter' => ['auth', 'permission:reports.indicators.view']], function ($routes) {

    $routes->get('indicators', 'Reports\IndicatorsController::index');
});
