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
| LOAD STATES
|--------------------------------------------------------------------------
*/

function loadStates(selectId, selectedValue = null) {
  $.ajax({
    url: BASE_URL + "/location/states",

    type: "GET",

    dataType: "json",

    success: function (response) {
      let options = `

        <option value="">

          Selecione o estado

        </option>

      `;

      response.forEach(function (state) {
        options += `

          <option value="${state.id}">

            ${state.name}

          </option>

        `;
      });

      /*
      |--------------------------------------------------------------------------
      | RENDER
      |--------------------------------------------------------------------------
      */

      $(selectId).html(options);

      /*
      |--------------------------------------------------------------------------
      | SELECT CURRENT
      |--------------------------------------------------------------------------
      */

      if (selectedValue) {
        $(selectId)
          .val(selectedValue)

          .trigger("change");
      }
    },

    error: function () {
      Swal.fire({
        icon: "error",

        title: "Erro",

        text: "Erro ao carregar estados",
      });
    },
  });
}

/*
|--------------------------------------------------------------------------
| LOAD CREATE CITIES
|--------------------------------------------------------------------------
*/

$(document).on("change", "#state_id", function () {
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
  | AJAX
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
});

/*
|--------------------------------------------------------------------------
| LOAD EDIT CITIES
|--------------------------------------------------------------------------
*/

$(document).on("change", "#edit_state_id", function () {
  let stateId = $(this).val();

  /*
  |--------------------------------------------------------------------------
  | LOADING
  |--------------------------------------------------------------------------
  */

  $("#edit_city_id").html(`

    <option>

      Carregando municípios...

    </option>

  `);

  /*
  |--------------------------------------------------------------------------
  | AJAX
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

      /*
      |--------------------------------------------------------------------------
      | RENDER
      |--------------------------------------------------------------------------
      */

      $("#edit_city_id").html(options);

      /*
      |--------------------------------------------------------------------------
      | SELECT CURRENT CITY
      |--------------------------------------------------------------------------
      */

      if (window.selectedPatientCity) {
        $("#edit_city_id").val(window.selectedPatientCity);
      }
    },

    error: function () {
      Swal.fire({
        icon: "error",

        title: "Erro",

        text: "Erro ao carregar municípios",
      });
    },
  });
});

/*
|--------------------------------------------------------------------------
| INIT CREATE STATES
|--------------------------------------------------------------------------
*/

loadStates("#state_id");