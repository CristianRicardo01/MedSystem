<!DOCTYPE html>
<html lang="pt-br">

<head>

    <?= $this->include('layouts/header') ?>

</head>

<body>

    <!-- SIDEBAR -->
    <?= $this->include('layouts/sidebar') ?>

    <!-- MAIN -->
    <main class="main-wrapper">

        <!-- NAVBAR -->
        <?= $this->include('layouts/navbar') ?>

        <!-- CONTENT -->
        <section class="content-area">

            <?= $this->renderSection('content') ?>

        </section>

    </main>

    <!-- FOOTER -->
    <?= $this->include('layouts/footer') ?>

</body>

</html>