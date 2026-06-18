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
        | GRÁFICO SOLICITAÇÕES CHART
        |--------------------------------------------------------------------------
        */

        $data['statusChart'] = [
            'TRIAGEM' => 0,
            'EM ATENDIMENTO' => 0,
            'INTERNADO' => 0,
            'FINALIZADO' => 0,
        ];

        /*
        |--------------------------------------------------------------------------
        | GRÁFICO SOLICITAÇÕES CHART
        |--------------------------------------------------------------------------
        */

        $data['requestChart'] = [
            'PENDING' => 0,
            'SCHEDULED' => 0,
            'COMPLETED' => 0,
        ];

        /*
        |--------------------------------------------------------------------------
        | D60 VENCIDOS
        |--------------------------------------------------------------------------
        */

        $data['d60ExpiredPatients'] = [];

        /*
        |--------------------------------------------------------------------------
        | EXAMES ATRASADOS
        |--------------------------------------------------------------------------
        */

        $data['expiredRequestsList'] = [];

        /*
        |--------------------------------------------------------------------------
        | PRÓXIMOS VENCIMENTOS
        |--------------------------------------------------------------------------
        */

        $data['upcomingDeadlines'] = [];

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

        $data['totalPatients'] = count($patients);

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

                $data['d60ExpiredPatients'][] = [

                    'id' => $patient['id'],

                    'name' => $patient['name'],

                    'status' => $patient['status'],

                    'flow_type' => $patient['flow_type'],

                    'days_overdue' => abs($daysRemaining)

                ];
            } elseif ($daysRemaining <= 20) {

                $data['d60Warning']++;

                if (

                    $patient['flow_type'] == 'PATIENT'

                ) {

                    $data['upcomingDeadlines'][] = [

                        'type' => 'D60',

                        'description' => 'Prazo D60',

                        'patient_id' => $patient['id'],

                        'patient_name' => $patient['name'],

                        'flow_type' => $patient['flow_type'],

                        'days_remaining' => $daysRemaining

                    ];
                }
            }


            /*
            |--------------------------------------------------------------------------
            | GRÁFICO STATUS CHART
            |--------------------------------------------------------------------------
            */

            if (
                isset(
                    $data['statusChart'][$patient['status']]
                )
            ) {

                $data['statusChart'][$patient['status']]++;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | SOLICITAÇÕES
        |--------------------------------------------------------------------------
        */

        $requestQuery = $this->patientRequestModel
            ->select(
                'patient_requests.*,
                patients.name as patient_name,
                request_types.name as request_name
                '
            )
            ->join(
                'patients',
                'patients.id = patient_requests.patient_id'
            )
            ->join(
                'request_types',
                'request_types.id = patient_requests.request_type_id'
            );

        if (!isAdmin() && $flowType) {

            $requestQuery->where(
                'patient_requests.flow_type',
                $flowType
            );
        }

        $requests = $requestQuery->findAll();

        foreach ($requests as $request) {
            /*
            |--------------------------------------------------------------------------
            | GRÁFICO SOLICITAÇÕES CHART
            |--------------------------------------------------------------------------
            */
            if (
                isset(
                    $data['requestChart'][$request['request_status']]
                )
            ) {

                $data['requestChart'][$request['request_status']]++;
            }
            /*
            |--------------------------------------------------------------------------
            | 
            |--------------------------------------------------------------------------
            */
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
                != 'PENDING'
            ) {

                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | EXAMES ATRASADOS
            |--------------------------------------------------------------------------
            */

            if ($daysRemaining < 0) {

                $data['expiredRequests']++;

                $data['expiredRequestsList'][] = [

                    'patient_id' => $request['patient_id'],

                    'patient_name' => $request['patient_name'],

                    'request_name' => $request['request_name'],

                    'flow_type' => $request['flow_type'],

                    'days_overdue' => abs($daysRemaining)

                ];

                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | EXAMES PRÓXIMOS
            |--------------------------------------------------------------------------
            */

            if ($daysRemaining <= 5) {

                $data['warningRequests']++;

                $data['upcomingDeadlines'][] = [

                    'type' => 'EXAME',

                    'description' => $request['request_name'],

                    'patient_id' => $request['patient_id'],

                    'patient_name' => $request['patient_name'],

                    'flow_type' => $request['flow_type'],

                    'days_remaining' => $daysRemaining

                ];
            }
        }

        usort(
            $data['upcomingDeadlines'],
            fn($a, $b) =>

            $a['days_remaining']

                <=>

                $b['days_remaining']
        );

        return view(
            'pages/reports/indicators/index',
            $data
        );
    }
}
