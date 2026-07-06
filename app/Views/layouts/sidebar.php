<aside class="sidebar" id="sidebar">

    <div class="sidebar-logo">

        <h3>
            <i class="bi bi-heart-pulse-fill"></i>
            <!-- Tracking -->
            <!-- System -->
            ERP Hospitalar
        </h3>

    </div>

    <div class="sidebar-menu">

        <div class="menu-title">
            Principal
        </div>

        <!-- Dashboard -->
        <?php if (can('dashboard.view')) : ?>

            <a href="<?= base_url('/dashboard') ?>"
                class="sidebar-link <?= activeMenu('dashboard') ?>">

                <i class="bi bi-grid"></i>

                Dashboard

            </a>

        <?php endif; ?>

        <!-- Pacientes -->
        <?php if (can('patients.view')) : ?>
            <a href="<?= base_url('patients') ?>"
                class="sidebar-link <?= activeMenu('patients') ?>">

                <i class="bi bi-people"></i>
                Pacientes

            </a>
        <?php endif; ?>

        <!-- Central Triagem -->
        <?php if (can('triage.view')) : ?>
            <a href="<?= base_url('triage') ?>"
                class="sidebar-link <?= activeMenu('triage') ?>">

                <i class="bi bi-clipboard2-pulse"></i>

                Central Triagem

            </a>
        <?php endif; ?>

        <!-- Consultas -->
        <!-- <1?php if (can('appointments.view')) : ?>
            <a href="<1?= base_url('appointments') ?>"
                class="sidebar-link <1?= activeMenu('appointments') ?>">

                <i class="bi bi-calendar-check"></i>
                Consultas

            </a>
        <1?php endif; ?> -->

        <!-- Internações -->
        <?php if (can('hospitalization.view')) : ?>
            <a href="<?= base_url('hospitalization') ?>"
                class="sidebar-link <?= activeMenu('hospitalization') ?>">

                <i class="bi bi-hospital"></i>
                Internações

            </a>
        <?php endif; ?>

        <?php if (
            can('requests.view') ||
            can('specialties.view') ||
            isAdmin()
        ) : ?>

            <div class="menu-title">
                Gestão
            </div>

        <?php endif; ?>

        <!-- Solicitações -->
        <?php if (can('requests.view')) : ?>

            <a href="<?= base_url('settings/requests') ?>"
                class="sidebar-link <?= activeMenu('requests') ?>">

                <i class="bi bi-clipboard2-pulse"></i>

                Solicitações

            </a>
        <?php endif; ?>

        <!-- Especialidades -->
        <?php if (can('specialties.view')) : ?>

            <a href="<?= base_url('settings/specialties') ?>"
                class="sidebar-link <?= activeMenu('specialties') ?>">

                <i class="bi bi-heart-pulse"></i>

                Especialidades

            </a>
        <?php endif; ?>

        <!-- Relatórios -->
        <?php if (can('reports.view')) : ?>

            <li class="nav-item">

                <a class="sidebar-link collapsed"
                    data-bs-toggle="collapse"
                    href="#reportsMenu">

                    <i class="bi bi-file-earmark-bar-graph"></i>

                    <span>Relatórios</span>

                    <i class="bi bi-chevron-down ms-auto"></i>

                </a>

                <div class="collapse <?= activeCollapse('reports') ?>" id="reportsMenu">

                    <ul class="btn-toggle-nav list-unstyled">

                        <li>
                            <a href="<?= base_url('reports/exams') ?>"
                                class="<?= activeMenu('reports/exams') ?>">
                                Exames
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url('reports/patients') ?>"
                                class="<?= activeMenu('reports/patients') ?>">
                                Pacientes
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url('reports/consultations') ?>"
                                class="<?= activeMenu('reports/consultations') ?>">
                                Consultas
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url('reports/sla') ?>"
                                class="<?= activeMenu('reports/sla') ?>">
                                SLA 60 dias
                            </a>
                        </li>

                    </ul>

                </div>

            </li>

        <?php endif; ?>

        <!-- Configurações -->
        <?php if (can('reports.indicators.view')) : ?>

            <a href="<?= base_url('reports/indicators') ?>"
                class="sidebar-link <?= activeMenu('indicators') ?>">

                <i class="bi bi-bar-chart"></i>

                Indicadores

            </a>
        <?php endif; ?>

        <!-- USUÁRIOS -->
        <?php if (can('users.view')) : ?>
            <a href="<?= base_url('settings/users') ?>"
                class="sidebar-link <?= activeMenu('users') ?>">

                <i class="bi bi-people"></i>

                Usuários

            </a>
        <?php endif; ?>

        <!-- LOGOUT -->
        <div class="sidebar-footer">

            <a href="<?= base_url('logout') ?>"
                class="sidebar-link logout-link">

                <i class="bi bi-box-arrow-left"></i>

                Sair

            </a>

        </div>

    </div>

</aside>