<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <div class="row mb-4">

        <div class="col-12">

            <h2 class="fw-bold">
                Central de Relatórios
            </h2>

            <p class="text-muted mb-0">
                Selecione um relatório para consultar informações do sistema.
            </p>

        </div>

    </div>

    <div class="row g-4">

        <?php foreach ($reports as $report): ?>

            <?= view('pages/reports/components/report-card', [
                'report' => $report
            ]) ?>

        <?php endforeach; ?>
    </div>

</div>


<?= $this->endSection() ?>