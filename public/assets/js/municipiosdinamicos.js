console.log("IMPORTADOR IBGE CARREGADO");

/*
|--------------------------------------------------------------------------
| IMPORT STATES
|--------------------------------------------------------------------------
*/

$.get(
  BASE_URL + "/location/import-states",

  function () {
    console.log("Estados importados");
  },
);
/*
|--------------------------------------------------------------------------
| LOAD CITIES
|--------------------------------------------------------------------------
*/

$("#state_id").change(function () {
  let stateId = $(this).val();

  /*
  |--------------------------------------------------------------------------
  | LOADING
  |--------------------------------------------------------------------------
  */

  $("#city_id").html(`

                <option>

                    Carregando municípios...

                </option>

        `);

  /*
  |--------------------------------------------------------------------------
  | IMPORT CITIES FIRST
  |--------------------------------------------------------------------------
  */

  $.post(
    BASE_URL + "/location/import-cities/" + stateId,

    function () {
      /*
      |--------------------------------------------------------------------------
      | LOAD CITIES
      |--------------------------------------------------------------------------
      */

      $.ajax({
        url: BASE_URL + "/location/cities-by-state/" + stateId,

        type: "GET",

        dataType: "json",

        success: function (response) {
          let options = `

                                <option value="">

                                    Selecione o município

                                </option>

                            `;

          response.forEach(function (city) {
            options += `

                                    <option value="${city.name}">

                                        ${city.name}

                                    </option>

                                `;
          });

          $("#city_id").html(options);
        },

        error: function () {
          Swal.fire({
            icon: "error",

            title: "Erro",

            text: "Erro ao carregar municípios",
          });
        },
      });
    },
  );
});
