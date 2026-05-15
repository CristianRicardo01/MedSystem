<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <!-- HEADER -->
    <?= $this->include('pages/triage/components/header') ?>

    <!-- CARDS -->
    <?= $this->include('pages/triage/components/cards') ?>

    <!-- TABLE -->
    <?= $this->include('pages/triage/components/table') ?>

</div>

<!-- MODAL -->
<?= $this->include('pages/triage/components/modal-create') ?>

<?= $this->endSection() ?>