console.log("IMPORTADOR USUÁRIOS CARREGADO");

/*
|--------------------------------------------------------------------------
| OPEN MODAL USUÁRIO CRIATE
|--------------------------------------------------------------------------
*/
$(document).on("submit", "#formUser", function (e) {
  console.log("SUBMIT USER DISPARADO");
  e.preventDefault();

  let form = $(this);

  $.ajax({
    url: BASE_URL + "users/store",

    type: "POST",

    data: form.serialize(),

    dataType: "json",

    success: function (response) {
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
        Swal.fire({
          icon: "error",

          title: "Erro",

          text: response.message,
        });
      }
    },
  });
});

/*
|--------------------------------------------------------------------------
| OPEN MODAL USUÁRIO EDIT
|--------------------------------------------------------------------------
*/
$(document).on("click", ".btnEditUser", function () {
  let id = $(this).data("id");

  $.get(
    BASE_URL + "users/edit/" + id,

    function (response) {
      if (response.status) {
        $("#edit_user_id").val(response.data.id);

        $("#edit_user_name").val(response.data.name);

        $("#edit_user_email").val(response.data.email);

        $("#edit_user_role").val(response.data.role);

        $("#edit_user_status").val(response.data.status);

        const modal = new bootstrap.Modal(
          document.getElementById("modalEditUser"),
        );

        modal.show();
      }
    },

    "json",
  );
});

/*
|--------------------------------------------------------------------------
| UPDATE USER
|--------------------------------------------------------------------------
*/
$(document).on("submit", "#formEditUser", function (e) {
  e.preventDefault();

  let form = $(this);

  $.ajax({
    url: BASE_URL + "users/update",

    type: "POST",

    data: form.serialize(),

    dataType: "json",

    success: function (response) {
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
        Swal.fire({
          icon: "error",

          title: "Erro",

          text: response.message,
        });
      }
    },
  });
});

/*
|--------------------------------------------------------------------------
| DELETE USER
|--------------------------------------------------------------------------
*/
$(document).on("click", ".btnDeleteUser", function () {
  let id = $(this).data("id");

  Swal.fire({
    icon: "warning",

    title: "Excluir usuário?",

    text: "Esta ação não poderá ser desfeita.",

    showCancelButton: true,

    confirmButtonText: "Sim, excluir",

    cancelButtonText: "Cancelar",

    confirmButtonColor: "#dc3545",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: BASE_URL + "users/delete",

        type: "POST",

        data: {
          id: id,
        },

        dataType: "json",

        success: function (response) {
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
      });
    }
  });
});
