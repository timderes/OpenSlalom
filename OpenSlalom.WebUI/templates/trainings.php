<?php declare(strict_types=1); ?>
<section class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div><p class="text-primary fw-semibold mb-2">Persönliche Übersicht</p><h1>Trainings</h1></div>
        <?php if ($canManageTrainings): ?><a class="btn btn-primary" href="<?= escape(base_url('trainings/neu')) ?>">+ Training anlegen</a><?php endif; ?>
    </div>
    <p class="listing-lead">Veröffentlichte Trainings und Trainings, denen du als Fahrer zugeordnet bist.</p>
    <?php $listPath = 'trainings'; $showSearch = true; $showPagination = false; require __DIR__ . '/list-controls.php'; ?>
    <?php if ($trainings === []): ?>
        <div class="alert alert-info"><strong>Keine Trainings verfügbar.</strong> Es wurden noch keine passenden Trainings veröffentlicht oder zugeordnet.</div>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php foreach ($trainings as $training): ?>
                <article class="col"><div class="card h-100 shadow-sm"><a class="card-body text-decoration-none text-body" href="<?= escape(base_url('training/' . $training['uuid'])) ?>">
                        <span class="training-card-date"><?= escape(format_date($training['zeitpunkt'])) ?></span>
                        <h2><?= escape($training['name']) ?></h2>
                        <p><?= escape($training['beschreibung']) ?></p>
                        <div class="d-flex gap-3 text-body-secondary"><span><?= escape($training['vereinsname']) ?></span><span><?= escape($training['disziplin']) ?></span></div>
                    </a><?php if ((bool) $training['ist_veroeffentlicht']): ?><b class="badge text-bg-success m-3">Veröffentlicht</b><?php endif; ?><?php if ($canManageTrainings): ?><a class="btn btn-sm btn-outline-primary m-3" href="<?= escape(base_url('training/' . $training['uuid'] . '/bearbeiten')) ?>">Bearbeiten</a><?php endif; ?></div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <?php if ($trainings !== []): ?><?php $listPath = 'trainings'; $showSearch = false; $showPagination = true; require __DIR__ . '/list-controls.php'; ?><?php endif; ?>
</section>
