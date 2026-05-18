<?php

/*
|--------------------------------------------------------------------------
| PROCESS STATUS
|--------------------------------------------------------------------------
*/

$statusClass = 'primary';

if ($patient['status'] == 'NEGADO') {

    $statusClass = 'danger';
} elseif ($patient['status'] == 'ACEITO') {

    $statusClass = 'success';
} elseif ($patient['status'] == 'AGUARDANDO_EXAMES') {

    $statusClass = 'warning';
} elseif ($patient['status'] == 'FINALIZADO') {

    $statusClass = 'dark';
}

/*
|--------------------------------------------------------------------------
| EXAMS
|--------------------------------------------------------------------------
*/

$hasExams = !empty($patient['has_exams']);

?>

<!-- STATUS -->

<div class="col-md-6"
    data-aos="fade-up"
    data-aos-delay="100">

    <div class="card card-modern border-0 h-100">

        <div class="card-body p-4">

            <!-- HEADER -->

            <div class="card-title-modern">

                <div class="icon-box orange">

                    <i class="bi bi-clipboard2-pulse"></i>

                </div>

                <div>

                    <h5 class="fw-bold mb-0">
                        Status Triagem
                    </h5>

                    <small class="text-muted">
                        Controle operacional
                    </small>

                </div>

            </div>

            <!-- STATUS -->

            <div class="exam-status mt-4">

                <!-- EXAMES -->

                <div class="status-row">

                    <span>
                        Possui Exames
                    </span>

                    <?php if ($hasExams): ?>

                        <span class="custom-badge success">

                            SIM

                        </span>

                    <?php else: ?>

                        <span class="custom-badge danger">

                            NÃO

                        </span>

                    <?php endif; ?>

                </div>

                <!-- STATUS -->

                <div class="status-row">

                    <span>
                        Processo
                    </span>

                    <span class="custom-badge <?= $statusClass ?>">

                        <?= esc($patient['status']) ?>

                    </span>

                </div>

                <!-- FLUXO -->

                <div class="status-row">

                    <span>
                        Fluxo
                    </span>

                    <span class="custom-badge primary">

                        <?= esc($patient['flow_type']) ?>

                    </span>

                </div>

                <!-- SETOR -->

                <div class="status-row">

                    <span>
                        Setor Atual
                    </span>

                    <span class="custom-badge warning">

                        <?= esc($patient['current_sector']) ?>

                    </span>

                </div>

            </div>

        </div>

    </div>

</div>