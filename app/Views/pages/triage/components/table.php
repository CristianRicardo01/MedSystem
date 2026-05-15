<!-- TABLE -->

<div class="table-container"
    data-aos="fade-up"
    data-aos-delay="300">

    <!-- HEADER -->

    <div class="table-header d-flex justify-content-between align-items-center flex-wrap gap-3">

        <div>

            <h5 class="fw-bold mb-1">
                Pacientes em Triagem
            </h5>

            <small class="text-muted">
                Controle dos atendimentos em andamento
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

        <table class="table align-middle triage-table">

            <thead>

                <tr>

                    <th>Paciente</th>
                    <th>Prontuário</th>
                    <th>Atendimento</th>
                    <th>Consulta</th>
                    <th>Prazo</th>
                    <th>Status</th>
                    <th width="120">Ações</th>

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

                        #000001

                    </td>

                    <!-- ATENDIMENTO -->

                    <td>

                        01/05/2026

                    </td>

                    <!-- CONSULTA -->

                    <td>

                        15/05/2026

                    </td>

                    <!-- PRAZO -->

                    <td>

                        <span class="custom-badge warning">

                            5 Dias

                        </span>

                    </td>

                    <!-- STATUS -->

                    <td>

                        <span class="custom-badge primary">

                            Em Andamento

                        </span>

                    </td>

                    <!-- ACTIONS -->

                    <td>

                        <a href="<?= base_url('triage/show/1') ?>"
                            class="btn-action">

                            <i class="bi bi-eye"></i>

                        </a>

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

                        #000002

                    </td>

                    <td>

                        01/05/2026

                    </td>

                    <td>

                        20/05/2026

                    </td>

                    <td>

                        <span class="custom-badge success">

                            15 Dias

                        </span>

                    </td>

                    <td>

                        <span class="custom-badge warning">

                            Aguardando Exames

                        </span>

                    </td>

                    <td>

                        <a href="<?= base_url('patients/show/1') ?>"
                            class="btn-action">

                            <i class="bi bi-eye"></i>

                        </a>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>