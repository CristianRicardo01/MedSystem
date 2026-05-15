<div class="modal fade"
    id="modalPatient"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">

        <div class="modal-content border-0 rounded-4 shadow-lg">

            <!-- HEADER -->

            <div class="modal-header border-0 p-4">

                <div>

                    <h3 class="fw-bold mb-1">
                        Cadastro de Paciente
                    </h3>

                    <p class="text-muted mb-0">
                        Preencha as informações do paciente.
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

                    <!-- DADOS PRINCIPAIS -->

                    <div class="form-section mb-4">

                        <h6 class="section-title">
                            Dados Principais
                        </h6>

                        <div class="row g-4">

                            <!-- NOME -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    Nome Completo
                                </label>

                                <input type="text"
                                    class="form-control form-control-lg"
                                    placeholder="Digite o nome completo">

                            </div>

                            <!-- PRONTUARIO -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    Prontuário
                                </label>

                                <input type="text"
                                    class="form-control form-control-lg"
                                    placeholder="Número do prontuário">

                            </div>

                            <!-- ESPECIALIDADE -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    Especialidade
                                </label>

                                <select class="form-select form-select-lg">

                                    <option selected disabled>
                                        Selecione
                                    </option>

                                    <option>
                                        Cardiologia
                                    </option>

                                    <option>
                                        Pediatria
                                    </option>

                                    <option>
                                        Ortopedia
                                    </option>

                                    <option>
                                        Neurologia
                                    </option>

                                </select>

                            </div>

                            <!-- DATA PRIMEIRA CONSULTA -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    Data da Primeira Consulta
                                </label>

                                <input type="date"
                                    class="form-control form-control-lg">

                            </div>

                        </div>

                    </div>

                    <!-- EXAMES -->

                    <div class="form-section mb-4">

                        <h6 class="section-title">
                            Informações Médicas
                        </h6>

                        <div class="row g-4">

                            <!-- EXAMES PRONTOS -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    Exames Prontos
                                </label>

                                <select class="form-select form-select-lg">

                                    <option selected disabled>
                                        Selecione
                                    </option>

                                    <option value="sim">
                                        Sim
                                    </option>

                                    <option value="nao">
                                        Não
                                    </option>

                                </select>

                            </div>


                            <!-- NOME -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    Telefone de Contato
                                </label>

                                <input type="text"
                                    class="form-control form-control-lg"
                                    placeholder="69 99999-9999">

                            </div>
                        </div>

                    </div>

                    <!-- ENDEREÇO -->

                    <div class="form-section">

                        <h6 class="section-title">
                            Endereço
                        </h6>

                        <div class="row g-4">

                            <!-- ESTADO -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    Estado
                                </label>

                                <select class="form-select form-select-lg"
                                    id="estado">

                                    <option selected disabled>
                                        Selecione o estado
                                    </option>

                                    <option value="RO">
                                        Rondônia
                                    </option>

                                    <option value="AM">
                                        Amazonas
                                    </option>

                                    <option value="AC">
                                        Acre
                                    </option>

                                </select>

                            </div>

                            <!-- MUNICIPIO -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    Município
                                </label>

                                <select class="form-select form-select-lg"
                                    id="municipio"
                                    disabled>

                                    <option>
                                        Selecione o estado primeiro
                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- FOOTER -->

                <div class="modal-footer border-0 p-4">

                    <button type="button"
                        class="btn btn-light btn-lg"
                        data-bs-dismiss="modal">

                        Cancelar

                    </button>

                    <button type="submit"
                        class="btn btn-primary btn-lg px-5">

                        <i class="bi bi-check-circle me-2"></i>
                        Salvar Paciente

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>