<?php declare(strict_types=1); ?>
<section class="container py-5"><div class="row justify-content-center"><div class="col-12 col-md-7 col-lg-5"><div class="card shadow-sm"><div class="card-body p-4 p-md-5">
        <div class="text-center mb-4"><img src="<?= escape(base_url('assets/img/logo.svg')) ?>" alt="" width="64" height="64"></div>
        <div class="mb-4"><p class="text-primary fw-semibold mb-2">Zugang sichern</p><h1><?= isset($resetSuccessful) ? 'Passwort geändert' : 'Neues Passwort' ?></h1>
            <p><?= isset($resetSuccessful) ? 'Dein neues Passwort ist aktiv. Du kannst dich jetzt anmelden.' : 'Lege ein neues Passwort mit mindestens 12 Zeichen fest.' ?></p>
        </div>
        <?php if (isset($resetSuccessful)): ?>
            <a class="btn btn-primary" href="<?= escape(base_url('login')) ?>">Zur Anmeldung</a>
        <?php else: ?>
            <?php if (isset($resetError)): ?><div class="alert alert-danger" role="alert"><?= escape($resetError) ?></div><?php endif; ?>
            <?php if ($token !== ''): ?>
                <form class="vstack gap-3" action="<?= escape(base_url('passwort-zuruecksetzen')) ?>" method="post">
                    <input type="hidden" name="csrf_token" value="<?= escape(csrf_token()) ?>">
                    <input type="hidden" name="token" value="<?= escape($token) ?>">
                    <label class="form-label">Neues Passwort<input class="form-control" type="password" name="password" autocomplete="new-password" required minlength="12"></label>
                    <label class="form-label">Passwort wiederholen<input class="form-control" type="password" name="password_confirmation" autocomplete="new-password" required minlength="12"></label>
                    <button class="btn btn-primary" type="submit">Passwort speichern</button>
                </form>
            <?php else: ?>
                <a class="btn btn-primary" href="<?= escape(base_url('passwort-vergessen')) ?>">Neuen Link anfordern</a>
            <?php endif; ?>
        <?php endif; ?>
    </div></div></div></div></section>
