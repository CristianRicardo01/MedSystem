<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function auth()
    {
        /*
        |--------------------------------------------------------------------------
        | AQUI FUTURAMENTE:
        |--------------------------------------------------------------------------
        |
        | - validar usuario
        | - verificar senha
        | - criar sessão
        | - redirect dashboard
        |
        */

        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}