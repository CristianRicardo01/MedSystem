<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-4">

    <div class="card summary-card">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <div class="summary-title">

                        <?= esc($title) ?>

                    </div>

                    <div class="summary-value" <?= isset($id) ? 'id="' . esc($id) . '"' : '' ?>>

                        <?= esc($value) ?>

                    </div>

                </div>

                <div class="summary-icon bg-<?= esc($color) ?> bg-opacity-10">

                    <i class="bi <?= esc($icon) ?> text-<?= esc($color) ?>"></i>

                </div>

            </div>

        </div>

    </div>

</div>