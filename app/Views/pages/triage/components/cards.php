<!-- CARDS -->

<div class="row g-4 mb-4">

    <!-- CARD Em Triagem-->

    <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="100">

        <div class="dashboard-card card-blue">

            <div class="icon">

                <i class="bi bi-person-check"></i>

            </div>

            <h3>
                <?= $triageCount ?>
            </h3>

            <p class="mb-0">
                Em Triagem
            </p>

        </div>

    </div>

    <!-- CARD Finalizados-->

    <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="200">

        <div class="dashboard-card card-green">

            <div class="icon">

                <i class="bi bi-check-circle"></i>

            </div>

            <h3>
                <?= $finishedCount ?>
            </h3>

            <p class="mb-0">
                Finalizados
            </p>

        </div>

    </div>

    <!-- CARD Próximos do Prazo-->

    <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="300">

        <div class="dashboard-card card-yellow">

            <div class="icon bg-white">

                <i class="bi bi-clock text-warning"></i>

            </div>

            <h3>
                <?= $warningCount ?>
            </h3>

            <p class="mb-0">
                Próximos do Prazo
            </p>

        </div>

    </div>

    <!-- CARD Críticos-->

    <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="400">

        <div class="dashboard-card card-beige">

            <div class="icon bg-white">

                <i class="bi bi-exclamation-triangle text-danger"></i>

            </div>

            <h3>
                <?= $criticalCount ?>
            </h3>

            <p class="mb-0">
                Críticos
            </p>

        </div>

    </div>

</div>