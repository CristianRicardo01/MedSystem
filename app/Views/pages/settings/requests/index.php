<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <!-- HEADER -->

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4"
        data-aos="fade-down">

        <div>

            <h2 class="fw-bold mb-1">
                Configuração de Solicitações
            </h2>

            <p class="text-muted mb-0">
                Gerencie os tipos de solicitações e seus prazos.
            </p>

        </div>

        <!-- BTN -->

        <button class="btn btn-primary rounded-4 px-4"
            data-bs-toggle="modal"
            data-bs-target="#modalRequest">

            <i class="bi bi-plus-circle me-2"></i>

            Nova Solicitação

        </button>

    </div>

    <!-- TABLE -->

    <div class="table-container"
        data-aos="fade-up"
        data-aos-delay="200">

        <!-- HEADER -->

        <div class="table-header d-flex justify-content-between align-items-center flex-wrap gap-3">

            <div>

                <h5 class="fw-bold mb-1">
                    Solicitações Cadastradas
                </h5>

                <small class="text-muted">
                    Controle administrativo das solicitações
                </small>

            </div>

            <!-- SEARCH -->

            <div class="table-search">

                <i class="bi bi-search"></i>

                <input type="text"
                    placeholder="Pesquisar solicitação...">

            </div>

        </div>

        <!-- TABLE -->

        <div class="table-responsive">

            <table class="table align-middle request-table">

                <thead>

                    <tr>

                        <th>Solicitação</th>
                        <th>Prazo Conclusão</th>
                        <th>Status</th>
                        <th width="140">Ações</th>

                    </tr>

                </thead>

                <tbody>

                    <!-- ITEM -->

                    <tr>

                        <td>

                            <div class="d-flex align-items-center gap-3">

                                <div>

                                    <strong>
                                        eletrocardiograma
                                    </strong>

                                    <small class="d-block text-muted">
                                        Atendimento especializado
                                    </small>

                                </div>

                            </div>

                        </td>

                        <td>

                            <span class="custom-badge warning">

                                60 Dias

                            </span>

                        </td>

                        <td>

                            <span class="custom-badge success">

                                Ativo

                            </span>

                        </td>

                        <!-- ACTIONS -->

                        <td>

                            <div class="d-flex gap-2">

                                <!-- EDIT -->

                                <button class="btn-action">

                                    <i class="bi bi-pencil"></i>

                                </button>

                                <!-- DELETE -->

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
                                        Internação
                                    </strong>

                                    <small class="d-block text-muted">
                                        Processo hospitalar
                                    </small>

                                </div>

                            </div>

                        </td>

                        <td>

                            <span class="custom-badge danger">

                                30 Dias

                            </span>

                        </td>

                        <td>

                            <span class="custom-badge success">

                                Ativo

                            </span>

                        </td>

                        <td>

                            <div class="d-flex gap-2">

                                <button class="btn-action">

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

</div>

<!-- MODAL -->

<div class="modal fade"
    id="modalRequest"
    tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 rounded-4">

            <!-- HEADER -->

            <div class="modal-header border-0 p-4">

                <div>

                    <h4 class="fw-bold mb-1">
                        Nova Solicitação
                    </h4>

                    <p class="text-muted mb-0">
                        Cadastro administrativo de solicitação.
                    </p>

                </div>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <!-- FORM -->

            <form>

                <div class="modal-body px-4">

                    <!-- NOME -->

                    <div class="mb-4">

                        <label class="form-label">
                            Nome da Solicitação
                        </label>

                        <input type="text"
                            class="form-control form-control-lg"
                            placeholder="Digite o nome">

                    </div>

                    <!-- PRAZO -->

                    <div class="mb-4">

                        <label class="form-label">
                            Prazo para Conclusão
                        </label>

                        <div class="input-group">

                            <input type="number"
                                class="form-control form-control-lg"
                                placeholder="0">

                            <span class="input-group-text">
                                Dias
                            </span>

                        </div>

                    </div>

                    <!-- STATUS -->

                    <div class="mb-4">

                        <label class="form-label">
                            Status
                        </label>

                        <select class="form-select form-select-lg">

                            <option>
                                Ativo
                            </option>

                            <option>
                                Inativo
                            </option>

                        </select>

                    </div>

                </div>

                <!-- FOOTER -->

                <div class="modal-footer border-0 p-4">

                    <button type="button"
                        class="btn btn-light btn-lg rounded-4"
                        data-bs-dismiss="modal">

                        Cancelar

                    </button>

                    <button type="submit"
                        class="btn btn-primary btn-lg rounded-4 px-4">

                        <i class="bi bi-check-circle me-2"></i>

                        Salvar

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<?= $this->endSection() ?>