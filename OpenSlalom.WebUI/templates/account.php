<?php

declare(strict_types=1);

$activeTab = $_GET['tab'] ?? 'uebersicht';

?>

<section class="vstack gap-4">
    <header>
        <p class="lead text-body-secondary mb-0">
            Persönlicher Bereich
        </p>
        <h1 class="fw-bold text-body-emphasis">
            Mein Konto
        </h1>
    </header>

    <div class="row">
        <div class="col-12 col-lg-3">
            <nav class="nav flex-row flex-md-column">
                <a
                    class="nav-link <?= $activeTab === 'uebersicht' ? 'active fw-bold' : '' ?>"
                    href="<?= escape(base_url('konto')) ?>">
                    Übersicht
                </a>

                <a
                    class="nav-link <?= $activeTab === 'passwort-aendern' ? 'active fw-bold' : '' ?>"
                    href="<?= escape(base_url('konto?tab=passwort-aendern')) ?>">
                    Passwort ändern
                </a>

                <a
                    class="nav-link <?= $activeTab === 'konto-loeschen' ? 'active fw-bold' : '' ?>"
                    href="<?= escape(base_url('konto?tab=konto-loeschen')) ?>">
                    Konto löschen
                </a>
            </nav>
        </div>
        <div class="col-12 col-lg-9">

            <div class="surface-card rounded-4 p-4">
                <div class="card-body vstack gap-3">

                    <?php if ($activeTab === 'uebersicht'): ?>

                        <dl class="row row-cols-1 row-cols-md-2 g-4">
                            <div>
                                <dt class="text-body-secondary fw-normal mb-2">Benutzername</dt>
                                <dd class="font-monospace fw-bold fs-5"><?= escape($currentUser['username'] ?? 'Unbekannter Benutzer') ?></dd>
                            </div>
                            <div>
                                <dt class="text-body-secondary fw-normal mb-2">E-Mail-Adresse</dt>
                                <dd class="font-monospace fw-bold"><?= escape($currentUser['email'] ?? '-') ?></dd>
                            </div>
                            <div>
                                <dt class="text-body-secondary fw-normal mb-2">Rolle<?= count($currentUser['roles'] ?? ['-']) === 1 ? '' : 'n' ?></dt>
                                <dd><span class="badge text-bg-primary"><?= escape(implode(', ', $currentUser['roles'] ?? ['-'])) ?></span></dd>
                            </div>
                            <div>
                                <dt class="text-body-secondary fw-normal mb-2">Fahrerzuordnung</dt>
                                <dd class="fw-bold"><?= escape($driverName ?? '-') ?></dd>
                            </div>
                        </dl>

                    <?php elseif ($activeTab === 'passwort-aendern'): ?>

                        <p class="fw-bold text-danger">Nach der Änderung werden alle bestehenden Sitzungen beendet und Sie müssen sich erneut anmelden.</p>

                        <?php if (isset($passwordError)): ?><div class="alert alert-danger" role="alert"><?= escape($passwordError) ?></div><?php endif; ?>

                        <form class="vstack gap-3" action="<?= escape(base_url('konto/passwort')) ?>" method="post">

                            <input type="hidden" name="csrf_token" value="<?= escape(csrf_token()) ?>">

                            <label class="form-label">Aktuelles Passwort

                                <input class="form-control" type="password" name="current_password" autocomplete="current-password" required>
                            </label>

                            <label class="form-label">Neues Passwort
                                <input class="form-control" type="password" name="new_password" autocomplete="new-password" required minlength="12">
                            </label>
                            <label class="form-label">Neues Passwort wiederholen
                                <input class="form-control" type="password" name="password_confirmation" autocomplete="new-password" required minlength="12">
                            </label>
                            <button class="btn btn-danger" type="submit" style="width: fit-content;">Passwort ändern</button>
                        </form>


                    <?php elseif ($activeTab === 'konto-loeschen'): ?>

                        <h2>Konto löschen</h2>
                        <p>Dein WebUI-Konto, Rollen und Passwort-Reset-Tokens werden unwiderruflich gelöscht. Fahrerprofile, Trainings und Ergebnisse bleiben erhalten. Sicherheitsprotokolle werden entsprechend der Datenschutzerklärung technisch befristet aufbewahrt.</p>
                        <?php if (isset($deleteError)): ?><div class="alert alert-danger" role="alert"><?= escape($deleteError) ?></div><?php endif; ?>
                        <form class="vstack gap-3" action="<?= escape(base_url('konto/loeschen')) ?>" method="post">
                            <input type="hidden" name="csrf_token" value="<?= escape(csrf_token()) ?>">
                            <label class="form-label">Aktuelles Passwort<input class="form-control" type="password" name="current_password" autocomplete="current-password" required></label>
                            <label class="form-label">Zur Bestätigung LÖSCHEN eingeben<input class="form-control" name="delete_confirmation" autocomplete="off" required></label>
                            <button class="btn btn-danger" type="submit">Konto endgültig löschen</button>
                        </form>


                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
