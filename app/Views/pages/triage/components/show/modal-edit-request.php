<!-- MODAL EDIT REQUEST -->

<div class="modal fade"
    id="modalEditPatientRequest"
    tabindex="-1">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content border-0 rounded-4">

            <!-- HEADER -->

            <div class="modal-header border-0 p-4">

                <div>

                    <h4 class="fw-bold mb-1">

                        Editar Solicitação

                    </h4>

                    <p class="text-muted mb-0">

                        Atualize as informações da solicitação

                    </p>

                </div>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <!-- FORM -->

            <form id="formEditPatientRequest">

                <input type="hidden"
                    name="id"
                    id="edit_request_id">

                <div class="modal-body px-4">

                    <div class="row g-4">

                        <!-- REQUEST -->

                        <div class="col-md-6">

                            <label class="form-label">

                                Solicitação

                            </label>

                            <select name="request_type_id"
                                id="edit_request_type_id"
                                required
                                class="form-select form-select-lg">

                                <?php foreach ($requestTypes as $type): ?>

                                    <option
                                        value="<?= $type['id'] ?>">

                                        <?= esc($type['name']) ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                        <!-- DATE -->

                        <div class="col-md-6">

                            <label class="form-label">

                                Data do Exame

                            </label>

                            <input type="date"
                                name="scheduled_date"
                                id="edit_scheduled_date"
                                required
                                class="form-control form-control-lg">

                        </div>

                        <!-- ALERT -->

                        <div class="col-md-6">

                            <label class="form-label">

                                Alerta

                            </label>

                            <div class="input-group">

                                <input type="number"
                                    name="alert_offset_days"
                                    id="edit_alert_offset_days"
                                    class="form-control form-control-lg">

                                <span class="input-group-text">

                                    Dias

                                </span>

                            </div>

                        </div>

                        <!-- STATUS -->

                        <!-- <div class="col-md-6">

                            <label class="form-label">

                                Status

                            </label>

                            <select name="request_status"
                                id="edit_request_status"
                                class="form-select form-select-lg">

                                <option value="PENDING">

                                    Em andamento

                                </option>

                                <option value="COMPLETED">

                                    Finalizado

                                </option>

                            </select>

                        </div> -->

                        <!-- OBS -->

                        <div class="col-12">

                            <label class="form-label">

                                Observação

                            </label>

                            <textarea
                                name="observation"
                                id="edit_observation"
                                rows="3"
                                class="form-control"></textarea>

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
                        id="btnUpdatePatientRequest"
                        class="btn btn-primary btn-lg rounded-4 px-4">

                        <i class="bi bi-check-circle me-2"></i>

                        Atualizar

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>