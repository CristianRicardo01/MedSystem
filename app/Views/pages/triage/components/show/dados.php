<!-- DADOS -->

<div class="col-md-6"
    data-aos="fade-up">

    <div class="card card-modern border-0 h-100">

        <div class="card-body p-4">

            <!-- HEADER -->

            <div class="card-title-modern">

                <div class="icon-box blue">

                    <i class="bi bi-person"></i>

                </div>

                <div>

                    <h5 class="fw-bold mb-0">
                        Dados Paciente
                    </h5>

                    <small class="text-muted">
                        Informações cadastrais
                    </small>

                </div>

            </div>

            <!-- INFO -->

            <div class="info-list mt-4">

                <!-- CPF -->

                <div class="info-item">

                    <small>
                        CPF
                    </small>

                    <strong>

                        <?= !empty($patient['cpf'])
                            ? esc($patient['cpf'])
                            : 'Não informado'
                        ?>

                    </strong>

                </div>

                <!-- TELEFONE -->

                <div class="info-item">

                    <small>
                        Telefone
                    </small>

                    <strong>

                        <?= !empty($patient['phone'])
                            ? esc($patient['phone'])
                            : 'Não informado'
                        ?>

                    </strong>

                </div>

                <!-- NASCIMENTO -->

                <div class="info-item">

                    <small>
                        Nascimento
                    </small>

                    <strong>

                        <?= !empty($patient['birth_date'])
                            ? date(
                                'd/m/Y',
                                strtotime($patient['birth_date'])
                            )
                            : 'Não informado'
                        ?>

                    </strong>

                </div>

                <!-- MUNICIPIO -->

                <div class="info-item">

                    <small>
                        Município
                    </small>

                    <strong>

                        <?php

                        $city = $patient['city'] ?? null;

                        $state = $patient['state'] ?? null;

                        ?>

                        <?= !empty($city) || !empty($state)
                            ? esc($city . ' - ' . $state)
                            : 'Não informado'
                        ?>

                    </strong>

                </div>

                <!-- EXAMES -->

                <div class="info-item">

                    <small>
                        Possui Exames
                    </small>

                    <strong>

                        <?php if (!empty($patient['has_exams'])): ?>

                            <span class="badge bg-success rounded-pill">

                                SIM

                            </span>

                        <?php else: ?>

                            <span class="badge bg-danger rounded-pill">

                                NÃO

                            </span>

                        <?php endif; ?>

                    </strong>

                </div>

                <!-- CONSULTA -->

                <div class="info-item">

                    <small>
                        Consulta
                    </small>

                    <strong>

                        <?= !empty($patient['first_consultation_date'])
                            ? date(
                                'd/m/Y',
                                strtotime(
                                    $patient['first_consultation_date']
                                )
                            )
                            : 'Não informado'
                        ?>

                    </strong>

                </div>

            </div>

        </div>

    </div>

</div>