<!DOCTYPE html>
<html>

<head>

    <title>Importador IBGE</title>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

</head>

<body>

    <h2>Importando municípios...</h2>

    <div id="log"></div>

    <script>
        $(document).ready(function() {

            /*
            |--------------------------------------------------------------------------
            | LOAD STATES
            |--------------------------------------------------------------------------
            */

            $.get("<?= base_url('api/states') ?>", function(states) {

                let index = 0;

                function importNext() {

                    if (index >= states.length) {

                        $("#log").append("<p>IMPORTAÇÃO FINALIZADA</p>");

                        return;
                    }

                    let state = states[index];

                    $("#log").append(`

                        <p>

                            Importando ${state.name}

                        </p>

                    `);

                    $.ajax({

                        url:

                            "<?= base_url('location/import-cities') ?>/" +

                            state.id,

                        method: "POST",

                        success: function() {

                            $("#log").append(`

                                <p>

                                    OK ${state.name}

                                </p>

                            `);

                            index++;

                            importNext();

                        },

                        error: function() {

                            $("#log").append(`

                                <p>

                                    ERRO ${state.name}

                                </p>

                            `);

                            index++;

                            importNext();

                        }

                    });

                }

                importNext();

            });

        });
    </script>

</body>

</html>