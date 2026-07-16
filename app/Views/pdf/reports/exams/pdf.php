<!DOCTYPE html>

<html lang="pt-br">
<!-- favicon -->
<link rel="icon" type="image/png" href="<?= base_url('assets/img/favicon.png') ?>">

<head>

    <meta charset="UTF-8">

    <title><?= esc($title) ?></title>

    <style>
        <?= view('pdf/reports/components/styles'); ?>
    </style>

</head>

<body>

    <?= view('pdf/reports/components/header'); ?>

    <!-- MOSTRAR FILTROS UTILIZADOS NO PDF -->
    <!-- <1?php if (
        !empty($filters['status']) ||
        !empty($filters['request_type']) ||
        !empty($filters['start_date']) ||
        !empty($filters['end_date'])
    ): ?>

        <div class="section">

            <div class="section-title">
                Filtros Utilizados
            </div>

            <table>

                <tr>

                    <td><strong>Status:</strong></td>

                    <td><?= $filters['status'] ?: 'Todos' ?></td>

                    <td><strong>Exame:</strong></td>

                    <td><?= $filters['request_type_name'] ?? 'Todos' ?></td>

                </tr>

                <tr>

                    <td><strong>Período:</strong></td>

                    <td colspan="3">

                        <?= $filters['start_date'] ?: '--' ?>

                        até

                        <?= $filters['end_date'] ?: '--' ?>

                    </td>

                </tr>

            </table>

        </div>

    <1?php endif; ?> -->

    <div class="section">

        <div class="section-title">

            Exames

        </div>

        <table>

            <thead>

                <tr>

                    <th>Paciente</th>

                    <th>Exame</th>

                    <th>Status</th>

                    <th>Solicitado em</th>

                </tr>

            </thead>

            <tbody>

                <?php if (!empty($table)): ?>

                    <?php foreach ($table as $row): ?>

                        <tr>

                            <td><?= esc($row['patient_name']) ?></td>

                            <td><?= esc($row['request_name']) ?></td>

                            <td><?= esc($row['request_status']) ?></td>

                            <td><?= date('d/m/Y', strtotime($row['requested_at'])) ?></td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td colspan="4" style="text-align:center">

                            Nenhum exame encontrado.

                        </td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

    <?= view('pdf/reports/components/footer'); ?>

</body>

</html>