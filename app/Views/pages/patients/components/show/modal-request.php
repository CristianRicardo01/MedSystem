<!-- MODAL SOLICITAÇÃO -->
<div class="modal fade" id="modalPatientRequest" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content border-0 rounded-4">

            <!-- HEADER -->

            <div class="modal-header border-0 p-4">

                <div>

                    <h4 class="fw-bold mb-1">

                        Nova Solicitação

                    </h4>

                    <p class="text-muted mb-0">

                        Solicitação de exames do paciente

                    </p>

                </div>

                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>

            </div>

            <!-- FORM -->

            <form id="formPatientRequestStore">

                <input type="hidden" name="patient_id" value="<?= $patient['id'] ?>">

                <div class="modal-body px-4">

                    <div class="row g-4">

                        <!-- REQUEST -->

                        <div class="col-md-12">

                            <label class="form-label">

                                Solicitação

                            </label>

                           
                             <select name="request_type_id" id="patient_request_type_id" required class="form-select form-select-lg">

                                <option value="">

                                    Selecione

                                </option>

                                <?php foreach ($requestTypes as $type): ?>

                                    <option
                                        value="<?= $type['id'] ?>"

                                        data-deadline="<?= $type['deadline_days'] ?>"

                                        data-external="<?= $type['is_external'] ?>">

                                        <?= esc($type['name']) ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>
                        </div>

                        <!-- DATA DO EXAME -->

                        <div class="col-md-6" id="patient_scheduled_date_container">

                            <label class="form-label">

                                Data do Exame

                            </label>

                            <input type="date" name="scheduled_date" id="patient_scheduled_date" required class="form-control form-control-lg">

                        </div>

                        <!-- ALERTA POR DIAS -->

                        <div class="col-md-6" id="patient_offset_container">

                            <label class="form-label">

                                Alerta

                            </label>

                            <div class="input-group">

                                <input type="number" name="alert_offset_days" value="0" class="form-control form-control-lg">

                                <span class="input-group-text">

                                    Dias

                                </span>

                            </div>

                            <small class="text-muted">

                                Ex:
                                -5 antes |
                                0 no dia |
                                5 depois

                            </small>

                        </div>

                        <!-- ALERTA MANUAL -->

                        <div class="col-md-6 d-none" id="patient_alert_date_container">

                            <label class="form-label">

                                Data para Alerta

                            </label>

                            <input type="date" name="alert_date" id="patient_alert_date" class="form-control form-control-lg">

                        </div>

                        <!-- OBS -->

                        <div class="col-12">

                            <label class="form-label">

                                Observação

                            </label>

                            <textarea name="observation" rows="3" class="form-control" placeholder="Digite uma observação..."></textarea>

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
                        id="btnStorePatientRequest"
                        class="btn btn-primary btn-lg rounded-4 px-4">

                        <i class="bi bi-check-circle me-2"></i>

                        Salvar Solicitação

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>