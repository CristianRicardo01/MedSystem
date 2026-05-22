$(document).on("submit", "#formSpecialty", function (e) {
  e.preventDefault();

  let form = $(this);

  let button = $("#btnSaveSpecialty");

  $.ajax({
    url: form.attr("action"),

    type: "POST",

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

        form.trigger("reset");

        const modal = bootstrap.Modal.getInstance(
          document.getElementById("modalSpecialty"),
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

      button.html(`
                <i class="bi bi-check-circle me-2"></i>
                Salvar
            `);
    },
  });
});

/*
|--------------------------------------------------------------------------
| OPEN EDIT MODAL
|--------------------------------------------------------------------------
*/

$(document).on("click", ".btnEditSpecialty", function () {
  let button = $(this);

  let id = button.data("id");

  $("#edit_id").val(id);

  $("#edit_name").val(button.data("name"));

  $("#edit_description").val(button.data("description"));

  $("#edit_status").val(button.data("status"));

  /*
    |--------------------------------------------------------------------------
    | ACTION
    |--------------------------------------------------------------------------
    */

  $("#formEditSpecialty").attr(
    "action",

    BASE_URL + "settings/specialties/update/" + id,
  );

  /*
    |--------------------------------------------------------------------------
    | OPEN MODAL
    |--------------------------------------------------------------------------
    */

  $("#modalEditSpecialty").modal("show");
});

/*
|--------------------------------------------------------------------------
| UPDATE REQUEST
|--------------------------------------------------------------------------
*/

$(document).on("submit", "#formEditSpecialty", function (e) {
  /*
    |--------------------------------------------------------------------------
    | STOP FORM
    |--------------------------------------------------------------------------
    */

  e.preventDefault();

  /*
    |--------------------------------------------------------------------------
    | VARIABLES
    |--------------------------------------------------------------------------
    */

  let form = $(this);

  let button = $("#btnUpdateSpecialty");

  /*
    |--------------------------------------------------------------------------
    | AJAX
    |--------------------------------------------------------------------------
    */

  $.ajax({
    /*
    |--------------------------------------------------------------------------
    | URL
    |--------------------------------------------------------------------------
    */

    url: form.attr("action"),

    /*
    |--------------------------------------------------------------------------
    | METHOD
    |--------------------------------------------------------------------------
    */

    type: "POST",

    /*
    |--------------------------------------------------------------------------
    | DATA
    |--------------------------------------------------------------------------
    */

    data: form.serialize(),

    /*
    |--------------------------------------------------------------------------
    | TYPE
    |--------------------------------------------------------------------------
    */

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
      console.log(response);

      /*
        |--------------------------------------------------------------------------
        | SUCCESS TRUE
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
          document.getElementById("modalEditSpecialty"),
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
                Atualizar
            `);
    },
  });
});

/*
|--------------------------------------------------------------------------
| DELETE REQUEST
|--------------------------------------------------------------------------
*/

$(document).on("click", ".btnDeleteSpecialty", function (e) {
  /*
  |--------------------------------------------------------------------------
  | STOP LINK
  |--------------------------------------------------------------------------
  */

  e.preventDefault();

  /*
  |--------------------------------------------------------------------------
  | URL
  |--------------------------------------------------------------------------
  */

  let url = $(this).attr("href");

  /*
  |--------------------------------------------------------------------------
  | ALERT
  |--------------------------------------------------------------------------
  */

  Swal.fire({
    title: "Deseja remover?",

    text: "Essa ação não poderá ser desfeita.",

    icon: "warning",

    showCancelButton: true,

    confirmButtonColor: "#d33",

    cancelButtonColor: "#6c757d",

    confirmButtonText: "Sim, remover",

    cancelButtonText: "Cancelar",
  }).then((result) => {
    /*
    |--------------------------------------------------------------------------
    | CONFIRM
    |--------------------------------------------------------------------------
    */

    if (result.isConfirmed) {
      window.location.href = url;
    }
  });
});

/*
|--------------------------------------------------------------------------
| EXTERNAL REQUEST
|--------------------------------------------------------------------------
*/
