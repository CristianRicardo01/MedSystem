<!-- MODAL -->

<div class="modal fade"
    id="modalSpecialty"
    tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 rounded-4">

            <!-- HEADER -->

            <div class="modal-header border-0 p-4">

                <div>

                    <h4 class="fw-bold mb-1">
                        Nova Especialidade
                    </h4>

                    <p class="text-muted mb-0">
                        Cadastro administrativo de especialidade médica.
                    </p>

                </div>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <!-- FORM -->

            <form id="formSpecialty"
                action="<?= base_url('settings/specialties/store') ?>"
                method="POST">

                <div class="modal-body px-4">

                    <!-- NAME -->

                    <div class="mb-4">

                        <label class="form-label">
                            Nome da Especialidade
                        </label>

                        <input type="text"
                            name="name"
                            id="specialty_name"
                            required
                            class="form-control form-control-lg"
                            placeholder="Digite o nome da especialidade">

                    </div>

                    <!-- STATUS -->

                    <div class="mb-4">

                        <label class="form-label">
                            Status
                        </label>

                        <select name="status"
                            id="specialty_status"
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

                    <!-- DESCRIPTION -->

                    <div class="mb-4">

                        <label class="form-label">
                            Descrição
                        </label>

                        <textarea name="description"
                            id="specialty_description"
                            class="form-control"
                            rows="3"
                            placeholder="Digite uma descrição da especialidade..."></textarea>

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
                        id="btnSaveSpecialty"
                        class="btn btn-primary btn-lg rounded-4 px-4">

                        <i class="bi bi-check-circle me-2"></i>

                        Salvar

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>