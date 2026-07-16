<?= view(
    'pages/reports/components/page-header',
    [
        'title' => 'Relatório de Exames',
        'subtitle' => 'Acompanhe exames pendentes e realizados.',
        'icon' => 'bi-clipboard2-pulse',
        'back_url' => base_url('reports/home')
    ]
) ?>