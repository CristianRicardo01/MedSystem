<div class="page-title mb-4" data-aos="fade-right" data-aos-delay="200">
    <h2>Tabela Exames Atrasados</h2>
</div>

<div class="card border-0 shadow-sm rounded-4 mb-4" data-aos="fade-up" data-aos-delay="300">

    <div class="card-header bg-white">

        <h5 class="fw-bold mb-0">

            <i class="bi bi-file-earmark-medical text-danger me-2"></i>

            Exames Atrasados

        </h5>

    </div>

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover mb-0">

                <thead>

                    <tr>

                        <th>Paciente</th>

                        <th>Exame</th>

                        <th>Atraso</th>

                        <th>Ação</th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($expiredRequestsList as $request) : ?>

                        <tr>

                            <td>

                                <?= $request['patient_name'] ?>

                            </td>

                            <td>

                                <?= $request['request_name'] ?>

                            </td>

                            <td>

                                <span class="badge bg-danger">

                                    <?= $request['days_overdue'] ?> dias

                                </span>

                            </td>

                            <td>

                                <a
                                    href="<?= $request['flow_type'] == 'TRIAGE'
                                                ? base_url('triage/show/' . $request['patient_id'])
                                                : base_url('patients/show/' . $request['patient_id']) ?>"
                                    class="btn btn-sm btn-outline-primary">

                                    Ver

                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>