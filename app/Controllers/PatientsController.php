<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PatientModel;
use App\Models\SpecialtyModel;
use App\Models\PatientMovementModel;
use App\Models\PatientObservationModel;
use App\Models\PatientRequestModel;
use App\Models\PatientStatusHistoryModel;
use App\Models\RequestTypeModel;
use App\Services\PatientFlowService;
use DateTime;
use Dompdf\Dompdf;
use Dompdf\Options;

class PatientsController extends BaseController
{
    protected $patientFlowService;

    protected $patientModel;

    protected $patientStatusHistoryModel;

    protected $patientMovementModel;

    protected $patientObservationModel;

    protected $specialtyModel;

    protected $patientRequestModel;

    protected $requestTypeModel;

    public function __construct()
    {
        $this->patientFlowService = new PatientFlowService();

        $this->patientModel = new PatientModel();

        $this->patientStatusHistoryModel = new PatientStatusHistoryModel();

        $this->patientMovementModel = new PatientMovementModel();

        $this->patientObservationModel = new PatientObservationModel();

        $this->specialtyModel = new SpecialtyModel();

        $this->patientRequestModel = new PatientRequestModel();

        $this->requestTypeModel = new RequestTypeModel();
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | PATIENTS
        |--------------------------------------------------------------------------
        */

        $patients =
            $this->patientModel

            ->select('
                patients.*,

                specialties.name as specialty_name
            ')

            ->join(
                'specialties',
                'specialties.id = patients.specialty_id',
                'left'
            )

            /*
            |--------------------------------------------------------------------------
            | REMOVE TRIAGE
            |--------------------------------------------------------------------------
            */

            ->where(
                'patients.flow_type !=',
                'TRIAGE'
            )

            ->orderBy(
                'patients.id',
                'DESC'
            )

            ->findAll();

        /*
        |--------------------------------------------------------------------------
        | SPECIALTIES
        |--------------------------------------------------------------------------
        */

        $specialties =
            $this->specialtyModel

            ->where(
                'status',
                'ACTIVE'
            )

            ->findAll();

        /*
        |--------------------------------------------------------------------------
        | RETURN
        |--------------------------------------------------------------------------
        */

        return view(

            'pages/patients/index',

            [

                'patients' => $patients,

                'specialties' => $specialties,

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
        /*
        |--------------------------------------------------------------------------
        | DATA
        |--------------------------------------------------------------------------
        */

        $data = [

            'name' =>

            $this->request
                ->getPost('name'),

            'medical_record' =>

            $this->request
                ->getPost(
                    'medical_record'
                ),

            'cpf' =>

            $this->request
                ->getPost('cpf'),

            'phone' =>

            $this->request
                ->getPost('phone'),

            'specialty_id' =>

            $this->request
                ->getPost(
                    'specialty_id'
                ),

            'first_consultation_date' =>

            $this->request
                ->getPost(
                    'first_consultation_date'
                ),

            'has_exams' =>

            $this->request
                ->getPost(
                    'has_exams'
                ),

            'state' =>

            $this->request
                ->getPost('state'),

            'city' =>

            $this->request
                ->getPost('city'),

            'status' =>

            'EM ATENDIMENTO',

            'accepted_at' =>

            date(
                'Y-m-d'
            ),

            'flow_type' =>

            'PATIENT',

        ];

        /*
        |--------------------------------------------------------------------------
        | INSERT
        |--------------------------------------------------------------------------
        */

        $patientId = $this->patientModel->insert($data);

        /*
        |--------------------------------------------------------------------------
        | MOVEMENT
        |--------------------------------------------------------------------------
        */

        $this->patientMovementModel
            ->insert([

                'patient_id' => $patientId,

                'movement_type' => 'CADASTRO_REALIZADO',

                'description' => 'Paciente cadastrado no sistema',

                'created_by' => session()->get('user_id'),

                'flow_type' => 'PATIENT',

            ]);

        /*
        |--------------------------------------------------------------------------
        | STATUS HISTORY
        |--------------------------------------------------------------------------
        */

        $this->patientStatusHistoryModel
            ->insert([

                'patient_id' =>
                $patientId,

                'old_status' =>
                null,

                'new_status' =>
                'EM ATENDIMENTO',

                'observation' =>
                'Cadastro inicial do paciente',

                'changed_by' =>
                session()->get(
                    'user_id'
                )

            ]);

        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        return redirect()

            ->to('/patients')

            ->with(

                'success',

                'Paciente cadastrado com sucesso.'

            );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update()
    {
        /*
        |--------------------------------------------------------------------------
        | ID
        |--------------------------------------------------------------------------
        */

        $id =
            $this->request
            ->getPost('id');

        /*
        |--------------------------------------------------------------------------
        | PATIENT
        |--------------------------------------------------------------------------
        */

        $patient =
            $this->patientModel
            ->find($id);

        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        if (!$patient) {

            return redirect()

                ->back()

                ->with(

                    'error',

                    'Paciente não encontrado.'

                );
        }

        /*
        |--------------------------------------------------------------------------
        | DATA
        |--------------------------------------------------------------------------
        */

        $data = [

            'name' =>
            $this->request
                ->getPost('name'),

            'medical_record' =>
            $this->request
                ->getPost(
                    'medical_record'
                ),

            'cpf' =>
            $this->request
                ->getPost('cpf'),

            'phone' =>
            $this->request
                ->getPost('phone'),

            'specialty_id' =>
            $this->request
                ->getPost(
                    'specialty_id'
                ),

            'first_consultation_date' =>
            $this->request
                ->getPost(
                    'first_consultation_date'
                ),

            'has_exams' =>
            $this->request
                ->getPost(
                    'has_exams'
                ),

            'state' =>
            $this->request
                ->getPost('state'),

            'city' =>
            $this->request
                ->getPost('city'),

            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */

            'status' =>
            'EM ATENDIMENTO',

        ];

        /*
        |--------------------------------------------------------------------------
        | ACCEPTED AT
        |--------------------------------------------------------------------------
        */

        if (
            empty($patient['accepted_at'])
        ) {

            $data['accepted_at'] =
                date('Y-m-d');
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $this->patientModel
            ->update($id, $data);

        /*
        |--------------------------------------------------------------------------
        | MOVEMENT
        |--------------------------------------------------------------------------
        */

        $this->patientMovementModel
            ->insert([

                'patient_id' => $id,

                'movement_type' => 'CADASTRO COMPLEMENTADO',

                'description' => 'Cadastro do paciente complementado',

                'created_by' => session()->get('user_id'),

                'flow_type' => 'PATIENT',
            ]);

        /*
        |--------------------------------------------------------------------------
        | STATUS HISTORY
        |--------------------------------------------------------------------------
        */

        $this->patientStatusHistoryModel
            ->insert([

                'patient_id' => $id,

                'old_status' =>

                'EM FILA',

                'new_status' =>

                'EM ATENDIMENTO',

                'observation' =>

                'Cadastro complementar realizado',

                'changed_by' =>

                session()->get('user_id')

            ]);

        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        return redirect()

            ->to('/patients')

            ->with(

                'success',

                'Paciente atualizado com sucesso.'

            );
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        /*
        |--------------------------------------------------------------------------
        | PATIENT
        |--------------------------------------------------------------------------
        */

        $patient = $this->patientModel

            ->select('
                patients.*,

                specialties.name
                as specialty_name,

                states.name
                as state_name,

                states.uf
                as state_uf
            ')

            ->join(
                'specialties',
                'specialties.id = patients.specialty_id',
                'left'
            )

            ->join(
                'states',
                'states.id = patients.state',
                'left'
            )

            ->find($id);

        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        if (!$patient) {

            return redirect()->to('/patients')->with('error', 'Paciente não encontrado.');
        }

        /*
        |--------------------------------------------------------------------------
        | MOVEMENTS
        |--------------------------------------------------------------------------
        */

        $movements = $this->patientMovementModel

            ->where('patient_id', $id)

            ->where('flow_type', 'PATIENT')

            ->orderBy('created_at', 'DESC')

            ->findAll();

        /*
        |--------------------------------------------------------------------------
        | OBSERVATIONS
        |--------------------------------------------------------------------------
        */

        $observations = $this->patientObservationModel

            ->where('patient_id', $id)

            ->where('flow_type', 'PATIENT')

            ->orderBy('created_at', 'DESC')

            ->findAll();

        /*
        |--------------------------------------------------------------------------
        | REQUESTS
        |--------------------------------------------------------------------------
        */

        $requests = $this->patientRequestModel

            ->select('patient_requests.*,request_types.name as request_type_name')

            ->join('request_types', 'request_types.id= patient_requests.request_type_id', 'left')

            ->where('patient_id', $id)

            ->where('patient_requests.flow_type', 'PATIENT')

            ->orderBy('created_at', 'DESC')

            ->findAll();

        /*
        |--------------------------------------------------------------------------
        | STATUS HISTORY
        |--------------------------------------------------------------------------
        */

        $statusHistory = $this->patientStatusHistoryModel

            ->where('patient_id', $id)

            ->where('flow_type', 'PATIENT')

            ->orderBy('created_at', 'DESC')

            ->findAll();

        /*
        |--------------------------------------------------------------------------
        | RETURN
        |--------------------------------------------------------------------------
        */

        return view(

            'pages/patients/show',

            [

                'patient' => $patient,

                'movements' => $movements,

                'observations' => $observations,

                'requests' => $requests,

                'statusHistory' => $statusHistory,

            ]

        );
    }
}
