<!-- TABLE -->

<div class="table-responsive">

    <table class="table align-middle request-table">

        <thead>

            <tr>

                <th>Solicitação</th>
                <th>Prazo Conclusão</th>
                <th>Tipo</th>
                <th>Status</th>
                <th width="140">Ações</th>

            </tr>

        </thead>

        <tbody>

            <?php foreach ($requests as $request): ?>

                <tr>

                    <!-- NAME -->

                    <td>

                        <strong>

                            <?= esc($request['name']) ?>

                        </strong>
                        <small class="d-block text-muted">
                            <?= esc($request['description']) ?>
                        </small>
                    </td>

                    <!-- DEADLINE -->

                    <td>

                        <span class="custom-badge warning">

                            <?= esc($request['deadline_days']) ?>
                            Dias

                        </span>

                    </td>

                    <!-- TIPO -->
                    <td>

                        <?php if ($request['is_external']): ?>

                            <span class="custom-badge warning">

                                Externo

                            </span>

                        <?php else: ?>

                            <span class="custom-badge success">

                                Interno

                            </span>

                        <?php endif; ?>

                    </td>

                    <!-- STATUS -->
                    <td>

                        <?php if ($request['status'] == 'ACTIVE'): ?>

                            <span class="custom-badge success">

                                Ativo

                            </span>

                        <?php else: ?>

                            <span class="custom-badge danger">

                                Inativo

                            </span>

                        <?php endif; ?>

                    </td>

                    <!-- ACTIONS -->

                    <td>
                        <div class="d-flex gap-2">

                            <button class="btn-action btnEditRequest"

                                data-id="<?= $request['id'] ?>"

                                data-name="<?= esc($request['name']) ?>"

                                data-deadline="<?= $request['deadline_days'] ?>"

                                data-description="<?= esc($request['description']) ?>"

                                data-external="<?= $request['is_external'] ?>"

                                data-status="<?= $request['status'] ?>">

                                <i class="bi bi-pencil"></i>

                            </button>

                            <a href="<?= base_url('settings/requests/delete/' . $request['id']) ?>" class="btn-action btn-action-danger btnDeleteRequest">

                                <i class="bi bi-trash"></i>

                            </a>
                        </div>

                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

    <?php
    $total = $pager->getTotal();
    $perPageAtual = $pager->getPerPage();
    $current = $pager->getCurrentPage();

    $inicio = (($current - 1) * $perPageAtual) + 1;
    $fim = min($current * $perPageAtual, $total);
    ?>

    <div class="table-footer">

        <!-- ESQUERDA -->
        <div class="table-left">

            <form method="GET" class="d-flex align-items-center gap-2">

                <?php if (!empty($search)): ?>
                    <input type="hidden"
                        name="search"
                        value="<?= esc($search) ?>">
                <?php endif; ?>

                <label class="mb-0 text-muted">
                    Mostrar
                </label>

                <select
                    class="form-select form-select-sm"
                    name="perPage"
                    onchange="this.form.submit()">

                    <option value="10" <?= $perPage == 10 ? 'selected' : '' ?>>10</option>
                    <option value="25" <?= $perPage == 25 ? 'selected' : '' ?>>25</option>
                    <option value="50" <?= $perPage == 50 ? 'selected' : '' ?>>50</option>
                    <option value="100" <?= $perPage == 100 ? 'selected' : '' ?>>100</option>

                </select>

                <span class="text-muted">
                    registros
                </span>

            </form>

        </div>

        <!-- CENTRO -->
        <div class="table-center">

            <i class="bi bi-database me-2"></i>

            Mostrando

            <strong><?= $inicio ?></strong>

            -

            <strong><?= $fim ?></strong>

            de

            <strong><?= $total ?></strong>

            registros

        </div>

        <!-- DIREITA -->
        <div class="table-right">

            <?= $pager->links() ?>

        </div>

    </div>

</div>