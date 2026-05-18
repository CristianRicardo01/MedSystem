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

        <a href="<?= base_url('/dashboard') ?>"
            class="sidebar-link <?= activeMenu('dashboard') ?>">

            <i class="bi bi-grid"></i>
            Dashboard

        </a>

        <a href="<?= base_url('patients') ?>"
            class="sidebar-link <?= activeMenu('patients') ?>">

            <i class="bi bi-people"></i>
            Pacientes

        </a>

        <a href="<?= base_url('triage') ?>"
            class="sidebar-link <?= activeMenu('triage') ?>">

            <i class="bi bi-clipboard2-pulse"></i>

            Central Triagem

        </a>

        <a href="<?= base_url('appointments') ?>"
            class="sidebar-link <?= activeMenu('appointments') ?>">

            <i class="bi bi-calendar-check"></i>
            Consultas

        </a>

        <a href="<?= base_url('hospitalization') ?>"
            class="sidebar-link <?= activeMenu('hospitalization') ?>">

            <i class="bi bi-hospital"></i>
            Internações

        </a>


        <div class="menu-title">
            Gestão
        </div>

        <a href="<?= base_url('settings/requests') ?>"
            class="sidebar-link <?= activeMenu('requests') ?>">

            <i class="bi bi-clipboard2-pulse"></i>

            Solicitações

        </a>

        <a href="<?= base_url('#') ?>"
            class="sidebar-link <?= activeMenu('#') ?>">

            <i class="bi bi-file-earmark-medical"></i>
            Relatórios

        </a>

        <a href="<?= base_url('#') ?>"
            class="sidebar-link <?= activeMenu('#') ?>">

            <i class="bi  bi-gear"></i>
            Configurações

        </a>

        <a href="<?= base_url('settings/users') ?>"
            class="sidebar-link <?= activeMenu('users') ?>">

            <i class="bi bi-people"></i>

            Usuários

        </a>
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