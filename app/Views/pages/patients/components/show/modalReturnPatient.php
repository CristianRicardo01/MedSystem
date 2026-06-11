<div
    class="modal fade"
    id="modalReturnPatient"
    tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <form id="formReturnPatient">

                <input
                    type="hidden"
                    name="patient_id"
                    id="return_patient_id">

                <div class="modal-header">

                    <h5 class="modal-title">

                        Retornar para Atendimento

                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>

                </div>

                <div class="modal-body">

                    <label class="form-label">

                        Observação

                    </label>

                    <textarea
                        class="form-control"
                        id="return_observation"
                        name="observation"
                        rows="4"
                        minlength="15"
                        required></textarea>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Cancelar

                    </button>

                    <button
                        type="submit"
                        id="btnReturnPatientSave"
                        class="btn btn-success">

                        Retornar Paciente

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>