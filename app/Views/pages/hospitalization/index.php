<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <!-- HEADER -->

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4"
        data-aos="fade-down">

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
                        12
                    </strong>

                    <small>
                        Internados
                    </small>

                </div>

            </div>

        </div>

    </div>

    <!-- TABLE -->

    <div class="table-container"
        data-aos="fade-up"
        data-aos-delay="200">

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

                    <!-- ITEM -->

                    <tr>

                        <!-- PACIENTE -->

                        <td>

                            <div class="d-flex align-items-center gap-3">

                                <div class="patient-avatar">

                                    M

                                </div>

                                <div>

                                    <strong>
                                        Maria Silva
                                    </strong>

                                    <small class="d-block text-muted">
                                        Cardiologia
                                    </small>

                                </div>

                            </div>

                        </td>

                        <!-- PRONTUARIO -->

                        <td>

                            <span class="fw-semibold">
                                #0000000
                            </span>

                        </td>

                        <!-- DATA -->

                        <td>

                            14/05/2026

                        </td>

                        <!-- OBSERVAÇÃO -->

                        <td>

                            <span class="text-muted">

                                Paciente em observação clínica.

                            </span>

                        </td>

                        <!-- ACTIONS -->

                        <td>

                            <div class="d-flex gap-2">

                                <!-- SHOW -->

                                <a href="<?= base_url('patients/show/1') ?>"
                                    class="btn-action">

                                    <i class="bi bi-eye"></i>

                                </a>

                                <!-- REMOVER -->

                                <button class="btn-action btn-action-danger">

                                    <i class="bi bi-hospital"></i>

                                </button>

                            </div>

                        </td>

                    </tr>

                    <!-- ITEM -->

                    <tr>

                        <td>

                            <div class="d-flex align-items-center gap-3">

                                <div class="patient-avatar">

                                    J

                                </div>

                                <div>

                                    <strong>
                                        João Pedro
                                    </strong>

                                    <small class="d-block text-muted">
                                        Neurologia
                                    </small>

                                </div>

                            </div>

                        </td>

                        <td>

                            <span class="fw-semibold">
                                #0000001
                            </span>

                        </td>

                        <td>

                            13/05/2026

                        </td>

                        <td>

                            <span class="text-muted">

                                Aguardando avaliação médica.

                            </span>

                        </td>

                        <td>

                            <div class="d-flex gap-2">

                                <!-- SHOW -->

                                <a href="<?= base_url('patients/show/1') ?>"
                                    class="btn-action">

                                    <i class="bi bi-eye"></i>

                                </a>

                                <!-- REMOVER -->

                                <button class="btn-action btn-action-danger">

                                    <i class="bi bi-hospital"></i>

                                </button>

                            </div>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?= $this->endSection() ?>