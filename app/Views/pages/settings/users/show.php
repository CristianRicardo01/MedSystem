<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <!-- PERFIL -->

    <div class="card border-0 shadow-sm rounded-4 mb-4">

        <div class="card-body">

            <div class="d-flex align-items-center">

                <div
                    class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold"
                    style="
                            width:80px;
                            height:80px;
                            font-size:32px;
                            border:4px solid rgba(255,255,255,.3);
                            ">

                    <?= strtoupper(substr(userName(), 0, 1)) ?>

                </div>

                <div class="ms-4">

                    <h3 class="fw-bold mb-1">

                        <?= userName() ?>

                    </h3>

                    <div class="d-flex gap-2">

                        <span class="badge bg-primary px-3 py-2">

                            <?= userRole() ?>

                        </span>

                        <span class="badge bg-success px-3 py-2">

                            <?= $user['status'] ?>

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <!-- DADOS DA CONTA -->

        <div class="col-lg-6 mb-4">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-header bg-white border-0">

                    <h5 class="fw-bold mb-0">

                        <i class="bi bi-person-vcard me-2"></i>

                        Dados da Conta

                    </h5>

                </div>

                <div class="card-body">

                    <div class="mb-4">

                        <small class="text-muted d-block">
                            Nome
                        </small>

                        <strong>
                            <?= userName() ?>
                        </strong>

                    </div>

                    <hr>

                    <div class="mb-4">

                        <small class="text-muted d-block">
                            E-mail
                        </small>

                        <strong>
                            <?= userEmail() ?>
                        </strong>

                    </div>

                    <hr>

                    <div class="mb-4">

                        <small class="text-muted d-block">
                            Perfil
                        </small>

                        <strong>
                            <?= userRole() ?>
                        </strong>

                    </div>

                    <hr>

                    <div class="mb-4">

                        <small class="text-muted d-block">

                            Usuário desde

                        </small>

                        <strong>

                            <?= date(
                                'd/m/Y',
                                strtotime($user['created_at'])
                            ) ?>

                        </strong>

                    </div>

                    <hr>

                    <div class="mb-4">

                        <small class="text-muted d-block">
                            Último Login
                        </small>

                        <strong>

                            <?= !empty($user['last_login'])
                                ? date(
                                    'd/m/Y  ',
                                    strtotime($user['last_login'])
                                )
                                : 'Primeiro acesso'; ?>

                        </strong>

                    </div>

                </div>

            </div>

        </div>

        <!-- ALTERAÇÃO DE SENHA -->

        <div class="col-lg-6 mb-4">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-header bg-white border-0">

                    <h5 class="fw-bold mb-0">

                        <i class="bi bi-shield-lock me-2"></i>

                        Alteração de Senha

                    </h5>

                </div>

                <div class="card-body">

                    <form
                        id="formChangePassword"
                        method="POST"
                        action="<?= base_url('profile/change-password') ?>">
                        
                        <div class="mb-3">

                            <label class="form-label">

                                Senha Atual

                            </label>

                            <input
                                type="password"
                                name="current_password"
                                id="current_password"
                                class="form-control form-control-lg"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Nova Senha

                            </label>

                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control form-control-lg"
                                required>

                        </div>
                        <div class="mt-3">
                            <div class="progress mt-3" style="height:8px;">

                                <div
                                    id="passwordStrength"
                                    class="progress-bar"
                                    role="progressbar"
                                    style="width:0%">
                                </div>

                            </div>

                            <small id="passwordStrengthText" class="text-muted">

                                Digite uma senha

                            </small>
                            <small class="d-block mb-2">

                                Requisitos da senha:

                            </small>

                            <div id="length" class="text-danger">

                                <i class="bi bi-circle-fill me-1"></i>

                                Mínimo de 8 caracteres

                            </div>

                            <div id="uppercase" class="text-danger">

                                <i class="bi bi-circle-fill me-1"></i>

                                Pelo menos 1 letra maiúscula

                            </div>

                            <div id="special" class="text-danger">

                                <i class="bi bi-circle-fill me-1"></i>

                                Pelo menos 1 caractere especial

                            </div>

                        </div>

                        <div class="mb-4">

                            <label class="form-label">

                                Confirmar Nova Senha

                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                class="form-control form-control-lg"
                                required>

                            <div
                                id="passwordMatch"
                                class="small mt-2">
                            </div>

                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary rounded-4 px-4">

                            <i class="bi bi-check-circle me-2"></i>

                            Atualizar Senha

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>