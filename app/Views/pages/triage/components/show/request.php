<!-- SOLICITAÇÕES EXAMES CENTRAL TRIAGEM-->
<div class="col-12" data-aos="fade-up" data-aos-delay="300">

    <div class="card card-modern border-0">

        <div class="card-body p-4">

            <!-- HEADER -->

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

                <div class="card-title-modern">

                    <div class="icon-box primary">

                        <i class="bi bi-clipboard-data"></i>

                    </div>

                    <div>

                        <h5 class="fw-bold mb-0">
                            Solicitações
                        </h5>

                        <small class="text-muted">
                            Histórico de atendimentos do paciente
                        </small>

                    </div>

                </div>

                <!-- BTN -->

                <button class="btn btn-primary rounded-4 px-4" data-bs-toggle="modal" data-bs-target="#modalPatientRequest">

                    <i class="bi bi-plus-circle me-2"></i>

                    Nova Solicitação

                </button>

            </div>

            <!-- TABLE -->

            <div class="table-responsive request-table-wrapper">

                <?php if (!empty($patientRequests)): ?>
                    <table class="table align-middle patient-request-table">

                        <thead>

                            <tr>

                                <th width="50">Obs</th>

                                <th>Solicitação</th>

                                <th>Agendamento</th>

                                <th>Status</th>

                                <th>SLA</th>

                                <th>Alerta</th>

                                <th>Tipo</th>

                                <th width="120">Ações</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php foreach ($patientRequests as $request): ?>

                                <tr style="font-size: 14px;">

                                    <!-- OBSERVATION -->

                                    <td>

                                        <?php if (!empty($request['observation'])): ?>

                                            <button
                                                type="button"

                                                class="btn-action"

                                                data-bs-toggle="popover"

                                                data-bs-trigger="hover focus"

                                                data-bs-placement="right"

                                                title="Observação"

                                                data-bs-content="<?= esc($request['observation']) ?>">

                                                <i class="bi bi-chat-left-text"></i>

                                            </button>

                                        <?php else: ?>

                                            <span class="text-muted">

                                                #

                                            </span>

                                        <?php endif; ?>

                                    </td>

                                    <!-- REQUEST -->

                                    <td>

                                        <strong>

                                            <?= esc($request['request_name']) ?>

                                        </strong>

                                    </td>

                                    <!-- SCHEDULED DATE -->

                                    <td>

                                        <?php if (!empty($request['scheduled_date'])): ?>

                                            <?= date(

                                                'd/m/Y',

                                                strtotime($request['scheduled_date'])

                                            ) ?>

                                        <?php else: ?>

                                            -

                                        <?php endif; ?>

                                    </td>

                                    <!-- DATE -->

                                    <td>

                                        <?= date(
                                            'd/m/Y',
                                            strtotime($request['requested_at'])
                                        ) ?>

                                    </td>

                                    <!-- STATUS -->

                                    <td>

                                        <?php if (
                                            $request['request_status']
                                            == 'COMPLETED'
                                        ): ?>

                                            <span class="custom-badge success">

                                                Finalizado

                                            </span>

                                        <?php else: ?>

                                            <span class="custom-badge warning">

                                                Em andamento

                                            </span>

                                        <?php endif; ?>

                                    </td>

                                    <!-- SLA -->

                                    <td>

                                        <?php

                                        /*
                                        |--------------------------------------------------------------------------
                                        | EXTERNAL
                                        |--------------------------------------------------------------------------
                                        */

                                        if ($request['is_external']) {

                                            echo '<span class="custom-badge primary">
                                                    Externo
                                                </span>';
                                        } else {

                                            /*
                                            |--------------------------------------------------------------------------
                                            | SLA
                                            |--------------------------------------------------------------------------
                                            */

                                            $today = new DateTime();

                                            $deadline = new DateTime(
                                                $request['deadline_date']
                                            );

                                            $diff = $today->diff($deadline);

                                            $daysRemaining = $diff->days;

                                            $isLate = $diff->invert;

                                            /*
                                            |--------------------------------------------------------------------------
                                            | BADGE
                                            |--------------------------------------------------------------------------
                                            */

                                            if ($isLate) {

                                                $class = 'danger';

                                                $text =
                                                    'Atrasado';
                                            } elseif ($daysRemaining <= 5) {

                                                $class = 'warning';

                                                $text =
                                                    $daysRemaining . ' dias';
                                            } else {

                                                $class = 'success';

                                                $text =
                                                    $daysRemaining . ' dias';
                                            }

                                        ?>

                                            <span class="custom-badge <?= $class ?>">

                                                <?= $text ?>

                                            </span>

                                        <?php } ?>

                                    </td>

                                    <!-- TYPE -->

                                    <td>

                                        <?php if ($request['is_external']): ?>

                                            <span class="custom-badge primary">

                                                Externo

                                            </span>

                                        <?php else: ?>

                                            <span class="custom-badge success">

                                                Interno

                                            </span>

                                        <?php endif; ?>

                                    </td>

                                    <!-- ACTIONS -->

                                    <td>

                                        <div class="d-flex gap-2">

                                            <?php if (
                                                $request['request_status']
                                                != 'COMPLETED'
                                            ): ?>

                                                <!-- EDIT -->

                                                <button
                                                    class="btn-action btnEditRequest"

                                                    data-id="<?= $request['id'] ?>"

                                                    data-request_type_id="<?= $request['request_type_id'] ?>"

                                                    data-scheduled_date="<?= $request['scheduled_date'] ?>"

                                                    data-alert_offset_days="<?= $request['alert_offset_days'] ?>"

                                                    data-request_status="<?= $request['request_status'] ?>"

                                                    data-observation="<?= esc($request['observation']) ?>">

                                                    <i class="bi bi-pencil"></i>

                                                </button>

                                                <!-- FINALIZE -->

                                                <button
                                                    class="btn-action btn-success btnFinalizeRequest"

                                                    data-id="<?= $request['id'] ?>">

                                                    <i class="bi bi-check-circle"></i>

                                                </button>

                                                <!-- DELETE -->

                                                <button
                                                    class="btn-action btn-action-danger btnDeleteRequest"

                                                    data-id="<?= $request['id'] ?>">

                                                    <i class="bi bi-trash"></i>

                                                </button>

                                            <?php else: ?>

                                                <!-- COMPLETED -->

                                                <span class="custom-badge success">

                                                    Finalizado

                                                </span>

                                            <?php endif; ?>

                                        </div>

                                    </td>

                                </tr>

                            <?php endforeach; ?>
                        <?php else: ?>

                            <div class="text-center py-4">

                                <i class="bi bi-chat-left-text fs-1 text-muted"></i>

                                <p class="text-muted mt-3 mb-0">

                                    Nenhuma observação cadastrada.

                                </p>

                            </div>

                        <?php endif; ?>
                        </tbody>

                    </table>

            </div>

        </div>

    </div>

</div>