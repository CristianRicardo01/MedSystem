<?php

if (!function_exists('userId')) {

    function userId()
    {
        return session()->get('user_id');
    }
}

if (!function_exists('userName')) {

    function userName()
    {
        return session()->get('user_name');
    }
}

if (!function_exists('userEmail')) {

    function userEmail()
    {
        return session()->get('user_email');
    }
}


if (!function_exists('userRole')) {

    function userRole()
    {
        return session()->get('user_role');
    }
}

if (!function_exists('isAdmin')) {

    function isAdmin()
    {
        return userRole() == 'ADMIN';
    }
}

if (!function_exists('can')) {

    function can($permission)
    {
        $role = userRole();

        $permissions = [

            'ADMIN' => [

                '*',

                'users.view',
                'users.create',
                'users.update',
                'users.delete',

                /*
                |--------------------------------------------------------------------------
                | CALENDAIO
                |--------------------------------------------------------------------------
                */

                'appointments.view',

                /*
                |--------------------------------------------------------------------------
                | PROFILE
                |--------------------------------------------------------------------------
                */

                'profile.view',
            ],

            'REGULACAO' => [

                'dashboard.view',

                /*
                |--------------------------------------------------------------------------
                | PACIENTES
                |--------------------------------------------------------------------------
                */

                'patients.view',
                'patients.create',
                'patients.update',

                'patients.hospitalize',
                'patients.finalize',

                'patients.observation',

                'patients.pdf',

                /*
                |--------------------------------------------------------------------------
                | INTERNAÇÃO
                |--------------------------------------------------------------------------
                */

                'hospitalization.view',

                /*
                |--------------------------------------------------------------------------
                | SOLICITAÇÕES
                |--------------------------------------------------------------------------
                */
                'settings.view',

                'requests.view',
                'requests.create',
                'requests.update',
                'requests.delete',

                /*
                |--------------------------------------------------------------------------
                | ESPECIALIDADES
                |--------------------------------------------------------------------------
                */

                'specialties.view',
                'specialties.create',
                'specialties.update',
                'specialties.delete',

                /*
                |--------------------------------------------------------------------------
                | AGENDAMENTOS
                |--------------------------------------------------------------------------
                */

                'appointments.view',

                /*
                |--------------------------------------------------------------------------
                | PROFILE
                |--------------------------------------------------------------------------
                */
                'profile.view',

                /*
                |--------------------------------------------------------------------------
                | INDICADORES
                |--------------------------------------------------------------------------
                */
                'reports.indicators.view',

            ],

            'TRIAGEM' => [

                /*
                |--------------------------------------------------------------------------
                | DASHBOARD
                |--------------------------------------------------------------------------
                */

                'dashboard.view',

                /*
                |--------------------------------------------------------------------------
                | TRIAGEM
                |--------------------------------------------------------------------------
                */

                'triage.view',
                'triage.create',
                'triage.update',

                'triage.observation',

                'triage.requests.create',
                'triage.requests.update',
                'triage.requests.delete',
                'triage.request.finalize',

                'triage.transfer',

                'triage.pdf',

                /*
                |--------------------------------------------------------------------------
                | CALENDAIO
                |--------------------------------------------------------------------------
                */

                'appointments.view',

                /*
                |--------------------------------------------------------------------------
                | PROFILE
                |--------------------------------------------------------------------------
                */

                'profile.view',

                /*
                |--------------------------------------------------------------------------
                | INDICADORES
                |--------------------------------------------------------------------------
                */
                'reports.indicators.view',

                /*
                |--------------------------------------------------------------------------
                | SOLICITAÇÕES
                |--------------------------------------------------------------------------
                */

                'settings.view',

                'requests.view',
                'requests.create',
                'requests.update',
                'requests.delete',

                /*
                |--------------------------------------------------------------------------
                | ESPECIALIDADES
                |--------------------------------------------------------------------------
                */

                'specialties.view',
                'specialties.create',
                'specialties.update',
                'specialties.delete',
            ],

            'CONSULTA' => [

                'patients.view',
                'observations.create',
                /*
                |--------------------------------------------------------------------------
                | PROFILE
                |--------------------------------------------------------------------------
                */

                'profile.view',
                /*
                |--------------------------------------------------------------------------
                | PROFILE
                |--------------------------------------------------------------------------
                */
                'reports.indicators.view',
            ],

            'VISUALIZADOR' => [

                'dashboard.view',
                'patients.view',
                'hospitalization.view',

                /*
                |--------------------------------------------------------------------------
                | PROFILE
                |--------------------------------------------------------------------------
                */

                'profile.view',

                /*
                |--------------------------------------------------------------------------
                | INDICADORES
                |--------------------------------------------------------------------------
                */
                'reports.indicators.view',

            ],

        ];

        if (
            isset($permissions[$role]) &&
            in_array('*', $permissions[$role])
        ) {

            return true;
        }

        return in_array(

            $permission,

            $permissions[$role] ?? []

        );
    }
}
