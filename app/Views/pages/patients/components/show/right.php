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

                <?php foreach ($movements as $movement): ?>

                    <div class="timeline-item primary">

                        <div class="timeline-dot"></div>

                        <div>

                            <strong>

                                <?= esc($movement['movement_type']) ?>

                            </strong>

                            <p class="text-muted mb-0">

                                <?= date('d/m/Y H:i', strtotime($movement['created_at'])) ?>

                            </p>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        </div>

    </div>

</div>