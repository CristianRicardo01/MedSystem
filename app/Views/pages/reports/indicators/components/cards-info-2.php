<div class="row">

    <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="100">

        <div class="card border-start border-danger border-4 shadow-sm rounded-4">

            <div class="card-body">

                <h6 class="text-muted">

                    D60 Vencidos

                </h6>

                <h2 class="fw-bold text-danger">

                    <?= $d60Expired ?>

                </h2>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="200">

        <div class="card border-start border-warning border-4 shadow-sm rounded-4">

            <div class="card-body">

                <h6 class="text-muted">

                    D60 Próximos

                </h6>

                <h2 class="fw-bold text-warning">

                    <?= $d60Warning ?>

                </h2>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="300">

        <div class="card border-start border-danger border-4 shadow-sm rounded-4">

            <div class="card-body">

                <h6 class="text-muted">

                    Exames Atrasados

                </h6>

                <h2 class="fw-bold text-danger">

                    <?= $expiredRequests ?>

                </h2>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="400">

        <div class="card border-start border-info border-4 shadow-sm rounded-4">

            <div class="card-body">

                <h6 class="text-muted">

                    Exames Próximos

                </h6>

                <h2 class="fw-bold text-info">

                    <?= $warningRequests ?>

                </h2>

            </div>

        </div>

    </div>

</div>