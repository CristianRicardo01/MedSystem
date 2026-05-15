<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        Login | Sistema Hospitalar
    </title>

    <!-- BOOTSTRAP -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- BOOTSTRAP ICONS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet">

    <!-- CSS -->

    <link rel="stylesheet"
        href="<?= base_url('assets/css/auth.css') ?>">

</head>

<body>

    <div class="login-wrapper">

        <!-- LEFT -->

        <div class="login-left d-none d-lg-flex">

            <div class="login-overlay"></div>

            <div class="login-content">

                <div class="brand-logo">

                    <i class="bi bi-heart-pulse-fill"></i>

                </div>

                <h1>

                    Sistema Hospitalar

                </h1>

                <p>

                    Plataforma de rastreamento e gerenciamento
                    de atendimentos hospitalares.

                </p>

            </div>

        </div>

        <!-- RIGHT -->

        <div class="login-right">

            <div class="login-card">

                <!-- HEADER -->

                <div class="mb-5">

                    <h2 class="fw-bold mb-2">
                        Bem-vindo
                    </h2>

                    <p class="text-muted mb-0">
                        Faça login para acessar o sistema.
                    </p>

                </div>

                <!-- FORM -->

                <form action="<?= base_url('login/auth') ?>"
                    method="POST">

                    <!-- EMAIL -->

                    <div class="mb-4">

                        <label class="form-label">
                            Email
                        </label>

                        <div class="input-modern">

                            <i class="bi bi-envelope"></i>

                            <input type="email"
                                class="form-control form-control-lg"
                                name="email"
                                placeholder="Digite seu email">

                        </div>

                    </div>

                    <!-- PASSWORD -->

                    <div class="mb-4">

                        <label class="form-label">
                            Senha
                        </label>

                        <div class="input-modern">

                            <i class="bi bi-lock"></i>

                            <input type="password"
                                class="form-control form-control-lg"
                                name="password"
                                placeholder="Digite sua senha">

                        </div>

                    </div>

                    <!-- REMEMBER -->

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <div class="form-check">

                            <input class="form-check-input"
                                type="checkbox"
                                id="remember">

                            <label class="form-check-label"
                                for="remember">

                                Lembrar acesso

                            </label>

                        </div>

                        <a href="#"
                            class="forgot-link">

                            Esqueceu a senha?

                        </a>

                    </div>

                    <!-- BTN -->

                    <button type="submit"
                        class="btn btn-primary btn-lg w-100 rounded-4">

                        <i class="bi bi-box-arrow-in-right me-2"></i>

                        Entrar

                    </button>

                </form>

            </div>

        </div>

    </div>

</body>

</html>