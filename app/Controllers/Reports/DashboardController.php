<?php

namespace App\Controllers\Reports;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    public function index()
    {
        $data['reports'] = [

            [
                'title'       => 'Pacientes',
                'subtitle'    => 'Relatório Assistencial',
                'icon'        => 'bi-people-fill',
                'description' => 'Fluxo completo dos pacientes.',
                'url'         => base_url('reports/patients'),
                'permission'  => 'reports.patients.view',
                'color'       => 'primary'
            ],

            [
                'title'       => 'Exames',
                'subtitle'    => 'Relatório Assistencial',
                'icon'        => 'bi-clipboard2-pulse',
                'description' => 'Pendentes, realizados e atrasados.',
                'url'         => base_url('reports/exams'),
                'permission'  => 'reports.exams.view',
                'color'       => 'success'
            ],

            [
                'title'       => 'Consultas',
                'subtitle'    => 'Relatório Assistencial',
                'icon'        => 'bi-calendar-check',
                'description' => 'Agenda médica.',
                'url'         => base_url('reports/consultations'),
                'permission'  => 'reports.consultations.view',
                'color'       => 'warning'
            ],

            [
                'title'       => 'SLA 60 Dias',
                'subtitle'    => 'Relatório Assistencial',
                'icon'        => 'bi-clock-history',
                'description' => 'Tempo de espera dos pacientes.',
                'url'         => base_url('reports/sla'),
                'permission'  => 'reports.sla.view',
                'color'       => 'danger'
            ],

            [
                'title'       => 'Indicadores',
                'subtitle'    => 'Business Intelligence',
                'icon'        => 'bi-bar-chart',
                'description' => 'Indicadores do sistema.',
                'url'         => base_url('reports/indicators'),
                'permission'  => 'reports.indicators.view',
                'color'       => 'info'
            ],

        ];
        return view('pages/reports/dashboard/index', $data);
    }
}
