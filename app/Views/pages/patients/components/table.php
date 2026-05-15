<div class="table-container"
    data-aos="fade-up"
    data-aos-delay="400">

    <div class="table-header d-flex justify-content-between align-items-center">

        <div>

            <h5 class="fw-bold mb-1">
                Lista de Pacientes
            </h5>

            <small class="text-muted">
                Gerenciamento dos pacientes cadastrados
            </small>

        </div>

        <div>

            <button class="btn btn-light">

                <i class="bi bi-funnel"></i>

            </button>

        </div>

    </div>

    <div class="table-responsive">

        <table class="table align-middle patient-table">

            <thead>

                <tr>

                    <th>Paciente</th>
                    <th>Prontuário</th>
                    <th>Data</th>
                    <th>Exames</th>
                    <th>60D</th>
                    <th>Status</th>
                    <th width="140">Ações</th>

                </tr>

            </thead>

            <tbody>

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

                        01/01/2026

                    </td>

                    <!-- EXAMES -->

                    <td>

                        <span class="custom-badge success">

                            SIM

                        </span>

                    </td>

                    <!-- 60D -->

                    <td>

                        <span class="custom-badge warning">

                            35 Dias

                        </span>

                    </td>

                    <!-- STATUS -->

                    <td>

                        <span class="custom-badge success">

                            Finalizado

                        </span>

                    </td>

                    <!-- AÇÕES -->



                    <td>

                        <div class="d-flex gap-2">

                            <button class="btn-action">

                                <i class="bi bi-pencil"></i>

                            </button>

                            <a href="<?= base_url('patients/show/1') ?>"
                                class="btn-action">

                                <i class="bi bi-eye"></i>

                            </a>

                        </div>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>