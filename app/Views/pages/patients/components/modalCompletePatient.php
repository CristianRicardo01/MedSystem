<div class="modal fade" id="modalEditPatientData" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">

        <div class="modal-content border-0 rounded-4 shadow-lg">

            <!-- HEADER -->

            <div class="modal-header border-0 p-4">

                <div>

                    <h3 class="fw-bold mb-1">
                        Editar Paciente
                    </h3>

                    <p class="text-muted mb-0">
                        Atualize os dados cadastrais do paciente.
                    </p>

                </div>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>


            <!-- FORM -->
            <form id="formEditPatientData" action="<?= base_url('patients/update-data') ?>" method="POST">

                <input type="hidden" name="id" id="edit_data_id">

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
                                    name="name" required
                                    id="edit_data_name"
                                    class="form-control form-control-lg"
                                    placeholder="Digite o nome completo">

                            </div>

                            <!-- PRONTUARIO -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    Prontuário
                                </label>

                                <input type="text"
                                    name="medical_record" required
                                    id="edit_data_medical_record"
                                    class="form-control form-control-lg"
                                    placeholder="Número do prontuário">

                            </div>

                            <!-- CPF -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    CPF
                                </label>

                                <input type="text"
                                    name="cpf"
                                    id="edit_data_cpf"
                                    class="form-control form-control-lg"
                                    placeholder="Número do CPF">

                            </div>

                            <!-- ESPECIALIDADE -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    Especialidade
                                </label>

                                <select class="form-select form-select-lg"
                                    name="specialty_id"
                                    id="edit_data_specialty_id">

                                    <option value="">
                                        Selecione
                                    </option>

                                    <?php foreach (
                                        $specialties as $specialty
                                    ): ?>

                                        <option
                                            value="<?= $specialty['id'] ?>">

                                            <?= esc(
                                                $specialty['name']
                                            ) ?>

                                        </option>

                                    <?php endforeach; ?>

                                </select>

                            </div>

                            <!-- DATA PRIMEIRA CONSULTA -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    Data da Primeira Consulta
                                </label>

                                <input type="date"
                                    name="first_consultation_date" required
                                    id="edit_data_first_consultation_date"
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

                                <select class="form-select form-select-lg" name="has_exams" id="edit_data_has_exams">
                                    <option selected disabled>
                                        Selecione
                                    </option>

                                    <option value="1">
                                        Sim
                                    </option>

                                    <option value="0">
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
                                    name="phone"
                                    id="edit_data_phone"
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

                                <select
                                    class="form-select form-select-lg"
                                    name="state" required
                                    id="edit_data_state_id">
                                    <option selected disabled>
                                        Selecione
                                    </option>
                                </select>

                            </div>

                            <!-- MUNICIPIO -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    Município
                                </label>

                                <select
                                    class="form-select form-select-lg"
                                    name="city"
                                    id="edit_data_city_id"
                                    required>
                                    <option selected disabled>
                                        Selecione o município
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
                        id="btnCompletePatient"
                        class="btn btn-primary btn-lg px-5">

                        <i class="bi bi-check-circle me-2"></i>
                        Salvar Paciente

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>