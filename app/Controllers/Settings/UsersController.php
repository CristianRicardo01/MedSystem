<?php

namespace App\Controllers\Settings;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UsersController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {

        $data['users'] = $this->userModel
            ->orderBy('id', 'DESC')
            ->findAll();

        return view(
            'pages/settings/users/index',
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store()
    {
        if (!can('users.create')) {

            return $this->response->setJSON([

                'status' => false,

                'message' => 'Sem permissão.'

            ]);
        }
        $name = trim($this->request->getPost('name'));

        $email = trim($this->request->getPost('email'));

        $password = $this->request->getPost('password');

        $role = $this->request->getPost('role');

        $status = $this->request->getPost('status');

        /*
        |--------------------------------------------------------------------------
        | VALIDATE PERFIL
        |--------------------------------------------------------------------------
        */

        $allowedRoles = [

            'ADMIN',
            'REGULACAO',
            'TRIAGEM',
            'CONSULTA',
            'VISUALIZADOR'

        ];

        if (!in_array($role, $allowedRoles)) {

            return $this->response->setJSON([

                'status' => false,

                'message' => 'Perfil inválido.'

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDATE STATUS
        |--------------------------------------------------------------------------
        */
        $allowedStatus = [

            'ACTIVE',
            'INACTIVE'

        ];

        if (!in_array($status, $allowedStatus)) {

            return $this->response->setJSON([

                'status' => false,

                'message' => 'Status inválido.'

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDATE E-MAIL
        |--------------------------------------------------------------------------
        */

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            return $this->response->setJSON([

                'status' => false,

                'message' => 'E-mail inválido.'

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDATE CAMPOS
        |--------------------------------------------------------------------------
        */

        if (
            empty($name) ||
            empty($email) ||
            empty($password)
        ) {

            return $this->response->setJSON([

                'status' => false,

                'message' => 'Preencha todos os campos obrigatórios.'

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDATE CONFIRM PASSOWORD
        |--------------------------------------------------------------------------
        */

        $confirmPassword =
            $this->request->getPost(
                'confirm_password'
            );

        if ($password != $confirmPassword) {

            return $this->response->setJSON([

                'status' => false,

                'message' =>
                'As senhas não coincidem.'

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | EMAIL EXISTS
        |--------------------------------------------------------------------------
        */

        $exists = $this->userModel
            ->where('email', $email)
            ->first();

        if ($exists) {

            return $this->response->setJSON([

                'status' => false,

                'message' => 'Já existe um usuário com este e-mail.'

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | SAVE
        |--------------------------------------------------------------------------
        */

        $this->userModel->insert([

            'name' => $name,

            'email' => $email,

            'password' => password_hash(

                $password,

                PASSWORD_DEFAULT

            ),

            'role' => $role,

            'status' => $status,

        ]);


        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        return $this->response->setJSON([

            'status' => true,

            'message' => 'Usuário cadastrado com sucesso.'

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        if (!can('users.edit')) {

            return $this->response->setJSON([
                'status' => false,
                'message' => 'Sem permissão.'
            ]);
        }
        $user = $this->userModel->find($id);

        if (!$user) {

            return $this->response->setJSON([

                'status' => false,

                'message' => 'Usuário não encontrado.'

            ]);
        }

        return $this->response->setJSON([

            'status' => true,

            'data' => $user

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
    public function update()
    {
        if (!can('users.update')) {

            return $this->response->setJSON([
                'status' => false,
                'message' => 'Sem permissão.'
            ]);
        }
        $id = $this->request->getPost('id');

        $user = $this->userModel->find($id);

        if (!$user) {

            return $this->response->setJSON([

                'status' => false,

                'message' => 'Usuário não encontrado.'

            ]);
        }

        $data = [

            'name' => trim(
                $this->request->getPost('name')
            ),

            'email' => trim(
                $this->request->getPost('email')
            ),

            'role' => $this->request->getPost('role'),

            'status' => $this->request->getPost('status'),

        ];

        $password = $this->request->getPost('password');

        $confirmPassword = $this->request->getPost('confirm_password');

        /*
        |--------------------------------------------------------------------------
        | UPDATE PASSWORD
        |--------------------------------------------------------------------------
        */

        if (!empty($password)) {

            if ($password != $confirmPassword) {

                return $this->response->setJSON([

                    'status' => false,

                    'message' => 'As senhas não coincidem.'

                ]);
            }

            $data['password'] = password_hash(

                $password,

                PASSWORD_DEFAULT

            );
        }

        /*
        |--------------------------------------------------------------------------
        | EMAIL EXISTS
        |--------------------------------------------------------------------------
        */

        $exists = $this->userModel

            ->where('email', $data['email'])

            ->where('id !=', $id)

            ->first();

        if ($exists) {

            return $this->response->setJSON([

                'status' => false,

                'message' => 'Este e-mail já está em uso.'

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $this->userModel->update(

            $id,

            $data

        );

        return $this->response->setJSON([

            'status' => true,

            'message' => 'Usuário atualizado com sucesso.'

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */
    public function delete()
    {
        if (!can('users.delete')) {

            return $this->response->setJSON([

                'status' => false,

                'message' => 'Sem permissão.'

            ]);
        }
        $id = $this->request->getPost('id');

        $user = $this->userModel->find($id);

        if ($id == userId()) {

            return $this->response->setJSON([

                'status' => false,

                'message' => 'Você não pode excluir seu próprio usuário.'

            ]);
        }

        if (!$user) {

            return $this->response->setJSON([

                'status' => false,

                'message' => 'Usuário não encontrado.'

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | PROTECT ADMIN
        |--------------------------------------------------------------------------
        */

        if ($user['role'] == 'ADMIN') {

            return $this->response->setJSON([

                'status' => false,

                'message' => 'Não é permitido excluir um administrador.'

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | DELETE
        |--------------------------------------------------------------------------
        */

        $this->userModel->delete($id);

        return $this->response->setJSON([

            'status' => true,

            'message' => 'Usuário removido com sucesso.'

        ]);
    }
}
