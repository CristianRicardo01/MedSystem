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

                        Especialidade:
                        <?= esc($patient['specialty_name']) ?>
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
            <button
                class="btn btn-success btn-lg rounded-4 px-4 shadow-sm btnTransferPatient"

                data-id="<?= $patient['id'] ?>">

                <i class="bi bi-arrow-left-right me-2"></i>

                Transferir

            </button>

            <!-- EDITAR -->

            <button
                class="btn btn-light btn-lg rounded-4 shadow-sm btnEditPatient"

                data-id="<?= $patient['id'] ?>"

                data-name="<?= esc($patient['name']) ?>"

                data-medical_record="<?= esc($patient['medical_record']) ?>"

                data-cpf="<?= esc($patient['cpf']) ?>"

                data-phone="<?= esc($patient['phone']) ?>"

                data-specialty_id="<?= $patient['specialty_id'] ?>"

                data-has_exams="<?= $patient['has_exams'] ?>"

                data-first_service_date="<?= $patient['first_service_date'] ?>"

                data-first_consultation_date="<?= $patient['first_consultation_date'] ?>">

                <i class="bi bi-pencil"></i>

            </button>

            <!-- PDF -->

            <a href="<?= base_url('triage/pdf/' . $patient['id']) ?>" target="_blank" class="btn btn-light btn-lg rounded-4 shadow-sm btnPdfPatient">

                <i class="bi bi-file-earmark-pdf"></i>

            </a>

        </div>

    </div>

</div>