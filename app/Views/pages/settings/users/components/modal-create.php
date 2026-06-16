<div class="modal fade" id="modalUser" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content border-0 rounded-4">

            <!-- HEADER -->

            <div class="modal-header border-0 p-4">

                <div>

                    <h4 class="fw-bold mb-1">
                        Novo Usuário
                    </h4>

                    <p class="text-muted mb-0">
                        Cadastro de acesso ao sistema.
                    </p>

                </div>

                <button type="button" class="btn-close" data-bs-dismiss="modal"> </button>

            </div>

            <!-- FORM -->

            <form id="formUser">

                <div class="modal-body px-4">

                    <div class="row g-4">

                        <!-- NOME -->

                        <div class="col-md-6">

                            <label class="form-label">
                                Nome
                            </label>

                            <div class="input-modern">

                                <i class="bi bi-person"></i>

                                <input type="text"
                                    name="name"
                                    id="user_name"
                                    class="form-control form-control-lg"
                                    placeholder="Digite o nome">

                            </div>

                        </div>

                        <!-- EMAIL -->

                        <div class="col-md-6">

                            <label class="form-label">
                                Email
                            </label>

                            <div class="input-modern">

                                <i class="bi bi-envelope"></i>

                                <input type="email"
                                    name="email"
                                    id="user_email"
                                    class="form-control form-control-lg"
                                    placeholder="Digite o email">

                            </div>

                        </div>

                        <!-- PERFIL -->
                        <div class="col-md-6">
                            <label class="form-label">
                                Perfil
                            </label>

                            <select
                                class="form-select form-select-lg"
                                name="role"
                                id="user_role">

                                <option value="">
                                    Selecione
                                </option>
                                
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
                                class="form-select form-select-lg"
                                name="status"
                                id="user_status">

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
                                Senha
                            </label>

                            <div class="input-modern">

                                <i class="bi bi-lock"></i>

                                <input
                                    type="password"
                                    name="password"
                                    id="user_password"
                                    class="form-control form-control-lg"
                                    placeholder="Digite a senha">

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
                                    id="confirm_password"
                                    class="form-control form-control-lg"
                                    placeholder="Confirme a senha">

                            </div>

                        </div>

                    </div>

                </div>

                <!-- FOOTER -->

                <div class="modal-footer border-0 p-4">

                    <button type="button" class="btn btn-light btn-lg rounded-4" data-bs-dismiss="modal">

                        Cancelar

                    </button>

                    <button
                        type="submit"
                        id="btnSaveUser"
                        class="btn btn-primary btn-lg rounded-4 px-4">

                        <i class="bi bi-check-circle me-2"></i>

                        Salvar Usuário

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>