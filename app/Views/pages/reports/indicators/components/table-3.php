<div class="page-title mb-4" data-aos="fade-right" data-aos-delay="300">
    <h2>Tabela Próximos Vencimentos</h2>
</div>

<div class="card border-0 shadow-sm rounded-4 mb-4"data-aos="fade-up" data-aos-delay="400">

    <div class="card-header bg-white">

        <h5 class="fw-bold mb-0">

            <i class="bi bi-clock-history text-warning me-2"></i>

            Próximos Vencimentos

        </h5>

    </div>

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th>Paciente</th>

                        <th>Tipo</th>

                        <th>Descrição</th>

                        <th>Vence em</th>

                        <th width="120">
                            Ação
                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php if (empty($upcomingDeadlines)) : ?>

                        <tr>

                            <td
                                colspan="5"
                                class="text-center py-4 text-muted">

                                Nenhum vencimento próximo encontrado.

                            </td>

                        </tr>

                    <?php endif; ?>

                    <?php foreach ($upcomingDeadlines as $item) : ?>

                        <tr>

                            <td>

                                <strong>

                                    <?= esc($item['patient_name']) ?>

                                </strong>

                            </td>

                            <td>

                                <?php if ($item['type'] == 'D60') : ?>

                                    <span class="badge bg-warning text-dark">

                                        D60

                                    </span>

                                <?php else : ?>

                                    <span class="badge bg-info">

                                        EXAME

                                    </span>

                                <?php endif; ?>

                            </td>

                            <td>

                                <?= esc($item['description']) ?>

                            </td>

                            <td>

                                <span class="badge bg-secondary">

                                    <?= $item['days_remaining'] ?>

                                    dia(s)

                                </span>

                            </td>

                            <td>

                                <a
                                    href="<?= $item['flow_type'] == 'TRIAGE'
                                                ? base_url(
                                                    'triage/show/' . $item['patient_id']
                                                )
                                                : base_url(
                                                    'patients/show/' . $item['patient_id']
                                                ) ?>"
                                    class="btn btn-sm btn-outline-primary rounded-3">

                                    <i class="bi bi-eye"></i>

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