<!-- GRID -->
<div class="row g-4">

    <!-- LEFT -->
    <div class="col-lg-8">

        <!-- CARD -->
        <div class="row g-4">

            <!-- DADOS -->
            <?= $this->include('pages/patients/components/show/dados') ?>
            <!-- STATUS -->
            <?= $this->include('pages/patients/components/show/status') ?>
            <!-- OBSERVAÇÕES -->
            <?= $this->include('pages/patients/components/show/observacoes') ?>
            <!-- SOLICITAÇÕES -->
            <?= $this->include('pages/patients/components/show/request') ?>

        </div>

    </div>

    <!-- RIGHT -->
    <?= $this->include('pages/patients/components/show/right') ?>


</div>