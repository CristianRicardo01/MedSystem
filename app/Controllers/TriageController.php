<?php

namespace App\Controllers;

use App\Models\PatientModel;
use App\Services\PatientFlowService;
use DateTime;

class TriageController extends BaseController
{
    protected $patientFlowService;

    protected $patientModel;

    public function __construct()
    {
        $this->patientFlowService = new PatientFlowService();

        $this->patientModel = new PatientModel();
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $patients = $this->patientModel

            ->where('flow_type', 'TRIAGE')

            ->orderBy('id', 'DESC')

            ->findAll();

        /*
        |--------------------------------------------------------------------------
        | CARDS
        |--------------------------------------------------------------------------
        */

        $triageCount = 0;

        $finishedCount = 0;

        $warningCount = 0;

        $criticalCount = 0;

        foreach ($patients as $patient) {

            /*
            |--------------------------------------------------------------------------
            | TRIAGEM
            |--------------------------------------------------------------------------
            */

            $triageCount++;

            /*
            |--------------------------------------------------------------------------
            | FINALIZADOS HOJE
            |--------------------------------------------------------------------------
            */

            if (

                $patient['status'] == 'NEGADO' ||

                $patient['status'] == 'FINALIZADO'

            ) {

                if (!empty($patient['finalized_at'])) {

                    $finalizedDate = date(
                        'Y-m-d',
                        strtotime($patient['finalized_at'])
                    );

                    $todayDate = date('Y-m-d');

                    if ($finalizedDate == $todayDate) {

                        $finishedCount++;
                    }
                }
            }

            /*
            |--------------------------------------------------------------------------
            | SLA
            |--------------------------------------------------------------------------
            */

            $today = new DateTime(date('Y-m-d'));

            $consultation = new DateTime(
                $patient['first_consultation_date']
            );

            $diff = $today->diff($consultation);

            $days = $diff->days;

            $isLate = $diff->invert;

            /*
            |--------------------------------------------------------------------------
            | CRITICOS
            |--------------------------------------------------------------------------
            */

            if ($isLate) {

                $criticalCount++;
            } elseif ($days <= 20) {

                /*
            |--------------------------------------------------------------------------
            | PROXIMOS PRAZO
            |--------------------------------------------------------------------------
            */

                $warningCount++;
            }
        }

        return view('pages/triage/index', [

            'patients' => $patients,

            'triageCount' => $triageCount,

            'finishedCount' => $finishedCount,

            'warningCount' => $warningCount,

            'criticalCount' => $criticalCount

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store()
    {
        try {

            $data = $this->request->getPost();

            /*
            |--------------------------------------------------------------------------
            | CREATE PATIENT
            |--------------------------------------------------------------------------
            */

            $patientId = $this->patientFlowService->createTriagePatient($data);

            return $this->response->setJSON([

                'status' => true,

                'message' => 'Paciente criado com sucesso',

                'patient_id' => $patientId

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

        $patient = $this->patientModel->find($id);

        if (!$patient) {

            throw \CodeIgniter\Exceptions\PageNotFoundException
                ::forPageNotFound();
        }

        /*
        |--------------------------------------------------------------------------
        | TIMELINE
        |--------------------------------------------------------------------------
        */

        $statusHistoryModel = new \App\Models\PatientStatusHistoryModel();

        $timeline = $statusHistoryModel

            ->where('patient_id', $id)

            ->orderBy('id', 'DESC')

            ->findAll();

        /*
        |--------------------------------------------------------------------------
        | MOVEMENTS
        |--------------------------------------------------------------------------
        */

        $movementModel = new \App\Models\PatientMovementModel();

        $movements = $movementModel

            ->where('patient_id', $id)

            ->orderBy('id', 'DESC')

            ->findAll();

        return view('pages/triage/show', [

            'patient' => $patient,

            'timeline' => $timeline,

            'movements' => $movements

        ]);
    }

    public function storeObservation()
    {
        try {

            $patientId = $this->request
                ->getPost('patient_id');

            $observation = $this->request
                ->getPost('observation');

            /*
        |--------------------------------------------------------------------------
        | SAVE
        |--------------------------------------------------------------------------
        */

            $this->patientFlowService
                ->createObservation(

                    $patientId,

                    $observation

                );

            return $this->response->setJSON([

                'status' => true,

                'message' => 'Observação adicionada'

            ]);
        } catch (\Exception $e) {

            return $this->response->setJSON([

                'status' => false,

                'message' => $e->getMessage()

            ]);
        }
    }
}
