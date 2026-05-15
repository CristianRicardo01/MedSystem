<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <!-- HEADER -->
    <?= $this->include('pages/triage/components/show/header') ?>
    
    <!-- GRID -->
    <?= $this->include('pages/triage/components/show/grid') ?>   

</div>

<?= $this->endSection() ?>