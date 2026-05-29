<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <!-- HEADER -->
    <?= $this->include('pages/patients/components/header') ?>

    <!-- CARDS -->
    <?= $this->include('pages/patients/components/cards') ?>

    <!-- TABLE -->
    <?= $this->include('pages/patients/components/table') ?>

</div>

<!-- MODAL -->
<?= $this->include('pages/patients/components/modal-create') ?>
<?= $this->include('pages/patients/components/modal-edit') ?>

<?= $this->endSection() ?>