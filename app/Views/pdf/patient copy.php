<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">

    <title>
        Ficha do Paciente
    </title>

    <style>
        body {

            font-family: DejaVu Sans;

            font-size: 12px;

            color: #333;

        }

        .header {

            border-bottom: 2px solid #4A90E2;

            padding-bottom: 15px;

            margin-bottom: 20px;

        }

        .title {

            font-size: 22px;

            font-weight: bold;

            color: #4A90E2;

        }

        .section {

            margin-bottom: 25px;

        }

        .section h3 {

            background: #f5f5f5;

            padding: 10px;

            border-left: 4px solid #4A90E2;

        }

        table {

            width: 100%;

            border-collapse: collapse;

        }

        table th,
        table td {

            border: 1px solid #ddd;

            padding: 8px;

        }

        table th {

            background: #f5f5f5;

        }
    </style>

</head>

<body>

    <!-- HEADER -->

    <div class="header">

        <div class="title">

            Ficha do Paciente

        </div>

        <small>

            Emitido em:
            <?= date('d/m/Y H:i') ?>

        </small>

    </div>

    <!-- PATIENT -->

    <div class="section">

        <h3>
            Dados do Paciente
        </h3>

        <table>

            <tr>

                <th>Nome</th>

                <td>
                    <?= esc($patient['name']) ?>
                </td>

            </tr>

            <tr>

                <th>CPF</th>

                <td>
                    <?= esc($patient['cpf']) ?>
                </td>

            </tr>

            <tr>

                <th>Especialidade</th>

                <td>
                    <?= esc($patient['specialty_name']) ?>
                </td>

            </tr>

        </table>

    </div>
</body>