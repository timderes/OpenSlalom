<?php declare(strict_types=1); ?>
<?php $action = $editMode ? 'verwaltung/' . $masterType . '/' . $itemId : 'verwaltung/' . $masterType; ?>
<section class="container py-4">
    <div class="mb-4"><p class="text-primary fw-semibold mb-2">Stammdatenverwaltung</p><h1><?= escape($masterTitle) ?> <?= $editMode ? 'bearbeiten' : 'anlegen' ?></h1></div>
    <div class="card shadow-sm p-4">
        <?php if ($formError !== null): ?><div class="alert alert-danger" role="alert"><?= escape($formError) ?></div><?php endif; ?>
        <form class="row g-3" action="<?= escape(base_url($action)) ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= escape(csrf_token()) ?>">
            <?php if ($masterType === 'vereine'): ?>
                <label class="col-12 form-label">Vereinsname<input class="form-control" name="vereinsname" value="<?= escape($formValues['vereinsname'] ?? '') ?>" required maxlength="100"></label>
                <label><span>Mitgliedsnummer</span><input name="mitglieds_nummer" value="<?= escape($formValues['mitglieds_nummer'] ?? '') ?>" maxlength="50"></label>
                <label><span>Postleitzahl</span><input name="postleitzahl" value="<?= escape($formValues['postleitzahl'] ?? '') ?>" maxlength="20"></label>
                <label><span>Ort</span><input name="ort" value="<?= escape($formValues['ort'] ?? '') ?>" maxlength="100"></label>
                <label class="col-12 form-label">Adresse<textarea class="form-control" name="adresse" rows="3" maxlength="250"><?= escape($formValues['adresse'] ?? '') ?></textarea></label>
                <label class="col-12 form-label">Vereinslogo (PNG, JPG oder BMP, max. 2 MB)<input class="form-control" type="file" name="logo" accept="image/png,image/jpeg,image/bmp"></label>
                <?php if ($editMode && !empty($formValues['logo'])): ?><label class="checkbox-label"><input type="checkbox" name="logo_loeschen" value="1"><span>Bestehendes Logo löschen</span></label><?php endif; ?>
            <?php endif; ?>
            <?php if ($masterType === 'fahrer'): ?>
                <label><span>Vorname</span><input name="vorname" value="<?= escape($formValues['vorname'] ?? '') ?>" required maxlength="100"></label>
                <label><span>Nachname</span><input name="nachname" value="<?= escape($formValues['nachname'] ?? '') ?>" maxlength="100"></label>
                <label><span>Verein</span><select name="verein_id" required><option value="">Bitte auswählen</option><?php foreach ($lookups['clubs'] as $item): ?><option value="<?= (int) $item['id'] ?>" <?= (int) ($formValues['verein_id'] ?? 0) === (int) $item['id'] ? 'selected' : '' ?>><?= escape($item['name']) ?></option><?php endforeach; ?></select></label>
                <label><span>Mitgliedsnummer</span><input name="mitglieds_nummer" value="<?= escape($formValues['mitglieds_nummer'] ?? '') ?>" maxlength="50"></label>
                <label><span>Geburtsdatum</span><input type="date" name="geburtsdatum" value="<?= escape($formValues['geburtsdatum'] ?? '') ?>"></label>
                <label><span>Geschlecht</span><select name="geschlecht"><option value="">Keine Angabe</option><option value="m" <?= ($formValues['geschlecht'] ?? '') === 'm' ? 'selected' : '' ?>>Männlich</option><option value="w" <?= ($formValues['geschlecht'] ?? '') === 'w' ? 'selected' : '' ?>>Weiblich</option><option value="d" <?= ($formValues['geschlecht'] ?? '') === 'd' ? 'selected' : '' ?>>Divers</option></select></label>
            <?php endif; ?>
            <?php if ($masterType === 'disziplinen'): ?>
                <label class="col-12 form-label">Disziplinname<input class="form-control" name="name" value="<?= escape($formValues['name'] ?? '') ?>" required maxlength="50"></label>
                <label><span>Torfehler-Strafe in Sekunden</span><input name="tf" value="<?= escape((string) ($formValues['tf'] ?? '0')) ?>" required inputmode="decimal"></label>
                <label><span>Pylonenfehler-Strafe in Sekunden</span><input name="pf" value="<?= escape((string) ($formValues['pf'] ?? '0')) ?>" required inputmode="decimal"></label>
                <fieldset class="col-12"><legend>Altersklassen</legend><div id="age-class-list" class="vstack gap-2"><?php foreach (($formValues['altersklassen'] ?? []) as $class): ?><div class="d-flex gap-2 age-class-row"><input class="form-control" name="age_label[]" value="<?= escape($class['label'] ?? '') ?>" placeholder="Bezeichnung"><input class="form-control" name="age_from[]" value="<?= escape((string) ($class['age_from'] ?? '')) ?>" type="number" min="0" placeholder="Von"><input class="form-control" name="age_to[]" value="<?= escape((string) ($class['age_to'] ?? '')) ?>" type="number" min="0" placeholder="Bis (offen)"><button type="button" class="btn btn-outline-danger remove-age-class">×</button></div><?php endforeach; ?></div><button type="button" class="btn btn-outline-secondary mt-2" id="add-age-class">+ Klasse hinzufügen</button></fieldset>
            <?php endif; ?>
            <?php if ($masterType === 'karts'): ?>
                <label><span>Verein</span><select name="verein_id" required><option value="">Bitte auswählen</option><?php foreach ($lookups['clubs'] as $item): ?><option value="<?= (int) $item['id'] ?>" <?= (int) ($formValues['verein_id'] ?? 0) === (int) $item['id'] ? 'selected' : '' ?>><?= escape($item['name']) ?></option><?php endforeach; ?></select></label>
                <label><span>Disziplin</span><select name="disziplin_id" required><option value="">Bitte auswählen</option><?php foreach ($lookups['disciplines'] as $item): ?><option value="<?= (int) $item['id'] ?>" <?= (int) ($formValues['disziplin_id'] ?? 0) === (int) $item['id'] ? 'selected' : '' ?>><?= escape($item['name']) ?></option><?php endforeach; ?></select></label>
                <label class="form-label"><span>Name</span><input class="form-control" name="name" value="<?= escape($formValues['name'] ?? '') ?>" maxlength="100"></label><label class="form-label"><span>Motor</span><input class="form-control" name="motor" value="<?= escape($formValues['motor'] ?? '') ?>" maxlength="100"></label><label class="col-12 form-label"><span>Chassis</span><input class="form-control" name="chassis" value="<?= escape($formValues['chassis'] ?? '') ?>" maxlength="100"></label>
            <?php endif; ?>
            <?php if ($masterType === 'wetter'): ?><label class="col-12 form-label">Bezeichnung<input class="form-control" name="name" value="<?= escape($formValues['name'] ?? '') ?>" required maxlength="50"></label><?php endif; ?>
            <div class="col-12 d-flex gap-2"><a class="btn btn-outline-secondary" href="<?= escape(base_url('verwaltung/' . $masterType)) ?>">Abbrechen</a><button class="btn btn-primary" type="submit"><?= $editMode ? 'Speichern' : 'Anlegen' ?></button></div>
        </form>
    </div>
</section>
<?php if ($masterType === 'disziplinen'): ?><script src="<?= escape(base_url('assets/js/master-data.js')) ?>" defer></script><?php endif; ?>
