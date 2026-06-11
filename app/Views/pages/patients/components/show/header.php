<!-- HEADER -->

<div class="patient-header mb-4"
    data-aos="fade-down">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

        <!-- LEFT -->

        <div class="d-flex align-items-center gap-4">

            <!-- AVATAR -->

            <div class="patient-photo">

                <?= strtoupper(substr($patient['name'], 0, 1)) ?>
            </div>

            <!-- INFO -->

            <div>

                <div class="d-flex align-items-center gap-3 flex-wrap mb-2">

                    <h2 class="fw-bold mb-0">
                        <?= esc($patient['name']) ?>
                    </h2>

                    <?php

                    $badgeClass = 'success';

                    if ($patient['status'] == 'INTERNADO') {

                        $badgeClass = 'danger';
                    } elseif ($patient['status'] == 'FINALIZADO') {

                        $badgeClass = 'dark';
                    }

                    ?>

                    <span class="custom-badge <?= $badgeClass ?>">

                        <?= esc($patient['status']) ?>

                    </span>

                </div>

                <div class="patient-meta">

                    <span>
                        <i class="bi bi-file-earmark-medical"></i>
                        Prontuário #<?= esc($patient['medical_record']) ?>
                    </span>

                    <span>
                        <i class="bi bi-heart-pulse"></i>
                        <?= esc($patient['specialty_name']) ?>
                    </span>

                    <span>
                        <i class="bi bi-calendar"></i>
                        <?= date('d/m/Y', strtotime($patient['accepted_at'])) ?>
                    </span>

                </div>

            </div>

        </div>

        <!-- ACTIONS -->

        <div class="d-flex gap-2 flex-wrap">

            <?php if ($patient['status'] == 'INTERNADO'): ?>

                <!-- VOLTAR -->

                <button
                    class="btn btn-warning btnReturnPatient"
                    data-id="<?= $patient['id'] ?>">

                    <i class="bi bi-arrow-counterclockwise me-2"></i>

                    Voltar para Atendimento

                </button>

            <?php elseif ($patient['status'] == 'FINALIZADO'): ?>

                <!-- APENAS PDF -->

            <?php else: ?>

                <!-- FINALIZAR -->

                <button
                    class="btn btn-success btn-lg rounded-4 px-4 shadow-sm btnFinalizePatient"
                    data-id="<?= $patient['id'] ?>">

                    <i class="bi bi-check-circle me-2"></i>

                    Finalizar

                </button>

                <!-- INTERNAÇÃO -->

                <button
                    class="btn btn-danger btn-lg rounded-4 px-4 shadow-sm btnHospitalizePatient"
                    data-id="<?= $patient['id'] ?>">

                    <i class="bi bi-hospital me-2"></i>

                    Internação

                </button>

            <?php endif; ?>

            <!-- PDF -->

            <a
                href="<?= base_url('patients/pdf/' . $patient['id']) ?>"
                target="_blank"
                class="btn btn-light btn-lg rounded-4 shadow-sm btnPdfPatient">

                <i class="bi bi-file-earmark-pdf"></i>

            </a>

        </div>
    </div>

</div>