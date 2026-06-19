<div class="row g-4 mb-4">

    <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">

        <div class="info-card blue-card content-animation">

            <div>

                <small>Pacientes em Atendimento</small>

                <h3><?= $patientsInAttendance ?></h3>

            </div>

            <i class="bi bi-people"></i>

        </div>

    </div>

    <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">

        <div class="info-card green-card content-animation">

            <div>

                <small>Internados</small>

                <h3><?= $hospitalizedPatients ?></h3>


            </div>

            <i class="bi bi-heart-pulse"></i>

        </div>

    </div>

    <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">

        <div class="info-card yellow-card content-animation">

            <div>

                <small>Internados</small>

                <h3><?= $hospitalizedPatients ?></h3>


            </div>

            <i class="bi bi-person-plus"></i>

        </div>

    </div>

    <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">

        <div class="info-card beige-card content-animation">

            <div>

                <small> Exames Pendentes </small>

                <h3> <?= $pendingRequests ?> </h3>
                
            </div>

            <i class="bi bi-person-plus"></i>

        </div>

    </div>

</div>