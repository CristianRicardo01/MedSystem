<?php

namespace App\Controllers\Settings;

use App\Controllers\BaseController;

use App\Models\RequestTypeModel;

class RequestsController extends BaseController
{
    protected $requestModel;

    public function __construct()
    {
        $this->requestModel = new RequestTypeModel();
    }

    public function index()
    {
        $requests = $this->requestModel

            ->orderBy('id', 'DESC')

            ->findAll();

        return view('pages/settings/requests/index', [

            'requests' => $requests

        ]);
    }

    public function store()
    {
        if (!can('requests.create')) {
            return redirect()->back()->with('error', 'Sem permissão.');
        }
        /*
        |--------------------------------------------------------------------------
        | DATA
        |--------------------------------------------------------------------------
        */

        $isExternal = (int) $this->request
            ->getPost('is_external');

        $deadline = (int) $this->request
            ->getPost('deadline_days');

        /*
        |--------------------------------------------------------------------------
        | EXTERNAL RULE
        |--------------------------------------------------------------------------
        */

        if ($isExternal === 0 && $deadline <= 0) {

            return $this->response->setJSON([

                'status' => false,

                'message' => 'Exames internos precisam ter prazo maior que 0'

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $rules = [

            'name' => 'required|trim',

            'deadline_days' => 'required',

            'status' => 'required',

        ];

        /*
        |--------------------------------------------------------------------------
        | VALIDATE
        |--------------------------------------------------------------------------
        */

        if (!$this->validate($rules)) {

            return $this->response->setJSON([

                'status' => false,

                'message' => strip_tags(
                    $this->validator->listErrors()
                )

            ]);
        }

        try {

            /*
            |--------------------------------------------------------------------------
            | INSERT
            |--------------------------------------------------------------------------
            */

            $this->requestModel->insert([

                'name' => trim(
                    $this->request->getPost('name')
                ),

                'deadline_days' => $deadline,

                'description' => trim(
                    $this->request->getPost('description')
                ),

                'is_external' => $isExternal,

                'status' => $this->request
                    ->getPost('status'),

            ]);

            /*
            |--------------------------------------------------------------------------
            | SUCCESS
            |--------------------------------------------------------------------------
            */

            return $this->response->setJSON([

                'status' => true,

                'message' => 'Solicitação criada com sucesso'

            ]);
        } catch (\Exception $e) {

            /*
            |--------------------------------------------------------------------------
            | ERROR
            |--------------------------------------------------------------------------
            */

            return $this->response->setJSON([

                'status' => false,

                'message' => $e->getMessage()

            ]);
        }
    }

    public function update($id)
    {

        if (!can('requests.update')) {
            return redirect()->back()->with('error', 'Sem permissão.');
        }
        /*
        |--------------------------------------------------------------------------
        | DATA
        |--------------------------------------------------------------------------
        */

        $isExternal = (int) $this->request
            ->getPost('is_external');

        $deadline = (int) $this->request
            ->getPost('deadline_days');

        /*
        |--------------------------------------------------------------------------
        | EXTERNAL RULE
        |--------------------------------------------------------------------------
        */

        if ($isExternal === 0 && $deadline <= 0) {

            return $this->response->setJSON([

                'status' => false,

                'message' => 'Exames internos precisam ter prazo maior que 0'

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $rules = [

            'name' => 'required|trim',

            'deadline_days' => 'required',

            'status' => 'required',

        ];

        /*
        |--------------------------------------------------------------------------
        | VALIDATE
        |--------------------------------------------------------------------------
        */

        if (!$this->validate($rules)) {

            return $this->response->setJSON([

                'status' => false,

                'message' => strip_tags(
                    $this->validator->listErrors()
                )

            ]);
        }

        try {

            /*
            |--------------------------------------------------------------------------
            | UPDATE
            |--------------------------------------------------------------------------
            */

            $this->requestModel->update($id, [

                'name' => trim(
                    $this->request->getPost('name')
                ),

                'deadline_days' => $deadline,

                'description' => trim(
                    $this->request->getPost('description')
                ),

                'is_external' => $isExternal,

                'status' => $this->request
                    ->getPost('status'),

            ]);

            /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

            return $this->response->setJSON([

                'status' => true,

                'message' =>
                'Solicitação atualizada com sucesso'

            ]);
        } catch (\Exception $e) {

            /*
        |--------------------------------------------------------------------------
        | ERROR
        |--------------------------------------------------------------------------
        */

            return $this->response->setJSON([

                'status' => false,

                'message' => $e->getMessage()

            ]);
        }
    }

    public function delete($id)
    {
        if (!can('requests.delete')) {
            return redirect()->back()->with('error', 'Sem permissão.');
        }
        try {

            /*
            |--------------------------------------------------------------------------
            | DELETE
            |--------------------------------------------------------------------------
            */

            $this->requestModel->delete($id);

            /*
            |--------------------------------------------------------------------------
            | SUCCESS
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->to(base_url('settings/requests'));
        } catch (\Exception $e) {

            /*
            |--------------------------------------------------------------------------
            | ERROR
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->back();
        }
    }
}
