<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class PermissionFilter implements FilterInterface
{
    public function before(
        RequestInterface $request,
        $arguments = null
    ) {

        $permission = $arguments[0] ?? null;

        if (!$permission) {

            return;
        }

        if (!can($permission)) {

            return redirect()

                ->to('/dashboard')

                ->with(

                    'error',

                    'Você não possui permissão para acessar este recurso.'

                );
        }
    }

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {}
}
