<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <!-- HEADER -->
    <?= $this->include('pages/settings/requests/components/header') ?>

    <!-- TABLE -->
    <div class="table-container" data-aos="fade-up" data-aos-delay="200">

        <!-- HEADER -->

        <div class="table-header d-flex justify-content-between align-items-center flex-wrap gap-3">

            <div>

                <h5 class="fw-bold mb-1">
                    Solicitações Cadastradas
                </h5>

                <small class="text-muted">
                    Controle administrativo das solicitações
                </small>

            </div>

            <!-- SEARCH -->

            <form method="GET" class="table-search">

                <i class="bi bi-search"></i>

                <input
                    type="text"
                    name="search"
                    value="<?= esc($search ?? '') ?>"
                    placeholder="Pesquisar solicitação...">

            </form>

        </div>

        <!-- TABLE -->
        <?= $this->include('pages/settings/requests/components/table') ?>

    </div>

</div>

<!-- MODAL -->
<?= $this->include('pages/settings/requests/components/modal-edit') ?>
<?= $this->include('pages/settings/requests/components/modal-create') ?>

<?= $this->endSection() ?>