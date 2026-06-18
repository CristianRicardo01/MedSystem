<?php

namespace App\Controllers\Reports;

use App\Controllers\BaseController;
use App\Models\PatientModel;
use App\Models\PatientRequestModel;

class IndicatorsController extends BaseController
{
    protected $patientModel;

    protected $patientRequestModel;

    public function __construct()
    {
        $this->patientModel = new PatientModel();

        $this->patientRequestModel =
            new PatientRequestModel();
    }

    public function index()
    {
        $data = [

            'totalPatients'         => 0,
            'inAttendance'          => 0,
            'hospitalized'          => 0,
            'finished'              => 0,

            'd60Expired'            => 0,
            'd60Warning'            => 0,

            'pendingRequests'       => 0,
            'expiredRequests'       => 0,
            'warningRequests'       => 0,

        ];

        /*
        |--------------------------------------------------------------------------
        | DEFINE FLUXO
        |--------------------------------------------------------------------------
        */

        $flowType = null;

        if (can('patients.view')) {

            $flowType = 'PATIENT';
        } elseif (can('triage.view')) {

            $flowType = 'TRIAGE';
        }

        /*
        |--------------------------------------------------------------------------
        | PACIENTES
        |--------------------------------------------------------------------------
        */

        $patientQuery = $this->patientModel;

        if (!isAdmin() && $flowType) {

            $patientQuery->where(
                'flow_type',
                $flowType
            );
        }

        $patients = $patientQuery->findAll();

        $data['totalPatients'] =
            count($patients);

        foreach ($patients as $patient) {

            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */

            if (
                $patient['status']
                == 'EM ATENDIMENTO'
            ) {

                $data['inAttendance']++;
            }

            if (
                $patient['status']
                == 'INTERNADO'
            ) {

                $data['hospitalized']++;
            }

            if (
                $patient['status']
                == 'FINALIZADO'
            ) {

                $data['finished']++;
            }

            /*
            |--------------------------------------------------------------------------
            | D60
            |--------------------------------------------------------------------------
            */

            if (
                empty($patient['accepted_at'])
            ) {

                continue;
            }

            if (
                $patient['status']
                == 'FINALIZADO'
            ) {

                continue;
            }

            $d60Date = strtotime(

                $patient['accepted_at']
                    . ' +60 days'

            );

            $daysRemaining = floor(

                (
                    $d60Date - time()
                ) / 86400

            );

            if ($daysRemaining < 0) {

                $data['d60Expired']++;
            } elseif ($daysRemaining <= 20) {

                $data['d60Warning']++;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | SOLICITAÇÕES
        |--------------------------------------------------------------------------
        */

        $requestQuery =
            $this->patientRequestModel;

        if (!isAdmin() && $flowType) {

            $requestQuery->where(
                'flow_type',
                $flowType
            );
        }

        $requests =
            $requestQuery->findAll();

        foreach ($requests as $request) {

            if (
                $request['request_status']
                == 'PENDING'
            ) {

                $data['pendingRequests']++;
            }

            if (
                empty($request['deadline_date'])
            ) {

                continue;
            }

            $daysRemaining = floor(

                (
                    strtotime(
                        $request['deadline_date']
                    )
                    -
                    time()
                ) / 86400

            );

            if (
                $request['request_status']
                == 'PENDING'
            ) {

                if ($daysRemaining < 0) {

                    $data['expiredRequests']++;
                } elseif ($daysRemaining <= 5) {

                    $data['warningRequests']++;
                }
            }
        }

        return view(
            'pages/reports/indicators/index',
            $data
        );
    }
}
