<div class="modal fade"
    id="modalEditUser"
    tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content border-0 rounded-4">

            <!-- HEADER -->

            <div class="modal-header border-0 p-4">

                <div>

                    <h4 class="fw-bold mb-1">
                        Editar Usuário
                    </h4>

                    <p class="text-muted mb-0">
                        Atualização dos dados do usuário.
                    </p>

                </div>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <!-- FORM -->

            <form id="formEditUser">

                <input type="hidden" name="id" id="edit_user_id">

                <div class="modal-body px-4">

                    <div class="row g-4">

                        <!-- NOME -->

                        <div class="col-md-6">

                            <label class="form-label">
                                Nome
                            </label>

                            <div class="input-modern">

                                <i class="bi bi-person"></i>

                                <input
                                    type="text"
                                    name="name"
                                    id="edit_user_name"
                                    class="form-control form-control-lg">

                            </div>

                        </div>

                        <!-- EMAIL -->

                        <div class="col-md-6">

                            <label class="form-label">
                                Email
                            </label>

                            <div class="input-modern">

                                <i class="bi bi-envelope"></i>

                                <input
                                    type="email"
                                    name="email"
                                    id="edit_user_email"
                                    class="form-control form-control-lg">

                            </div>

                        </div>

                        <!-- PERFIL -->

                        <div class="col-md-6">

                            <label class="form-label">
                                Perfil
                            </label>

                            <select
                                name="role"
                                id="edit_user_role"
                                class="form-select form-select-lg">

                                <option value="ADMIN">
                                    Administrador
                                </option>

                                <option value="REGULACAO">
                                    Regulação
                                </option>

                                <option value="TRIAGEM">
                                    Triagem
                                </option>

                                <option value="CONSULTA">
                                    Consulta
                                </option>

                                <option value="VISUALIZADOR">
                                    Visualizador
                                </option>

                            </select>

                        </div>

                        <!-- STATUS -->

                        <div class="col-md-6">

                            <label class="form-label">
                                Status
                            </label>

                            <select
                                name="status"
                                id="edit_user_status"
                                class="form-select form-select-lg">

                                <option value="ACTIVE">
                                    Ativo
                                </option>

                                <option value="INACTIVE">
                                    Inativo
                                </option>

                            </select>

                        </div>

                        <!-- SENHA -->

                        <div class="col-md-6">

                            <label class="form-label">
                                Nova Senha
                            </label>

                            <div class="input-modern">

                                <i class="bi bi-lock"></i>

                                <input
                                    type="password"
                                    name="password"
                                    id="edit_user_password"
                                    class="form-control form-control-lg"
                                    placeholder="Nova senha (opcional)">

                            </div>

                        </div>

                        <!-- CONFIRMAR -->

                        <div class="col-md-6">

                            <label class="form-label">
                                Confirmar Senha
                            </label>

                            <div class="input-modern">

                                <i class="bi bi-shield-lock"></i>

                                <input
                                    type="password"
                                    name="confirm_password"
                                    id="edit_confirm_password"
                                    class="form-control form-control-lg"
                                    placeholder="Confirmar senha">

                            </div>

                        </div>

                    </div>

                </div>

                <!-- FOOTER -->

                <div class="modal-footer border-0 p-4">

                    <button type="button"
                        class="btn btn-light btn-lg rounded-4"
                        data-bs-dismiss="modal">

                        Cancelar

                    </button>

                    <button
                        type="submit"
                        id="btnUpdateUser"
                        class="btn btn-primary btn-lg rounded-4 px-4">

                        <i class="bi bi-check-circle me-2"></i>

                        Atualizar

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>