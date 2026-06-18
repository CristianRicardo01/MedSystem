<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <!-- HEADER -->
    <?= $this->include('pages/reports/indicators/components/header') ?>

    <!-- CARDS -->
    <?= $this->include('pages/reports/indicators/components/cards-info-1.php') ?>
    <?= $this->include('pages/reports/indicators/components/cards-info-2.php') ?>

    <!-- TABLE -->
    <?= $this->include('pages/reports/indicators/components/table-1') ?>
    <?= $this->include('pages/reports/indicators/components/table-2') ?>
    <?= $this->include('pages/reports/indicators/components/table-3') ?>

    <!-- GRÁFICO -->
    <div class="row">

        <div class="col-lg-4">

            <?= $this->include('pages/reports/indicators/components/grafico-1') ?>

        </div>

        <div class="col-lg-4">

            <?= $this->include('pages/reports/indicators/components/grafico-2') ?>

        </div>

        <div class="col-lg-4">

            <?= $this->include('pages/reports/indicators/components/grafico-3') ?>

        </div>

    </div>
    
</div>

<?= $this->endSection() ?>