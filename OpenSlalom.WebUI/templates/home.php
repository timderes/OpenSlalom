<?php declare(strict_types=1); ?>

<section class="hero-panel p-4 p-lg-5">
    <div class="row align-items-center g-5">
        <div class="col-lg-7">
            <p class="eyebrow text-white-50 mb-3">Race control für Kart-Slalom</p>
            <h1 class="display-4 fw-bold mb-3">Training steuern. Leistung sichtbar machen.</h1>
            <p class="lead text-white-50 mb-4">openSlalom verbindet Trainingsorganisation, doppelte Zeitnahme, Fehlererfassung und veröffentlichte Ergebnisse in einem durchgängigen Ablauf.</p>
            <div class="d-flex flex-wrap gap-2">
                <a class="btn btn-light btn-lg" href="<?= escape(base_url('registrieren')) ?>">Konto registrieren</a>
                <a class="btn btn-outline-light btn-lg" href="<?= escape(base_url('login')) ?>">Anmelden</a>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="bg-white bg-opacity-10 rounded-4 p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom border-white border-opacity-25 pb-3 mb-3">
                    <span class="small text-uppercase fw-bold text-white-50">Live timing</span>
                    <span class="badge text-bg-success"><span class="status-dot"></span>Aktiv</span>
                </div>
                <div class="d-flex justify-content-between align-items-end">
                    <div><span class="d-block text-white-50 small">Schnellste Runde</span><strong class="display-6 timing-value text-white">01:23.456</strong></div>
                    <span class="badge text-bg-warning">+ 3.000</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" aria-labelledby="features-heading">
    <div class="row align-items-end g-3 mb-4">
        <div class="col-md-8"><p class="eyebrow mb-2">Für die Strecke entwickelt</p><h2 id="features-heading" class="fw-bold mb-0">Alles Wichtige auf einen Blick.</h2></div>
        <div class="col-md-4 text-md-end text-body-secondary">Von der Starterliste bis zur Auswertung.</div>
    </div>
    <div class="row g-4">
        <div class="col-md-4"><article class="surface-card rounded-4 p-4"><span class="badge text-bg-primary mb-4">01 · Zeitnahme</span><h3 class="h4">Präzise Runden</h3><p class="text-body-secondary mb-0">Zwei unabhängige Zeitnahmestationen, Stints und Strafzeiten bleiben nachvollziehbar.</p></article></div>
        <div class="col-md-4"><article class="surface-card rounded-4 p-4"><span class="badge text-bg-success mb-4">02 · Ergebnisse</span><h3 class="h4">Klarer Zwischenstand</h3><p class="text-body-secondary mb-0">Platzierung, Fahrer, Fehler und Gesamtzeit sind auf Desktop und Smartphone schnell erfassbar.</p></article></div>
        <div class="col-md-4"><article class="surface-card rounded-4 p-4"><span class="badge text-bg-warning mb-4">03 · Verwaltung</span><h3 class="h4">Saubere Stammdaten</h3><p class="text-body-secondary mb-0">Vereine, Fahrer, Disziplinen, Karts und Trainings bleiben zentral organisiert.</p></article></div>
    </div>
</section>

<section class="row g-4 align-items-stretch" aria-labelledby="workflow-heading">
    <div class="col-lg-7"><div class="surface-card rounded-4 p-4 p-lg-5 h-100"><p class="eyebrow">Der Ablauf</p><h2 id="workflow-heading" class="fw-bold">Weniger Verwaltung. Mehr Zeit auf der Strecke.</h2><p class="text-body-secondary">Die Desktop-App bleibt schnell an der Strecke. Die WebUI macht Ergebnisse, Auswertungen und Verwaltung dort verfügbar, wo sie gebraucht werden.</p><div class="row g-3 mt-2"><div class="col-sm-4"><strong class="d-block fs-3 text-primary">01</strong><span class="small text-body-secondary">Vorbereiten</span></div><div class="col-sm-4"><strong class="d-block fs-3 text-primary">02</strong><span class="small text-body-secondary">Fahren</span></div><div class="col-sm-4"><strong class="d-block fs-3 text-primary">03</strong><span class="small text-body-secondary">Auswerten</span></div></div></div></div>
    <div class="col-lg-5"><div class="surface-card rounded-4 p-4 p-lg-5 h-100"><p class="eyebrow">Sicher und kontrolliert</p><h2 class="h3 fw-bold">Rollen dort, wo sie wirken.</h2><p class="text-body-secondary">Öffentliche Ergebnisse bleiben schreibgeschützt. Verwaltungsfunktionen sind rollenbasiert geschützt.</p><a class="btn btn-primary" href="<?= escape(base_url('registrieren')) ?>">Jetzt starten</a></div></div>
</section>
