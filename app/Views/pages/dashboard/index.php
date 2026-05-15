<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>


<div class="page-title mb-4" data-aos="fade-right">
    <h2>Visão Geral</h2>
    <p>Bem-vindo ao painel administrativo hospitalar.</p>
</div>

<!-- CARDS -->
<div class="row g-4 mb-4">

    <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="100">

        <div class="dashboard-card card-blue">

            <div class="icon">
                <i class="bi bi-people"></i>
            </div>

            <h3>1.245</h3>

            <p class="mb-0">
                Pacientes Ativos
            </p>

        </div>

    </div>

    <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="200">

        <div class="dashboard-card card-green">

            <div class="icon">
                <i class="bi bi-calendar-check"></i>
            </div>

            <h3>328</h3>

            <p class="mb-0">
                Consultas Hoje
            </p>

        </div>

    </div>

    <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="300">

        <div class="dashboard-card card-beige">

            <div class="icon bg-white">
                <i class="bi bi-heart-pulse text-primary"></i>
            </div>

            <h3>25</h3>

            <p class="mb-0">
                Internações
            </p>

        </div>

    </div>

    <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="400">

        <div class="dashboard-card card-yellow">

            <div class="icon bg-white">
                <i class="bi bi-clipboard2-pulse text-warning"></i>
            </div>

            <h3>17</h3>

            <p class="mb-0">
                Emergências
            </p>

        </div>

    </div>

</div>

<!-- TABLE -->
<div class="custom-table shadow-sm" data-aos="fade-up" data-aos-delay="500">

    <div class="p-4 border-bottom">
        <h5 class="mb-0 fw-bold">
            Últimos Atendimentos
        </h5>
    </div>

    <div class="table-responsive">

        <table class="table align-middle">

            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Prontuário</th>
                    <th>Especialidade</th>
                    <th>Status</th>
                    <th>Data</th>
                    <th>D60</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>Maria Silva</td>
                    <td>91500768</td>
                    <td>Cardiologia</td>
                    <td>
                        <span class="badge bg-success">
                            Finalizado
                        </span>
                    </td>
                    <td>13/05/2026</td>
                    <td>
                        <span class="badge bg-success">
                            D10
                        </span>
                    </td>
                </tr>

                <tr>
                    <td>João Pedro</td>
                    <td>91477004</td>
                    <td>Ortopedia</td>
                    <td>
                        <span class="badge bg-warning text-dark">
                            Em atendimento
                        </span>
                    </td>
                    <td>13/05/2026</td>
                    <td>
                        <span class="badge bg-warning text-dark">
                            D20
                        </span>
                    </td>
                </tr>

                <tr>
                    <td>Fernanda Lima</td>
                    <td>710243</td>
                    <td>Pediatria</td>
                    <td>
                        <span class="badge bg-primary">
                            Aguardando
                        </span>
                    </td>
                    <td>13/05/2026</td>
                    <td>
                        <span class="badge bg-warning text-dark">
                            D25
                        </span>
                    </td>
                </tr>

            </tbody>

        </table>

    </div>

</div>

<?= $this->endSection() ?>