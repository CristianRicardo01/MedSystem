<!-- DADOS -->

<div class="col-md-6" data-aos="fade-up" data-aos-delay="100">

    <div class="card card-modern border-0 h-100">

        <div class="card-body p-4">

            <div class="card-title-modern">

                <div class="icon-box blue">

                    <i class="bi bi-person"></i>

                </div>

                <div>

                    <h5 class="fw-bold mb-0">
                        Dados do Paciente
                    </h5>

                    <small class="text-muted">
                        Informações cadastrais
                    </small>

                </div>

            </div>

            <div class="info-list mt-4">

                <div class="info-item">

                    <small>CPF</small>

                    <strong>
                        <?= esc($patient['cpf']) ?>
                    </strong>

                </div>

                <div class="info-item">

                    <small>Telefone</small>

                    <strong>
                        <?= esc($patient['phone']) ?>
                    </strong>

                </div>

                <div class="info-item">

                    <small>Município</small>

                    <strong>
                        <?= esc($patient['city']) ?>

                        -

                        <?= esc($patient['state_uf']) ?>
                    </strong>

                </div>

            </div>

        </div>

    </div>

</div>