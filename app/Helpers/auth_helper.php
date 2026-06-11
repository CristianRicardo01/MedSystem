<?php

if (!function_exists('userId')) {

    function userId()
    {
        return session()->get('user_id') ?? 1;
    }
}

if (!function_exists('userName')) {

    function userName()
    {
        return session()->get('user_name') ?? 'Usuário Teste';
    }
}

if (!function_exists('userEmail')) {

    function userEmail()
    {
        return session()->get('user_email') ?? 'EmailTeste@gmail.com.br';
    }
}
