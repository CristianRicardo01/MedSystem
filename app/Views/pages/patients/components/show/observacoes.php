<!-- OBSERVAÇÕES -->

<div class="col-12" data-aos="fade-up" data-aos-delay="300">

    <div class="card card-modern border-0">

        <div class="card-body p-4">

            <!-- HEADER -->

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

                <div class="card-title-modern">

                    <div class="icon-box orange">

                        <i class="bi bi-chat-left-text"></i>

                    </div>

                    <div>

                        <h5 class="fw-bold mb-0">
                            Observações
                        </h5>

                        <small class="text-muted">
                            Informações adicionais do paciente
                        </small>

                    </div>

                </div>

                <!-- BTN -->

                <button
                    class="btn btn-primary rounded-4 px-4"
                    <?= ($patient['status'] == 'FINALIZADO') ? 'style="display:none;"' : ''; ?>
                    data-bs-toggle="modal"
                    data-bs-target="#modalObservation">

                    <i class="bi bi-plus-circle me-2"></i>

                    Nova Observação

                </button>

            </div>

            <!-- OBSERVAÇÃO -->

            <div class="observation-box table-responsive observation-table-wrapper">

                <?php if (!empty($observations)): ?>

                    <div class="observation-list">

                        <?php foreach ($observations as $observation): ?>

                            <div class="observation-item mb-3">

                                <!-- TOP -->

                                <div class="d-flex justify-content-between align-items-start mb-2">

                                    <strong>Observação</strong>

                                    <div>

                                        <small class="text-muted me-3">
                                            <?= date('d/m/Y H:i', strtotime($observation['created_at'])) ?>
                                        </small>

                                        <button
                                            class="btn btn-sm btn-outline-primary btnEditObservation"

                                            data-id="<?= $observation['id'] ?>"

                                            data-observation="<?= esc($observation['observation']) ?>">

                                            <i class="bi bi-pencil"></i>

                                        </button>

                                        <button

                                            class="btn btn-sm btn-outline-danger btnDeleteObservation"

                                            data-id="<?= $observation['id'] ?>">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </div>

                                </div>
                                <!-- CONTENT -->

                                <div class="observation-box">

                                    <p class="text-muted mb-0">

                                        <?= esc($observation['observation']) ?>

                                    </p>

                                </div>

                            </div>

                        <?php endforeach; ?>

                    </div>

                <?php else: ?>

                    <div class="text-center py-4">

                        <i class="bi bi-chat-left-text fs-1 text-muted"></i>

                        <p class="text-muted mt-3 mb-0">

                            Nenhuma observação cadastrada.

                        </p>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    </div>

</div>