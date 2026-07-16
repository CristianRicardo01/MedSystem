console.log("CARREGANDO reports/exame.js");

$(function () {
  // Botões começam bloqueados
  toggleExportButtons(false);
  /*
  |--------------------------------------------------------------------------
  | Filtro
  |--------------------------------------------------------------------------
  */

  $("#formFilters").on("submit", function (e) {
    e.preventDefault();

    loadReport();
  });
});

/*
|--------------------------------------------------------------------------
| Carrega o relatório
|--------------------------------------------------------------------------
*/

function loadReport() {
  showLoading();

  $.ajax({
    url: BASE_URL + "reports/exams/search",

    type: "GET",

    data: $("#formFilters").serialize(),

    dataType: "json",

    success: function (response) {
      updateSummary(response.summary);

      updateTable(response.table);

      toggleExportButtons(response.table.length > 0);
    },

    error: function (xhr) {
      console.error(xhr);

      toggleExportButtons(false);

      alert("Erro ao carregar o relatório.");
    },

    complete: function () {
      hideLoading();
    },
  });
}

/*
|--------------------------------------------------------------------------
| Atualiza os cards
|--------------------------------------------------------------------------
*/

function updateSummary(summary) {
  $("#summary-pending").text(summary.pending);

  $("#summary-completed").text(summary.completed);
}

/*
|--------------------------------------------------------------------------
| Atualiza tabela
|--------------------------------------------------------------------------
*/

function updateTable(rows) {
  let html = "";

  if (rows.length === 0) {
    html = `
            <tr>
                <td colspan="4" class="text-center text-muted py-4">

                    Nenhum exame encontrado.

                </td>
            </tr>
        `;
  } else {
    rows.forEach(function (row) {
      let badge = "";

      switch (row.request_status) {
        case "PENDING":
          badge = '<span class="badge bg-warning text-dark">Pendente</span>';

          break;

        case "COMPLETED":
          badge = '<span class="badge bg-success">Realizado</span>';

          break;

        default:
          badge = row.request_status;
      }

      const showUrl =
        row.flow_type === "TRIAGE"
          ? `${BASE_URL}triage/show/${row.patient_id}`
          : `${BASE_URL}patients/show/${row.patient_id}`;

      html += `<tr>

            <td>${row.patient_name}</td>

            <td>${row.request_name}</td>

            <td>${badge}</td>

            <td>

                <a href="${showUrl}" class="btn-action">

                    <i class="bi bi-eye"></i>

                </a>

            </td>

        </tr>`;
    });
  }

  $("#table-exams tbody").html(html);
}
/*
|--------------------------------------------------------------------------
| Exportação
|--------------------------------------------------------------------------
*/

function toggleExportButtons(enabled) {
  $("#btnPdf").prop("disabled", !enabled);

  $("#btnExcel").prop("disabled", !enabled);
}

/*
|--------------------------------------------------------------------------
| PDF
|--------------------------------------------------------------------------
*/

$("#btnPdf").on("click", function () {
  const query = $("#formFilters").serialize();

  window.open(
    BASE_URL + "reports/exams/pdf?" + query,

    "_blank",
  );
});

/*
|--------------------------------------------------------------------------
| Loading
|--------------------------------------------------------------------------
*/

function showLoading() {
  $("#loading").show();

  $("#report-content").hide();
}

function hideLoading() {
  $("#loading").hide();

  $("#report-content").show();
}
