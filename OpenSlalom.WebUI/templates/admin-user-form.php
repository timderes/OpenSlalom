<?php declare(strict_types=1); ?>
<?php
$editMode ??= false;
$formValues ??= ['username' => '', 'email' => '', 'role' => 'Fahrer', 'fahrer_id' => null, 'is_active' => true];
$formAction = $editMode ? 'admin/benutzer/' . (int) $editedUserId : 'admin/benutzer';
?>
<section class="container py-4"><div class="card shadow-sm"><div class="card-body">
        <p class="text-primary fw-semibold mb-2">Administration</p>
        <h1><?= $editMode ? 'Benutzer bearbeiten' : 'Benutzer anlegen' ?></h1>
        <p>Jeder Rolle kann optional ein Fahrer zugeordnet werden. Für die Rolle Fahrer ist die Zuordnung verpflichtend.</p>
        <?php if (isset($formError)): ?><div class="alert alert-danger" role="alert"><?= escape($formError) ?></div><?php endif; ?>
        <form class="vstack gap-3" action="<?= escape(base_url($formAction)) ?>" method="post">
            <input type="hidden" name="csrf_token" value="<?= escape(csrf_token()) ?>">
            <label class="form-label">Benutzername<input class="form-control" name="username" value="<?= escape($formValues['username']) ?>" autocomplete="username" required maxlength="100"></label>
            <label class="form-label">E-Mail-Adresse<input class="form-control" type="email" name="email" value="<?= escape($formValues['email'] ?? '') ?>" autocomplete="email" required maxlength="254"></label>
            <label class="form-label">Rolle
                <select class="form-select" name="role" id="role-select" required>
                    <?php foreach (['Administrator', 'Trainingsleiter', 'Fahrer', 'Registriert'] as $role): ?>
                        <option value="<?= escape($role) ?>" <?= $formValues['role'] === $role ? 'selected' : '' ?>><?= escape($role) ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
            <label class="form-label" id="fahrer-select-wrapper">Fahrerzuordnung
                <select class="form-select" name="fahrer_id" id="fahrer-select">
                    <option value="">Bitte auswählen</option>
                    <?php foreach ($drivers as $driver): ?>
                        <option value="<?= (int) $driver['id'] ?>" <?= (int) ($formValues['fahrer_id'] ?? 0) === (int) $driver['id'] ? 'selected' : '' ?>><?= escape(display_name($driver['vorname'], $driver['nachname'])) ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
            <?php if ($editMode): ?>
                <div class="form-check"><input class="form-check-input" type="checkbox" name="is_active" value="1" <?= ($formValues['is_active'] ?? false) ? 'checked' : '' ?>><label class="form-check-label">Benutzerkonto aktiv</label></div>
            <?php endif; ?>
            <label class="form-label"><?= $editMode ? 'Neues Passwort (optional)' : 'Passwort' ?><input class="form-control" type="password" name="password" autocomplete="new-password" <?= $editMode ? '' : 'required' ?> minlength="12"></label>
            <label class="form-label">Passwort wiederholen<input class="form-control" type="password" name="password_confirmation" autocomplete="new-password" <?= $editMode ? '' : 'required' ?> minlength="12"></label>
            <div class="d-flex gap-2"><a class="btn btn-outline-secondary" href="<?= escape(base_url('admin/benutzer')) ?>">Abbrechen</a><button class="btn btn-primary" type="submit"><?= $editMode ? 'Speichern' : 'Anlegen' ?></button></div>
        </form>
    </div></div>
</section>
<script>
(() => {
    const role = document.querySelector('#role-select');
    const wrapper = document.querySelector('#fahrer-select-wrapper');
    const driver = document.querySelector('#fahrer-select');
    const update = () => {
        const required = role.value === 'Fahrer';
        driver.required = required;
        wrapper.querySelector('select').setAttribute('aria-required', required ? 'true' : 'false');
    };
    role.addEventListener('change', update);
    update();
})();
</script>
