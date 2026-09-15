<?php declare(strict_types=1); ?>
<?php $formValues ??= ['username' => '', 'email' => '']; ?>
<section class="container py-5"><div class="row justify-content-center"><div class="col-12 col-lg-8"><div class="card shadow-sm"><div class="card-body p-4 p-md-5">
        <div class="text-center mb-4"><img src="<?= escape(base_url('assets/img/logo.svg')) ?>" alt="" width="64" height="64"></div>
        <div class="mb-4">
            <p class="text-primary fw-semibold mb-2">Neues Konto</p>
            <h1 class="h2"><?= isset($registrationSuccessful) ? 'Registrierung abgeschlossen' : 'Registrieren' ?></h1>
            <p><?= isset($registrationSuccessful) ? 'Dein Konto wurde angelegt. Ein Administrator wurde informiert und kann dir später eine Rolle und ein Fahrerprofil zuweisen.' : 'Erstelle ein Konto für den internen openSlalom-Bereich.' ?></p>
        </div>

        <?php if (isset($registrationSuccessful)): ?>
            <a class="btn btn-primary" href="<?= escape(base_url('login')) ?>">Zur Anmeldung</a>
        <?php else: ?>
            <?php if (isset($registrationError)): ?><div class="alert alert-danger" role="alert"><?= escape($registrationError) ?></div><?php endif; ?>
            <form class="vstack gap-3" action="<?= escape(base_url('registrieren')) ?>" method="post">
                <input type="hidden" name="csrf_token" value="<?= escape(csrf_token()) ?>">
                <label class="honeypot-field" aria-hidden="true">Website<input name="website" tabindex="-1" autocomplete="off"></label>
                <label class="form-label">Benutzername<input class="form-control" name="username" value="<?= escape($formValues['username']) ?>" autocomplete="username" required minlength="3" maxlength="100" pattern="[A-Za-zÄÖÜäöüß0-9._-]+" placeholder="Dein Benutzername"></label>
                <label class="form-label">E-Mail-Adresse<input class="form-control" type="email" name="email" value="<?= escape($formValues['email']) ?>" autocomplete="email" required maxlength="254" placeholder="name@beispiel.de"></label>
                <label class="form-label">Passwort<input class="form-control" type="password" name="password" autocomplete="new-password" required minlength="12" placeholder="Mindestens 12 Zeichen"></label>
                <label class="form-label">Passwort wiederholen<input class="form-control" type="password" name="password_confirmation" autocomplete="new-password" required minlength="12"></label>
                <div class="form-check"><input class="form-check-input" type="checkbox" name="accept_privacy" value="1" required><label class="form-check-label">Ich habe die <a href="<?= escape(base_url('datenschutz')) ?>" target="_blank" rel="noopener">Datenschutzerklärung</a> gelesen.</label></div>
                <button class="btn btn-primary" type="submit">Konto registrieren</button>
            </form>
        <?php endif; ?>
        <div class="text-center mt-4">Bereits registriert? <a href="<?= escape(base_url('login')) ?>">Zur Anmeldung</a></div>
        <a class="d-block text-center mt-3" href="<?= escape(base_url()) ?>">← Zurück zur Startseite</a>
    </div></div></div></div></section>
</section>
