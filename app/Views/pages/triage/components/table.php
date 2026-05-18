<!-- TABLE -->

<div class="table-container" data-aos="fade-up" data-aos-delay="500">

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

                <?php if (!empty($patients)): ?>

                    <?php foreach ($patients as $patient): ?>

                        <?php

                        /*
                        |--------------------------------------------------------------------------
                        | AVATAR
                        |--------------------------------------------------------------------------
                        */

                        $avatar = strtoupper(substr($patient['name'], 0, 1));

                        /*
                        |--------------------------------------------------------------------------
                        | PRAZO
                        |--------------------------------------------------------------------------
                        */

                        $today = new DateTime(date('Y-m-d'));

                        $consultation = new DateTime(
                            $patient['first_consultation_date']
                        );

                        $diff = $today->diff($consultation);

                        $days = $diff->days;

                        /*
                        |--------------------------------------------------------------------------
                        | VERIFICA ATRASO
                        |--------------------------------------------------------------------------
                        */

                        $isLate = $diff->invert;

                        /*
                        |--------------------------------------------------------------------------
                        | BADGE PRAZO
                        |--------------------------------------------------------------------------
                        */

                        $deadlineClass = 'success';

                        $deadlineText = $days . ' Dias';

                        /*
                        |--------------------------------------------------------------------------
                        | ATRASADO
                        |--------------------------------------------------------------------------
                        */

                        if ($isLate) {

                            $deadlineClass = 'danger';

                            $deadlineText = 'Atrasado';
                        } else {

                            /*
                            |--------------------------------------------------------------------------
                            | SLA NORMAL
                            |--------------------------------------------------------------------------
                            */

                            if ($days <= 10) {

                                $deadlineClass = 'danger';
                            } elseif ($days <= 20) {

                                $deadlineClass = 'warning';
                            }
                        }


                        /*
                        |--------------------------------------------------------------------------
                        | STATUS BADGE
                        |--------------------------------------------------------------------------
                        */

                        $statusClass = 'primary';

                        if ($patient['status'] == 'AGUARDANDO_EXAMES') {

                            $statusClass = 'warning';
                        }

                        if ($patient['status'] == 'NEGADO') {

                            $statusClass = 'danger';
                        }

                        ?>

                        <tr>

                            <!-- PACIENTE -->

                            <td>

                                <div class="d-flex align-items-center gap-3">

                                    <div class="patient-avatar">

                                        <?= esc($avatar) ?>

                                    </div>

                                    <div>

                                        <strong>
                                            <?= esc($patient['name']) ?>
                                        </strong>

                                        <small class="d-block text-muted">

                                            Especialidade ID:
                                            <?= esc($patient['specialty_id']) ?>

                                        </small>

                                    </div>

                                </div>

                            </td>

                            <!-- PRONTUARIO -->

                            <td>

                                #<?= esc($patient['medical_record']) ?>

                            </td>

                            <!-- ATENDIMENTO -->

                            <td>

                                <?= date(
                                    'd/m/Y',
                                    strtotime($patient['first_service_date'])
                                ) ?>

                            </td>

                            <!-- CONSULTA -->

                            <td>

                                <?= date(
                                    'd/m/Y',
                                    strtotime($patient['first_consultation_date'])
                                ) ?>

                            </td>

                            <!-- PRAZO -->

                            <td>

                                <span class="custom-badge <?= $deadlineClass ?>">

                                    <?= $deadlineText ?>
                                </span>

                            </td>

                            <!-- STATUS -->

                            <td>

                                <span class="custom-badge <?= $statusClass ?>">

                                    <?= esc($patient['status']) ?>

                                </span>

                            </td>

                            <!-- ACTIONS -->

                            <td>

                                <a href="<?= base_url('triage/show/' . $patient['id']) ?>"
                                    class="btn-action">

                                    <i class="bi bi-eye"></i>

                                </a>

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

</div>