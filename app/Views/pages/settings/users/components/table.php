<div class="table-container"
    data-aos="fade-up"
    data-aos-delay="200">

    <!-- HEADER -->

    <div class="table-header d-flex justify-content-between align-items-center flex-wrap gap-3">

        <div>

            <h5 class="fw-bold mb-1">
                Usuários Cadastrados
            </h5>

            <small class="text-muted">
                Controle de acesso do sistema
            </small>

        </div>

        <!-- SEARCH -->

        <div class="table-search">

            <i class="bi bi-search"></i>

            <input type="text"
                placeholder="Pesquisar usuário...">

        </div>

    </div>

    <!-- TABLE -->

    <div class="table-responsive">

        <table class="table align-middle users-table">

            <thead>

                <tr>

                    <th>Usuário</th>
                    <th>Email</th>
                    <th>Perfil</th>
                    <th>Status</th>
                    <th width="150">Ações</th>

                </tr>

            </thead>

            <tbody>

                <!-- ITEM -->

                <tr>

                    <td>

                        <div class="d-flex align-items-center gap-3">

                            <div>

                                <strong>
                                    Administrador
                                </strong>

                                <small class="d-block text-muted">
                                    Último acesso hoje
                                </small>

                            </div>

                        </div>

                    </td>

                    <td>

                        admin@sistema.com

                    </td>

                    <td>

                        <span class="custom-badge primary">

                            Administrador

                        </span>

                    </td>

                    <td>

                        <span class="custom-badge success">

                            Ativo

                        </span>

                    </td>

                    <td>

                        <div class="d-flex gap-2">

                            <button class="btn-action"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditUser">

                                <i class="bi bi-pencil"></i>

                            </button>

                            <button class="btn-action btn-action-danger">

                                <i class="bi bi-trash"></i>

                            </button>

                        </div>

                    </td>

                </tr>

                <!-- ITEM -->

                <tr>

                    <td>

                        <div class="d-flex align-items-center gap-3">

                            <div>

                                <strong>
                                    Maria Souza
                                </strong>

                                <small class="d-block text-muted">
                                    Último acesso ontem
                                </small>

                            </div>

                        </div>

                    </td>

                    <td>

                        maria@sistema.com

                    </td>

                    <td>

                        <span class="custom-badge warning">

                            Usuário

                        </span>

                    </td>

                    <td>

                        <span class="custom-badge success">

                            Ativo

                        </span>

                    </td>

                    <td>

                        <div class="d-flex gap-2">

                            <button class="btn-action"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditUser">

                                <i class="bi bi-pencil"></i>

                            </button>
                            <button class="btn-action btn-action-danger">

                                <i class="bi bi-trash"></i>

                            </button>

                        </div>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>