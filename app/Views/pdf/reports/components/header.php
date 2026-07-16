<div class="header">

    <div class="header-left">

        <img src="<?= base_url('assets/img/logo.jpeg') ?>" class="logo">

        <div class="hospital-info">

            <h1><?= esc($title) ?></h1>

            <p>Central de Triagem e Regulação Hospitalar</p>

            <small>ERP Hospitalar MedSystem</small>

        </div>

    </div>

    <div class="document-info">

        <div class="doc-badge">

            ERP HOSPITALAR

        </div>

        <p>

            Emitido em:
            <?= date('d/m/Y H:i') ?>

        </p>

        <p>

            Usuário:
            <?= session('user_name') ?>

        </p>

    </div>

</div>