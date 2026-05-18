<!-- MODAL OBSERVAÇÃO -->

<div class="modal fade"
    id="modalObservation"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content border-0 rounded-4">

            <!-- HEADER -->

            <div class="modal-header border-0 p-4">

                <div>

                    <h4 class="fw-bold mb-1">

                        Nova Observação

                    </h4>

                    <p class="text-muted mb-0">

                        Adicione uma observação operacional
                        do paciente.

                    </p>

                </div>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <!-- FORM -->

            <form id="formObservation" action="<?= base_url('triage/observation/store') ?>"
                method="POST">

                <div class="modal-body px-4">

                    <!-- PATIENT ID -->

                    <input type="hidden"
                        name="patient_id"
                        value="<?= $patient['id'] ?>">

                    <!-- OBS -->

                    <div class="mb-3">

                        <label class="form-label fw-semibold">

                            Observação

                        </label>

                        <textarea name="observation"
                            class="form-control form-control-lg"
                            rows="6"
                            placeholder="Digite a observação..."></textarea>

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
                        id="btnSaveObservation"
                        class="btn btn-primary btn-lg rounded-4 px-4">

                        <i class="bi bi-check-circle me-2"></i>

                        Salvar Observação

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>