<?php

namespace App\Controllers;

use App\Models\StateModel;
use App\Models\CityModel;

class LocationController extends BaseController
{
    protected $stateModel;

    protected $cityModel;

    public function __construct()
    {
        $this->stateModel = new StateModel();

        $this->cityModel = new CityModel();
    }

    public function import()
    {
        return view('location/import');
    }
    /*
    |--------------------------------------------------------------------------
    | IMPORT STATES
    |--------------------------------------------------------------------------
    */

    public function importStates()
    {
        $json = file_get_contents(

            'https://servicodados.ibge.gov.br/api/v1/localidades/estados'

        );

        $states = json_decode($json, true);

        foreach ($states as $state) {

            $exists = $this->stateModel

                ->where('uf', $state['sigla'])

                ->first();

            if (!$exists) {

                $this->stateModel->insert([

                    'name' => $state['nome'],

                    'uf' => $state['sigla'],

                    'ibge_code' => $state['id']

                ]);
            }
        }

        return $this->response->setJSON([

            'status' => true,

            'message' => 'Estados importados'

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | IMPORT CITIES
    |--------------------------------------------------------------------------
    */

    public function importCities($stateId)
    {
        $state = $this->stateModel->find($stateId);

        if (!$state) {

            return $this->response->setJSON([

                'status' => false,

                'message' => 'Estado não encontrado'

            ]);
        }

        $json = file_get_contents(

            'https://servicodados.ibge.gov.br/api/v1/localidades/estados/' .

                $state['uf'] .

                '/municipios'

        );

        $cities = json_decode($json, true);

        foreach ($cities as $city) {

            $exists = $this->cityModel

                ->where('ibge_code', $city['id'])

                ->first();

            if (!$exists) {

                $this->cityModel->insert([

                    'state_id' => $stateId,

                    'name' => $city['nome'],

                    'ibge_code' => $city['id']

                ]);
            }
        }

        return $this->response->setJSON([

            'status' => true,

            'message' => 'Municípios importados'

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | CITIES BY STATE
    |--------------------------------------------------------------------------
    */

    public function citiesByState($stateId)
    {
        $cities = $this->cityModel

            ->where('state_id', $stateId)

            ->orderBy('name', 'ASC')

            ->findAll();

        return $this->response->setJSON($cities);
    }

    public function states()
    {
        $states = $this->stateModel

            ->orderBy('name', 'ASC')

            ->findAll();

        return $this->response->setJSON($states);
    }
}
