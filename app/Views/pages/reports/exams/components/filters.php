<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white">

        <strong>

            <i class="bi bi-funnel"></i>

            Filtros

        </strong>

    </div>

    <div class="card-body">

        <form id="formFilters" method="GET" action="<?= current_url() ?>">

            <div class="row">

                <!-- Data Inicial -->

                <div class="col-md-2">

                    <label class="form-label">

                        Data Inicial

                    </label>

                    <input
                        type="date"
                        name="start_date"
                        value="<?= esc($filters['start_date'] ?? '') ?>"
                        class="form-control">

                </div>

                <!-- Data Final -->

                <div class="col-md-2">

                    <label class="form-label">

                        Data Final

                    </label>

                    <input
                        type="date"
                        name="end_date"
                        value="<?= esc($filters['end_date'] ?? '') ?>"
                        class="form-control">

                </div>

                <!-- Exames -->

                <div class="col-md-4">

                    <label class="form-label">

                        Exame

                    </label>

                    <select
                        name="request_type"
                        id="filter_request_type"
                        class="form-select">

                        <option value="">

                            Todos

                        </option>

                        <?php foreach ($requestTypes as $type): ?>

                            <option
                                value="<?= $type['id'] ?>"
                                <?= (($filters['request_type'] ?? '') == $type['id']) ? 'selected' : '' ?>>

                                <?= esc($type['name']) ?>

                            </option>
                        <?php endforeach; ?>

                    </select>

                </div>

                <!-- Status -->

                <div class="col-md-2">

                    <label class="form-label">

                        Status

                    </label>

                    <select
                        name="status"
                        id="filter_status"
                        class="form-select">

                        <option value="">

                            Todos

                        </option>

                        <option value="PENDING">

                            Pendentes

                        </option>

                        <option value="COMPLETED">

                            Realizados

                        </option>

                    </select>

                </div>

                <!-- Pesquisar -->

                <div class="col-md d-flex align-items-end">

                    <button
                        type="submit"
                        class="btn btn-success w-100">

                        <i class="bi bi-search me-2"></i>

                        Filtrar

                    </button>
                    <a
                        href="<?= current_url() ?>"
                        class="btn btn-outline-secondary px-4 ms-2"
                        title="Limpar filtros">

                        <i class="bi bi-arrow-clockwise"></i>

                    </a>
                </div>

            </div>

        </form>

    </div>

</div>