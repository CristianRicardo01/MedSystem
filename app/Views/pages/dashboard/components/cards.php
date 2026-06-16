<!-- CARDS PATIENT -->
<?php if (can('dashboard.view')) : ?>

    <?php if (can('patients.view')) : ?>

        <div class="row g-4 mb-4">

            <!-- CARD PATIENT 1 -->
            <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="100">

                <div class="dashboard-card card-blue">

                    <div class="icon">
                        <i class="bi bi-people"></i>
                    </div>

                    <h3><?= $patientInAttendance ?></h3>

                    <p class="mb-0">
                        Pacientes em Atendimento
                    </p>

                </div>

            </div>

            <!-- CARD PATIENT 2 -->
            <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="200">

                <div class="dashboard-card card-green">

                    <div class="icon">
                        <i class="bi bi-calendar-check"></i>
                    </div>

                    <h3><?= $patientHospitalized ?></h3>

                    <p class="mb-0">
                        Pacientes Internados
                    </p>

                </div>

            </div>

            <!-- CARD PATIENT 3 -->
            <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="300">

                <div class="dashboard-card card-beige">

                    <div class="icon bg-white">
                        <i class="bi bi-heart-pulse text-primary"></i>
                    </div>

                    <h3><?= $patientFinished ?></h3>

                    <p class="mb-0">
                        Pacientes Finalizados
                    </p>

                </div>

            </div>

            <!-- CARD PATIENT 4 -->
            <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="400">

                <div class="dashboard-card card-yellow">

                    <div class="icon bg-white">
                        <i class="bi bi-clipboard2-pulse text-warning"></i>
                    </div>

                    <h3><?= $patientPendingRequests ?></h3>

                    <p class="mb-0">
                        Solicitações Pendentes
                    </p>

                </div>

            </div>

        </div>
    <?php endif; ?>


    <?php if (can('triage.view')) : ?>

        <!-- CARDS TRIAGE-->
        <div class="row g-4 mb-4">

            <!-- CARD TRIAGE 1 -->
            <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="100">

                <div class="dashboard-card card-blue">

                    <div class="icon">
                        <i class="bi bi-people"></i>
                    </div>

                    <h3><?= $triagePatients ?></h3>

                    <p class="mb-0">
                        Pacientes em Triagem
                    </p>

                </div>

            </div>

            <!-- CARD TRIAGE 2 -->
            <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="200">

                <div class="dashboard-card card-green">

                    <div class="icon">
                        <i class="bi bi-calendar-check"></i>
                    </div>

                    <h3><?= $triageWarning ?></h3>

                    <p class="mb-0">
                        Próximos do Prazo
                    </p>

                </div>

            </div>

            <!-- CARD TRIAGE 3 -->
            <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="300">

                <div class="dashboard-card card-beige">

                    <div class="icon bg-white">
                        <i class="bi bi-heart-pulse text-primary"></i>
                    </div>

                    <h3><?= $triageExpired ?></h3>

                    <p class="mb-0">
                        Fora do Prazo
                    </p>

                </div>

            </div>

            <!-- CARD TRIAGE 4 -->
            <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="400">

                <div class="dashboard-card card-yellow">

                    <div class="icon bg-white">
                        <i class="bi bi-clipboard2-pulse text-warning"></i>
                    </div>

                    <h3><?= $triagePendingRequests ?></h3>

                    <p class="mb-0">
                        Exames Pendentes
                    </p>

                </div>

            </div>

        </div>
    <?php endif; ?>

<?php endif; ?>