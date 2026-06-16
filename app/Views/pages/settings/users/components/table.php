<div class="table-container" data-aos="fade-up" data-aos-delay="200">

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
                <?php if (!empty($users)): ?>

                    <?php foreach ($users as $user): ?>

                        <tr>

                            <td>

                                <div class="d-flex align-items-center gap-3">

                                    <div>

                                        <strong>

                                            <?= esc($user['name']) ?>

                                        </strong>

                                        <small class="d-block text-muted">

                                            <?= !empty($user['last_login'])

                                                ? 'Último acesso: ' .
                                                date(
                                                    'd/m/Y H:i',
                                                    strtotime(
                                                        $user['last_login']
                                                    )
                                                )

                                                : 'Nunca acessou'; ?>

                                        </small>

                                    </div>

                                </div>

                            </td>

                            <td>

                                <?= esc($user['email']) ?>

                            </td>

                            <td>

                                <span class="custom-badge primary">

                                    <?= esc($user['role']) ?>

                                </span>

                            </td>

                            <td>

                                <span class="custom-badge <?= $user['status'] == 'ACTIVE' ? 'success' : 'danger' ?>">

                                    <?= $user['status'] == 'ACTIVE'
                                        ? 'Ativo'
                                        : 'Inativo' ?>

                                </span>

                            </td>

                            <td>

                                <div class="d-flex gap-2">

                                    <button
                                        class="btn-action btnEditUser"
                                        data-id="<?= $user['id'] ?>">

                                        <i class="bi bi-pencil"></i>

                                    </button>

                                    <button
                                        class="btn-action btn-action-danger btnDeleteUser"
                                        data-id="<?= $user['id'] ?>">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td colspan="5"
                            class="text-center py-5 text-muted">

                            Nenhum usuoario encontrado.

                        </td>

                    </tr>

                <?php endif; ?>
            </tbody>

        </table>

    </div>

</div>