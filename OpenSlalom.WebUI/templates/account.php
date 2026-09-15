<?php declare(strict_types=1); ?>
<section class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div><p class="text-primary fw-semibold mb-2">Persönlicher Bereich</p><h1>Mein Konto</h1></div>
    </div>

    <div class="row g-4">
        <section class="col-12 col-lg-6"><div class="card shadow-sm h-100 p-4">
            <h2>Kontodaten</h2>
            <dl>
                <div><dt>Benutzername</dt><dd><?= escape($currentUser['username']) ?></dd></div>
                <div><dt>E-Mail-Adresse</dt><dd><?= escape($currentUser['email'] ?? '-') ?></dd></div>
                <div><dt>Rolle<?= count($currentUser['roles']) === 1 ? '' : 'n' ?></dt><dd><?= escape(implode(', ', $currentUser['roles'])) ?></dd></div>
                <div><dt>Fahrerzuordnung</dt><dd><?= escape($driverName ?? '-') ?></dd></div>
            </dl>
        </div></section>

        <section class="col-12 col-lg-6"><div class="card shadow-sm h-100 p-4">
            <h2>Passwort ändern</h2>
            <p>Nach der Änderung werden alle bestehenden Sitzungen beendet.</p>
            <?php if (isset($passwordError)): ?><div class="alert alert-danger" role="alert"><?= escape($passwordError) ?></div><?php endif; ?>
            <form class="vstack gap-3" action="<?= escape(base_url('konto/passwort')) ?>" method="post">
                <input type="hidden" name="csrf_token" value="<?= escape(csrf_token()) ?>">
                <label class="form-label">Aktuelles Passwort<input class="form-control" type="password" name="current_password" autocomplete="current-password" required></label>
                <label class="form-label">Neues Passwort<input class="form-control" type="password" name="new_password" autocomplete="new-password" required minlength="12"></label>
                <label class="form-label">Neues Passwort wiederholen<input class="form-control" type="password" name="password_confirmation" autocomplete="new-password" required minlength="12"></label>
                <button class="btn btn-primary" type="submit">Passwort ändern</button>
            </form>
        </div></section>

        <section class="col-12"><div class="card shadow-sm p-4">
            <h2>Konto löschen</h2>
            <p>Dein WebUI-Konto, Rollen und Passwort-Reset-Tokens werden unwiderruflich gelöscht. Fahrerprofile, Trainings und Ergebnisse bleiben erhalten. Sicherheitsprotokolle werden entsprechend der Datenschutzerklärung technisch befristet aufbewahrt.</p>
            <?php if (isset($deleteError)): ?><div class="alert alert-danger" role="alert"><?= escape($deleteError) ?></div><?php endif; ?>
            <form class="vstack gap-3" action="<?= escape(base_url('konto/loeschen')) ?>" method="post">
                <input type="hidden" name="csrf_token" value="<?= escape(csrf_token()) ?>">
                <label class="form-label">Aktuelles Passwort<input class="form-control" type="password" name="current_password" autocomplete="current-password" required></label>
                <label class="form-label">Zur Bestätigung LÖSCHEN eingeben<input class="form-control" name="delete_confirmation" autocomplete="off" required></label>
                <button class="btn btn-danger" type="submit">Konto endgültig löschen</button>
            </form>
        </div></section>
    </div>
</section>
