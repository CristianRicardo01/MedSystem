<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <!-- HEADER -->

    <div class="patient-header mb-4"
        data-aos="fade-down">

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

            <!-- LEFT -->

            <div class="d-flex align-items-center gap-4">

                <!-- AVATAR -->

                <div class="patient-photo">

                    M

                </div>

                <!-- INFO -->

                <div>

                    <div class="d-flex align-items-center gap-3 flex-wrap mb-2">

                        <h2 class="fw-bold mb-0">
                            Maria Silva
                        </h2>

                        <span class="custom-badge warning">

                            Em Triagem

                        </span>

                    </div>

                    <div class="patient-meta">

                        <span>

                            <i class="bi bi-file-earmark-medical"></i>

                            Prontuário #0000000

                        </span>

                        <span>

                            <i class="bi bi-heart-pulse"></i>

                            Cardiologia

                        </span>

                        <span>

                            <i class="bi bi-calendar"></i>

                            01/05/2026

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

    <!-- GRID -->

    <div class="row g-4">

        <!-- LEFT -->

        <div class="col-lg-8">

            <div class="row g-4">

                <!-- DADOS -->

                <div class="col-md-6"
                    data-aos="fade-up">

                    <div class="card card-modern border-0 h-100">

                        <div class="card-body p-4">

                            <div class="card-title-modern">

                                <div class="icon-box blue">

                                    <i class="bi bi-person"></i>

                                </div>

                                <div>

                                    <h5 class="fw-bold mb-0">
                                        Dados Paciente
                                    </h5>

                                    <small class="text-muted">
                                        Informações cadastrais
                                    </small>

                                </div>

                            </div>

                            <div class="info-list mt-4">

                                <div class="info-item">

                                    <small>CPF</small>

                                    <strong>
                                        000.000.000-00
                                    </strong>

                                </div>

                                <div class="info-item">

                                    <small>Telefone</small>

                                    <strong>
                                        (69) 99999-9999
                                    </strong>

                                </div>

                                <div class="info-item">

                                    <small>Nascimento</small>

                                    <strong>
                                        01/01/1990
                                    </strong>

                                </div>

                                <div class="info-item">

                                    <small>Município</small>

                                    <strong>
                                        Porto Velho - RO
                                    </strong>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- STATUS -->

                <div class="col-md-6"
                    data-aos="fade-up"
                    data-aos-delay="100">

                    <div class="card card-modern border-0 h-100">

                        <div class="card-body p-4">

                            <div class="card-title-modern">

                                <div class="icon-box orange">

                                    <i class="bi bi-clipboard2-pulse"></i>

                                </div>

                                <div>

                                    <h5 class="fw-bold mb-0">
                                        Status Triagem
                                    </h5>

                                    <small class="text-muted">
                                        Controle do processo
                                    </small>

                                </div>

                            </div>

                            <div class="exam-status mt-4">

                                <div class="status-row">

                                    <span>
                                        Exames Prontos
                                    </span>

                                    <span class="custom-badge success">

                                        SIM

                                    </span>

                                </div>

                                <div class="status-row">

                                    <span>
                                        Exames Prévios
                                    </span>

                                    <span class="custom-badge danger">

                                        NÃO

                                    </span>

                                </div>

                                <div class="status-row">

                                    <span>
                                        Processo
                                    </span>

                                    <span class="custom-badge warning">

                                        Em Análise

                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- OBSERVAÇÕES -->

                <div class="col-12"
                    data-aos="fade-up"
                    data-aos-delay="200">

                    <div class="card card-modern border-0">

                        <div class="card-body p-4">

                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

                                <div class="card-title-modern">

                                    <div class="icon-box primary">

                                        <i class="bi bi-chat-left-text"></i>

                                    </div>

                                    <div>

                                        <h5 class="fw-bold mb-0">
                                            Observações
                                        </h5>

                                        <small class="text-muted">
                                            Informações da triagem
                                        </small>

                                    </div>

                                </div>

                            </div>

                            <div class="observation-box">

                                <p class="text-muted mb-0">

                                    Paciente aguardando análise documental
                                    para transferência ao fluxo principal.

                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- RIGHT -->

        <div class="col-lg-4"
            data-aos="fade-left">

            <div class="card card-modern border-0 h-100">

                <div class="card-body p-4">

                    <div class="card-title-modern mb-4">

                        <div class="icon-box primary">

                            <i class="bi bi-clock-history"></i>

                        </div>

                        <div>

                            <h5 class="fw-bold mb-0">
                                Timeline
                            </h5>

                            <small class="text-muted">
                                Histórico da triagem
                            </small>

                        </div>

                    </div>

                    <!-- TIMELINE -->

                    <div class="timeline-modern">

                        <div class="timeline-item success">

                            <div class="timeline-dot"></div>

                            <div>

                                <strong>
                                    Cadastro Realizado
                                </strong>

                                <p class="text-muted mb-0">
                                    01/05/2026 - 08:30
                                </p>

                            </div>

                        </div>

                        <div class="timeline-item warning">

                            <div class="timeline-dot"></div>

                            <div>

                                <strong>
                                    Exames Enviados
                                </strong>

                                <p class="text-muted mb-0">
                                    05/05/2026 - 11:00
                                </p>

                            </div>

                        </div>

                        <div class="timeline-item primary">

                            <div class="timeline-dot"></div>

                            <div>

                                <strong>
                                    Em Análise
                                </strong>

                                <p class="text-muted mb-0">
                                    10/05/2026 - 15:42
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>