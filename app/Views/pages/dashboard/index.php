<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <!-- HEADER -->
    <?= $this->include('pages/dashboard/components/header') ?>

    <!-- PERMISSIONS -->
    <!-- <1?= $this->include('pages/dashboard/permissions.php') ?> -->

    <!-- CARDS -->
    <?= $this->include('pages/dashboard/components/cards') ?>

    <!-- TABLE -->
    <?= $this->include('pages/dashboard/components/table') ?>

</div>

<?= $this->endSection() ?>