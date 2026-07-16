<div class="row mb-4">
    <?= view(
        'pages/reports/components/summary-card',
        [
            'id'    => 'summary-pending',
            'title' => 'Pendentes',
            'value' => $summary['pending'] ?? 0,
            'icon'  => 'bi-hourglass-split',
            'color' => 'warning'
        ]
    ) ?>

    <?= view(
        'pages/reports/components/summary-card',
        [
            'id'    => 'summary-completed',
            'title' => 'Realizados',
            'value' => $summary['completed'] ?? 0,
            'icon'  => 'bi-check-circle',
            'color' => 'success'
        ]
    ) ?>

</div>