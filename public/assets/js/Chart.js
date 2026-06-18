new Chart(document.getElementById("statusChart"), {
  type: "pie",

  data: {
    labels: ["Triagem", "Em Atendimento", "Internado", "Finalizado"],

    datasets: [
      {
        data: [
          STATUS_TRIAGEM,
          STATUS_ATENDIMENTO,
          STATUS_INTERNADO,
          STATUS_FINALIZADO,
        ],
      },
    ],
  },
});
