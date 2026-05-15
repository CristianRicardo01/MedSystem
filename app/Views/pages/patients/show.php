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

                        <span class="custom-badge success">
                            Finalizado
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

                            01/01/2026

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

    <!-- GRID -->

    <div class="row g-4">

        <!-- LEFT -->

        <div class="col-lg-8">

            <div class="row g-4">

                <!-- DADOS -->

                <div class="col-md-6"
                    data-aos="fade-up"
                    data-aos-delay="100">

                    <div class="card card-modern border-0 h-100">

                        <div class="card-body p-4">

                            <div class="card-title-modern">

                                <div class="icon-box blue">

                                    <i class="bi bi-person"></i>

                                </div>

                                <div>

                                    <h5 class="fw-bold mb-0">
                                        Dados do Paciente
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

                <!-- EXAMES -->

                <div class="col-md-6"
                    data-aos="fade-up"
                    data-aos-delay="200">

                    <div class="card card-modern border-0 h-100">

                        <div class="card-body p-4">

                            <div class="card-title-modern">

                                <div class="icon-box green">

                                    <i class="bi bi-clipboard2-pulse"></i>

                                </div>

                                <div>

                                    <h5 class="fw-bold mb-0">
                                        Exames
                                    </h5>

                                    <small class="text-muted">
                                        Situação dos exames
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
                                        Processo
                                    </span>

                                    <span class="custom-badge warning">

                                        35 Dias

                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- OBSERVAÇÕES -->

                <div class="col-12"
                    data-aos="fade-up"
                    data-aos-delay="300">

                    <div class="card card-modern border-0">

                        <div class="card-body p-4">

                            <!-- HEADER -->

                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

                                <div class="card-title-modern">

                                    <div class="icon-box orange">

                                        <i class="bi bi-chat-left-text"></i>

                                    </div>

                                    <div>

                                        <h5 class="fw-bold mb-0">
                                            Observações
                                        </h5>

                                        <small class="text-muted">
                                            Informações adicionais do paciente
                                        </small>

                                    </div>

                                </div>

                                <!-- BTN -->

                                <button class="btn btn-primary rounded-4 px-4"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalObservation">

                                    <i class="bi bi-plus-circle me-2"></i>

                                    Nova Observação

                                </button>

                            </div>

                            <!-- OBSERVAÇÃO -->

                            <div class="observation-box">

                                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">

                                    <strong>
                                        Recepção
                                    </strong>

                                    <small class="text-muted">
                                        14/05/2026 - 10:42
                                    </small>

                                </div>

                                <p class="text-muted mb-0">

                                    Paciente aguardando liberação final dos documentos
                                    para encerramento do processo.

                                </p>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- SOLICITAÇÕES -->

                <div class="col-12"
                    data-aos="fade-up"
                    data-aos-delay="400">

                    <div class="card card-modern border-0">

                        <div class="card-body p-4">

                            <!-- HEADER -->

                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

                                <div class="card-title-modern">

                                    <div class="icon-box primary">

                                        <i class="bi bi-clipboard-data"></i>

                                    </div>

                                    <div>

                                        <h5 class="fw-bold mb-0">
                                            Solicitações
                                        </h5>

                                        <small class="text-muted">
                                            Histórico de atendimentos do paciente
                                        </small>

                                    </div>

                                </div>

                                <!-- BTN -->

                                <button class="btn btn-primary rounded-4 px-4">

                                    <i class="bi bi-plus-circle me-2"></i>

                                    Nova Solicitação

                                </button>

                            </div>

                            <!-- TABLE -->

                            <div class="table-responsive">

                                <table class="table align-middle patient-request-table">

                                    <thead>

                                        <tr>

                                            <th>Solicitação</th>
                                            <th>Especialidade</th>
                                            <th>Data</th>
                                            <th>Status</th>
                                            <th>D60</th>
                                            <th>Alerta</th>
                                            <th width="120">Ações</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <!-- ITEM -->

                                        <tr>

                                            <td>

                                                Primeira Consulta

                                            </td>

                                            <td>

                                                Cardiologia

                                            </td>

                                            <td>

                                                14/05/2026

                                            </td>

                                            <td>

                                                <span class="custom-badge success">

                                                    Finalizado

                                                </span>

                                            </td>
                                            <td>

                                                <span class="custom-badge warning">
                                                    25

                                                </span>

                                            </td>
                                            <td>

                                                <span class="custom-badge warning">


                                                    alerta
                                                </span>

                                            </td>

                                            <td>

                                                <div class="d-flex gap-2">

                                                    <button class="btn-action">

                                                        <i class="bi bi-eye"></i>

                                                    </button>

                                                </div>

                                            </td>

                                        </tr>

                                        <!-- ITEM -->

                                        <tr>

                                            <td>

                                                Solicitação de Exames

                                            </td>

                                            <td>

                                                Neurologia

                                            </td>

                                            <td>

                                                10/05/2026

                                            </td>
                                            <td>

                                                <span class="custom-badge warning">

                                                    Em andamento

                                                </span>

                                            </td>
                                            <td>

                                                <span class="custom-badge warning">
                                                    25

                                                </span>

                                            </td>
                                            <td>

                                                <span class="custom-badge warning">


                                                    alerta
                                                </span>

                                            </td>


                                            <td>

                                                <div class="d-flex gap-2">

                                                    <button class="btn-action">

                                                        <i class="bi bi-eye"></i>

                                                    </button>

                                                </div>

                                            </td>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- MODAL OBSERVAÇÃO -->

                <div class="modal fade"
                    id="modalObservation"
                    tabindex="-1"
                    aria-hidden="true">

                    <div class="modal-dialog modal-dialog-centered">

                        <div class="modal-content border-0 rounded-4">

                            <!-- HEADER -->

                            <div class="modal-header border-0 p-4">

                                <div>

                                    <h4 class="fw-bold mb-1">
                                        Nova Observação
                                    </h4>

                                    <p class="text-muted mb-0">
                                        Adicione uma observação ao prontuário.
                                    </p>

                                </div>

                                <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal">
                                </button>

                            </div>

                            <!-- FORM -->

                            <form>

                                <div class="modal-body px-4">

                                    <div class="mb-4">

                                        <label class="form-label">
                                            Observação
                                        </label>

                                        <textarea class="form-control"
                                            rows="6"
                                            placeholder="Digite a observação..."></textarea>

                                    </div>

                                </div>

                                <!-- FOOTER -->

                                <div class="modal-footer border-0 p-4">

                                    <button type="button"
                                        class="btn btn-light btn-lg rounded-4"
                                        data-bs-dismiss="modal">

                                        Cancelar

                                    </button>

                                    <button type="submit"
                                        class="btn btn-primary btn-lg rounded-4 px-4">

                                        <i class="bi bi-check-circle me-2"></i>

                                        Salvar

                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- RIGHT -->

        <div class="col-lg-4"
            data-aos="fade-left"
            data-aos-delay="400">

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
                                Histórico do processo
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
                                    01/03/2026 - D5
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
                                    05/03/2026 - D7
                                </p>

                            </div>

                        </div>

                        <div class="timeline-item primary">

                            <div class="timeline-dot"></div>

                            <div>

                                <strong>
                                    Processo Finalizado
                                </strong>

                                <p class="text-muted mb-0">
                                    10/03/2026 - D10
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