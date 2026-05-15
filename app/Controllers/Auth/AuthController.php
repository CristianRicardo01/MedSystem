<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

class AuthController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    public function login()
    {
        return view('auth/login');
    }

    /*
    |--------------------------------------------------------------------------
    | AUTH
    |--------------------------------------------------------------------------
    */

    public function auth()
    {
        /*
        |--------------------------------------------------------------------------
        | FUTURAMENTE:
        |--------------------------------------------------------------------------
        |
        | - validar email
        | - validar senha
        | - criar sessão
        | - salvar usuário logado
        |
        */

        return redirect()->to('/dashboard');
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}
