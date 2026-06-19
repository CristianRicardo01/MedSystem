<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class InstallController extends BaseController
{
    public function index()
    {
        return view(
            'install/index'
        );
    }
    public function run()
    {
        $db = \Config\Database::connect();

        try {

            if (
                !in_array(
                    'users',
                    $db->listTables()
                )
            ) {

                return redirect()
                    ->to('install')
                    ->with(
                        'error',
                        'Banco de dados não encontrado. Importe o arquivo trackingsystem.sql primeiro.'
                    );
            }

            $adminExists = $db
                ->table('users')
                ->where(
                    'role',
                    'ADMIN'
                )
                ->countAllResults();

            if ($adminExists > 0) {

                return redirect()
                    ->to('install')
                    ->with(
                        'error',
                        'Administrador já existe.'
                    );
            }

            $db->table('users')->insert([

                'name'       => 'Administrador',

                'email'      => 'admin@sistema.local',

                'password'   => '$2y$10$hP.v4LLEU9m/WHYGZKK2NeurtFujnb3fc8A/mVy2F9L32z/R3ggq6',

                'role'       => 'ADMIN',

                'status'     => 'ACTIVE',

                'created_at' => date('Y-m-d H:i:s'),

                'updated_at' => date('Y-m-d H:i:s'),

            ]);

            return redirect()
                ->to('install')
                ->with(
                    'success',
                    'Administrador criado com sucesso.'
                );
        } catch (\Exception $e) {

            return redirect()
                ->to('install')
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }
}
