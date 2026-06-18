<div class="page-title mb-4  mt-2" data-aos="fade-right" data-aos-delay="400">
    <h2>Gráfico Status</h2>
</div>

<div class="card shadow-sm rounded-4" data-aos="fade-up" data-aos-delay="400">

    <div class="card-header">

        <h5 class="fw-bold mb-0">

            Pacientes por Status
        </h5>

    </div>

    <div class="card-body">

        <div style="height:600px;">

            <canvas id="statusChart"></canvas>

        </div>

    </div>

</div>

<script>
    document.addEventListener(
        'DOMContentLoaded',
        function() {

            new Chart(

                document.getElementById(
                    'statusChart'
                ),

                {

                    type: 'pie',

                    data: {

                        labels: [

                            'Triagem',
                            'Em Atendimento',
                            'Internado',
                            'Finalizado'

                        ],

                        datasets: [{

                            data: [

                                <?= $statusChart['TRIAGEM'] ?>,
                                <?= $statusChart['EM ATENDIMENTO'] ?>,
                                <?= $statusChart['INTERNADO'] ?>,
                                <?= $statusChart['FINALIZADO'] ?>

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