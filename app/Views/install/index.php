<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?? 'Instalação do Sistema' ?></title>
    <!-- favicon -->
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/favicon.png') ?>">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body class="bg-light">

    <div class="container">

        <div class="row justify-content-center min-vh-100 align-items-center">

            <div class="col-lg-6">

                <div class="card border-0 shadow rounded-4">

                    <div class="card-body p-5 text-center">

                        <h2 class="fw-bold mb-3">

                            Sistema Hospitalar

                        </h2>

                        <p class="text-muted mb-4">

                            Assistente de Instalação

                        </p>

                        <?php if (session()->getFlashdata('success')) : ?>

                            <div class="alert alert-success">

                                <?= session()->getFlashdata('success') ?>

                            </div>

                        <?php endif; ?>

                        <?php if (session()->getFlashdata('error')) : ?>

                            <div class="alert alert-danger">

                                <?= session()->getFlashdata('error') ?>

                            </div>

                        <?php endif; ?>

                        <form
                            action="<?= base_url('install/run') ?>"
                            method="post">

                            <?= csrf_field() ?>

                            <button
                                type="submit"
                                class="btn btn-primary btn-lg rounded-4 px-5">

                                Instalar Sistema

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>