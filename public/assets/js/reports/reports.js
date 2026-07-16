console.log("CARREGANDO reports.js");

// Filtros

$(function () {
  $("#filter_request_type").select2({
    placeholder: "Pesquisar exame...",

    allowClear: true,

    width: "100%",
  });
});
