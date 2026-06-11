<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <title><?= $title ?? 'Pontuário ERP Hospitalar' ?></title>
    <!-- favicon -->
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/favicon.png') ?>">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {

            background: #fff;

            padding: 25px;

            color: #1e293b;

        }

        .document {
            background: #fff;
            border-radius: 10px;
            padding: 40px;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
        }

        /* 
            =========================
            HEADER
            ========================= 
        */

        .header {

            display: flex;

            justify-content: space-between;

            align-items: center;

            border-bottom: 3px solid #2563eb;

            padding-bottom: 25px;

            margin-bottom: 35px;

        }

        .header-left {

            display: flex;

            align-items: center;

            gap: 20px;

        }

        .logo {

            width: auto;

            height: 85px;

            object-fit: contain;

        }

        .hospital-info h1 {

            font-size: 24px;

            color: #0f172a;

            margin-bottom: 6px;

            letter-spacing: 1px;

        }

        .hospital-info p {

            font-size: 14px;

            color: #475569;

            margin-bottom: 4px;

        }

        .hospital-info small {

            color: #94a3b8;

            font-size: 12px;

        }

        .document-info {

            text-align: right;

        }

        .doc-badge {

            display: inline-block;

            background: #2563eb;

            color: white;

            padding: 8px 14px;

            border-radius: 8px;

            font-size: 11px;

            font-weight: bold;

            margin-bottom: 10px;

        }

        .document-info p {

            font-size: 12px;

            color: #64748b;

        }

        /* 
            =========================
                PATIENT DOCUMENT
            ========================= 
        */

        .patient-document {

            display: flex;

            justify-content: space-between;

            gap: 60px;

            margin-top: 15px;

        }

        /* COLUMN */

        .patient-column {

            width: 48%;

        }

        /* TEXT */

        .patient-column p {

            font-size: 13px;

            color: #0f172a;

            margin-bottom: 10px;

            line-height: 1.6;

        }

        /* LABEL */

        .patient-column strong {

            color: #0f172a;

            font-weight: bold;

        }

        /* SECTION */

        .patient-layout {

            width: 100%;

            border-collapse: collapse;

        }

        .patient-layout td {

            vertical-align: top;

            width: 50%;

        }

        .patient-side {

            padding-right: 30px;

        }

        .section {
            margin-bottom: 35px;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #0f172a;
            border-left: 5px solid #2563eb;
            padding-left: 12px;
        }

        /* GRID */

        .grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .info-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 15px;
        }

        .info-label {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 15px;
            font-weight: 600;
            color: #0f172a;
        }

        /* TABLE */

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead {
            background: #f1f5f9;
        }

        table th {
            padding: 14px;
            text-align: left;
            font-size: 14px;
            color: #334155;
        }

        table td {
            padding: 14px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 14px;
        }

        /* OBS */

        .observation {

            background: #ffffff;

            border: 1px solid #e2e8f0;

            border-left: 4px solid #2563eb;

            border-radius: 10px;

            padding: 10px;

            margin-bottom: 15px;

            color: #334155;

            line-height: 1;

            font-size: 14px;

        }

        /* TIMELINE */

        .timeline {
            position: relative;
            margin-top: 10px;
        }

        .timeline-item {

            margin-bottom: 20px;

        }


        .timeline-content {
            background: #f8fafc;
            border-radius: 12px;
            padding: 15px;
            border: 1px solid #e2e8f0;
        }

        .timeline-date {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 6px;
        }

        .timeline-text {
            font-size: 14px;
            font-weight: 600;
        }
    </style>

</head>

<body>

    <div class="">

        <!-- HEADER -->

        <div class="header">

            <!-- LEFT -->

            <div class="header-left">

                <img src="<?= base_url('assets/img/logo.jpeg') ?>" class="logo">

                <div class="hospital-info">

                    <h1>

                        <!-- HOSPITAL MEDSYSTEM -->

                    </h1>

                    <p>

                        Central de Triagem e Regulação Hospitalar

                    </p>

                    <small>

                        Prontuário Operacional Hospitalar
                        
                    </small>

                </div>

            </div>

            <!-- RIGHT -->

            <div class="document-info">

                <div class="doc-badge">

                    ERP HOSPITALAR

                </div>

                <p>

                    Emitido em:
                    <?= date('d/m/Y H:i') ?>

                </p>

            </div>

        </div>

        <!-- PACIENTE -->

        <div class="section">

            <div class="section-title">

                Identificação do Paciente

            </div>
            <div class="patient-document">

                <table class="patient-layout">

                    <tr>

                        <!-- LEFT -->

                        <td class="patient-side">

                            <p>

                                <strong>
                                    Nome:
                                </strong>

                                <?= esc($patient['name']) ?>

                            </p>

                            <p>

                                <strong>
                                    Prontuário:
                                </strong>

                                <?= esc($patient['medical_record']) ?>

                            </p>

                            <p>

                                <strong>
                                    CPF:
                                </strong>

                                <?php if (isset($patient['cpf']) && !empty($patient['cpf'])): ?>

                                    <?= esc($patient['cpf']) ?>

                                <?php else: ?>

                                    Não informado
                                <?php endif; ?>

                            </p>

                            <p>

                                <strong>
                                    Telefone:
                                </strong>

                                <?php if (isset($patient['phone']) && !empty($patient['phone'])): ?>

                                    <?= esc($patient['phone']) ?>

                                <?php else: ?>

                                    N/A

                                <?php endif; ?>
                            </p>

                        </td>

                        <!-- RIGHT -->

                        <td class="patient-side">

                            <p>

                                <strong>
                                    Especialidade:
                                </strong>

                                <?= esc($patient['specialty_name']) ?>

                            </p>

                            <p>

                                <strong>
                                    Status:
                                </strong>

                                <?= esc($patient['status']) ?>

                            </p>

                            <p>

                                <strong>
                                    Atendimento:
                                </strong>

                                <?= date(
                                    'd/m/Y',
                                    strtotime(
                                        $patient['first_service_date']
                                    )
                                ) ?>

                            </p>

                            <p>

                                <strong>
                                    Consulta:
                                </strong>

                                <?= date(
                                    'd/m/Y',
                                    strtotime(
                                        $patient['first_consultation_date']
                                    )
                                ) ?>

                            </p>

                        </td>

                    </tr>

                </table>

            </div>

        </div>

        <!-- SOLICITAÇÕES -->
        <div class="section">

            <div class="section-title">
                Solicitações
            </div>

            <table>

                <thead>

                    <tr>
                        <th>Solicitação</th>
                        <th>Data</th>
                        <th>Status</th>
                        <th>Prazo</th>
                    </tr>

                </thead>

                <tbody>

                    <?php if (!empty($patientRequests)): ?>

                        <?php foreach ($patientRequests as $request): ?>

                            <tr>

                                <td>
                                    <?= esc($request['request_type_name']) ?>
                                </td>

                                <td>
                                    <?= date('d/m/Y', strtotime($request['created_at'])) ?>
                                </td>

                                <td>
                                    <?php

                                    $statusClass = '#f59e0b';

                                    if (
                                        $request['request_status']
                                        == 'COMPLETED'
                                    ) {

                                        $statusClass = '#16a34a';
                                    }

                                    ?>

                                    <span style="
                                            background: <?= $statusClass ?>;
                                            color: #fff;
                                            padding: 6px 10px;
                                            border-radius: 6px;
                                            font-size: 12px;
                                            font-weight: bold;
                                        ">

                                        <?= esc($request['request_status']) ?>

                                    </span>
                                </td>

                                <td>
                                    <?= esc($request['deadline_days']) ?> dias
                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="4" style="text-align:center;">

                                Nenhuma solicitação encontrada.

                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

        <!-- OBSERVAÇÕES -->
        <div class="section">

            <div class="section-title">
                Observações
            </div>

            <?php if (!empty($observations)): ?>

                <?php foreach ($observations as $observation): ?>

                    <div class="observation" style="margin-bottom:15px;">

                        <strong>

                            <?= date(
                                'd/m/Y H:i',
                                strtotime($observation['created_at'])
                            ) ?>

                        </strong>

                        <br><br>

                        <?= nl2br(
                            esc($observation['observation'])
                        ) ?>

                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <div class="observation">

                    Nenhuma observação encontrada.

                </div>

            <?php endif; ?>

        </div>

        <!-- TIMELINE -->
        <div class="section">

            <div class="section-title">
                Timeline do Atendimento
            </div>

            <div class="timeline">

                <?php if (!empty($timeline)): ?>

                    <?php foreach ($timeline as $item): ?>

                        <div class="timeline-item">

                            <div class="timeline-content">

                                <div class="timeline-date">

                                    <?= date(
                                        'd/m/Y H:i',
                                        strtotime($item['created_at'])
                                    ) ?>

                                </div>

                                <div class="timeline-text" style="font-size:12px;">

                                    <?php if (!empty($item['new_status'])): ?>

                                        <?= esc($item['new_status']) ?>

                                    <?php else: ?>

                                        Atualização de Status

                                    <?php endif; ?>

                                </div>

                                <?php if (!empty($item['observation'])): ?>

                                    <div style="
                                margin-top:8px;
                                font-size:14px;
                                color:#64748b;
                                line-height:1;
                            ">

                                        <?= nl2br(
                                            esc($item['observation'])
                                        ) ?>

                                    </div>

                                <?php endif; ?>

                            </div>

                        </div>

                    <?php endforeach; ?>

                <?php else: ?>

                    <div class="timeline-item">

                        <div class="timeline-content">

                            Nenhum histórico encontrado.

                        </div>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    </div>

</body>

</html>