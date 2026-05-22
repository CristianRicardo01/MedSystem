<!-- MODAL EDIT -->

<div class="modal fade"
    id="modalEditSpecialty"
    tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 rounded-4">

            <!-- HEADER -->

            <div class="modal-header border-0 p-4">

                <div>

                    <h4 class="fw-bold mb-1">

                        Editar Especialidade

                    </h4>

                    <p class="text-muted mb-0">

                        Atualize as informações.

                    </p>

                </div>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <!-- FORM -->

            <form id="formEditSpecialty"
                method="POST">

                <input type="hidden"
                    name="id"
                    id="edit_id">

                <div class="modal-body px-4">

                    <!-- NAME -->

                    <div class="mb-4">

                        <label class="form-label">
                            Nome
                        </label>

                        <input type="text"
                            name="name"
                            id="edit_name"
                            required
                            class="form-control form-control-lg">

                    </div>

                    <!-- STATUS -->

                    <div class="mb-4">

                        <label class="form-label">
                            Status
                        </label>

                        <select name="status"
                            id="edit_status"
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
                            id="edit_description"
                            rows="2"
                            class="form-control"></textarea>

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
                        id="btnUpdateSpecialty"
                        class="btn btn-primary btn-lg rounded-4 px-4">

                        <i class="bi bi-check-circle me-2"></i>

                        Atualizar

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>