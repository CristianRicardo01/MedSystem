<?php

namespace App\Controllers\Settings;

use App\Controllers\BaseController;
use App\Models\SpecialtyModel;

class SpecialtiesController extends BaseController
{
    protected $specialtyModel;

    public function __construct()
    {
        $this->specialtyModel =
            new SpecialtyModel();
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $specialties = $this->specialtyModel

            ->orderBy('id', 'DESC')

            ->findAll();

        return view(
            'pages/settings/specialties/index',
            [

                'specialties' => $specialties

            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store()
    {
        try {

            $this->specialtyModel->insert([

                'name' => trim(
                    $this->request->getPost('name')
                ),

                'description' => trim(
                    $this->request->getPost('description')
                ),

                'status' => $this->request
                    ->getPost('status'),

            ]);

            return $this->response->setJSON([

                'status' => true,

                'message' =>
                'Especialidade criada com sucesso'

            ]);
        } catch (\Exception $e) {

            return $this->response->setJSON([

                'status' => false,

                'message' => $e->getMessage()

            ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update($id)
    {
        try {

            $this->specialtyModel->update($id, [

                'name' => trim(
                    $this->request->getPost('name')
                ),

                'description' => trim(
                    $this->request->getPost('description')
                ),

                'status' => $this->request
                    ->getPost('status'),

            ]);

            return $this->response->setJSON([

                'status' => true,

                'message' =>
                'Especialidade atualizada'

            ]);
        } catch (\Exception $e) {

            return $this->response->setJSON([

                'status' => false,

                'message' => $e->getMessage()

            ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        $this->specialtyModel->delete($id);

        return redirect()
            ->to(base_url('settings/specialties'));
    }
}
