<div class="page-title mb-4" data-aos="fade-right" data-aos-delay="100">
    <h2>Indicadores Geral</h2>
</div>

<div class="mb-3" data-aos="fade-right" data-aos-delay="200">

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