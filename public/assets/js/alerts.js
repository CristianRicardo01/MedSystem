console.log("CARREGADO ALERTS");

function loadAlerts() {
  // console.log("ENTROU NA FUNÇÃO");

  $.get(BASE_URL + "alerts", function (response) {
    // console.log("RESPOSTA:");
    // console.log("TIPO:", typeof response);
    // console.log("RESPONSE:", response);
    // console.log("LENGTH:", response.length);
    // console.table(response);
    // console.log("ARRAY?", Array.isArray(response));
    // console.log(response);
    // response.forEach(function (alert) {
    //   console.log(alert.title, alert.message, alert.flow_type);
    // });
    $("#alertCount").text(response.length);

    let html = "";

    if (response.length === 0) {
      html += `

        <div class="p-3 border-start border-4 border-primary">

            <div class="d-flex justify-content-between">
            
                <div>

                    <strong>

                        Nenhum alerta encontrado

                    </small>

                </div>
                
            </div>

        </div>

    `;
    } else {
      response.forEach(function (alert) {
        let borderClass = "border-secondary";

        if (alert.type === "danger") {
          borderClass = "border-danger";
        }

        if (alert.type === "warning") {
          borderClass = "border-warning";
        }

        if (alert.type === "info") {
          borderClass = "border-primary";
        }

        html += `

        <a href="${alert.url}" class="text-decoration-none text-dark">

            <div class="p-3 border-start border-4 ${borderClass}">

                <div class="d-flex justify-content-between">

                    <div>

                        <strong>

                            ${alert.title}

                        </strong>

                        <br>

                        <small>

                            ${alert.message}

                        </small>

                    </div>

                    <div>

                        <i
                            class="bi bi-arrow-right-circle">

                        </i>

                    </div>

                </div>

            </div>

        </a>

        `;
      });
    }

    $("#alertsContainer").html(html);
  });
}

loadAlerts();
