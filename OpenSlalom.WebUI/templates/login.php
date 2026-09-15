<?php declare(strict_types=1); ?>
<section class="container py-5"><div class="row justify-content-center"><div class="col-12 col-md-7 col-lg-5"><div class="card shadow-sm"><div class="card-body p-4 p-md-5">
        <div class="text-center mb-4">
            <img src="<?= escape(base_url('assets/img/logo.svg')) ?>" alt="" width="64" height="64">
        </div>
        <div class="mb-4">
            <p class="text-primary fw-semibold mb-2">Geschützter Bereich</p>
            <h1 class="h2"><?= isset($passwordChanged) ? 'Passwort geändert' : 'Willkommen zurück' ?></h1>
            <p><?= isset($passwordChanged) ? 'Dein Passwort wurde geändert. Bitte melde dich mit dem neuen Passwort an.' : 'Melde dich an, um interne Trainings und deine persönlichen Zuordnungen aufzurufen.' ?></p>
        </div>
        <?php if (isset($loginError)): ?>
            <div class="alert alert-danger" role="alert"><?= escape($loginError) ?></div>
        <?php endif; ?>
        <form class="vstack gap-3" action="<?= escape(base_url('login')) ?>" method="post">
            <input type="hidden" name="csrf_token" value="<?= escape(csrf_token()) ?>">
            <label class="form-label">Benutzername oder E-Mail-Adresse<input class="form-control" name="login" value="<?= escape($login ?? '') ?>" autocomplete="username" required maxlength="254" placeholder="Benutzername oder E-Mail-Adresse"></label>
            <label class="form-label">Passwort<input class="form-control" type="password" name="password" autocomplete="current-password" required placeholder="Dein Passwort"></label>
            <a href="<?= escape(base_url('passwort-vergessen')) ?>">Passwort vergessen?</a>
            <button class="btn btn-primary" type="submit">Anmelden</button>
        </form>
        <div class="text-center mt-4">Noch kein Konto? <a href="<?= escape(base_url('registrieren')) ?>">Jetzt registrieren</a></div>
        <a class="d-block text-center mt-3" href="<?= escape(base_url()) ?>">← Zurück zur Startseite</a>
    </div></div></div></div></section>
</section>
