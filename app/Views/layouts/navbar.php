<nav class="top-navbar d-flex align-items-center justify-content-between">

    <div class="d-flex align-items-center gap-3">

        <button class="btn btn-light mobile-toggle"
            id="toggleSidebar">

            <i class="bi bi-list"></i>

        </button>

        <div>

            <h5 class="mb-0 fw-bold">
                Dashboard Hospitalar
            </h5>

            <small class="text-muted">
                Sistema de Gestão
            </small>

        </div>

    </div>

    <div class="d-flex align-items-center gap-4">

        <div class="search-box d-none d-md-block">

            <i class="bi bi-search"></i>

            <input type="text"
                placeholder="Pesquisar...">

        </div>
        <div class="dropdown">

            <button class="btn position-relative" data-bs-toggle="dropdown">

                <i class="bi bi-bell fs-5"></i>

                <span id="alertCount" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    0
                </span>

            </button>
            <div
                id="alertsContainer"
                class="dropdown-menu dropdown-menu-end p-0"
                style="width:350px;">

            </div>

        </div>

        <div class="profile-box">

            <!-- <img src="https://i.pravatar.cc/100"
                alt=""> -->

            <div class="d-none d-md-block">

                <div class="dropdown">

                    <a
                        href="#"
                        class="dropdown-toggle text-decoration-none text-dark"
                        data-bs-toggle="dropdown">

                        <strong>
                            <?= userName() ?>
                        </strong>

                        <br>

                        <small class="text-muted">
                            <?= userEmail() ?>
                        </small>

                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">

                        <li>

                            <a class="dropdown-item" href="<?= base_url('profile') ?>">

                                <i class=" bi bi-person"></i>

                                Meu Perfil

                            </a>

                        </li>

                        <li>

                            <a
                                class="dropdown-item"
                                href="<?= base_url('logout') ?>">

                                <i class="bi bi-box-arrow-right"></i>

                                Sair

                            </a>

                        </li>

                    </ul>

                </div>
            </div>

        </div>

    </div>

</nav>