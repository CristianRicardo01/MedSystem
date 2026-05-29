<!-- EXAMES -->

<div class="col-md-6" data-aos="fade-up" data-aos-delay="200">

    <div class="card card-modern border-0 h-100">

        <div class="card-body p-4">

            <div class="card-title-modern">

                <div class="icon-box green">

                    <i class="bi bi-clipboard2-pulse"></i>

                </div>

                <div>

                    <h5 class="fw-bold mb-0">
                        Exames
                    </h5>

                    <small class="text-muted">
                        Situação dos exames
                    </small>

                </div>

            </div>

            <div class="exam-status mt-4">

                <div class="status-row">

                    <span>
                        Exames Prontos
                    </span>

                    <span class="custom-badge success">

                        <?= $patient['has_exams']
                            ? 'SIM'
                            : 'NÃO' ?>

                    </span>

                </div>

                <div class="status-row">
                    <?php

                    $d60Days = 0;

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
                    <span>
                        Dias
                    </span>

                    <span class="custom-badge warning">

                        <?= $d60Days ?>

                        Dias
                    </span>

                </div>

            </div>

        </div>

    </div>

</div>