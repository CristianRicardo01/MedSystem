$(document).ready(function () {
  /*
    |--------------------------------------------------------------------------
    | SAVE TRIAGE PATIENT
    |--------------------------------------------------------------------------
    */

  $("#formPatient").submit(function (e) {
    e.preventDefault();

    let form = $(this);

    let button = $("#btnSavePatient");

    /*
        |--------------------------------------------------------------------------
        | DEBUG
        |--------------------------------------------------------------------------
        */

    console.log("FORM ENVIADO");

    // console.log(form.serialize());

    $.ajax({
      url: form.attr("action"),

      method: "POST",

      data: form.serialize(),

      dataType: "json",

      beforeSend: function () {
        console.log("AJAX INICIADO");

        button.prop("disabled", true);

        button.html(`
                    <span class="spinner-border spinner-border-sm me-2"></span>
                    Salvando...
                `);
      },

      success: function (response) {
        console.log(response);

        if (response.status) {
          Swal.fire({
            icon: "success",

            title: "Sucesso",

            text: response.message,

            confirmButtonColor: "#4A90E2",
          });

          /*
                    |--------------------------------------------------------------------------
                    | RESET FORM
                    |--------------------------------------------------------------------------
                    */

          form.trigger("reset");

          /*
                    |--------------------------------------------------------------------------
                    | CLOSE MODAL
                    |--------------------------------------------------------------------------
                    */

          $("#modalPatient").modal("hide");

          /*
                    |--------------------------------------------------------------------------
                    | RELOAD PAGE
                    |--------------------------------------------------------------------------
                    */

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

        Swal.fire({
          icon: "error",

          title: "Erro",

          text: "Erro interno no servidor",
        });
      },

      complete: function () {
        button.prop("disabled", false);

        button.html(`
                    <i class="bi bi-check-circle me-2"></i>
                    Salvar Paciente
                `);
      },
    });
  });

  /*
  |--------------------------------------------------------------------------
  | SAVE OBSERVATION
  |--------------------------------------------------------------------------
  */

  $("#formObservation").submit(function (e) {
    e.preventDefault();

    let form = $(this);

    let button = $("#btnSaveObservation");

    $.ajax({
      url: form.attr("action"),
      
      method: "POST",

      data: form.serialize(),

      dataType: "json",

      beforeSend: function () {
        button.prop("disabled", true);

        button.html(`
                <span class="spinner-border spinner-border-sm me-2"></span>
                Salvando...
            `);
      },

      success: function (response) {
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
                | CLOSE
                |--------------------------------------------------------------------------
                */

          $("#modalObservation").modal("hide");

          /*
                |--------------------------------------------------------------------------
                | RELOAD
                |--------------------------------------------------------------------------
                */

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

        Swal.fire({
          icon: "error",

          title: "Erro",

          text: "Erro interno no servidor",
        });
      },

      complete: function () {
        button.prop("disabled", false);

        button.html(`
                <i class="bi bi-check-circle me-2"></i>
                Salvar Observação
            `);
      },
    });
  });
});
