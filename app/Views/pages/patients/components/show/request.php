<!-- SOLICITAÇÕES -->

<div class="col-12" data-aos="fade-up" data-aos-delay="400">

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

                <button
                    class="btn btn-primary rounded-4 px-4"
                    <?= ($patient['status'] == 'FINALIZADO') ? 'style="display:none;"' : ''; ?>
                    data-bs-toggle="modal"
                    data-bs-target="#modalPatientRequest">

                    <i class="bi bi-plus-circle me-2"></i>

                    Nova Solicitação

                </button>

            </div>

            <!-- TABLE -->

            <div class="table-responsive request-table-wrapper">
                <?php if (!empty($requests)): ?>
                    <table class="table align-middle patient-request-table">

                        <thead>

                            <tr>
                                <th width="50">Obs</th>
                                <th>Solicitação</th>
                                <th>Especialidade</th>
                                <th>Data</th>
                                <th>Status</th>
                                <th>D60</th>
                                <th>Alerta</th>
                                <th width="120">Ações</th>

                            </tr>

                        </thead>

                        <tbody style="font-size: 12px;">

                            <!-- ITEM -->

                            <?php foreach ($requests as $request): ?>

                                <?php

                                /*
                                    |--------------------------------------------------------------------------
                                    | D60
                                    |--------------------------------------------------------------------------
                                    */

                                $requestDays = 0;

                                if (
                                    !empty($request['created_at'])
                                ) {

                                    $requestDate =
                                        new DateTime(
                                            $request['created_at']
                                        );

                                    $today =
                                        new DateTime();

                                    $requestDays =
                                        (int)

                                        $requestDate

                                            ->diff($today)

                                            ->format('%r%a');
                                }

                                /*
                                    |--------------------------------------------------------------------------
                                    | BADGE
                                    |--------------------------------------------------------------------------
                                    */

                                $d60Class = 'success';

                                $alertText = 'NORMAL';

                                /*
                                    |--------------------------------------------------------------------------
                                    | 21 - 40
                                    |--------------------------------------------------------------------------
                                    */

                                if (
                                    $requestDays >= 21 &&
                                    $requestDays <= 40
                                ) {

                                    $d60Class =
                                        'warning';

                                    $alertText =
                                        'ATENÇÃO';
                                }

                                /*
                                    |--------------------------------------------------------------------------
                                    | 41 - 60
                                    |--------------------------------------------------------------------------
                                    */

                                if (
                                    $requestDays >= 41 &&
                                    $requestDays <= 60
                                ) {

                                    $d60Class =
                                        'danger';

                                    $alertText =
                                        'URGENTE';
                                }

                                /*
                                    |--------------------------------------------------------------------------
                                    | 61+
                                    |--------------------------------------------------------------------------
                                    */

                                if (
                                    $requestDays > 60
                                ) {

                                    $d60Class =
                                        'dark';

                                    $alertText =
                                        'PRIORIDADE';
                                }

                                /*
                                    |--------------------------------------------------------------------------
                                    | STATUS
                                    |--------------------------------------------------------------------------
                                    */

                                $statusClass =
                                    'secondary';

                                if (
                                    $request['request_status']
                                    == 'PENDING'
                                ) {

                                    $statusClass =
                                        'warning';
                                }

                                if (
                                    $request['request_status']
                                    == 'COMPLETED'
                                ) {

                                    $statusClass =
                                        'success';
                                }

                                ?>

                                <tr>

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

                                            <span class="text-muted" style="text-align: center; margin-left: 15px;">

                                                #

                                            </span>

                                        <?php endif; ?>

                                    </td>
                                    <!-- SOLICITAÇÃO -->

                                    <td>

                                        <?= esc($request['request_type_name']) ?>

                                    </td>

                                    <!-- ESPECIALIDADE -->

                                    <td>

                                        <?= esc($patient['specialty_name']) ?>

                                    </td>

                                    <!-- DATA -->

                                    <td>

                                        <?= date('d/m/Y', strtotime($request['created_at'])) ?>

                                    </td>

                                    <!-- STATUS -->

                                    <td>

                                        <span
                                            class="custom-badge <?= $statusClass ?>">

                                            <?= esc($request['request_status']) ?>

                                        </span>

                                    </td>

                                    <!-- D60 -->

                                    <td>

                                        <span
                                            class="custom-badge <?= $d60Class ?>">

                                            <?= $requestDays ?>

                                        </span>

                                    </td>

                                    <!-- ALERTA -->

                                    <td>

                                        <span
                                            class="custom-badge <?= $d60Class ?>">

                                            <?= $alertText ?>

                                        </span>

                                    </td>

                                    <!-- AÇÕES -->

                                    <td>

                                        <div class="d-flex gap-2">

                                            <?php if (
                                                $request['request_status']
                                                != 'COMPLETED'
                                            ): ?>

                                                <!-- EDIT -->

                                                <button
                                                    class="btn-action btnPatientEditRequest"

                                                    data-id="<?= $request['id'] ?>"

                                                    data-request_type_id="<?= $request['request_type_id'] ?>"

                                                    data-scheduled_date="<?= $request['scheduled_date'] ?>"

                                                    data-alert_offset_days="<?= $request['alert_offset_days'] ?>"

                                                    data-alert_date="<?= $request['alert_date'] ?>"

                                                    data-request_status="<?= $request['request_status'] ?>"

                                                    data-observation="<?= esc($request['observation']) ?>">

                                                    <i class="bi bi-pencil"></i>

                                                </button>

                                                <!-- FINALIZE -->

                                                <button
                                                    class="btn-action btn-success btnPatientFinalizeRequest"

                                                    data-id="<?= $request['id'] ?>">

                                                    <i class="bi bi-check-circle"></i>

                                                </button>

                                                <!-- DELETE -->

                                                <button
                                                    class="btn-action btn-action-danger btnPatientDeleteRequest"

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

                                    Nenhuma solicitação cadastrada.

                                </p>

                            </div>

                        <?php endif; ?>
                        </tbody>

                    </table>

            </div>

        </div>

    </div>

</div>