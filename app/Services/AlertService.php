<?php

namespace App\Services;

use App\Models\PatientModel;
use App\Models\PatientRequestModel;

class AlertService
{
    protected $patientModel;

    protected $patientRequestModel;

    public function __construct()
    {
        $this->patientModel = new PatientModel();

        $this->patientRequestModel = new PatientRequestModel();
        
    }

    /**
     * D60 vencido
     */
    private function getD60ExpiredAlerts()
    {
        $flowType = $this->getFlowType();

        $query = $this->patientModel
            ->where('accepted_at IS NOT NULL');

        if ($flowType) {

            $query->where(
                'flow_type',
                $flowType
            );
        }

        $patients = $query->findAll();

        $alerts = [];

        foreach ($patients as $patient) {

            if ($patient['status'] == 'FINALIZADO') {
                continue;
            }

            $d60Date = strtotime(
                $patient['accepted_at'] . ' +60 days'
            );

            if ($d60Date > time()) {
                continue;
            }

            $url = $patient['flow_type'] == 'TRIAGE'

                ? base_url(
                    'triage/show/' . $patient['id']
                )

                : base_url(
                    'patients/show/' . $patient['id']
                );

            $alerts[] = [

                'type' => 'danger',

                'flow_type' => $patient['flow_type'],

                'title' => 'D60 Vencido',

                'message' =>

                $patient['name']

                    . ' ultrapassou o prazo D60.',

                'url' => $url,

                'patient_id' => $patient['id']

            ];
        }

        return $alerts;
    }

    /** 
     * D60 Próximo
     */
    private function getD60WarningAlerts()
    {
        $flowType = $this->getFlowType();

        $query = $this->patientModel
            ->where('accepted_at IS NOT NULL');

        if ($flowType) {

            $query->where(
                'flow_type',
                $flowType
            );
        }

        $patients = $query->findAll();

        $alerts = [];

        foreach ($patients as $patient) {

            if ($patient['status'] == 'FINALIZADO') {
                continue;
            }

            $d60Date = strtotime(
                $patient['accepted_at'] . ' +60 days'
            );

            $daysRemaining = floor(

                (
                    $d60Date - time()
                ) / 86400

            );

            if (
                $daysRemaining > 20
                ||
                $daysRemaining < 0
            ) {
                continue;
            }

            $url = $patient['flow_type'] == 'TRIAGE'

                ? base_url(
                    'triage/show/' . $patient['id']
                )

                : base_url(
                    'patients/show/' . $patient['id']
                );

            $alerts[] = [

                'type' => 'warning',

                'flow_type' => $patient['flow_type'],

                'title' => 'D60 Próximo',

                'message' =>

                $patient['name']

                    . ' possui '

                    . $daysRemaining

                    . ' dia(s) restantes.',

                'url' => $url,

                'patient_id' => $patient['id']

            ];
        }

        return $alerts;
    }

    /** 
     *Exame Atrasado
     */
    private function getRequestExpiredAlerts()
    {
        $flowType = $this->getFlowType();

        $query = $this->patientRequestModel

            ->select('
            patient_requests.*,
            patients.name as patient_name,
            request_types.name as request_name
        ')

            ->join(
                'patients',
                'patients.id = patient_requests.patient_id'
            )

            ->join(
                'request_types',
                'request_types.id = patient_requests.request_type_id'
            )

            ->whereIn(
                'patient_requests.request_status',
                ['PENDING', 'SCHEDULED']
            )

            ->where(
                'patient_requests.deadline_date <',
                date('Y-m-d')
            );

        if ($flowType) {

            $query->where(
                'patient_requests.flow_type',
                $flowType
            );
        }

        $requests = $query->findAll();

        $alerts = [];

        foreach ($requests as $request) {

            $daysLate = floor(

                (
                    time()
                    -
                    strtotime($request['deadline_date'])
                ) / 86400

            );

            $url = $request['flow_type'] == 'TRIAGE'

                ? base_url(
                    'triage/show/' . $request['patient_id']
                )

                : base_url(
                    'patients/show/' . $request['patient_id']
                );

            $alerts[] = [

                'type' => 'danger',

                'flow_type' => $request['flow_type'],

                'title' => 'Exame Atrasado',

                'message' =>

                $request['request_name']

                    . ' atrasado há '

                    . $daysLate

                    . ' dia(s).',

                'url' => $url,

                'patient_id' => $request['patient_id']

            ];
        }

        return $alerts;
    }

    /** 
     *Exame Próximo
     */
    private function getRequestWarningAlerts()
    {
        $flowType = $this->getFlowType();

        $query = $this->patientRequestModel

            ->select('
            patient_requests.*,
            patients.name as patient_name,
            request_types.name as request_name
        ')

            ->join(
                'patients',
                'patients.id = patient_requests.patient_id'
            )

            ->join(
                'request_types',
                'request_types.id = patient_requests.request_type_id'
            )

            ->whereIn(
                'patient_requests.request_status',
                ['PENDING', 'SCHEDULED']
            );

        if ($flowType) {

            $query->where(
                'patient_requests.flow_type',
                $flowType
            );
        }

        $requests = $query->findAll();

        $alerts = [];

        foreach ($requests as $request) {

            if (empty($request['deadline_date'])) {
                continue;
            }

            $daysRemaining = floor(

                (
                    strtotime($request['deadline_date'])
                    -
                    time()
                ) / 86400

            );

            if ($daysRemaining > 5 || $daysRemaining < 0) {
                continue;
            }

            $url = $request['flow_type'] == 'TRIAGE'

                ? base_url(
                    'triage/show/' . $request['patient_id']
                )

                : base_url(
                    'patients/show/' . $request['patient_id']
                );

            $alerts[] = [

                'type' => 'warning',

                'flow_type' => $request['flow_type'],

                'title' => 'Exame Próximo',

                'message' =>

                $request['request_name']

                    . ' vence em '

                    . $daysRemaining

                    . ' dia(s).',

                'url' => $url,

                'patient_id' => $request['patient_id']

            ];
        }

        return $alerts;
    }

    /**
     * Retorna todos os alertas do sistema
     */
    public function getAlerts()
    {
        $alerts = [];

        $alerts = array_merge(
            $alerts,
            $this->getD60ExpiredAlerts()
        );

        $alerts = array_merge(
            $alerts,
            $this->getD60WarningAlerts()
        );

        $alerts = array_merge(
            $alerts,
            $this->getRequestExpiredAlerts()
        );

        $alerts = array_merge(
            $alerts,
            $this->getRequestWarningAlerts()
        );

        usort($alerts, function ($a, $b) {

            $priority = [

                'danger'  => 1,
                'warning' => 2,
                'info'    => 3

            ];

            return

                $priority[$a['type']]

                <=>

                $priority[$b['type']];
        });
        return $alerts;
    }

    /**
     * Descobre qual fluxo o usuário pode visualizar
     */
    private function getFlowType()
    {
        if (isAdmin()) {

            return null;
        }

        switch (userRole()) {

            case 'REGULACAO':
                return 'PATIENT';

            case 'TRIAGEM':
                return 'TRIAGE';

            default:
                return null;
        }
    }
}
