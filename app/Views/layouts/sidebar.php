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
        <?php if (can('appointments.view')) : ?>
            <a href="<?= base_url('appointments') ?>"
                class="sidebar-link <?= activeMenu('appointments') ?>">

                <i class="bi bi-calendar-check"></i>
                Consultas

            </a>
        <?php endif; ?>

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
        <?php if (can('#.view')) : ?>

            <a href="<?= base_url('#') ?>"
                class="sidebar-link <?= activeMenu('#') ?>">

                <i class="bi bi-file-earmark-medical"></i>
                Relatórios

            </a>
        <?php endif; ?>

        <!-- Configurações -->
        <?php if (can('#.view')) : ?>

            <a href="<?= base_url('#') ?>"
                class="sidebar-link <?= activeMenu('#') ?>">

                <i class="bi  bi-gear"></i>
                Configurações

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