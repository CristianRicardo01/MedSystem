<?php

namespace App\Services\Reports;

use App\Models\PatientRequestModel;

class ExamsReportService
{
    protected PatientRequestModel $patientRequestModel;

    public function __construct()
    {
        $this->patientRequestModel = new PatientRequestModel();
    }

    /*
    |--------------------------------------------------------------------------
    | Relatório
    |--------------------------------------------------------------------------
    */

    /**
     * Retorna todos os dados do relatório.
     */
    public function getReport(array $filters = []): array
    {
        // Prepara os filtros
        $filters = $this->prepareFilters($filters);

        // Busca os registros
        $rows = $this->search($filters);

        // Calcula o resumo
        $summary = $this->summary($rows);

        return [

            'filters' => $filters,

            'summary' => $summary,

            'table' => $rows,

        ];
    }
   
    /*
    |--------------------------------------------------------------------------
    | Filtros
    |--------------------------------------------------------------------------
    */

    /**
     * Prepara os filtros recebidos do Controller.
     */
    private function prepareFilters(array $filters): array
    {
        $filters = array_merge([

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */
            'status' => null,

            /*
            |--------------------------------------------------------------------------
            | Período
            |--------------------------------------------------------------------------
            */
            'start_date' => null,

            'end_date' => null,

            /*
            |--------------------------------------------------------------------------
            | Tipo do Exame
            |--------------------------------------------------------------------------
            */
            'request_type' => null,

            /*
            |--------------------------------------------------------------------------
            | Fluxo
            |--------------------------------------------------------------------------
            */
            'flow_type' => null,

        ], $filters);

        /*
        |--------------------------------------------------------------------------
        | Permissões
        |--------------------------------------------------------------------------
        |
        | ADMIN
        |  - Visualiza tudo
        |
        | TRIAGEM
        |  - Apenas TRIAGEM
        |
        | REGULAÇÃO
        |  - Apenas REGULAÇÃO
        |--------------------------------------------------------------------------
        */

        if (!isAdmin()) {

            switch (userRole()) {

                case 'TRIAGEM':
                    $filters['flow_type'] = 'TRIAGE';
                    break;

                case 'REGULACAO':
                    $filters['flow_type'] = 'PATIENT';
                    break;
            }
        }

        return $filters;
    }

    /*
    |--------------------------------------------------------------------------
    | Consulta
    |--------------------------------------------------------------------------
    */

    /**
     * Consulta principal do relatório.
     *
     * Retorna apenas:
     *
     * - Nome do paciente
     * - Nome do exame
     * - Status
     *
     * Filtros:
     *
     * - Flow Type
     * - Status
     * - Período
     * - Tipo do exame
     */
    private function search(array $filters): array
    {
        $builder = $this->patientRequestModel

            ->select([

                'patient_requests.id AS request_id',

                'patient_requests.flow_type',

                'patient_requests.request_status',

                'patient_requests.requested_at',

                'patients.id AS patient_id',

                'patients.name AS patient_name',

                'request_types.name AS request_name',

            ])

            ->join(
                'patients',
                'patients.id = patient_requests.patient_id'
            )

            ->join(
                'request_types',
                'request_types.id = patient_requests.request_type_id'
            );

        /*
        |--------------------------------------------------------------------------
        | Somente os status utilizados neste relatório
        |--------------------------------------------------------------------------
        */

        $builder->whereIn(
            'patient_requests.request_status',
            [
                'PENDING',
                'COMPLETED'
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Flow Type
        |--------------------------------------------------------------------------
        */

        if (!empty($filters['flow_type'])) {

            $builder->where(
                'patient_requests.flow_type',
                $filters['flow_type']
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Status
        |--------------------------------------------------------------------------
        */

        if (!empty($filters['status'])) {

            $builder->where(
                'patient_requests.request_status',
                $filters['status']
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Exame
        |--------------------------------------------------------------------------
        */

        if (!empty($filters['request_type'])) {

            $builder->where(
                'patient_requests.request_type_id',
                $filters['request_type']
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Data Inicial
        |--------------------------------------------------------------------------
        */

        if (!empty($filters['start_date'])) {

            $builder->where(
                'DATE(patient_requests.requested_at) >=',
                $filters['start_date']
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Data Final
        |--------------------------------------------------------------------------
        */

        if (!empty($filters['end_date'])) {

            $builder->where(
                'DATE(patient_requests.requested_at) <=',
                $filters['end_date']
            );
        }

        return $builder

            ->orderBy('patient_requests.requested_at', 'DESC')

            ->findAll();
    }

    /*
    |--------------------------------------------------------------------------
    | Resumo
    |--------------------------------------------------------------------------
    */

    /**
     * Calcula os indicadores do relatório.
     */
    private function summary(array $rows): array
    {
        $summary = [

            'pending' => 0,

            'completed' => 0,

        ];

        foreach ($rows as $row) {

            switch ($row['request_status']) {

                case 'PENDING':
                    $summary['pending']++;
                    break;

                case 'COMPLETED':
                    $summary['completed']++;
                    break;
            }
        }

        return $summary;
    }
}
