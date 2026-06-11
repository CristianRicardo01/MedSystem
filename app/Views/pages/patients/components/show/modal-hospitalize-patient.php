<!-- MODAL HOSPITALIZE PATIENT OBSERVAÇÃO -->
<div class="modal fade" id="modalHospitalizePatient" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content border-0 rounded-4">

            <!-- HEADER -->

            <div class="modal-header border-0 p-4">

                <div>

                    <h4 class="fw-bold mb-1">

                        Internação

                    </h4>

                    <p class="text-muted mb-0">

                        Internação de exames do paciente

                    </p>

                </div>

                <button type="button" class="btn-close" data-bs-dismiss="modal"> </button>

            </div>

            <!-- FORM -->

            <form id="formHospitalizePatient">

                <input type="hidden" name="patient_id" id="hospitalize_patient_id">

                <div class="modal-body px-4">

                    <div class="row g-4">

                        <!-- OBS -->

                        <div class="col-12">

                            <label class="form-label">

                                Observação

                            </label>

                            <textarea id="hospitalize_observation" name="observation" rows="3" class="form-control" minlength="15" required></textarea>

                        </div>

                    </div>

                </div>

                <!-- FOOTER -->

                <div class="modal-footer border-0 p-4">

                    <button type="button" class="btn btn-light btn-lg rounded-4" data-bs-dismiss="modal">

                        Cancelar

                    </button>

                    <button type="submit" id="btnHospitalizePatientSave" class="btn btn-danger btn-lg rounded-4 px-4">

                        <i class="bi bi-check-circle me-2"></i>

                        Internar Paciente
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>