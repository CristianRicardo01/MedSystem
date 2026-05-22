<!-- CARDS -->

<div class="row g-4 mb-4">

    <!-- CARD Em Triagem-->

    <div class="col-md col-xl" data-aos="fade-up" data-aos-delay="100" style="color: #000000;">

        <div class="info-card blue-card content-animation">

            <div>

                <small> Em Triagem </small>

                <h3> <?= $triageCount ?> </h3>

            </div>

            <i class="bi bi-person-check"></i>

        </div>

    </div>

    <!-- CARD Finalizados-->

    <div class="col-md col-xl" data-aos="fade-up" data-aos-delay="200" style="color: #000000;">

        <div class="info-card card-green content-animation">

            <div>

                <small> Finalizados </small>

                <h3> <?= $finishedCount ?> </h3>

            </div>

            <i class="bi bi-check-circle"></i>

        </div>

    </div>

    <!-- CARD Próximos do Prazo-->

    <div class="col-md col-xl" data-aos="fade-up" data-aos-delay="300">

        <div class="info-card card-yellow content-animation" style="color: #000000;">

            <div>

                <small> Próximos do Prazo </small>

                <h3> <?= $warningCount ?> </h3>

            </div>

            <i class="bi bi-check-circle"></i>

        </div>

    </div>

    <!-- CARD Críticos-->

        <div class="col-md col-xl" data-aos="fade-up" data-aos-delay="400">

        <div class="info-card card-beige content-animation" style="color: #000000;">

            <div>

                <small> Críticos </small>

                <h3> <?= $criticalCount ?> </h3>

            </div>

                <i class="bi bi-exclamation-triangle text-danger"></i>

        </div>

    </div>

</div>