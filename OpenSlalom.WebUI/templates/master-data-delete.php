<?php

declare(strict_types=1);

// TODO: This page is misleading. The `$masterType`/`$masterTitle` is not singular and that can confuse the user.

?>
<section class="vstack gap-4">
    <header>
        <p class="text-muted mb-0">Verwaltung</p>
        <h1 class="text-body-emphasis display-5 fw-bold mb-0"><?= escape($masterTitle) ?> löschen</h1>
        <p class="text-muted">Der Datensatz wird aus der aktiven Ansicht entfernt. Bereits verknüpfte Trainings- und Ergebnisdaten bleiben erhalten.</p>
    </header>

    <form action="<?= escape(base_url('verwaltung/' . $masterType . '/' . $item['id'] . '/loeschen')) ?>" method="post">
        <input type="hidden" name="csrf_token" value="<?= escape(csrf_token()) ?>">

        <button class="btn btn-danger" type="submit">
            <?= escape($masterTitle) ?> löschen
        </button>

        <button class="btn btn-secondary" type="submit" formaction="<?= escape(base_url('verwaltung/' . $masterType)) ?>">
            Abbrechen
        </button>
    </form>
</section>
