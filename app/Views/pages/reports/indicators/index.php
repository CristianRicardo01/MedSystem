<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <!-- HEADER -->
    <!-- <1?= $this->include('pages/triage/components/header') ?> -->

    <!-- CARDS -->
    <?= $this->include('pages/reports/indicators/components/cards.php') ?>

    <!-- TABLE -->
    <!-- <1?= $this->include('pages/triage/components/table') ?> -->

</div>

<?= $this->endSection() ?>