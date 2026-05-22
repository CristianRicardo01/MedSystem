<!-- TABLE -->

<div class="table-responsive">

    <table class="table align-middle request-table">

        <thead>

            <tr>

                <th>Especialidades</th>
                <th>Status</th>
                <th width="140">Ações</th>

            </tr>

        </thead>

        <tbody>

            <?php foreach ($specialties as $specialty): ?>

                <tr>

                    <!-- NAME -->

                    <td>

                        <strong>

                            <?= esc($specialty['name']) ?>

                        </strong>
                        <small class="d-block text-muted">
                            <?= esc($specialty['description']) ?>
                        </small>
                    </td>


                    <!-- STATUS -->
                    <td>

                        <?php if ($specialty['status'] == 'ACTIVE'): ?>

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

                            <button class="btn-action btnEditSpecialty"

                                data-id="<?= $specialty['id'] ?>"

                                data-name="<?= esc($specialty['name']) ?>"

                                data-description="<?= esc($specialty['description']) ?>"

                                data-status="<?= $specialty['status'] ?>">

                                <i class="bi bi-pencil"></i>

                            </button>

                            <a href="<?= base_url('settings/specialties/delete/' . $specialty['id']) ?>" class="btn-action btn-action-danger btnDeleteSpecialty">

                                <i class="bi bi-trash"></i>

                            </a>
                        </div>

                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

</div>