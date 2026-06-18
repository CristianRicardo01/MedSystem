<?php if (session()->getFlashdata('success')) : ?>

    <div class="alert alert-success rounded-4">

        <i class="bi bi-check-circle me-2"></i>

        <?= session()->getFlashdata('success') ?>

    </div>

<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>

    <div class="alert alert-danger rounded-4">

        <i class="bi bi-exclamation-triangle me-2"></i>

        <?= session()->getFlashdata('error') ?>

    </div>

<?php endif; ?>