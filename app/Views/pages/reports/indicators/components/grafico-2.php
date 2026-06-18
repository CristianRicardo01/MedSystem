<div class="page-title mb-4 mt-2" data-aos="fade-right" data-aos-delay="500">
    <h2>Gráfico Solicitações</h2>
</div>

<div class="card shadow-sm rounded-4" data-aos="fade-up" data-aos-delay="600">

    <div class="card-header">

        <h5 class="fw-bold mb-0">

            Solicitações por Status

        </h5>

    </div>

    <div class="card-body">

        <div style="height:600px;">
            <canvas id="requestChart"></canvas>
        </div>
    </div>

</div>

<script>
    document.addEventListener(
        'DOMContentLoaded',
        function() {

            new Chart(

                document.getElementById(
                    'requestChart'
                ),

                {

                    type: 'bar',

                    data: {

                        labels: [

                            'Pendente',
                            'Agendado',
                            'Finalizado'

                        ],

                        datasets: [{

                            label: 'Solicitações',

                            data: [

                                <?= $requestChart['PENDING'] ?>,
                                <?= $requestChart['SCHEDULED'] ?>,
                                <?= $requestChart['COMPLETED'] ?>

                            ]

                        }]

                    },

                    options: {

                        responsive: true,

                        maintainAspectRatio: false

                    }

                }

            );

        }

    );
</script>