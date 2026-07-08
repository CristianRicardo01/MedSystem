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

        <div class="d-flex gap-2">

            <form method="GET">

                <input
                    type="text"
                    name="search"
                    value="<?= esc($search ?? '') ?>"
                    class="form-control"
                    placeholder="Pesquisar paciente...">

            </form>

            <button
                class="btn btn-light"
                data-bs-toggle="collapse"
                data-bs-target="#patientFilters">

                <i class="bi bi-funnel"></i>

            </button>

        </div>

    </div>

    <div class="collapse mt-3" id="patientFilters">

        <div class="card card-body">

            <form method="GET">

                <div class="row">

                    <div class="col-md-3">

                        <label class="form-label">
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-select">

                            <option value="">
                                Todos
                            </option>

                            <option
                                value="EM ATENDIMENTO"
                                <?= ($status ?? '') == 'EM ATENDIMENTO' ? 'selected' : '' ?>>

                                Em Atendimento

                            </option>

                            <option
                                value="EM FILA"
                                <?= ($status ?? '') == 'EM FILA' ? 'selected' : '' ?>>

                                Em Fila

                            </option>

                        </select>

                    </div>
                    <div class="col-md-3">

                        <label class="form-label">
                            Primeira Consulta
                        </label>

                        <select
                            name="first_service_order"
                            class="form-select">

                            <option value="">
                                Padrão
                            </option>

                            <option
                                value="ASC"
                                <?= ($firstServiceOrder ?? '') == 'ASC' ? 'selected' : '' ?>>

                                Mais Antigas Primeiro

                            </option>

                            <option
                                value="DESC"
                                <?= ($firstServiceOrder ?? '') == 'DESC' ? 'selected' : '' ?>>

                                Mais Recentes Primeiro

                            </option>

                        </select>

                    </div>
                    <div class="col-md-3 d-flex align-items-end">

                        <button class="btn btn-primary">

                            <i class="bi bi-search"></i>

                            Filtrar

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>
    <div class="table-responsive">

        <table class="table align-middle patient-table">

            <thead>

                <tr>

                    <th>Paciente</th>
                    <th>Prontuário</th>
                    <th>Primeira Consulta</th>
                    <!-- <th>Primeira Consulta2</th> -->
                    <th>Exames Pronto</th>
                    <th>60D</th>
                    <th>Status</th>
                    <th width="140">Ações</th>

                </tr>

            </thead>

            <tbody>
                <?php if (!empty($patients)): ?>

                    <?php foreach ($patients as $patient): ?>

                        <tr>

                            <!-- PACIENTE -->

                            <td>

                                <div class="d-flex align-items-center gap-3">

                                    <div class="patient-avatar">

                                        <?= strtoupper(substr($patient['name'], 0, 1)) ?>

                                    </div>

                                    <div>

                                        <strong>

                                            <?= esc($patient['name']) ?>

                                        </strong>

                                        <small class="d-block text-muted">

                                            <?= esc($patient['specialty_name']) ?>

                                        </small>

                                    </div>

                                </div>

                            </td>

                            <!-- PRONTUARIO -->

                            <td>

                                <span class="fw-semibold">

                                    #<?= esc($patient['medical_record']) ?>

                                </span>

                            </td>
                            <!-- DATA 2 -->

                            <td>
                                <?php if (
                                    $patient['status']
                                    == 'EM FILA'
                                ): ?>

                                    <span class="text-muted">

                                        --

                                    </span>

                                <?php else: ?>

                                    <?= date(
                                        'd/m/Y',
                                        strtotime(
                                            $patient['first_service_date']
                                        )
                                    ) ?>

                                <?php endif; ?>
                            </td>
                            <!-- DATA -->

                            <!-- <td>
                                <1?php if (
                                    $patient['status']
                                    == 'EM FILA'
                                ): ?>

                                    <span class="text-muted">

                                        --

                                    </span>

                                <1?php else: ?>

                                    <1?= date(
                                        'd/m/Y',
                                        strtotime(
                                            $patient['first_consultation_date']
                                        )
                                    ) ?>

                                <1?php endif; ?>
                            </td> -->


                            <!-- EXAMES -->

                            <td>

                                <?php if ($patient['status'] == 'EM FILA'): ?>

                                    <span class="custom-badge secondary">

                                        Aguardando

                                    </span>

                                <?php else: ?>

                                    <?php if ($patient['has_exams']): ?>

                                        <span class="custom-badge success">

                                            SIM

                                        </span>

                                    <?php else: ?>

                                        <span class="custom-badge danger">

                                            NÃO

                                        </span>

                                    <?php endif; ?>

                                <?php endif; ?>

                            </td>
                            <?php

                            $d60Days = null;

                            if (
                                !empty($patient['accepted_at'])
                            ) {

                                $acceptedDate =
                                    new DateTime(
                                        $patient['accepted_at']
                                    );

                                $today =
                                    new DateTime();

                                $d60Days =
                                    (int)

                                    $acceptedDate
                                        ->diff($today)

                                        ->format('%r%a');
                            }
                            ?>
                            <!-- 60D -->
                            <td>

                                <?php if (
                                    $patient['status']
                                    == 'EM FILA'
                                ): ?>

                                    <span class="text-muted">

                                        --

                                    </span>

                                <?php else: ?>

                                    <?php

                                    $badgeClass =
                                        'success';

                                    $badgeText =
                                        'NORMAL';

                                    /*
                                |--------------------------------------------------------------------------
                                | 21 - 40
                                |--------------------------------------------------------------------------
                                */

                                    if (
                                        $d60Days >= 21 &&
                                        $d60Days <= 40
                                    ) {

                                        $badgeClass =
                                            'warning';

                                        $badgeText =
                                            'ATENÇÃO';
                                    }

                                    /*
                                |--------------------------------------------------------------------------
                                | 41 - 60
                                |--------------------------------------------------------------------------
                                */

                                    if (
                                        $d60Days >= 41 &&
                                        $d60Days <= 60
                                    ) {

                                        $badgeClass =
                                            'danger';

                                        $badgeText =
                                            'PRIORIDADE';
                                    }

                                    /*
                                |--------------------------------------------------------------------------
                                | 61+
                                |--------------------------------------------------------------------------
                                */

                                    if (
                                        $d60Days > 60
                                    ) {

                                        $badgeClass =
                                            'dark';

                                        $badgeText =
                                            'URGENTE';
                                    }

                                    ?>

                                    <span
                                        class="custom-badge <?= $badgeClass ?>">

                                        <?= $d60Days ?>

                                        Dias

                                        -

                                        <?= $badgeText ?>

                                    </span>

                                <?php endif; ?>

                            </td>

                            <!-- STATUS -->

                            <td>

                                <?php

                                $statusClass = 'secondary';

                                if ($patient['status'] == 'EM FILA') {

                                    $statusClass = 'warning';
                                } elseif (
                                    $patient['status']
                                    == 'EM ATENDIMENTO'
                                ) {

                                    $statusClass = 'primary';
                                } elseif (
                                    $patient['status']
                                    == 'FINALIZADO'
                                ) {

                                    $statusClass = 'success';
                                }

                                ?>

                                <span class="custom-badge <?= $statusClass ?>">

                                    <?= esc($patient['status']) ?>

                                </span>

                            </td>

                            <!-- AÇÕES -->

                            <td>

                                <div class="d-flex gap-2">

                                    <!-- COMPLETAR CADASTRO -->

                                    <?php if ($patient['status'] == 'EM FILA'): ?>

                                        <button
                                            class="btn-action btnCompletePatient"

                                            data-id="<?= $patient['id'] ?>"

                                            data-name="<?= esc($patient['name']) ?>"

                                            data-medical_record="<?= esc($patient['medical_record']) ?>"

                                            data-cpf="<?= esc($patient['cpf']) ?>"

                                            data-phone="<?= esc($patient['phone']) ?>"

                                            data-specialty_id="<?= $patient['specialty_id'] ?>"

                                            data-state="<?= esc($patient['state']) ?>"

                                            data-city="<?= esc($patient['city']) ?>"

                                            data-has_exams="<?= $patient['has_exams'] ?>">
                                            <!-- (Removido para que seja inserido o valor manual.) data-first_consultation_date="<1?= $patient['first_consultation_date'] ?>" -->

                                            <i class="bi bi-ui-checks-grid"></i>

                                        </button>

                                    <?php else: ?>

                                        <!-- EDITAR -->
                                        <!-- <1?= $patient['first_service_date'] ?> -->
                                        <button

                                            class="btn-action btnEditPatientData"

                                            data-id="<?= $patient['id'] ?>"

                                            data-name="<?= esc($patient['name']) ?>"

                                            data-medical_record="<?= esc($patient['medical_record']) ?>"

                                            data-cpf="<?= esc($patient['cpf']) ?>"

                                            data-phone="<?= esc($patient['phone']) ?>"

                                            data-specialty_id="<?= $patient['specialty_id'] ?>"

                                            data-state="<?= esc($patient['state']) ?>"

                                            data-city="<?= esc($patient['city']) ?>"

                                            data-has_exams="<?= $patient['has_exams'] ?>"

                                            data-first_service_date="<?= $patient['first_service_date'] ?>">

                                            <i class="bi bi-pencil"></i>

                                        </button>


                                        <!-- VISUALIZAR -->

                                        <a href="<?= base_url('patients/show/' . $patient['id']) ?>" class="btn-action">

                                            <i class="bi bi-eye"></i>

                                        </a>
                                    <?php endif; ?>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td colspan="7"
                            class="text-center py-5 text-muted">

                            Nenhum paciente encontrado.

                        </td>

                    </tr>

                <?php endif; ?>
            </tbody>

        </table>

    </div>

    <!-- CENTRO -->

    <?php
    $total = $pager->getTotal();
    $perPageAtual = $pager->getPerPage();
    $current = $pager->getCurrentPage();

    $inicio = (($current - 1) * $perPageAtual) + 1;
    $fim = min($current * $perPageAtual, $total);
    ?>

    <div class="table-footer">

        <!-- ESQUERDA -->
        <div class="table-left">

            <form method="GET" class="d-flex align-items-center gap-2">

                <?php if (!empty($search)): ?>
                    <input type="hidden"
                        name="search"
                        value="<?= esc($search) ?>">
                <?php endif; ?>

                <label class="mb-0 text-muted">
                    Mostrar
                </label>

                <select
                    class="form-select form-select-sm"
                    name="perPage"
                    onchange="this.form.submit()">

                    <option value="10" <?= $perPage == 10 ? 'selected' : '' ?>>10</option>
                    <option value="25" <?= $perPage == 25 ? 'selected' : '' ?>>25</option>
                    <option value="50" <?= $perPage == 50 ? 'selected' : '' ?>>50</option>
                    <option value="100" <?= $perPage == 100 ? 'selected' : '' ?>>100</option>

                </select>

                <span class="text-muted">
                    registros
                </span>

            </form>

        </div>

        <!-- CENTRO -->
        <div class="table-center">

            <i class="bi bi-database me-2"></i>

            Mostrando

            <strong><?= $inicio ?></strong>

            -

            <strong><?= $fim ?></strong>

            de

            <strong><?= $total ?></strong>

            registros

        </div>

        <!-- DIREITA -->
        <div class="table-right">

            <?= $pager->links() ?>

        </div>

    </div>

</div>