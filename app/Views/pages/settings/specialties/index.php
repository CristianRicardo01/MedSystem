<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <!-- HEADER -->
    <?= $this->include('pages/settings/specialties/components/header') ?>

    <!-- TABLE -->
    <div class="table-container" data-aos="fade-up" data-aos-delay="200">

        <!-- HEADER -->

        <div class="table-header d-flex justify-content-between align-items-center flex-wrap gap-3">

            <div>

                <h5 class="fw-bold mb-1">
                    Lista de Especialidades
                </h5>

                <small class="text-muted">
                    Controle administrativo das especialidades médicas para categorização de solicitações.
                </small>

            </div>

            <!-- SEARCH -->

            <div class="table-search">

                <i class="bi bi-search"></i>

                <input type="text"
                    placeholder="Pesquisar solicitação...">

            </div>

        </div>

        <!-- TABLE -->
        <?= $this->include('pages/settings/specialties/components/table') ?>

    </div>

</div>

<!-- MODAL -->
<?= $this->include('pages/settings/specialties/components/modal-edit') ?>
<?= $this->include('pages/settings/specialties/components/modal-create') ?>

<?= $this->endSection() ?>