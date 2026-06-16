<div class="page-title mb-4" data-aos="fade-right">
    <h2>Visão Geral</h2>
    <p>Bem-vindo ao painel administrativo hospitalar.</p>
</div>

<div class="mb-3">

    <h5 class="fw-bold">

        <?php if (isAdmin()) : ?>

            Central do Administrador

        <?php elseif (userRole() == 'REGULACAO') : ?>

            Central de Regulação

        <?php elseif (userRole() == 'TRIAGEM') : ?>

            Central de Triagem

        <?php endif; ?>
    </h5>

</div>