<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <!-- HEADER -->
    <?= $this->include('pages/settings/users/components/header') ?>

    <!-- TABLE -->
    <?= $this->include('pages/settings/users/components/table') ?>

</div>

<!-- MODAL -->
<?= $this->include('pages/settings/users/components/modal-create') ?>

<?= $this->include('pages/settings/users/components/modal-edit') ?>

<?= $this->endSection() ?>