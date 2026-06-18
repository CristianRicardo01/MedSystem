<!-- RIGHT -->

<div class="col-lg-4" data-aos="fade-left" data-aos-delay="400">

    <div class="card card-modern border-0 h-100">

        <div class="card-body p-4">

            <div class="card-title-modern mb-4">

                <div class="icon-box primary">

                    <i class="bi bi-clock-history"></i>

                </div>

                <div>

                    <h5 class="fw-bold mb-0">
                        Timeline
                    </h5>

                    <small class="text-muted">
                        Histórico do processo
                    </small>

                </div>

            </div>

            <!-- TIMELINE -->

            <div class="timeline-modern">
                <?php if (!empty($statusHistory)): ?>

                    <?php foreach ($statusHistory as $item): ?>

                        <?php
                        // Helper para definir classes e ícones com base no status da triagem
                        helper('timeline');

                        $config = getTimelineConfig($item['new_status']);

                        ?>

                        <div class="timeline-item <?= $config['class'] ?>">

                            <div class="timeline-dot"></div>

                            <div>

                                <strong>

                                    <i class="bi <?= $config['icon'] ?>"></i>

                                    <?= esc($item['new_status']) ?>

                                </strong>

                                <p class="text-muted mb-1">

                                    <?= date(
                                        'd/m/Y H:i',
                                        strtotime($item['created_at'])
                                    ) ?>

                                </p>

                                <?php if (!empty($item['observation'])): ?>

                                    <small class="text-muted">

                                        <?= esc($item['observation']) ?>

                                    </small>

                                <?php endif; ?>

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