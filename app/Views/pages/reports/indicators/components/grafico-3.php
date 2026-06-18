<div class="page-title mb-4 mt-2" data-aos="fade-right" data-aos-delay="600">
    <h2>Gráfico D60</h2>
</div>

<div class="card shadow-sm rounded-4" data-aos="fade-up" data-aos-delay="700">

    <div class="card-header">

        <h5 class="fw-bold mb-0">

            Indicador D60

        </h5>

    </div>

    <div class="card-body">

        <div style="height:600px;">

            <canvas id="d60Chart"></canvas>

        </div>

    </div>

</div>

<script>
    document.addEventListener(
        'DOMContentLoaded',
        function() {

            new Chart(

                document.getElementById(
                    'd60Chart'
                ),

                {

                    type: 'doughnut',

                    data: {

                        labels: [

                            'D60 Vencidos',
                            'D60 Próximos'

                        ],

                        datasets: [{

                            data: [

                                <?= $d60Expired ?>,
                                <?= $d60Warning ?>

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