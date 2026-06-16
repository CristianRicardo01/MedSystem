<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{

    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

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
        $email = trim(
            $this->request->getPost('email')
        );

        $password = $this->request->getPost('password');

        /*
        |--------------------------------------------------------------------------
        | USER
        |--------------------------------------------------------------------------
        */

        $user = $this->userModel

            ->where('email', $email)

            ->where('status', 'ACTIVE')

            ->first();

        if (!$user) {

            return redirect()

                ->back()

                ->with(

                    'error',

                    'Usuário ou senha inválidos.'

                );
        }

        /*
        |--------------------------------------------------------------------------
        | PASSWORD
        |--------------------------------------------------------------------------
        */

        if (

            !password_verify(

                $password,

                $user['password']

            )

        ) {

            return redirect()

                ->back()

                ->with(

                    'error',

                    'Usuário ou senha inválidos.'

                );
        }

        /*
        |--------------------------------------------------------------------------
        | SESSION
        |--------------------------------------------------------------------------
        */

        session()->set([

            'user_id' => $user['id'],

            'user_name' => $user['name'],

            'user_email' => $user['email'],

            'user_role' => $user['role'],

            'isLogged' => true,

        ]);

        /*
        |--------------------------------------------------------------------------
        | LAST LOGIN
        |--------------------------------------------------------------------------
        */

        $this->userModel->update(

            $user['id'],

            [

                'last_login' => date(

                    'Y-m-d H:i:s'

                )

            ]

        );

        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        return redirect()

            ->to('/dashboard');
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout()
    {
        session()->destroy();

        return redirect()

            ->to('/login')

            ->with(

                'success',

                'Sessão encerrada com sucesso.'

            );
    }
}
