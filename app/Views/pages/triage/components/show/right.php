<!-- RIGHT -->

<div class="col-lg-4" data-aos="fade-left">

    <div class="card card-modern border-0 h-100">

        <div class="card-body p-4">

            <!-- HEADER -->

            <div class="card-title-modern mb-4">

                <div class="icon-box primary">

                    <i class="bi bi-clock-history"></i>

                </div>

                <div>

                    <h5 class="fw-bold mb-0">
                        Timeline
                    </h5>

                    <small class="text-muted">
                        Histórico operacional
                    </small>

                </div>

            </div>

            <!-- TIMELINE -->

            <div class="timeline-modern">

                <?php if (!empty($timeline)): ?>

                    <?php foreach ($timeline as $item): ?>

                        <?php
                        // Helper para definir classes e ícones com base no status da triagem
                        helper('timeline');

                        $config = getTimelineConfig($item['new_status']);

                        ?>

                        <div class="timeline-item <?= $config['class'] ?>">

                            <!-- DOT -->

                            <div class="timeline-dot"></div>

                            <!-- CONTENT -->

                            <div>

                                <!-- STATUS -->

                                <strong>

                                    <i class="bi <?= $config['icon'] ?>"></i>

                                    <?= esc($item['new_status']) ?>

                                </strong>

                                <!-- OBS -->

                                <?php if (!empty($item['observation'])): ?>

                                    <p class="timeline-observation mb-1">

                                        <?= esc($item['observation']) ?>

                                    </p>

                                <?php endif; ?>

                                <!-- DATE -->

                                <p class="text-muted mb-0">

                                    <?= date(
                                        'd/m/Y H:i',
                                        strtotime($item['created_at'])
                                    ) ?>

                                </p>

                            </div>

                        </div>

                    <?php endforeach; ?>

                <?php else: ?>

                    <!-- EMPTY -->

                    <div class="text-center py-5">

                        <i class="bi bi-clock-history fs-1 text-muted"></i>

                        <p class="text-muted mt-3 mb-0">

                            Nenhum histórico encontrado.

                        </p>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    </div>

</div>