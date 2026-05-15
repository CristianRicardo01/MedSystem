<!-- GRID -->
<div class="row g-4">

    <!-- LEFT -->
    <div class="col-lg-8">

        <!-- CARD -->
        <div class="row g-4">

            <!-- DADOS -->
            <?= $this->include('pages/triage/components/show/dados') ?>
            <!-- STATUS -->
            <?= $this->include('pages/triage/components/show/status') ?>
            <!-- OBSERVAÇÕES -->
            <?= $this->include('pages/triage/components/show/observacoes') ?>

        </div>

    </div>

    <!-- RIGHT -->
    <?= $this->include('pages/triage/components/show/right') ?>

</div>