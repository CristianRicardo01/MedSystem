<?php

/*
|--------------------------------------------------------------------------
| AVATAR
|--------------------------------------------------------------------------
*/

$avatar = strtoupper(substr($patient['name'], 0, 1));

/*
|--------------------------------------------------------------------------
| STATUS BADGE
|--------------------------------------------------------------------------
*/

$statusClass = 'primary';

if ($patient['status'] == 'NEGADO') {

    $statusClass = 'danger';
} elseif ($patient['status'] == 'ACEITO') {

    $statusClass = 'success';
} elseif ($patient['status'] == 'AGUARDANDO_EXAMES') {

    $statusClass = 'warning';
}

?>

<!-- HEADER -->

<div class="patient-header mb-4"
    data-aos="fade-down">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

        <!-- LEFT -->

        <div class="d-flex align-items-center gap-4">

            <!-- AVATAR -->

            <div class="patient-photo">

                <?= esc($avatar) ?>

            </div>

            <!-- INFO -->

            <div>

                <div class="d-flex align-items-center gap-3 flex-wrap mb-2">

                    <h2 class="fw-bold mb-0">

                        <?= esc($patient['name']) ?>

                    </h2>


                    <span class="custom-badge <?= $statusClass ?>">

                        <?= esc($patient['status']) ?>

                    </span>

                </div>

                <div class="patient-meta">

                    <!-- PRONTUARIO -->

                    <span>

                        <i class="bi bi-file-earmark-medical"></i>

                        Prontuário
                        #<?= esc($patient['medical_record']) ?>

                    </span>

                    <!-- ESPECIALIDADE -->

                    <span>

                        <i class="bi bi-heart-pulse"></i>

                        Especialidade ID:
                        <?= esc($patient['specialty_id']) ?>

                    </span>

                    <!-- DATA -->

                    <span>

                        <i class="bi bi-calendar"></i>

                        <?= date(
                            'd/m/Y',
                            strtotime(
                                $patient['first_consultation_date']
                            )
                        ) ?>

                    </span>

                </div>

            </div>

        </div>

        <!-- ACTIONS -->

        <div class="d-flex gap-2 flex-wrap">

            <!-- TRANSFERIR -->

            <button class="btn btn-success btn-lg rounded-4 px-4 shadow-sm">

                <i class="bi bi-arrow-left-right me-2"></i>

                Transferir

            </button>

            <!-- EDITAR -->

            <button class="btn btn-light btn-lg rounded-4 shadow-sm">

                <i class="bi bi-pencil"></i>

            </button>

            <!-- PDF -->

            <button class="btn btn-light btn-lg rounded-4 shadow-sm">

                <i class="bi bi-file-earmark-pdf"></i>

            </button>

        </div>

    </div>

</div>