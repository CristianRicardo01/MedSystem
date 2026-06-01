console.log("PATIENT JS CARREGADO");

/*
|--------------------------------------------------------------------------
| COMPLETE PATIENT
|--------------------------------------------------------------------------
*/

$(document).on("click", ".btnCompletePatient", function () {
  /*
    |--------------------------------------------------------------------------
    | BUTTON
    |--------------------------------------------------------------------------
    */

  let button = $(this);

  /*
    |--------------------------------------------------------------------------
    | DATA
    |--------------------------------------------------------------------------
    */

  $("#edit_id").val(button.data("id"));

  $("#edit_name").val(button.data("name"));

  $("#edit_medical_record").val(button.data("medical_record"));

  $("#edit_cpf").val(button.data("cpf"));

  $("#edit_phone").val(button.data("phone"));

  $("#edit_specialty_id").val(button.data("specialty_id"));

  $("#edit_has_exams").val(button.data("has_exams"));

  $("#edit_first_consultation_date").val(
    button.data("first_consultation_date"),
  );

  /*
    |--------------------------------------------------------------------------
    | CITY
    |--------------------------------------------------------------------------
    */

  window.selectedPatientCity = button.data("city");

  /*
    |--------------------------------------------------------------------------
    | STATE
    |--------------------------------------------------------------------------
    */

  window.selectedPatientState = button.data("state");

  /*
    |--------------------------------------------------------------------------
    | OPEN MODAL
    |--------------------------------------------------------------------------
    */

  const modal = new bootstrap.Modal(
    document.getElementById("modalCompletePatient"),
  );

  modal.show();

  /*
    |--------------------------------------------------------------------------
    | LOAD STATES
    |--------------------------------------------------------------------------
    */

  loadStates(
    "#edit_state_id",

    window.selectedPatientState,
  );
});

$(document).on("click", ".btnEditPatientData", function () {
  let button = $(this);

  $("#edit_data_id").val(button.data("id"));

  $("#edit_data_name").val(button.data("name"));

  $("#edit_data_medical_record").val(button.data("medical_record"));

  $("#edit_data_cpf").val(button.data("cpf"));

  $("#edit_data_phone").val(button.data("phone"));

  $("#edit_data_specialty_id").val(button.data("specialty_id"));

  $("#edit_data_has_exams").val(button.data("has_exams"));

  $("#edit_data_first_consultation_date").val(
    button.data("first_consultation_date"),
  );

  /*
  |--------------------------------------------------------------------------
  | CITY
  |--------------------------------------------------------------------------
  */

  window.selectedPatientCity = button.data("city");

  /*
  |--------------------------------------------------------------------------
  | STATE
  |--------------------------------------------------------------------------
  */

  window.selectedPatientState = button.data("state");

  /*
  |--------------------------------------------------------------------------
  | OPEN MODAL
  |--------------------------------------------------------------------------
  */

  const modal = new bootstrap.Modal(
    document.getElementById("modalEditPatientData"),
  );

  modal.show();

  /*
  |--------------------------------------------------------------------------
  | LOAD STATES
  |--------------------------------------------------------------------------
  */

  loadStates(
    "#edit_data_state_id",

    window.selectedPatientState,
  );
});
