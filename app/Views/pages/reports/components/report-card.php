<div class="col-xl-4 col-lg-6 col-md-6">
    <style>
        .report-icon {
            width: 60px;
            height: 60px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 16px;

            font-size: 28px;
        }

        .report-card {

            transition: .25s;

            cursor: pointer;

        }
    
        .report-card:hover {

            transform: translateY(-6px);

            box-shadow: 0 12px 30px rgba(0, 0, 0, .10);

        }
    </style>

    <div class="card h-100 shadow-sm border-0 report-card">

        <div class="card-body d-flex flex-column">

            <div class="d-flex align-items-center mb-3">

                <div class="report-icon bg-<?= $report['color'] ?> bg-opacity-10">

                    <i class="bi <?= $report['icon'] ?> text-<?= $report['color'] ?>"></i>

                </div>

                <div class="ms-3">

                    <h5 class="mb-0">
                        <?= esc($report['title']) ?>
                    </h5>

                    <small class="text-muted">
                        <?= esc($report['subtitle']) ?>
                    </small>

                </div>

            </div>

            <p class="text-muted flex-grow-1 mb-4">
                <?= esc($report['description']) ?>
            </p>

            <a href="<?= $report['url'] ?>"
                class="btn btn-primary w-100">

                Abrir Relatório

                <i class="bi bi-arrow-right ms-2"></i>

            </a>

        </div>

    </div>

</div>