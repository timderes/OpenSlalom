<?php declare(strict_types=1); ?>
<section class="container py-5"><div class="row justify-content-center"><div class="col-12 col-md-7 col-lg-5"><div class="card shadow-sm"><div class="card-body p-4 p-md-5">
        <div class="text-center mb-4"><img src="<?= escape(base_url('assets/img/logo.svg')) ?>" alt="" width="64" height="64"></div>
        <div class="mb-4"><p class="text-primary fw-semibold mb-2">Zugang wiederherstellen</p><h1>Passwort vergessen?</h1>
            <p>Gib deine E-Mail-Adresse ein. Wenn ein aktives Konto existiert, erhältst du einen Link zum Zurücksetzen.</p>
        </div>
        <?php if (isset($requestSent)): ?>
            <div class="alert alert-success">Wenn ein passendes Konto existiert, wurde eine E-Mail versendet.</div>
        <?php else: ?>
            <form class="vstack gap-3" action="<?= escape(base_url('passwort-vergessen')) ?>" method="post">
                <input type="hidden" name="csrf_token" value="<?= escape(csrf_token()) ?>">
                <label class="form-label">E-Mail-Adresse<input class="form-control" type="email" name="email" autocomplete="email" required maxlength="254" placeholder="name@beispiel.de"></label>
                <button class="btn btn-primary" type="submit">Link anfordern</button>
            </form>
        <?php endif; ?>
        <a class="d-block text-center mt-3" href="<?= escape(base_url('login')) ?>">← Zurück zur Anmeldung</a>
    </div></div></div></div></section>
</section>
