<div class="modal fade" id="modalFinalizePatient" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <form id="formFinalizePatient">

                <input type="hidden" name="patient_id" id="finalize_patient_id">

                <div class="modal-header">

                    <h5 class="modal-title">

                        Finalizar Atendimento

                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">

                            Justificativa

                        </label>

                        <textarea class="form-control" name="observation" id="finalize_observation" rows="4" minlength="15" required></textarea>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

                        Cancelar

                    </button>

                    <button type="submit" id="btnFinalizePatientSave" class="btn btn-success">

                        Finalizar Atendimento

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>