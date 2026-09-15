<?php declare(strict_types=1); ?>
<?php $showSearch ??= true; $showPagination ??= true; ?>
<?php if ($showSearch): ?>
    <div class="d-flex flex-wrap gap-3 align-items-end mb-4">
        <form class="d-flex flex-wrap gap-2" action="<?= escape(base_url($listPath)) ?>" method="get">
            <label><span class="visually-hidden">Liste durchsuchen</span><input class="form-control" name="q" value="<?= escape($search) ?>" maxlength="100" placeholder="Suchen ..."></label>
            <button class="btn btn-primary" type="submit">Suchen</button>
            <?php if ($search !== ''): ?><a class="btn btn-outline-secondary" href="<?= escape(base_url($listPath)) ?>">Zurücksetzen</a><?php endif; ?>
        </form>
        <span class="text-body-secondary"><?= (int) $pagination['total'] ?> Eintrag<?= (int) $pagination['total'] === 1 ? '' : 'e' ?></span>
    </div>
<?php endif; ?>
<?php if ($showPagination && $pagination['pages'] > 1): ?>
    <nav aria-label="Seitennavigation"><ul class="pagination">
        <?php if ($pagination['page'] > 1): ?><li class="page-item"><a class="page-link" href="<?= escape(list_page_url($listPath, $pagination['page'] - 1, $search)) ?>">← Zurück</a></li><?php endif; ?>
        <?php for ($page = max(1, $pagination['page'] - 2); $page <= min($pagination['pages'], $pagination['page'] + 2); $page++): ?>
            <li class="page-item <?= $page === $pagination['page'] ? 'active' : '' ?>"><a class="page-link" href="<?= escape(list_page_url($listPath, $page, $search)) ?>"><?= $page ?></a></li>
        <?php endfor; ?>
        <?php if ($pagination['page'] < $pagination['pages']): ?><li class="page-item"><a class="page-link" href="<?= escape(list_page_url($listPath, $pagination['page'] + 1, $search)) ?>">Weiter →</a></li><?php endif; ?>
    </ul></nav>
<?php endif; ?>
