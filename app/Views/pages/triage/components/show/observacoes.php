<!-- OBSERVAÇÕES -->

<div class="col-12"
    data-aos="fade-up"
    data-aos-delay="200">

    <div class="card card-modern border-0">

        <div class="card-body p-4">

            <!-- HEADER -->

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

                <div class="card-title-modern">

                    <div class="icon-box primary">

                        <i class="bi bi-chat-left-text"></i>

                    </div>

                    <div>

                        <h5 class="fw-bold mb-0">
                            Observações
                        </h5>

                        <small class="text-muted">
                            Informações operacionais
                        </small>

                    </div>

                </div>

                <!-- BTN -->

                <button class="btn btn-primary rounded-4 px-4" data-bs-toggle="modal" data-bs-target="#modalObservation">

                    <i class="bi bi-plus-circle me-2"></i>

                    Adicionar

                </button>

            </div>

            <!-- CONTENT -->

            <div class="observation-box">

                <?php if (!empty($patient['observations'])): ?>

                    <p class="text-muted mb-0">

                        <?= nl2br(
                            esc($patient['observations'])
                        ) ?>

                    </p>

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