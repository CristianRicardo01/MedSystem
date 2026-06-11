<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <!-- HEADER -->
    <?= $this->include('pages/patients/components/show/header') ?>

    <!-- GRID -->
    <?= $this->include('pages/patients/components/show/grid') ?>

</div>
<!-- MODAL -->
<?= $this->include('pages/patients/components/show/modal-observation') ?>
<?= $this->include('pages/patients/components/show/modal-request') ?>
<?= $this->include('pages/patients/components/show/modal-edit-request-patients') ?>
<?= $this->include('pages/patients/components/show/modal-hospitalize-patient') ?>
<?= $this->include('pages/patients/components/show/modalReturnPatient') ?>
<?= $this->include('pages/patients/components/show/modalFinalizePatient') ?>
<?= $this->endSection() ?>