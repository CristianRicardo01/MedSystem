<div class="modal fade" id="modalEditPatient" tabindex="-1">

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

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

            </div>

            <!-- FORM -->

            <form id="formEditPatient"
                action="<?= base_url('triage/update-patient') ?>"
                method="POST">

                <input type="hidden" name="id" id="edit_id">

                <div class="modal-body px-4">

                    <div class="row g-4">

                        <!-- NOME -->
                        <div class="col-md-12">

                            <label class="form-label">
                                Nome Completo
                            </label>

                            <div class="input-modern">

                                <i class="bi bi-person"></i>

                                <input type="text"
                                    id="edit_name"
                                    name="name" required
                                    class="form-control form-control-lg"
                                    placeholder="Digite o nome">

                            </div>

                        </div>

                        <!-- PRONTUARIO -->
                        <div class="col-md-4">

                            <label class="form-label">
                                Prontuário
                            </label>

                            <div class="input-modern">

                                <i class="bi bi-file-earmark-medical"></i>

                                <input type="text"
                                    id="edit_medical_record"
                                    name="medical_record" required
                                    class="form-control form-control-lg"
                                    placeholder="Digite o prontuário">

                            </div>

                        </div>

                        <!-- CPF -->
                        <div class="col-md-4">

                            <label class="form-label">
                                CPF
                            </label>

                            <div class="input-modern">

                                <i class="bi bi-file-earmark-medical"></i>

                                <input type="text"
                                    id="edit_cpf"
                                    name="cpf"
                                    class="form-control form-control-lg"
                                    placeholder="Digite o CPF">

                            </div>

                        </div>

                        <!-- TELEFONE -->
                        <div class="col-md-4">

                            <label class="form-label">
                                Telefone
                            </label>

                            <div class="input-modern">

                                <i class="bi bi-telephone"></i>

                                <input type="text"
                                    id="edit_phone"
                                    name="phone"
                                    class="form-control form-control-lg"
                                    placeholder="Digite o telefone">

                            </div>

                        </div>

                        <!-- ESPECIALIDADE -->
                        <div class="col-md-6">

                            <label class="form-label">
                                Especialidade
                            </label>

                            <select name="specialty_id" required
                                class="form-select form-select-lg">

                                <?php foreach ($specialties as $specialty): ?>

                                    <option value="<?= $specialty['id'] ?>">

                                        <?= esc($specialty['name']) ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                        <!-- EXAMES -->
                        <div class="col-md-6">

                            <label class="form-label">
                                Possui Exames Solicitados?
                            </label>

                            <select name="has_exams" required
                                class="form-select form-select-lg">

                                <option value="1">
                                    SIM
                                </option>

                                <option value="0">
                                    NÃO
                                </option>

                            </select>

                        </div>

                        <!-- DATA ATENDIMENTO -->
                        <div class="col-md-6">

                            <label class="form-label">
                                Data Triagem
                            </label>

                            <input type="date"
                                id="edit_first_service_date"
                                name="first_service_date" required
                                class="form-control form-control-lg">

                        </div>

                        <!-- DATA CONSULTA -->
                        <div class="col-md-6">

                            <label class="form-label">
                                Data Consulta
                            </label>

                            <input type="date"
                                id="edit_first_consultation_date"
                                name="first_consultation_date" required
                                class="form-control form-control-lg">

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

                    <button id="btnUpdatePatient"
                        type="submit"
                        class="btn btn-primary btn-lg rounded-4 px-4">

                        <i class="bi bi-check-circle me-2"></i>

                        Salvar Paciente

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>