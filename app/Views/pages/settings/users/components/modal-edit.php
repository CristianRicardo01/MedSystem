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

            <form>

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
                                    value="Administrador"
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

                                <input type="email"
                                    value="admin@sistema.com"
                                    class="form-control form-control-lg">

                            </div>

                        </div>

                        <!-- PERFIL -->

                        <div class="col-md-6">

                            <label class="form-label">
                                Perfil
                            </label>

                            <select class="form-select form-select-lg">

                                <option selected>
                                    Administrador
                                </option>

                                <option>
                                    Usuário
                                </option>

                            </select>

                        </div>

                        <!-- STATUS -->

                        <div class="col-md-6">

                            <label class="form-label">
                                Status
                            </label>

                            <select class="form-select form-select-lg">

                                <option selected>
                                    Ativo
                                </option>

                                <option>
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

                                <input type="password"
                                    class="form-control form-control-lg"
                                    placeholder="Digite a nova senha">

                            </div>

                        </div>

                        <!-- CONFIRMAR -->

                        <div class="col-md-6">

                            <label class="form-label">
                                Confirmar Senha
                            </label>

                            <div class="input-modern">

                                <i class="bi bi-shield-lock"></i>

                                <input type="password"
                                    class="form-control form-control-lg"
                                    placeholder="Confirme a nova senha">

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

                    <button type="submit"
                        class="btn btn-primary btn-lg rounded-4 px-4">

                        <i class="bi bi-check-circle me-2"></i>

                        Atualizar

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>