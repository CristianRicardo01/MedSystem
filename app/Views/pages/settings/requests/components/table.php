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

</div>