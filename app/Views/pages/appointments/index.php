<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <!-- HEADER -->

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4"
        data-aos="fade-down">

        <div>

            <h2 class="fw-bold mb-1">
                Central de Atendimentos
            </h2>

            <p class="text-muted mb-0">
                Controle e rastreamento dos atendimentos hospitalares.
            </p>

        </div>

        <button class="btn btn-primary rounded-4 px-4">

            <i class="bi bi-plus-circle me-2"></i>

            Nova Solicitação

        </button>

    </div>

    <!-- CARDS -->

    <div class="row g-4 mb-4">

        <!-- CARD -->

        <div class="col-md-6 col-xl-3"
            data-aos="fade-up"
            data-aos-delay="100">

            <div class="dashboard-card card-blue">

                <div class="icon">

                    <i class="bi bi-calendar-check"></i>

                </div>

                <h3>
                    24
                </h3>

                <p class="mb-0">
                    Atendimentos Hoje
                </p>

            </div>

        </div>

        <!-- CARD -->

        <div class="col-md-6 col-xl-3"
            data-aos="fade-up"
            data-aos-delay="200">

            <div class="dashboard-card card-green">

                <div class="icon">

                    <i class="bi bi-check-circle"></i>

                </div>

                <h3>
                    18
                </h3>

                <p class="mb-0">
                    Finalizados
                </p>

            </div>

        </div>

        <!-- CARD -->

        <div class="col-md-6 col-xl-3"
            data-aos="fade-up"
            data-aos-delay="300">

            <div class="dashboard-card card-yellow">

                <div class="icon bg-white">

                    <i class="bi bi-clock text-warning"></i>

                </div>

                <h3>
                    5
                </h3>

                <p class="mb-0">
                    Em Andamento
                </p>

            </div>

        </div>

        <!-- CARD -->

        <div class="col-md-6 col-xl-3"
            data-aos="fade-up"
            data-aos-delay="400">

            <div class="dashboard-card card-beige">

                <div class="icon bg-white">

                    <i class="bi bi-exclamation-triangle text-danger"></i>

                </div>

                <h3>
                    2
                </h3>

                <p class="mb-0">
                    Urgentes
                </p>

            </div>

        </div>

    </div>

    <!-- GRID -->

    <div class="row g-4">

        <!-- CALENDAR -->

        <div class="col-lg-8"
            data-aos="fade-right">

            <div class="calendar-card">

                <div class="calendar-header">

                    <div>

                        <h5 class="fw-bold mb-1">
                            Calendário de Atendimentos
                        </h5>

                        <small class="text-muted">
                            Visualização das solicitações
                        </small>

                    </div>

                </div>

                <div id="calendar"></div>

            </div>

        </div>

        <!-- SIDE -->

        <div class="col-lg-4"
            data-aos="fade-left">

            <div class="appointment-side">

                <div class="side-header">

                    <h5 class="fw-bold mb-0">
                        Atendimentos do Dia
                    </h5>

                </div>

                <!-- ITEM -->

                <div class="appointment-item">

                    <div class="appointment-color bg-primary"></div>

                    <div>

                        <strong>
                            Maria Silva
                        </strong>

                        <small class="d-block text-muted">
                            Cardiologia • 09:00
                        </small>

                    </div>

                </div>

                <!-- ITEM -->

                <div class="appointment-item">

                    <div class="appointment-color bg-success"></div>

                    <div>

                        <strong>
                            João Pedro
                        </strong>

                        <small class="d-block text-muted">
                            Neurologia • 11:30
                        </small>

                    </div>

                </div>

                <!-- ITEM -->

                <div class="appointment-item">

                    <div class="appointment-color bg-danger"></div>

                    <div>

                        <strong>
                            Fernanda Lima
                        </strong>

                        <small class="d-block text-muted">
                            Emergência • 13:00
                        </small>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>