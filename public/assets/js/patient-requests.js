console.log("PATIENT REQUEST JS LOADED");

/*
|--------------------------------------------------------------------------
| PATIENT
|--------------------------------------------------------------------------
| UPDATE PATIENT
|--------------------------------------------------------------------------
*/
$(document).on("submit", "#formEditPatient", function (e) {
  /*
    |--------------------------------------------------------------------------
    | STOP
    |--------------------------------------------------------------------------
    */

  e.preventDefault();

  /*
    |--------------------------------------------------------------------------
    | FORM
    |--------------------------------------------------------------------------
    */

  let form = $(this);

  let button = $("#btnUpdatePatient");

  /*
    |--------------------------------------------------------------------------
    | AJAX
    |--------------------------------------------------------------------------
    */

  $.ajax({
    url: form.attr("action"),

    type: "POST",

    data: form.serialize(),

    dataType: "json",

    /*
      |--------------------------------------------------------------------------
      | BEFORE
      |--------------------------------------------------------------------------
      */

    beforeSend: function () {
      button.prop("disabled", true);

      button.html(`

                    <span class="spinner-border spinner-border-sm me-2"></span>

                    Atualizando...

                `);
    },

    /*
      |--------------------------------------------------------------------------
      | SUCCESS
      |--------------------------------------------------------------------------
      */

    success: function (response) {
      /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

      if (response.status) {
        Swal.fire({
          icon: "success",

          title: "Sucesso",

          text: response.message,
        });

        /*
          |--------------------------------------------------------------------------
          | CLOSE MODAL
          |--------------------------------------------------------------------------
          */

        const modal = bootstrap.Modal.getInstance(
          document.getElementById("modalEditPatient"),
        );

        modal.hide();

        /*
          |--------------------------------------------------------------------------
          | RELOAD
          |--------------------------------------------------------------------------
          */

        setTimeout(() => {
          location.reload();
        }, 1000);
      } else {
        /*
          |--------------------------------------------------------------------------
          | ERROR
          |--------------------------------------------------------------------------
          */

        Swal.fire({
          icon: "error",

          title: "Erro",

          text: response.message,
        });
      }
    },

    /*
      |--------------------------------------------------------------------------
      | AJAX ERROR
      |--------------------------------------------------------------------------
      */

    error: function (xhr) {
      console.log(xhr.responseText);
    },

    /*
      |--------------------------------------------------------------------------
      | COMPLETE
      |--------------------------------------------------------------------------
      */

    complete: function () {
      button.prop("disabled", false);

      button.html(`

                    <i class="bi bi-check-circle me-2"></i>

                    Atualizar Paciente

                `);
    },
  });
});

/*
|--------------------------------------------------------------------------
| SAVE PATIENT REQUEST
|--------------------------------------------------------------------------
*/
$(document).on("submit", "#formPatientRequestStore", function (e) {
  e.preventDefault();

  let form = $(this);

  let button = $("#btnStorePatientRequest");

  $.ajax({
    url: BASE_URL + "patients/request/store",

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

        form.trigger("reset");

        const modal = bootstrap.Modal.getInstance(
          document.getElementById("modalPatientRequest"),
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

    error: function (xhr) {
      console.log(xhr.responseText);
    },

    complete: function () {
      button.prop("disabled", false);
    },
  });
});

/*
|--------------------------------------------------------------------------
| UPDATE REQUEST PATIENT
|--------------------------------------------------------------------------
*/
$(document).on("submit", "#formPatientEditRequest", function (e) {
  /*
  |--------------------------------------------------------------------------
  | STOP
  |--------------------------------------------------------------------------
  */

  e.preventDefault();

  /*
  |--------------------------------------------------------------------------
  | FORM
  |--------------------------------------------------------------------------
  */

  let form = $(this);

  let button = $("#btnPatientUpdateRequest");

  /*
  |--------------------------------------------------------------------------
  | VALIDATE CONSULTATION
  |--------------------------------------------------------------------------
  */

  let consultationDate = $("#consultation_date").val();

  let scheduledDate = $("#edit_patient_scheduled_date").val();

  if (scheduledDate > consultationDate) {
    Swal.fire({
      icon: "warning",

      title: "Atenção",

      text: "O exame não pode ultrapassar a data da consulta",
    });

    return;
  }

  /*
  |--------------------------------------------------------------------------
  | AJAX
  |--------------------------------------------------------------------------
  */

  $.ajax({
    url: BASE_URL + "patients/request/update",

    type: "POST",

    data: form.serialize(),

    dataType: "json",

    /*
    |--------------------------------------------------------------------------
    | BEFORE
    |--------------------------------------------------------------------------
    */

    beforeSend: function () {
      button.prop("disabled", true);

      button.html(`<span class="spinner-border spinner-border-sm me-2"></span>Atualizando...

                `);
    },

    /*
    |--------------------------------------------------------------------------
    | SUCCESS
    |--------------------------------------------------------------------------
    */

    success: function (response) {
      /*
      |--------------------------------------------------------------------------
      | SUCCESS
      |--------------------------------------------------------------------------
      */

      if (response.status) {
        Swal.fire({
          icon: "success",

          title: "Sucesso",

          text: response.message,

          confirmButtonColor: "#4A90E2",
        });

        /*
        |--------------------------------------------------------------------------
        | CLOSE MODAL
        |--------------------------------------------------------------------------
        */

        const modal = bootstrap.Modal.getInstance(
          document.getElementById("modalPatientEditRequest"),
        );

        modal.hide();

        /*
        |--------------------------------------------------------------------------
        | RELOAD
        |--------------------------------------------------------------------------
        */

        setTimeout(() => {
          location.reload();
        }, 1000);
      } else {
        /*
        |--------------------------------------------------------------------------
        | ERROR
        |--------------------------------------------------------------------------
        */

        Swal.fire({
          icon: "error",

          title: "Erro",

          text: response.message,
        });
      }
    },

    /*
    |--------------------------------------------------------------------------
    | AJAX ERROR
    |--------------------------------------------------------------------------
    */

    error: function (xhr) {
      console.log(xhr.responseText);
    },

    /*
    |--------------------------------------------------------------------------
    | COMPLETE
    |--------------------------------------------------------------------------
    */

    complete: function () {
      button.prop("disabled", false);

      button.html(`<i class="bi bi-check-circle me-2"></i>Atualizar`);
    },
  });
});

/*
|--------------------------------------------------------------------------
| OPEN MODAL EDIT REQUEST PATIENT
|--------------------------------------------------------------------------
*/
$(document).on("click", ".btnPatientEditRequest", function () {
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
  $("#edit_patient_request_id").val(button.data("id"));

  $("#edit_patient_request_type_id").val(button.data("request_type_id"));

  $("#edit_patient_scheduled_date").val(button.data("scheduled_date"));

  $("#edit_patient_alert_offset_days").val(button.data("alert_offset_days"));

  $("#edit_patient_alert_date").val(button.data("alert_date"));

  $("#edit_patient_observation").val(button.data("observation"));

  $("#edit_patient_request_type_id").trigger("change");

  /*
  |--------------------------------------------------------------------------
  | MODAL
  |--------------------------------------------------------------------------
  */

  $("#modalPatientEditRequest").modal("show");
});

/*
|--------------------------------------------------------------------------
| EDIT REQUEST TYPE CHANGE MODAL EDIT PATIENT
|--------------------------------------------------------------------------
*/
$(document).on("change", "#edit_patient_request_type_id", function () {
  let option = $(this).find(":selected");

  let isExternal = option.data("external");

  let deadline = option.data("deadline");

  if (isExternal == 1) {
    $("#edit_patient_scheduled_date_container").addClass("d-none");

    $("#edit_patient_offset_container").addClass("d-none");

    $("#edit_patient_alert_date_container").removeClass("d-none");

    $("#edit_patient_scheduled_date").prop("required", false).val("");

    $("#edit_patient_alert_date").prop("required", true);
  } else {
    $("#edit_patient_scheduled_date_container").removeClass("d-none");

    $("#edit_patient_offset_container").removeClass("d-none");

    $("#edit_patient_alert_date_container").addClass("d-none");

    $("#edit_patient_scheduled_date").prop("required", true);

    $("#edit_patient_alert_date").prop("required", false);
  }
});

/*
|--------------------------------------------------------------------------
| DELETE PATIENT REQUEST
|--------------------------------------------------------------------------
*/
$(document).on("click", ".btnPatientDeleteRequest", function () {
  /*
  |--------------------------------------------------------------------------
  | BUTTON
  |--------------------------------------------------------------------------
  */

  let button = $(this);

  let id = button.data("id");

  /*
  |--------------------------------------------------------------------------
  | CONFIRM
  |--------------------------------------------------------------------------
  */

  Swal.fire({
    title: "Deseja remover?",

    text: "Essa ação não poderá ser desfeita",

    icon: "warning",

    showCancelButton: true,

    confirmButtonColor: "#dc3545",

    cancelButtonColor: "#6c757d",

    confirmButtonText: "Sim, remover",

    cancelButtonText: "Cancelar",
  }).then((result) => {
    /*
    |--------------------------------------------------------------------------
    | CONFIRMED
    |--------------------------------------------------------------------------
    */

    if (result.isConfirmed) {
      /*
      |--------------------------------------------------------------------------
      | AJAX
      |--------------------------------------------------------------------------
      */

      $.ajax({
        url: BASE_URL + "/patients/request/delete",

        type: "POST",

        data: {
          id: id,
        },

        dataType: "json",

        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        success: function (response) {
          /*
          |--------------------------------------------------------------------------
          | SUCCESS
          |--------------------------------------------------------------------------
          */

          if (response.status) {
            Swal.fire({
              icon: "success",

              title: "Sucesso",

              text: response.message,
            });

            /*
            |--------------------------------------------------------------------------
            | RELOAD
            |--------------------------------------------------------------------------
            */

            setTimeout(() => {
              location.reload();
            }, 1000);
          } else {
            /*
            |--------------------------------------------------------------------------
            | ERROR
            |--------------------------------------------------------------------------
            */

            Swal.fire({
              icon: "error",

              title: "Erro",

              text: response.message,
            });
          }
        },

        /*
        |--------------------------------------------------------------------------
        | AJAX ERROR
        |--------------------------------------------------------------------------
        */

        error: function (xhr) {
          console.log(xhr.responseText);
        },
      });
    }
  });
});

/*
|--------------------------------------------------------------------------
| FINALIZE PATIENT REQUEST
|--------------------------------------------------------------------------
*/
$(document).on("click", ".btnPatientFinalizeRequest", function () {
  /*
  |--------------------------------------------------------------------------
  | BUTTON
  |--------------------------------------------------------------------------
  */

  let button = $(this);

  let id = button.data("id");

  /*
  |--------------------------------------------------------------------------
  | CONFIRM
  |--------------------------------------------------------------------------
  */

  Swal.fire({
    title: "Finalizar exame?",

    text: "O exame será marcado como concluído",

    icon: "question",

    showCancelButton: true,

    confirmButtonColor: "#198754",

    cancelButtonColor: "#6c757d",

    confirmButtonText: "Sim, finalizar",

    cancelButtonText: "Cancelar",
  }).then((result) => {
    /*
    |--------------------------------------------------------------------------
    | CONFIRMED
    |--------------------------------------------------------------------------
    */

    if (result.isConfirmed) {
      /*
      |--------------------------------------------------------------------------
      | AJAX
      |--------------------------------------------------------------------------
      */

      $.ajax({
        url: BASE_URL + "/patients/request/finalize",

        type: "POST",

        data: {
          id: id,
        },

        dataType: "json",

        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        success: function (response) {
          /*
          |--------------------------------------------------------------------------
          | SUCCESS
          |--------------------------------------------------------------------------
          */

          if (response.status) {
            Swal.fire({
              icon: "success",

              title: "Sucesso",

              text: response.message,
            });

            /*
            |--------------------------------------------------------------------------
            | RELOAD
            |--------------------------------------------------------------------------
            */

            setTimeout(() => {
              location.reload();
            }, 1000);
          } else {
            /*
            |--------------------------------------------------------------------------
            | ERROR
            |--------------------------------------------------------------------------
            */

            Swal.fire({
              icon: "error",

              title: "Erro",

              text: response.message,
            });
          }
        },

        /*
        |--------------------------------------------------------------------------
        | AJAX ERROR
        |--------------------------------------------------------------------------
        */

        error: function (xhr) {
          console.log(xhr.responseText);
        },
      });
    }
  });
});

/*
|--------------------------------------------------------------------------
| TRIAGE
|--------------------------------------------------------------------------
| SAVE TRIAGE REQUEST
|--------------------------------------------------------------------------
*/
$(document).on("submit", "#formPatientRequest", function (e) {
  /*
  |--------------------------------------------------------------------------
  | STOP
  |--------------------------------------------------------------------------
  */

  e.preventDefault();

  /*
  |--------------------------------------------------------------------------
  | VARIABLES
  |--------------------------------------------------------------------------
  */

  let form = $(this);

  let button = $("#btnSavePatientRequest");

  /*
  |--------------------------------------------------------------------------
  | CONSULTATION DATE
  |--------------------------------------------------------------------------
  */

  let consultationDate = $("#consultation_date").val();

  let scheduledDate = $("#scheduled_date").val();

  /*
  |--------------------------------------------------------------------------
  | VALIDATE RANGE
  |--------------------------------------------------------------------------
  */

  if (scheduledDate > consultationDate) {
    Swal.fire({
      icon: "warning",

      title: "Atenção",

      text: "O exame não pode ultrapassar a data da consulta",
    });

    return;
  }

  /*
    |--------------------------------------------------------------------------
    | AJAX
    |--------------------------------------------------------------------------
    */

  $.ajax({
    url: BASE_URL + "triage/store-request",

    type: "POST",

    data: form.serialize(),

    dataType: "json",

    /*
    |--------------------------------------------------------------------------
    | BEFORE
    |--------------------------------------------------------------------------
    */

    beforeSend: function () {
      button.prop("disabled", true);

      button.html(`

                <span class="spinner-border spinner-border-sm me-2"></span>

                Salvando...

            `);
    },

    /*
    |--------------------------------------------------------------------------
    | SUCCESS
    |--------------------------------------------------------------------------
    */

    success: function (response) {
      /*
      |--------------------------------------------------------------------------
      | SUCCESS
      |--------------------------------------------------------------------------
      */

      if (response.status) {
        Swal.fire({
          icon: "success",

          title: "Sucesso",

          text: response.message,

          confirmButtonColor: "#4A90E2",
        });

        /*
        |--------------------------------------------------------------------------
        | RESET
        |--------------------------------------------------------------------------
        */

        form.trigger("reset");

        /*
        |--------------------------------------------------------------------------
        | CLOSE MODAL
        |--------------------------------------------------------------------------
        */

        const modal = bootstrap.Modal.getInstance(
          document.getElementById("modalPatientRequest"),
        );

        modal.hide();

        /*
        |--------------------------------------------------------------------------
        | RELOAD
        |--------------------------------------------------------------------------
        */

        setTimeout(() => {
          location.reload();
        }, 1000);
      } else {
        /*
        |--------------------------------------------------------------------------
        | ERROR
        |--------------------------------------------------------------------------
        */

        Swal.fire({
          icon: "error",

          title: "Erro",

          text: response.message,
        });
      }
    },

    /*
    |--------------------------------------------------------------------------
    | AJAX ERROR
    |--------------------------------------------------------------------------
    */

    error: function (xhr) {
      console.log(xhr.responseText);
    },

    /*
    |--------------------------------------------------------------------------
    | COMPLETE
    |--------------------------------------------------------------------------
    */

    complete: function () {
      button.prop("disabled", false);

      button.html(`

            <i class="bi bi-check-circle me-2"></i>

            Salvar Solicitação

        `);
    },
  });
});

/*
|--------------------------------------------------------------------------
| OPEN EDIT MODAL REQUEST TRIAGE
|--------------------------------------------------------------------------
*/
$(document).on("click", ".btnEditRequest", function () {
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

  $("#edit_request_id").val(button.data("id"));

  $("#edit_request_type_id").val(button.data("request_type_id"));

  $("#edit_scheduled_date").val(button.data("scheduled_date"));

  $("#edit_alert_offset_days").val(button.data("alert_offset_days"));

  $("#edit_request_status").val(button.data("request_status"));

  $("#edit_observation").val(button.data("observation"));

  /*
  |--------------------------------------------------------------------------
  | MODAL
  |--------------------------------------------------------------------------
  */

  $("#modalEditPatientRequest").modal("show");
});

/*
|--------------------------------------------------------------------------
| UPDATE REQUEST
|--------------------------------------------------------------------------
*/
$(document).on("submit", "#formEditPatientRequest", function (e) {
  /*
  |--------------------------------------------------------------------------
  | STOP
  |--------------------------------------------------------------------------
  */

  e.preventDefault();

  /*
  |--------------------------------------------------------------------------
  | FORM
  |--------------------------------------------------------------------------
  */

  let form = $(this);

  let button = $("#btnUpdatePatientRequest");

  /*
  |--------------------------------------------------------------------------
  | VALIDATE CONSULTATION
  |--------------------------------------------------------------------------
  */

  let consultationDate = $("#consultation_date").val();

  let scheduledDate = $("#edit_scheduled_date").val();

  if (scheduledDate > consultationDate) {
    Swal.fire({
      icon: "warning",

      title: "Atenção",

      text: "O exame não pode ultrapassar a data da consulta",
    });

    return;
  }

  /*
  |--------------------------------------------------------------------------
  | AJAX
  |--------------------------------------------------------------------------
  */

  $.ajax({
    url: BASE_URL + "triage/update-request",

    type: "POST",

    data: form.serialize(),

    dataType: "json",

    /*
      |--------------------------------------------------------------------------
      | BEFORE
      |--------------------------------------------------------------------------
      */

    beforeSend: function () {
      button.prop("disabled", true);

      button.html(`<span class="spinner-border spinner-border-sm me-2"></span>Atualizando...

                `);
    },

    /*
    |--------------------------------------------------------------------------
    | SUCCESS
    |--------------------------------------------------------------------------
    */

    success: function (response) {
      /*
      |--------------------------------------------------------------------------
      | SUCCESS
      |--------------------------------------------------------------------------
      */

      if (response.status) {
        Swal.fire({
          icon: "success",

          title: "Sucesso",

          text: response.message,

          confirmButtonColor: "#4A90E2",
        });

        /*
        |--------------------------------------------------------------------------
        | CLOSE MODAL
        |--------------------------------------------------------------------------
        */

        const modal = bootstrap.Modal.getInstance(
          document.getElementById("modalEditPatientRequest"),
        );

        modal.hide();

        /*
        |--------------------------------------------------------------------------
        | RELOAD
        |--------------------------------------------------------------------------
        */

        setTimeout(() => {
          location.reload();
        }, 1000);
      } else {
        /*
        |--------------------------------------------------------------------------
        | ERROR
        |--------------------------------------------------------------------------
        */

        Swal.fire({
          icon: "error",

          title: "Erro",

          text: response.message,
        });
      }
    },

    /*
    |--------------------------------------------------------------------------
    | AJAX ERROR
    |--------------------------------------------------------------------------
    */

    error: function (xhr) {
      console.log(xhr.responseText);
    },

    /*
    |--------------------------------------------------------------------------
    | COMPLETE
    |--------------------------------------------------------------------------
    */

    complete: function () {
      button.prop("disabled", false);

      button.html(`<i class="bi bi-check-circle me-2"></i>Atualizar`);
    },
  });
});

/*
|--------------------------------------------------------------------------
| DELETE REQUEST
|--------------------------------------------------------------------------
*/
$(document).on("click", ".btnDeleteRequest", function () {
  /*
  |--------------------------------------------------------------------------
  | BUTTON
  |--------------------------------------------------------------------------
  */

  let button = $(this);

  let id = button.data("id");

  /*
  |--------------------------------------------------------------------------
  | CONFIRM
  |--------------------------------------------------------------------------
  */

  Swal.fire({
    title: "Deseja remover?",

    text: "Essa ação não poderá ser desfeita",

    icon: "warning",

    showCancelButton: true,

    confirmButtonColor: "#dc3545",

    cancelButtonColor: "#6c757d",

    confirmButtonText: "Sim, remover",

    cancelButtonText: "Cancelar",
  }).then((result) => {
    /*
    |--------------------------------------------------------------------------
    | CONFIRMED
    |--------------------------------------------------------------------------
    */

    if (result.isConfirmed) {
      /*
      |--------------------------------------------------------------------------
      | AJAX
      |--------------------------------------------------------------------------
      */

      $.ajax({
        url: BASE_URL + "triage/delete-request",

        type: "POST",

        data: {
          id: id,
        },

        dataType: "json",

        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        success: function (response) {
          /*
          |--------------------------------------------------------------------------
          | SUCCESS
          |--------------------------------------------------------------------------
          */

          if (response.status) {
            Swal.fire({
              icon: "success",

              title: "Sucesso",

              text: response.message,
            });

            /*
            |--------------------------------------------------------------------------
            | RELOAD
            |--------------------------------------------------------------------------
            */

            setTimeout(() => {
              location.reload();
            }, 1000);
          } else {
            /*
            |--------------------------------------------------------------------------
            | ERROR
            |--------------------------------------------------------------------------
            */

            Swal.fire({
              icon: "error",

              title: "Erro",

              text: response.message,
            });
          }
        },

        /*
        |--------------------------------------------------------------------------
        | AJAX ERROR
        |--------------------------------------------------------------------------
        */

        error: function (xhr) {
          console.log(xhr.responseText);
        },
      });
    }
  });
});

/*
|--------------------------------------------------------------------------
| FINALIZE REQUEST
|--------------------------------------------------------------------------
*/
$(document).on("click", ".btnFinalizeRequest", function () {
  /*
  |--------------------------------------------------------------------------
  | BUTTON
  |--------------------------------------------------------------------------
  */

  let button = $(this);

  let id = button.data("id");

  /*
  |--------------------------------------------------------------------------
  | CONFIRM
  |--------------------------------------------------------------------------
  */

  Swal.fire({
    title: "Finalizar exame?",

    text: "O exame será marcado como concluído",

    icon: "question",

    showCancelButton: true,

    confirmButtonColor: "#198754",

    cancelButtonColor: "#6c757d",

    confirmButtonText: "Sim, finalizar",

    cancelButtonText: "Cancelar",
  }).then((result) => {
    /*
    |--------------------------------------------------------------------------
    | CONFIRMED
    |--------------------------------------------------------------------------
    */

    if (result.isConfirmed) {
      /*
      |--------------------------------------------------------------------------
      | AJAX
      |--------------------------------------------------------------------------
      */

      $.ajax({
        url: BASE_URL + "triage/finalize-request",

        type: "POST",

        data: {
          id: id,
        },

        dataType: "json",

        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        success: function (response) {
          /*
          |--------------------------------------------------------------------------
          | SUCCESS
          |--------------------------------------------------------------------------
          */

          if (response.status) {
            Swal.fire({
              icon: "success",

              title: "Sucesso",

              text: response.message,
            });

            /*
            |--------------------------------------------------------------------------
            | RELOAD
            |--------------------------------------------------------------------------
            */

            setTimeout(() => {
              location.reload();
            }, 1000);
          } else {
            /*
            |--------------------------------------------------------------------------
            | ERROR
            |--------------------------------------------------------------------------
            */

            Swal.fire({
              icon: "error",

              title: "Erro",

              text: response.message,
            });
          }
        },

        /*
        |--------------------------------------------------------------------------
        | AJAX ERROR
        |--------------------------------------------------------------------------
        */

        error: function (xhr) {
          console.log(xhr.responseText);
        },
      });
    }
  });
});

/*
|--------------------------------------------------------------------------
| TRANSFER PATIENT PARA FILA PRINCIPAL
|--------------------------------------------------------------------------
*/
$(document).on("click", ".btnTransferPatient", function () {
  /*
    |--------------------------------------------------------------------------
    | ID
    |--------------------------------------------------------------------------
    */

  let id = $(this).data("id");

  /*
    |--------------------------------------------------------------------------
    | CONFIRM
    |--------------------------------------------------------------------------
    */

  Swal.fire({
    title: "Transferir paciente?",

    text: "O paciente será enviado para fila principal",

    icon: "question",

    showCancelButton: true,

    confirmButtonColor: "#198754",

    cancelButtonColor: "#6c757d",

    confirmButtonText: "Sim, transferir",

    cancelButtonText: "Cancelar",
  }).then((result) => {
    /*
      |--------------------------------------------------------------------------
      | CONFIRMED
      |--------------------------------------------------------------------------
      */

    if (result.isConfirmed) {
      /*
        |--------------------------------------------------------------------------
        | AJAX
        |--------------------------------------------------------------------------
        */

      $.ajax({
        url: BASE_URL + "triage/transfer-patient",

        type: "POST",

        data: {
          patient_id: id,
        },

        dataType: "json",

        /*
          |--------------------------------------------------------------------------
          | SUCCESS
          |--------------------------------------------------------------------------
          */

        success: function (response) {
          /*
            |--------------------------------------------------------------------------
            | SUCCESS
            |--------------------------------------------------------------------------
            */

          if (response.status) {
            Swal.fire({
              icon: "success",

              title: "Sucesso",

              text: response.message,
            });

            setTimeout(() => {
              location.reload();
            }, 1000);
          } else {
            /*
              |--------------------------------------------------------------------------
              | ERROR
              |--------------------------------------------------------------------------
              */

            Swal.fire({
              icon: "warning",

              title: "Atenção",

              text: response.message,
            });
          }
        },

        /*
          |--------------------------------------------------------------------------
          | AJAX ERROR
          |--------------------------------------------------------------------------
          */

        error: function (xhr) {
          console.log(xhr.responseText);
        },
      });
    }
  });
});
