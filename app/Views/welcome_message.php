<!-- 
|--------------------------------------------------------------------------
| Dashboard Hospitalar Profissional
| Bootstrap 5 + Responsivo + CodeIgniter 4
|--------------------------------------------------------------------------
| Estrutura sugerida:
|
| app/Views/layouts/dashboard.php
|--------------------------------------------------------------------------
-->

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Hospitalar</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        :root {

            /* PALETA HOSPITALAR */

            --primary-blue: #4A90E2;
            --secondary-green: #4CAF50;
            --soft-beige: #F5E9DA;
            --off-white: #FAFAFA;
            --light-yellow: #FFF4CC;
            --soft-pink: #F8E1E7;
            --light-gray: #E9ECEF;

            --sidebar-bg: #ffffff;
            --navbar-bg: #ffffff;
            --body-bg: #f4f7fb;

            --text-dark: #2c3e50;
            --text-light: #6c757d;

            --card-radius: 18px;
            --transition: all .3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--body-bg);
            overflow-x: hidden;
        }

        /* =========================
           SIDEBAR
        ========================== */

        .sidebar {
            width: 270px;
            height: 100vh;
            background: var(--sidebar-bg);
            position: fixed;
            left: 0;
            top: 0;
            z-index: 999;
            border-right: 1px solid #e5e7eb;
            transition: var(--transition);
            overflow-y: auto;
        }

        .sidebar-logo {
            padding: 25px;
            border-bottom: 1px solid #f1f1f1;
        }

        .sidebar-logo h3 {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin: 0;
        }

        .sidebar-menu {
            padding: 20px 15px;
        }

        .menu-title {
            font-size: 12px;
            font-weight: 600;
            color: #9ca3af;
            text-transform: uppercase;
            margin: 20px 15px 10px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 16px;
            text-decoration: none;
            border-radius: 14px;
            color: var(--text-dark);
            font-weight: 500;
            margin-bottom: 8px;
            transition: var(--transition);
        }

        .sidebar-link:hover {
            background: rgba(74, 144, 226, 0.1);
            color: var(--primary-blue);
            transform: translateX(3px);
        }

        .sidebar-link.active {
            background: var(--primary-blue);
            color: white;
            box-shadow: 0 10px 25px rgba(74, 144, 226, 0.25);
        }

        .sidebar-link i {
            font-size: 20px;
        }

        /* =========================
           NAVBAR
        ========================== */

        .main-wrapper {
            margin-left: 270px;
            transition: var(--transition);
        }

        .top-navbar {
            background: var(--navbar-bg);
            height: 80px;
            border-bottom: 1px solid #ececec;
            padding: 0 25px;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            border: none;
            background: #f5f7fa;
            padding: 12px 20px 12px 45px;
            border-radius: 14px;
            width: 320px;
        }

        .search-box i {
            position: absolute;
            left: 16px;
            top: 13px;
            color: #9ca3af;
        }

        .profile-box {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .profile-box img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* =========================
           CONTENT
        ========================== */

        .content-area {
            padding: 30px;
        }

        .page-title h2 {
            font-weight: 700;
            color: var(--text-dark);
        }

        .page-title p {
            color: var(--text-light);
        }

        /* =========================
           CARDS
        ========================== */

        .dashboard-card {
            border: none;
            border-radius: var(--card-radius);
            padding: 25px;
            transition: var(--transition);
            height: 100%;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
        }

        .card-blue {
            background: linear-gradient(135deg, #4A90E2, #6BA8F0);
            color: white;
        }

        .card-green {
            background: linear-gradient(135deg, #4CAF50, #7BC67E);
            color: white;
        }

        .card-beige {
            background: var(--soft-beige);
        }

        .card-yellow {
            background: var(--light-yellow);
        }

        .dashboard-card .icon {
            width: 60px;
            height: 60px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 20px;
            background: rgba(255, 255, 255, 0.2);
        }

        .dashboard-card h3 {
            font-size: 2rem;
            font-weight: 700;
        }

        /* =========================
           TABLE
        ========================== */

        .custom-table {
            background: white;
            border-radius: 20px;
            overflow: hidden;
        }

        .custom-table table {
            margin: 0;
        }

        .custom-table th {
            background: #f8fafc;
            padding: 18px;
            color: #64748b;
            border: none;
        }

        .custom-table td {
            padding: 18px;
            vertical-align: middle;
            border-color: #f1f5f9;
        }

        /* =========================
           MOBILE
        ========================== */

        .mobile-toggle {
            display: none;
        }

        @media(max-width: 991px) {

            .sidebar {
                left: -100%;
            }

            .sidebar.active {
                left: 0;
            }

            .main-wrapper {
                margin-left: 0;
            }

            .mobile-toggle {
                display: block;
            }

            .search-box input {
                width: 100%;
            }

            .content-area {
                padding: 20px;
            }
        }

        @media(max-width: 576px) {

            .top-navbar {
                padding: 0 15px;
            }

            .dashboard-card {
                padding: 20px;
            }

            .page-title h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">

        <div class="sidebar-logo">
            <h3>
                <i class="bi bi-heart-pulse-fill"></i>
                MedSystem
            </h3>
        </div>

        <div class="sidebar-menu">

            <div class="menu-title">Principal</div>

            <a href="#" class="sidebar-link active">
                <i class="bi bi-grid"></i>
                Dashboard
            </a>

            <a href="#" class="sidebar-link">
                <i class="bi bi-people"></i>
                Pacientes
            </a>

            <a href="#" class="sidebar-link">
                <i class="bi bi-calendar-check"></i>
                Consultas
            </a>

            <a href="#" class="sidebar-link">
                <i class="bi bi-hospital"></i>
                Internações
            </a>

            <div class="menu-title">Gestão</div>

            <a href="#" class="sidebar-link">
                <i class="bi bi-capsule"></i>
                Medicamentos
            </a>

            <a href="#" class="sidebar-link">
                <i class="bi bi-file-earmark-medical"></i>
                Relatórios
            </a>

            <a href="#" class="sidebar-link">
                <i class="bi bi-gear"></i>
                Configurações
            </a>

        </div>

    </aside>

    <!-- MAIN -->
    <main class="main-wrapper">

        <!-- NAVBAR -->
        <nav class="top-navbar d-flex align-items-center justify-content-between">

            <div class="d-flex align-items-center gap-3">

                <button class="btn btn-light mobile-toggle" id="toggleSidebar">
                    <i class="bi bi-list"></i>
                </button>

                <div>
                    <h5 class="mb-0 fw-bold">Dashboard Hospitalar</h5>
                    <small class="text-muted">Sistema de Gestão Clínica</small>
                </div>

            </div>

            <div class="d-flex align-items-center gap-4">

                <div class="search-box d-none d-md-block">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Pesquisar...">
                </div>

                <button class="btn position-relative">
                    <i class="bi bi-bell fs-5"></i>

                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        3
                    </span>
                </button>

                <div class="profile-box">

                    <img src="https://i.pravatar.cc/100" alt="">

                    <div class="d-none d-md-block">
                        <strong>Administrador</strong>
                        <br>
                        <small class="text-muted">Online</small>
                    </div>

                </div>

            </div>

        </nav>

        <!-- CONTENT -->
        <section class="content-area">

            <div class="page-title mb-4">
                <h2>Visão Geral</h2>
                <p>Bem-vindo ao painel administrativo hospitalar.</p>
            </div>

            <!-- CARDS -->
            <div class="row g-4 mb-4">

                <div class="col-md-6 col-xl-3">

                    <div class="dashboard-card card-blue">

                        <div class="icon">
                            <i class="bi bi-people"></i>
                        </div>

                        <h3>1.245</h3>

                        <p class="mb-0">
                            Pacientes Ativos
                        </p>

                    </div>

                </div>

                <div class="col-md-6 col-xl-3">

                    <div class="dashboard-card card-green">

                        <div class="icon">
                            <i class="bi bi-calendar-check"></i>
                        </div>

                        <h3>328</h3>

                        <p class="mb-0">
                            Consultas Hoje
                        </p>

                    </div>

                </div>

                <div class="col-md-6 col-xl-3">

                    <div class="dashboard-card card-beige">

                        <div class="icon bg-white">
                            <i class="bi bi-heart-pulse text-primary"></i>
                        </div>

                        <h3>98%</h3>

                        <p class="mb-0">
                            Taxa de Atendimento
                        </p>

                    </div>

                </div>

                <div class="col-md-6 col-xl-3">

                    <div class="dashboard-card card-yellow">

                        <div class="icon bg-white">
                            <i class="bi bi-clipboard2-pulse text-warning"></i>
                        </div>

                        <h3>17</h3>

                        <p class="mb-0">
                            Emergências
                        </p>

                    </div>

                </div>

            </div>

            <!-- TABLE -->
            <div class="custom-table shadow-sm">

                <div class="p-4 border-bottom">
                    <h5 class="mb-0 fw-bold">
                        Últimos Atendimentos
                    </h5>
                </div>

                <div class="table-responsive">

                    <table class="table align-middle">

                        <thead>
                            <tr>
                                <th>Paciente</th>
                                <th>Médico</th>
                                <th>Setor</th>
                                <th>Status</th>
                                <th>Data</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr>
                                <td>Maria Silva</td>
                                <td>Dr. Carlos</td>
                                <td>Cardiologia</td>
                                <td>
                                    <span class="badge bg-success">
                                        Finalizado
                                    </span>
                                </td>
                                <td>13/05/2026</td>
                            </tr>

                            <tr>
                                <td>João Pedro</td>
                                <td>Dra. Ana</td>
                                <td>Ortopedia</td>
                                <td>
                                    <span class="badge bg-warning text-dark">
                                        Em atendimento
                                    </span>
                                </td>
                                <td>13/05/2026</td>
                            </tr>

                            <tr>
                                <td>Fernanda Lima</td>
                                <td>Dr. Marcelo</td>
                                <td>Pediatria</td>
                                <td>
                                    <span class="badge bg-primary">
                                        Aguardando
                                    </span>
                                </td>
                                <td>13/05/2026</td>
                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </section>

    </main>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

    <script>

        // SIDEBAR MOBILE

        const toggleSidebar = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');

        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });

    </script>

</body>

</html>