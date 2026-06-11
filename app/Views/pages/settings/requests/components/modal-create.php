<div class="modal fade" id="modalRequest" tabindex="-1">

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

            <form id="formRequest"
                action="<?= base_url('settings/requests/store') ?>"
                method="POST">

                <div class="modal-body px-4">

                    <!-- NOME -->
                    <div class="mb-4">

                        <label class="form-label">
                            Nome da Solicitação
                        </label>

                        <input type="text"
                            name="name"
                            required
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
                                name="deadline_days"
                                id="deadline_days"
                                required
                                class="form-control form-control-lg"
                                placeholder="0">

                            <span class="input-group-text">
                                Dias
                            </span>

                        </div>

                    </div>

                    <!-- EXAME EXTERNO -->
                    <div class="mb-4">

                        <label class="form-label">
                            Tipo da Solicitação
                        </label>

                        <select name="is_external"
                            id="is_external"
                            class="form-select form-select-lg">

                            <option value="0">

                                Interno

                            </option>

                            <option value="1">

                                Externo

                            </option>

                        </select>

                    </div>

                    <!-- STATUS -->
                    <div class="mb-4">

                        <label class="form-label">
                            Status
                        </label>

                        <select name="status"
                            required
                            class="form-select form-select-lg">

                            <option value="ACTIVE">
                                Ativo
                            </option>

                            <option value="INACTIVE">
                                Inativo
                            </option>

                        </select>

                    </div>

                    <!-- DESCRIÇÃO -->
                    <div class="mb-4">

                        <label class="form-label">
                            Descrição
                        </label>

                        <textarea name="description"
                            class="form-control"
                            required
                            rows="2"
                            placeholder="Digite uma descrição da solicitação..."></textarea>

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
                        id="btnSaveRequest"
                        class="btn btn-primary btn-lg rounded-4 px-4">

                        <i class="bi bi-check-circle me-2"></i>

                        Salvar

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>