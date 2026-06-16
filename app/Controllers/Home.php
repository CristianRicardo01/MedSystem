<?php

namespace App\Controllers;

use App\Models\PatientModel;
use App\Models\PatientRequestModel;

class Home extends BaseController
{
    protected $patientModel;

    protected $patientRequestModel;

    public function __construct()
    {
        $this->patientModel = new PatientModel();

        $this->patientRequestModel = new PatientRequestModel();
    }

    public function index()
    {
        $data = [

            /*
            |--------------------------------------------------------------------------
            | REGULAÇÃO
            |--------------------------------------------------------------------------
            */

            'patientInAttendance' => 0,
            'patientHospitalized' => 0,
            'patientFinished' => 0,
            'patientPendingRequests' => 0,

            /*
            |--------------------------------------------------------------------------
            | TRIAGEM
            |--------------------------------------------------------------------------
            */

            'triagePatients' => 0,
            'triageWarning' => 0,
            'triageExpired' => 0,
            'triagePendingRequests' => 0,

        ];

        /*
        |--------------------------------------------------------------------------
        | PACIENTES REGULAÇÃO
        |--------------------------------------------------------------------------
        */
        $data['patientInAttendance'] =
            $this->patientModel

            ->where(
                'flow_type',
                'PATIENT'
            )

            ->where(
                'status',
                'EM ATENDIMENTO'
            )

            ->countAllResults();

        /*
        |--------------------------------------------------------------------------
        | INTERNADOS REGULAÇÃO
        |--------------------------------------------------------------------------
        */
        $data['patientHospitalized'] =
            $this->patientModel

            ->where(
                'flow_type',
                'PATIENT'
            )

            ->where(
                'status',
                'INTERNADO'
            )

            ->countAllResults();

        /*
        |--------------------------------------------------------------------------
        | FINALIZADOS REGULAÇÃO
        |--------------------------------------------------------------------------
        */
        $data['patientFinished'] =
            $this->patientModel

            ->where(
                'flow_type',
                'PATIENT'
            )

            ->where(
                'status',
                'FINALIZADO'
            )

            ->countAllResults();

        /*
        |--------------------------------------------------------------------------
        | PACIENTE TRIAGEM
        |--------------------------------------------------------------------------
        */
        $data['triagePatients'] =
            $this->patientModel

            ->where(
                'flow_type',
                'TRIAGE'
            )

            ->countAllResults();


        /*
        |--------------------------------------------------------------------------
        | SOLICITAÇÕES PENDENTES REGULAÇÃO
        |--------------------------------------------------------------------------
        */

        $data['patientPendingRequests'] =

            $this->patientRequestModel

            ->where('flow_type', 'PATIENT')

            ->where('request_status', 'PENDING')

            ->countAllResults();
        /*
        |--------------------------------------------------------------------------
        | TRIAGEM 60D
        |--------------------------------------------------------------------------
        */

        $warningPatients = 0;

        $expiredPatients = 0;

        $triagePatients = $this->patientModel

            ->where('flow_type', 'TRIAGE')

            ->findAll();

        foreach ($triagePatients as $patient) {

            /*
            |--------------------------------------------------------------------------
            | FORA DO PRAZO
            |--------------------------------------------------------------------------
            */

            if ($patient['d60_status'] == 'FORA_PRAZO') {

                $expiredPatients++;

                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | PRÓXIMO DO PRAZO
            |--------------------------------------------------------------------------
            */

            if (!empty($patient['first_consultation_date'])) {

                $daysRemaining = floor(

                    (
                        strtotime($patient['first_consultation_date'])
                        -
                        time()
                    ) / 86400

                );

                if ($daysRemaining >= 0 && $daysRemaining <= 20) {

                    $warningPatients++;
                }
            }
        }

        $data['triageWarning'] = $warningPatients;

        $data['triageExpired'] = $expiredPatients;

        /*
        |--------------------------------------------------------------------------
        | SOLICITAÇÕES PENDENTES TRIAGEM
        |--------------------------------------------------------------------------
        */

        $data['triagePendingRequests'] =

            $this->patientRequestModel

            ->where('flow_type', 'TRIAGE')

            ->where('request_status', 'PENDING')

            ->countAllResults();

        /*
        |--------------------------------------------------------------------------
        | ÚLTIMOS ATENDIMENTOS
        |--------------------------------------------------------------------------
        */

        if (isAdmin()) {

            $data['lastAttendances'] =

                $this->patientModel

                ->orderBy('created_at', 'DESC')

                ->limit(10)

                ->findAll();

        } elseif (can('patients.view')) {

            $data['lastAttendances'] =

                $this->patientModel

                ->where('flow_type', 'PATIENT')

                ->orderBy('created_at', 'DESC')

                ->limit(10)

                ->findAll();
                
        } elseif (can('triage.view')) {

            $data['lastAttendances'] =

                $this->patientModel

                ->where('flow_type', 'TRIAGE')

                ->orderBy('created_at', 'DESC')

                ->limit(10)

                ->findAll();
        } else {

            $data['lastAttendances'] = [];
        }

        // dd($data);

        return view(
            'pages/dashboard/index',
            $data
        );
    }
}
