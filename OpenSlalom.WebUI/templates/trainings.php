<?php

declare(strict_types=1);

?>

<section class="py-2">
    <div class="page-header d-flex flex-wrap gap-3 justify-content-between align-items-end">
        <div>
            <p class="eyebrow mb-2">Race control</p>
            <h1 class="display-6 fw-bold mb-0">Trainings</h1>
        </div>
        <?php if ($canManageTrainings): ?><a class="btn btn-primary" href="<?= escape(base_url('trainings/neu')) ?>">Training anlegen</a><?php endif; ?>
    </div>

    <p class="text-body-secondary mb-4">Veröffentlichte Trainings und Trainings, denen du als Fahrer zugeordnet bist.</p>

    <?php $listPath = 'trainings';
    $showSearch = true;
    $showPagination = false;
    require __DIR__ . '/list-controls.php'; ?>
    <?php if (empty($trainings)): ?>
        <div class="alert alert-info"><strong>Keine Trainings verfügbar.</strong> Es wurden noch keine passenden Trainings veröffentlicht oder zugeordnet.</div>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php foreach ($trainings as $training): ?>
                <article class="col">
                    <div class="surface-card rounded-4 overflow-hidden"><a class="card-body d-block text-decoration-none text-body p-4" href="<?= escape(base_url('training/' . $training['uuid'])) ?>">
                                    <div class="d-flex justify-content-between gap-2 align-items-start mb-3"><span class="badge text-bg-primary"><?= escape(format_date($training['zeitpunkt'])) ?></span><?php if ((bool) $training['ist_veroeffentlicht']): ?><span class="badge text-bg-success"><span class="status-dot"></span>Veröffentlicht</span><?php else: ?><span class="badge text-bg-secondary">Entwurf</span><?php endif; ?></div>
                                    <h2 class="h4"><?= escape($training['name']) ?></h2>
                                    <p class="text-body-secondary"><?= escape($training['beschreibung']) ?></p>
                                    <div class="d-flex flex-wrap gap-3 text-body-secondary small"><span><?= escape($training['vereinsname']) ?></span><span><?= escape($training['disziplin']) ?></span></div>
                        </a><?php if ($canManageTrainings): ?><div class="px-4 pb-4"><a class="btn btn-sm btn-outline-primary" href="<?= escape(base_url('training/' . $training['uuid'] . '/bearbeiten')) ?>">Bearbeiten</a></div><?php endif; ?></div>
                </article>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>
    <?php if (empty($trainings)): ?>

        <?php $listPath = 'trainings';
        $showSearch = false;
        $showPagination = true;
        require __DIR__ . '/list-controls.php';
        ?>

    <?php endif; ?>
</section>
