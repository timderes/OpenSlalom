<?php

declare(strict_types=1);

?>

<div class="vstack gap-5">
    <section class="row row-cols-lg-2 g-4">
        <div class="col">
            <p class="text-muted mb-0">Kart-Slalom digital organisiert</p>
            <h1 class="display-4 fw-bold text-body-emphasis">Training steuern.<br>Leistung sichtbar machen.</h1>
            <p class="lead">openSlalom verbindet Vorbereitung, doppelte Zeitnahme, Fehlererfassung, Auswertung und veröffentlichte Ergebnisse in einem durchgängigen Ablauf.</p>
            <div class="mt-3 mb-5">
                <a class="btn btn-primary" href="#funktionen">Funktionsumfang ansehen</a>
                <a class="btn btn-link text-decoration-none" href="<?= escape(base_url('registrieren')) ?>"><i class="bi bi-arrow-right"></i> Konto registrieren</a>
            </div>
        </div>
        <div class="col">
            <img class="img-fluid" src="<?= escape(base_url('assets/img/desktop-timing.svg')) ?>" alt="Illustration der Desktop-Zeitnahme mit zwei parallel laufenden Uhren">
            <span class="spinner-grow spinner-grow-sm text-primary"></span> <span class="text-muted">Lokal erfassen. Sicher synchronisieren.</span>
        </div>
    </section>

    <section class="text-center" aria-label="Kernfunktionen">
        <span><b>2</b> parallele Zeitnahmen</span> &mdash;
        <span><b>QR</b>-Codes erlauben direkten Zugang zu den Ergebnis- & Starterlisten</span> &mdash;
        <span><b>Live</b> Trainingsdaten</span>
    </section>

    <section class="row row-cols-1 row-cols-lg-2 g-3" aria-label="So funktioniert OpenSlalom">
        <div class="col">
            <div class="card card-body bg-body shadow-sm border-0 h-100">
                <span class="fs-5 text-primary">01</span>
                <h2 class="fw-bold text-body-emphasis">Vorbereiten</h2>
                <p class="lead mb-0">
                    Fahrer, Karts und Trainings organisieren – alles übersichtlich an einem Ort.
                </p>
            </div>
        </div>

        <div class="col">
            <div class="card card-body bg-body shadow-sm border-0 h-100">
                <span class="fs-5 text-primary">02</span>
                <h2 class="fw-bold text-body-emphasis">Auf die Strecke</h2>
                <p class="lead mb-0">
                    Rundenzeiten stoppen, Stints erfassen und Fahrfehler direkt dokumentieren.
                </p>
            </div>
        </div>

        <div class="col">
            <div class="card card-body bg-body shadow-sm border-0 h-100">
                <span class="fs-5 text-primary">03</span>
                <h2 class="fw-bold text-body-emphasis">Leistung auswerten</h2>
                <p class="lead mb-0">
                    Bestzeiten vergleichen, Kartleistungen analysieren und Fortschritte verfolgen.
                </p>
            </div>
        </div>

        <div class="col">
            <div class="card card-body bg-body shadow-sm border-0 h-100">
                <span class="fs-5 text-primary">04</span>
                <h2 class="fw-bold text-body-emphasis">Ergebnisse teilen</h2>
                <p class="lead mb-0">
                    Trainingsergebnisse einfach per Link oder QR-Code veröffentlichen.
                </p>
            </div>
        </div>
    </section>

    <section id="funktionen">
        <p class="text-muted mb-0">Der Trainingsalltag in einer Anwendung</p>
        <h2 class="display-4 fw-bold text-body-emphasis">Von der Starterliste bis zur veröffentlichten Runde.</h2>
        <p class="lead mb-5">Die Desktop-App bleibt schnell und zuverlässig an der Strecke. Die WebUI macht Ergebnisse, Auswertungen und Verwaltung dort verfügbar, wo sie gebraucht werden.</p>

        <div class="row">
            <div class="col-lg-2 display-4 d-flex flex-column align-items-lg-center font-monospace text-primary">
                01
                <div class="vr align-self-center flex-grow-1 d-none d-lg-flex"></div>
            </div>
            <div class="col-lg-10">
                <h3 class=" fw-bold text-body-emphasis">Präzise Zeitnahme</h3>
                <p class="lead">Zwei Zeitnahmestationen laufen unabhängig. Start, Runde, Stop und Stint-Speicherung sind für den Ablauf am Platz optimiert.</p>
                <ul class="list-group list-group-flush mb-5">
                    <li class="list-group-item bg-transparent">Shortcut-gesteuerte Bedienung</li>
                    <li class="list-group-item bg-transparent">Rundenziele und Überschreiten</li>
                    <li class="list-group-item bg-transparent">Parallele Fahrerzuweisung</li>
                </ul>
            </div>


        </div>
        <div class="row">
            <div class="col-lg-2 display-4 d-flex flex-column align-items-lg-center font-monospace text-primary">
                02
                <div class="vr align-self-center flex-grow-1 d-none d-lg-flex"></div>
            </div>
            <div class="col-lg-10">
                <h3 class=" fw-bold text-body-emphasis">Fehler transparent erfassen</h3>
                <p class="lead">Pylonen- und Torfehler, ungültige Runden und Strafzeiten bleiben vom einzelnen Lauf bis zur Rangliste nachvollziehbar.</p>
                <ul class="list-group list-group-flush mb-5">
                    <li class="list-group-item bg-transparent">PF und TF pro Runde</li>
                    <li class="list-group-item bg-transparent">Effektive Zeiten mit Strafen</li>
                    <li class="list-group-item bg-transparent">Nachträgliche Korrekturen</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2 display-4 d-flex flex-column align-items-lg-center font-monospace text-primary">
                03
                <div class="vr align-self-center flex-grow-1 d-none d-lg-flex"></div>
            </div>
            <div class="col-lg-10">
                <h3 class=" fw-bold text-body-emphasis">Stints im Kontext</h3>
                <p class="lead">Jeder gespeicherte Stint verbindet Fahrer, Kart, Altersklasse, Zeitpunkt und alle gefahrenen Runden.</p>
                <ul class="list-group list-group-flush mb-5">
                    <li class="list-group-item bg-transparent">Gesamt- und Durchschnittszeit</li>
                    <li class="list-group-item bg-transparent">Historische Kartzuordnung</li>
                    <li class="list-group-item bg-transparent">Komplette Rundendetails</li>
                </ul>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-2 display-4 d-flex flex-column align-items-lg-center font-monospace text-primary">
                04
                <div class="vr align-self-center flex-grow-1 d-none d-lg-flex"></div>
            </div>
            <div class="col-lg-10">
                <h3 class="fw-bold text-body-emphasis">Stammdaten sauber verwalten</h3>
                <p class="lead">Vereine, Fahrer, Disziplinen mit Altersklassen, Karts und Wetter bilden eine konsistente Grundlage für jedes Training.</p>
                <ul class="list-group list-group-flush mb-0 ">
                    <li class="list-group-item bg-transparent">Altersklassen ohne Überschneidungen</li>
                    <li class="list-group-item bg-transparent">Vereinslogos und Mitgliedsnummern</li>
                    <li class="list-group-item bg-transparent">Soft-Delete statt Datenverlust</li>
                </ul>
            </div>

        </div>
    </section>

    <section class="card card-body bg-primary text-white border-0 shadow-sm">
        <div class="row align-items-center g-4">
            <div class="col-lg-6"><img class="img-fluid" src="<?= escape(base_url('assets/img/web-results.svg')) ?>" alt="Illustration einer veröffentlichten Trainingsauswertung im Web"></div>
            <div class="col-lg-6">
                <p class="text-white-50">Ergebnisse im Web</p>
                <h2>Ein Training. Ein Link. Ein klarer Zwischenstand.</h2>
                <p>Veröffentlichte Trainings erhalten eine eindeutige UUID. Per QR-Code oder Trainingslink können Fahrer und Zuschauer Bestzeiten, Stints, Runden und Statistiken direkt aufrufen.</p>
                <div class="vstack gap-2">
                    <span><i class="bi bi-check2"></i> Öffentliche Ergebnisse mit Datenschutz</span>
                    <span><i class="bi bi-check2"></i> Vornamen sichtbar, Nachnamen geschützt</span>
                    <span><i class="bi bi-check2"></i> Vollständige Daten für berechtigte Benutzer</span>
                    <span><i class="bi bi-check2"></i> Aktualisierung während laufender Trainings</span>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="mb-4">
            <p class="text-muted mb-0">Mehr als eine Ergebnisliste</p>
            <h2 class="display-6 fw-bold">Auswertungen, die den nächsten Schritt zeigen.</h2>
        </div>
        <div class="row row-cols-1 row-cols-lg-3 g-3">
            <article class="col"><div class="card card-body border-0 shadow-sm h-100">
                <div class="d-flex justify-content-between"><span>STATISTIKEN</span><b>Aktuelles Jahr</b></div>
                <div class="display-5 fw-bold">284</div><span class="text-muted">zeitgemessene Runden</span>
                <p>Globale Statistik mit frei wählbarem Zeitraum, Fahrerwerten und Kart-Auswertung.</p>
                </div>
            </article>
            <article class="col"><div class="card card-body border-0 shadow-sm h-100">
                <span class="text-muted">KART-AUSWERTUNG</span>
                <h3>Welches Kart wurde wie gefahren?</h3>
                <p>Fahrzeit, Runden, Stints, Fehler und Fahrer können pro Kart und bis auf einzelne Fahrer aufgeschlüsselt werden.</p>
                <div class="list-group"><span class="list-group-item">Kart 7 <b>12 Stints</b></span><span class="list-group-item">Kart 3 <b>9 Stints</b></span><span class="list-group-item">Kart 4 <b>7 Stints</b></span></div>
                </div>
            </article>
            <article class="col"><div class="card card-body border-0 shadow-sm h-100">
                <span class="text-muted">BERECHTIGUNGEN</span>
                <h3>Rollen dort, wo sie wirken.</h3>
                <p>Administratoren, Trainingsleiter, Fahrer und registrierte Benutzer erhalten nur die Funktionen und Trainings, die für sie bestimmt sind.</p>
                <div class="d-flex flex-wrap gap-2"><span class="badge text-bg-primary">Admin</span><span class="badge text-bg-secondary">Leitung</span><span class="badge text-bg-info">Fahrer</span><span class="badge text-bg-light">Registriert</span></div>
                </div>
            </article>
        </div></div>
    </section>

    <section class="row g-4">
        <div class="col-lg-7">
            <p class="text-muted mb-0">Sicher verwalten</p>
            <h2>Vom Konto bis zur Veröffentlichung kontrolliert.</h2>
            <p>Die WebUI bringt Benutzerregistrierung, Passwort-Reset, eigene Kontoverwaltung und rollenbasierte CRUD-Bereiche zusammen. Öffentliche Trainings bleiben bewusst von internen Verwaltungsfunktionen getrennt.</p>
            <a class="btn btn-primary" href="<?= escape(base_url('registrieren')) ?>">Jetzt registrieren</a>
        </div>
        <div class="col-lg-5"><div class="list-group">
            <div class="list-group-item"><b>01</b> <strong>Konto erstellen</strong><small class="d-block text-muted">Registrierte Benutzer starten ohne Fahrerzuordnung.</small></div>
            <div class="list-group-item"><b>02</b> <strong>Rolle zuweisen</strong><small class="d-block text-muted">Administratoren ordnen Rechte und Fahrerprofil zu.</small></div>
            <div class="list-group-item"><b>03</b> <strong>Training freigeben</strong><small class="d-block text-muted">Öffentliche Ergebnisse nur bewusst veröffentlichen.</small></div>
        </div></div>
    </div>
    </section>

    <section class="card card-body border-0 shadow-sm text-center">
        <img class="mx-auto mb-3" src="<?= escape(base_url('assets/img/logo.png')) ?>" alt="" width="86" height="86">
        <div>
            <p class="text-muted">openSlalom</p>
            <h2>Weniger Verwaltung.<br>Mehr Zeit auf der Strecke.</h2>
        </div>
        <a class="btn btn-primary" href="<?= escape(base_url('registrieren')) ?>">Konto erstellen</a>
    </section>
</div>

