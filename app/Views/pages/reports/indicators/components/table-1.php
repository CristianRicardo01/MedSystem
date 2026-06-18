<div class="page-title mb-4" data-aos="fade-right" data-aos-delay="100">
    <h2>Tabela D60 Vencido</h2>
</div>

<div class="card border-0 shadow-sm rounded-4 mb-4" data-aos="fade-up" data-aos-delay="200">

    <div class="card-header bg-white">

        <h5 class="fw-bold mb-0">

            <i class="bi bi-exclamation-triangle text-danger me-2"></i>

            D60 Vencidos

        </h5>

    </div>

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover mb-0">

                <thead>

                    <tr>

                        <th>Paciente</th>

                        <th>Status</th>

                        <th>Dias Atraso</th>

                        <th>Ação</th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($d60ExpiredPatients as $patient) : ?>

                        <tr>

                            <td>

                                <?= $patient['name'] ?>

                            </td>

                            <td>

                                <?= $patient['status'] ?>

                            </td>

                            <td>

                                <span class="badge bg-danger">

                                    <?= $patient['days_overdue'] ?> dias

                                </span>

                            </td>

                            <td>

                                <a
                                    href="<?= $patient['flow_type'] == 'TRIAGE'
                                                ? base_url('triage/show/' . $patient['id'])
                                                : base_url('patients/show/' . $patient['id']) ?>"
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