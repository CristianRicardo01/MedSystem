<!-- TABLE -->
<div class="custom-table shadow-sm" data-aos="fade-up" data-aos-delay="500">

    <div class="p-4 border-bottom">
        <h5 class="mb-0 fw-bold">
            Últimos Atendimentos
        </h5>
    </div>

    <div class="table-responsive">

        <table class="table align-middle">

            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Status</th>
                    <th>Data Aceite</th>
                    <th>D60</th>
                    <th>Situação</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($lastAttendances)): ?>

                    <?php foreach ($lastAttendances as $patient) : ?>

                        <tr>

                            <!-- PACIENTE -->
                            <td>

                                <?= esc($patient['name']) ?>

                            </td>

                            <!-- STATUS -->
                            <td>

                                <?= esc($patient['status']) ?>

                            </td>

                            <!-- DATA ACEITE -->
                            <td>

                                <?= !empty($patient['accepted_at'])

                                    ? date(
                                        'd/m/Y',
                                        strtotime($patient['accepted_at'])
                                    )

                                    : '-' ?>

                            </td>

                            <!-- D60 -->
                            <td>

                                <?= !empty($patient['first_consultation_date'])

                                    ? date(
                                        'd/m/Y',
                                        strtotime($patient['first_consultation_date'])
                                    )

                                    : '-' ?>

                            </td>

                            <!-- SITUAÇÃO -->
                            <td>

                                <?php

                                $badge = 'secondary';

                                if ($patient['d60_status'] == 'DENTRO_PRAZO') {

                                    $badge = 'success';
                                } elseif ($patient['d60_status'] == 'FORA_PRAZO') {

                                    $badge = 'danger';
                                }

                                ?>
                                <?php

                                $status = $patient['d60_status'] ?? '';

                                if (empty($status)) {

                                    if ($patient['status'] == 'FINALIZADO') {

                                        $status = 'FINALIZADO';
                                    } else {

                                        $status = 'EM ANDAMENTO';
                                    }
                                }

                                ?>
                                <span class="badge bg-<?= $badge ?>">



                                    <?= $status ?>
                                </span>

                            </td>

                        </tr>

                    <?php endforeach; ?>
                <?php else: ?>

                    <tr>

                        <td colspan="5"
                            class="text-center py-5 text-muted">

                            Nenhum paciente encontrado.

                        </td>

                    </tr>

                <?php endif; ?>
            </tbody>

        </table>

    </div>

</div>