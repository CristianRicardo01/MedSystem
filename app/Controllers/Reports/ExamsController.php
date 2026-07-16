<?php

namespace App\Controllers\Reports;

use App\Controllers\BaseController;
use App\Services\Reports\ExamsReportService;
use App\Models\RequestTypeModel;

class ExamsController extends BaseController
{
    protected ExamsReportService $reportService;

    public function __construct()
    {
        $this->reportService = new ExamsReportService();
    }

    /**
     * --------------------------------------------------------------------------
     * Relatório de Exames
     * --------------------------------------------------------------------------
     */
    public function index()
    {
        $requestTypeModel = new RequestTypeModel();

        $data = $this->reportService->getReport(
            $this->getFilters()
        );

        $data['requestTypes'] = $requestTypeModel
            ->orderBy('name')
            ->findAll();

        return view(
            'pages/reports/exams/index',
            $data
        );
    }
    /**
     * --------------------------------------------------------------------------
     * Logica de busca do relatório de exames.
     * --------------------------------------------------------------------------
     */
    public function search()
    {
        $filters = $this->getFilters();

        // dd($filters);

        return $this->response->setJSON(

            $this->reportService->getReport($filters)

        );
    }
    /**
     * --------------------------------------------------------------------------
     * Filtros
     * --------------------------------------------------------------------------
     */
    private function getFilters(): array
    {
        return [

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */
            'status' => $this->request->getGet('status'),

            /*
            |--------------------------------------------------------------------------
            | Período
            |--------------------------------------------------------------------------
            */
            'start_date' => $this->request->getGet('start_date'),

            'end_date' => $this->request->getGet('end_date'),

            /*
            |--------------------------------------------------------------------------
            | Exame
            |--------------------------------------------------------------------------
            */
            'request_type' => $this->request->getGet('request_type'),

            /*
            |--------------------------------------------------------------------------
            | Origem
            |--------------------------------------------------------------------------
            | Somente ADMIN poderá utilizar.
            | TRIAGEM e REGULAÇÃO serão tratados automaticamente
            | pelo ExamsReportService.
            |--------------------------------------------------------------------------
            */
            'flow_type' => $this->request->getGet('flow_type'),

        ];
    }

    public function pdf()
    {
        $filters = $this->getFilters();

        $data = $this->reportService->getReport($filters);

        foreach ($data['table'] as &$row) {

            switch ($row['request_status']) {

                case 'PENDING':
                    $row['request_status'] = 'Pendente';
                    break;

                case 'COMPLETED':
                    $row['request_status'] = 'Realizado';
                    break;
            }
        }
        $data['title'] = 'RELATÓRIO DE EXAMES';

        return view(
            'pdf/reports/exams/pdf',
            $data
        );
    }
}
