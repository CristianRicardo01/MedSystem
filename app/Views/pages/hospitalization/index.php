<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <!-- HEADER -->

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4" data-aos="fade-down">

        <div>

            <h2 class="fw-bold mb-1">
                Internações
            </h2>

            <p class="text-muted mb-0">
                Lista de pacientes atualmente internados.
            </p>

        </div>

        <!-- STATUS -->

        <div class="d-flex gap-3 flex-wrap">

            <div class="hospital-counter">

                <span class="counter-icon">

                    <i class="bi bi-hospital"></i>

                </span>

                <div>

                    <strong>

                        <?= count($patients) ?>

                    </strong>

                    <small>
                        Internados
                    </small>

                </div>

            </div>

        </div>

    </div>

    <!-- TABLE -->

    <div class="table-container" data-aos="fade-up" data-aos-delay="200">

        <!-- HEADER TABLE -->

        <div class="table-header d-flex justify-content-between align-items-center flex-wrap gap-3">

            <div>

                <h5 class="fw-bold mb-1">
                    Pacientes Internados
                </h5>

                <small class="text-muted">
                    Controle hospitalar de internações
                </small>

            </div>

            <!-- SEARCH -->

            <div class="table-search">

                <i class="bi bi-search"></i>

                <input type="text"
                    placeholder="Pesquisar paciente...">

            </div>

        </div>

        <!-- TABLE -->

        <div class="table-responsive">

            <table class="table align-middle hospitalization-table">

                <thead>

                    <tr>

                        <th>Paciente</th>
                        <th>Prontuário</th>
                        <th>Data Internação</th>
                        <th>Observação</th>
                        <th width="160">Ações</th>

                    </tr>

                </thead>

                <tbody>
                    <?php if (!empty($patients)): ?>

                        <?php foreach ($patients as $patient): ?>
                            <tr>
                                <!-- PACIENTE -->

                                <td>

                                    <div class="d-flex align-items-center gap-3">

                                        <div class="patient-avatar">

                                            <?= strtoupper(substr($patient['name'], 0, 1)) ?>

                                        </div>

                                        <div>

                                            <strong>

                                                <?= esc($patient['name']) ?>

                                            </strong>

                                            <small class="d-block text-muted">

                                                <?= esc($patient['specialty_name']) ?>

                                            </small>

                                        </div>

                                    </div>

                                </td>

                                <!-- PRONTUARIO -->

                                <td>

                                    <span class="fw-semibold">

                                        #<?= esc($patient['medical_record']) ?>

                                    </span>

                                </td>

                                <!-- DATA -->

                                <td>

                                    <?= date('d/m/Y', strtotime($patient['hospitalized_at'])) ?>

                                </td>

                                <!-- OBSERVAÇÃO -->

                                <td>

                                    <span
                                        class="fw-semibold"
                                        title="<?= esc($patient['observation']) ?>">

                                        <?= esc(
                                            mb_strimwidth(
                                                $patient['observation'],
                                                0,
                                                50,
                                                '...'
                                            )
                                        ) ?>

                                    </span>

                                </td>
                                <!-- AÇÕES -->

                                <td>

                                    <div class="d-flex gap-2">

                                        <!-- VISUALIZAR -->

                                        <a href="<?= base_url('patients/show/' . $patient['id']) ?>" class="btn-action">

                                            <i class="bi bi-eye"></i>

                                        </a>

                                    </div>

                                </td>
                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="7"
                                class="text-center py-5 text-muted">

                                Nenhum paciente encontrado.

                            </td>

                        </tr>

                    <?php endif; ?>
                </tbody>

            </table>

        </div>

    </div>

</div>

<?= $this->endSection() ?>