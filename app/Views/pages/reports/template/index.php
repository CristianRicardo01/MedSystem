<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <?= $this->include('pages/reports/exams/components/header') ?>

    <?= $this->include('pages/reports/exams/components/filters') ?>

    <?= $this->include('pages/reports/exams/components/cards') ?>

    <?= $this->include('pages/reports/exams/components/table') ?>

</div>

<?= $this->endSection() ?>