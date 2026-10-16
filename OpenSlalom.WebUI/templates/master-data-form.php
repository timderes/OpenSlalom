<?php declare(strict_types=1); ?>
<?php $action = $editMode ? 'verwaltung/' . $masterType . '/' . $itemId : 'verwaltung/' . $masterType; ?>
<section class="container vstack gap-4">
    <div class="d-flex justify-content-between align-items-start"><div><p class="text-muted"><span></span> Stammdatenverwaltung</p><h1><?= escape($masterTitle) ?> <?= $editMode ? 'bearbeiten' : 'anlegen' ?></h1></div></div>
    <div class="card card-body border-0 shadow-sm">
        <?php if ($formError !== null): ?><div class="alert error" role="alert"><?= escape($formError) ?></div><?php endif; ?>
        <form  action="<?= escape(base_url($action)) ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= escape(csrf_token()) ?>">
            <?php if ($masterType === 'vereine'): ?>
                <label ><span>Vereinsname</span><input name="vereinsname" value="<?= escape($formValues['vereinsname'] ?? '') ?>" required maxlength="100"></label>
                <label><span>Mitgliedsnummer</span><input name="mitglieds_nummer" value="<?= escape($formValues['mitglieds_nummer'] ?? '') ?>" maxlength="50"></label>
                <label><span>Postleitzahl</span><input name="postleitzahl" value="<?= escape($formValues['postleitzahl'] ?? '') ?>" maxlength="20"></label>
                <label><span>Ort</span><input name="ort" value="<?= escape($formValues['ort'] ?? '') ?>" maxlength="100"></label>
                <label ><span>Adresse</span><textarea name="adresse" rows="3" maxlength="250"><?= escape($formValues['adresse'] ?? '') ?></textarea></label>
                <label ><span>Vereinslogo (PNG, JPG oder BMP, max. 2 MB)</span><input type="file" name="logo" accept="image/png,image/jpeg,image/bmp"></label>
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
                <label ><span>Disziplinname</span><input name="name" value="<?= escape($formValues['name'] ?? '') ?>" required maxlength="50"></label>
                <label><span>Torfehler-Strafe in Sekunden</span><input name="tf" value="<?= escape((string) ($formValues['tf'] ?? '0')) ?>" required inputmode="decimal"></label>
                <label><span>Pylonenfehler-Strafe in Sekunden</span><input name="pf" value="<?= escape((string) ($formValues['pf'] ?? '0')) ?>" required inputmode="decimal"></label>
                <fieldset class="border p-3"><legend>Altersklassen</legend><div id="age-class-list"><?php foreach (($formValues['altersklassen'] ?? []) as $class): ?><div class="row g-2"><input name="age_label[]" value="<?= escape($class['label'] ?? '') ?>" placeholder="Bezeichnung"><input name="age_from[]" value="<?= escape((string) ($class['age_from'] ?? '')) ?>" type="number" min="0" placeholder="Von"><input name="age_to[]" value="<?= escape((string) ($class['age_to'] ?? '')) ?>" type="number" min="0" placeholder="Bis (offen)"><button type="button" class="btn btn-sm btn-outline-danger">×</button></div><?php endforeach; ?></div><button type="button" class="btn btn-secondary" id="add-age-class">+ Klasse hinzufügen</button></fieldset>
            <?php endif; ?>
            <?php if ($masterType === 'karts'): ?>
                <label><span>Verein</span><select name="verein_id" required><option value="">Bitte auswählen</option><?php foreach ($lookups['clubs'] as $item): ?><option value="<?= (int) $item['id'] ?>" <?= (int) ($formValues['verein_id'] ?? 0) === (int) $item['id'] ? 'selected' : '' ?>><?= escape($item['name']) ?></option><?php endforeach; ?></select></label>
                <label><span>Disziplin</span><select name="disziplin_id" required><option value="">Bitte auswählen</option><?php foreach ($lookups['disciplines'] as $item): ?><option value="<?= (int) $item['id'] ?>" <?= (int) ($formValues['disziplin_id'] ?? 0) === (int) $item['id'] ? 'selected' : '' ?>><?= escape($item['name']) ?></option><?php endforeach; ?></select></label>
                <label><span>Name</span><input name="name" value="<?= escape($formValues['name'] ?? '') ?>" maxlength="100"></label><label><span>Motor</span><input name="motor" value="<?= escape($formValues['motor'] ?? '') ?>" maxlength="100"></label><label ><span>Chassis</span><input name="chassis" value="<?= escape($formValues['chassis'] ?? '') ?>" maxlength="100"></label>
            <?php endif; ?>
            <?php if ($masterType === 'wetter'): ?><label ><span>Bezeichnung</span><input name="name" value="<?= escape($formValues['name'] ?? '') ?>" required maxlength="50"></label><?php endif; ?>
            <div class="form-actions"><a class="btn btn-secondary" href="<?= escape(base_url('verwaltung/' . $masterType)) ?>">Abbrechen</a><button class="btn btn-primary" type="submit"><?= $editMode ? 'Speichern' : 'Anlegen' ?></button></div>
        </form>
    </div>
</section>
<?php if ($masterType === 'disziplinen'): ?><script src="<?= escape(base_url('assets/js/master-data.js')) ?>" defer></script><?php endif; ?>
