<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <!-- HEADER -->
    <?= $this->include('pages/triage/components/show/header') ?>
    
    <!-- GRID -->
    <?= $this->include('pages/triage/components/show/grid') ?>   

</div>

<!-- MODAL -->
<?= $this->include('pages/triage/components/show/modal-observation') ?>
<?= $this->include('pages/triage/components/show/modal-request') ?>
<?= $this->include('pages/triage/components/show/modal-edit-request') ?>
<?= $this->include('pages/triage/components/show/modal-edit-triage') ?>

<?= $this->endSection() ?>