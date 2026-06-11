console.log("IMPORTADOR HOSPITALIZAÇÃO CARREGADO");

/*
|--------------------------------------------------------------------------
| OPEN MODAL HOSPITALIZE PATIENT
|--------------------------------------------------------------------------
*/
$(document).on("click", ".btnHospitalizePatient", function () {
  let patientId = $(this).data("id");

  $("#hospitalize_patient_id").val(patientId);

  $("#modalHospitalizePatient").modal("show");
});

/*
|--------------------------------------------------------------------------
| SUBMIT FORM HOSPITALIZE PATIENT
|--------------------------------------------------------------------------
*/
$(document).on("submit", "#formHospitalizePatient", function (e) {
  e.preventDefault();

  let form = $(this);

  let button = $("#btnHospitalizePatientSave");

  let observation = $("#hospitalize_observation").val().trim();

  /*
    |--------------------------------------------------------------------------
    | VALIDATE OBSERVATION
    |--------------------------------------------------------------------------
    */

  if (observation.length < 15) {
    Swal.fire({
      icon: "warning",

      title: "Atenção",

      text: "A justificativa deve conter no mínimo 15 caracteres.",
    });

    return;
  }

  /*
    |--------------------------------------------------------------------------
    | AJAX
    |--------------------------------------------------------------------------
    */

  $.ajax({
    url: BASE_URL + "patients/hospitalize",

    type: "POST",

    data: form.serialize(),

    dataType: "json",

    /*
    |--------------------------------------------------------------------------
    | BEFORE SEND
    |--------------------------------------------------------------------------
    */

    beforeSend: function () {
      button.prop("disabled", true);

      button.html(`

                <span class="spinner-border spinner-border-sm me-2"></span>

                Internando...

            `);
    },

    /*
    |--------------------------------------------------------------------------
    | SUCCESS
    |--------------------------------------------------------------------------
    */

    success: function (response) {
      if (response.status) {
        Swal.fire({
          icon: "success",

          title: "Sucesso",

          text: response.message,
        });

        const modal = bootstrap.Modal.getInstance(
          document.getElementById("modalHospitalizePatient"),
        );

        modal.hide();

        setTimeout(() => {
          location.reload();
        }, 1000);
      } else {
        Swal.fire({
          icon: "error",

          title: "Erro",

          text: response.message,
        });
      }
    },

    /*
    |--------------------------------------------------------------------------
    | ERROR
    |--------------------------------------------------------------------------
    */

    error: function (xhr) {
      console.log(xhr.responseText);

      Swal.fire({
        icon: "error",

        title: "Erro",

        text: "Falha ao processar a internação.",
      });
    },

    /*
    |--------------------------------------------------------------------------
    | COMPLETE
    |--------------------------------------------------------------------------
    */

    complete: function () {
      button.prop("disabled", false);

      button.html(`

                <i class="bi bi-hospital me-2"></i>

                Internar Paciente

            `);
    },
  });
});

/*
|--------------------------------------------------------------------------
| OPEN RETURN MODAL
|--------------------------------------------------------------------------
*/

$(document).on("click", ".btnReturnPatient", function () {
  $("#return_patient_id").val($(this).data("id"));

  $("#modalReturnPatient").modal("show");
});

/*
|--------------------------------------------------------------------------
| RETURN PATIENT
|--------------------------------------------------------------------------
*/

$(document).on("submit", "#formReturnPatient", function (e) {
  e.preventDefault();

  let button = $("#btnReturnPatientSave");

  let observation = $("#return_observation").val().trim();

  if (observation.length < 15) {
    Swal.fire({
      icon: "warning",

      title: "Atenção",

      text: "A justificativa deve conter no mínimo 15 caracteres.",
    });

    return;
  }

  $.ajax({
    url: BASE_URL + "patients/return",

    type: "POST",

    data: $(this).serialize(),

    dataType: "json",

    beforeSend: function () {
      button.prop("disabled", true);
    },

    success: function (response) {
      if (response.status) {
        Swal.fire({
          icon: "success",

          title: "Sucesso",

          text: response.message,
        });

        const modal = bootstrap.Modal.getInstance(
          document.getElementById("modalReturnPatient"),
        );

        modal.hide();

        setTimeout(() => {
          location.reload();
        }, 1000);
      }
    },

    complete: function () {
      button.prop("disabled", false);
    },
  });
});

/*
|--------------------------------------------------------------------------
| OPEN FINALIZE MODAL
|--------------------------------------------------------------------------
*/
$(document).on("click", ".btnFinalizePatient", function () {
  $("#finalize_patient_id").val($(this).data("id"));

  const modal = new bootstrap.Modal(
    document.getElementById("modalFinalizePatient"),
  );

  modal.show();
});


/*
|--------------------------------------------------------------------------
| FINALIZE PATIENT
|--------------------------------------------------------------------------
*/
$(document).on("submit", "#formFinalizePatient", function (e) {
  e.preventDefault();

  let form = $(this);

  let button = $("#btnFinalizePatientSave");

  let observation = $("#finalize_observation").val().trim();

  if (observation.length < 15) {
    Swal.fire({
      icon: "warning",

      title: "Atenção",

      text: "A justificativa deve conter no mínimo 15 caracteres.",
    });

    return;
  }

  $.ajax({
    url: BASE_URL + "patients/finalize",

    type: "POST",

    data: form.serialize(),

    dataType: "json",

    beforeSend: function () {
      button.prop("disabled", true);
    },

    success: function (response) {
      if (response.status) {
        Swal.fire({
          icon: "success",

          title: "Sucesso",

          text: response.message,
        });

        const modal = bootstrap.Modal.getInstance(
          document.getElementById("modalFinalizePatient"),
        );

        modal.hide();

        setTimeout(() => {
          location.reload();
        }, 1000);
      }
    },

    complete: function () {
      button.prop("disabled", false);
    },
  });
});
