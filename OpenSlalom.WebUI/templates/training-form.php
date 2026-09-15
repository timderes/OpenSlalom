<?php
declare(strict_types=1);

$formAction = $editMode ? 'training/' . $trainingUuid : 'trainings';
?>
<section class="container py-4">
    <div class="mb-4">
        <div>
            <p class="text-primary fw-semibold mb-2">Trainingsverwaltung</p>
            <h1><?= $editMode ? 'Training bearbeiten' : 'Training anlegen' ?></h1>
        </div>
    </div>

    <div class="card shadow-sm p-4">
        <?php if (isset($formError)): ?><div class="alert alert-danger" role="alert"><?= escape($formError) ?></div><?php endif; ?>
        <form class="row g-3" action="<?= escape(base_url($formAction)) ?>" method="post">
            <input type="hidden" name="csrf_token" value="<?= escape(csrf_token()) ?>">

            <label class="col-12 form-label">Name<input class="form-control" name="name" value="<?= escape($formValues['name'] ?? '') ?>" required maxlength="100"></label>
            <label class="col-12 form-label">Beschreibung<textarea class="form-control" name="beschreibung" required maxlength="250" rows="4"><?= escape($formValues['beschreibung'] ?? '') ?></textarea></label>
            <label class="col-md-6 form-label">Datum<input class="form-control" type="date" name="zeitpunkt" value="<?= escape($formValues['zeitpunkt'] ?? '') ?>" required></label>
            <label class="col-md-6 form-label">Verein
                <select class="form-select" name="verein_id" required>
                    <option value="">Bitte auswählen</option>
                    <?php foreach ($lookups['clubs'] as $item): ?><option value="<?= (int) $item['id'] ?>" <?= (int) ($formValues['verein_id'] ?? 0) === (int) $item['id'] ? 'selected' : '' ?>><?= escape($item['name']) ?></option><?php endforeach; ?>
                </select>
            </label>
            <label class="col-md-6 form-label">Disziplin
                <select class="form-select" name="disziplin_id" required>
                    <option value="">Bitte auswählen</option>
                    <?php foreach ($lookups['disciplines'] as $item): ?><option value="<?= (int) $item['id'] ?>" <?= (int) ($formValues['disziplin_id'] ?? 0) === (int) $item['id'] ? 'selected' : '' ?>><?= escape($item['name']) ?></option><?php endforeach; ?>
                </select>
            </label>
            <label class="col-md-6 form-label">Wetter
                <select class="form-select" name="wetter_id" required>
                    <option value="">Bitte auswählen</option>
                    <?php foreach ($lookups['weather'] as $item): ?><option value="<?= (int) $item['id'] ?>" <?= (int) ($formValues['wetter_id'] ?? 0) === (int) $item['id'] ? 'selected' : '' ?>><?= escape($item['name']) ?></option><?php endforeach; ?>
                </select>
            </label>

            <div class="col-12 vstack gap-2">
                <label class="form-check"><input class="form-check-input" type="checkbox" name="training_abgeschlossen" value="1" <?= !empty($formValues['training_abgeschlossen']) ? 'checked' : '' ?>><span class="form-check-label">Training abgeschlossen</span></label>
                <label class="form-check"><input class="form-check-input" type="checkbox" name="ist_veroeffentlicht" value="1" <?= !empty($formValues['ist_veroeffentlicht']) ? 'checked' : '' ?>><span class="form-check-label">Training öffentlich in der WebUI freigeben</span></label>
            </div>

            <div class="col-12 d-flex gap-2">
                <a class="btn btn-outline-secondary" href="<?= escape(base_url($editMode ? 'training/' . $trainingUuid : 'trainings')) ?>">Abbrechen</a>
                <button class="btn btn-primary" type="submit"><?= $editMode ? 'Änderungen speichern' : 'Training anlegen' ?></button>
            </div>
        </form>
    </div>
</section>
