<div class="modal fade"
    id="modalPatient"
    tabindex="-1">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content border-0 rounded-4">

            <!-- HEADER -->

            <div class="modal-header border-0 p-4">

                <div>

                    <h4 class="fw-bold mb-1">
                        Novo Paciente
                    </h4>

                    <p class="text-muted mb-0">
                        Cadastro inicial da central de triagem.
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
                                Nome Completo
                            </label>

                            <div class="input-modern">

                                <i class="bi bi-person"></i>

                                <input type="text"
                                    class="form-control form-control-lg"
                                    placeholder="Digite o nome">

                            </div>

                        </div>

                        <!-- PRONTUARIO -->

                        <div class="col-md-6">

                            <label class="form-label">
                                Prontuário
                            </label>

                            <div class="input-modern">

                                <i class="bi bi-file-earmark-medical"></i>

                                <input type="text"
                                    class="form-control form-control-lg"
                                    placeholder="Digite o prontuário">

                            </div>

                        </div>

                        <!-- ESPECIALIDADE -->

                        <div class="col-md-6">

                            <label class="form-label">
                                Especialidade
                            </label>

                            <select class="form-select form-select-lg">

                                <option>
                                    Cardiologia
                                </option>

                                <option>
                                    Neurologia
                                </option>

                                <option>
                                    Ortopedia
                                </option>

                            </select>

                        </div>

                        <!-- TELEFONE -->

                        <div class="col-md-6">

                            <label class="form-label">
                                Telefone
                            </label>

                            <div class="input-modern">

                                <i class="bi bi-telephone"></i>

                                <input type="text"
                                    class="form-control form-control-lg"
                                    placeholder="Digite o telefone">

                            </div>

                        </div>

                        <!-- DATA ATENDIMENTO -->

                        <div class="col-md-6">

                            <label class="form-label">
                                Data Atendimento
                            </label>

                            <input type="date"
                                class="form-control form-control-lg">

                        </div>

                        <!-- DATA CONSULTA -->

                        <div class="col-md-6">

                            <label class="form-label">
                                Data Consulta
                            </label>

                            <input type="date"
                                class="form-control form-control-lg">

                        </div>

                        <!-- EXAMES -->

                        <div class="col-md-6">

                            <label class="form-label">
                                Exames Prontos
                            </label>

                            <select class="form-select form-select-lg">

                                <option>
                                    SIM
                                </option>

                                <option>
                                    NÃO
                                </option>

                            </select>

                        </div>

                        <!-- PREVIOS -->

                        <div class="col-md-6">

                            <label class="form-label">
                                Exames Prévios
                            </label>

                            <select class="form-select form-select-lg">

                                <option>
                                    SIM
                                </option>

                                <option>
                                    NÃO
                                </option>

                            </select>

                        </div>

                        <!-- OBS -->

                        <div class="col-12">

                            <label class="form-label">
                                Observação
                            </label>

                            <textarea class="form-control"
                                rows="4"
                                placeholder="Digite observações da triagem..."></textarea>

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

                        Salvar Paciente

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>