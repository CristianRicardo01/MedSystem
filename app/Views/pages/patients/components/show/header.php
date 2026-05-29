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

                    <span class="custom-badge success">
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

            <!-- FINALIZAR -->

            <button class="btn btn-success btn-lg rounded-4 px-4 shadow-sm">

                <i class="bi bi-check-circle me-2"></i>

                Finalizar

            </button>

            <!-- INTERNAÇÃO -->

            <button class="btn btn-danger btn-lg rounded-4 px-4 shadow-sm">

                <i class="bi bi-hospital me-2"></i>

                Internação

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