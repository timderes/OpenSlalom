<?php
declare(strict_types=1);

$training = $view['training'];
$summary = $view['summary'];
$leaderboard = $view['leaderboard'];
$statistics = $view['statistics'];
$status = $view['status'];
$trainingScriptVersion = (string) filemtime(dirname(__DIR__) . '/assets/js/training.js');
$trainingBreadcrumbTarget = $currentUser === null ? '' : 'trainings';
?>
<div class="vstack gap-4" data-auto-refresh="<?= (int) $refreshSeconds ?>">
    <section class="bg-body-tertiary py-4">
        <div class="container">
            <div class="small text-muted"><a href="<?= escape(base_url($trainingBreadcrumbTarget)) ?>">openSlalom</a><span>/</span>Trainingsergebnisse</div>
            <div class="d-flex justify-content-between gap-4 flex-wrap">
                <div>
                    <div class="badge text-bg-success <?= $training['is_finished'] ? 'is-finished' : '' ?>">
                        <span></span><?= $training['is_finished'] ? 'Training abgeschlossen' : 'Training läuft' ?>
                    </div>
                    <h1><?= escape($training['name']) ?></h1>
                    <p><?= escape($training['description']) ?></p>
                </div>
                <div class="d-flex flex-column gap-2">
                    <span>Stand <strong id="refresh-time"><?= escape((new DateTimeImmutable())->format('H:i:s')) ?></strong></span>
                    <?php if ($canManageTrainings): ?><a class="btn btn-sm btn-outline-secondary" href="<?= escape(base_url('training/' . $training['uuid'] . '/bearbeiten')) ?>">Training bearbeiten</a><?php endif; ?>
                    <?php if ($refreshSeconds > 0): ?>
                        <button id="refresh-toggle" type="button" aria-pressed="true">
                            <i></i><span>Live-Aktualisierung an</span>
                        </button>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row row-cols-2 row-cols-md-4 g-3">
                <div><span>DATUM</span><strong><?= escape($training['date']) ?></strong></div>
                <div><span>VEREIN</span><strong><?= escape($training['club']) ?></strong></div>
                <div><span>DISZIPLIN</span><strong><?= escape($training['discipline']) ?></strong></div>
                <div><span>WETTER</span><strong><?= escape($training['weather']) ?></strong></div>
            </div>
        </div>
    </section>

    <section class="container container">
        <div class="nav nav-tabs" role="tablist" aria-label="Trainingsansicht">
            <?php if (!$training['is_finished']): ?>
                <button id="status-tab" type="button" role="tab" aria-selected="true" aria-controls="status-panel" data-training-tab="status">Status</button>
            <?php endif; ?>
            <button id="results-tab" type="button" role="tab" aria-selected="<?= $training['is_finished'] ? 'true' : 'false' ?>" aria-controls="results-panel" data-training-tab="results">Ergebnisse</button>
            <button id="statistics-tab" type="button" role="tab" aria-selected="false" aria-controls="statistics-panel" data-training-tab="statistics">Statistik</button>
        </div>

        <?php if ($status !== null): ?>
            <section id="status-panel" class="vstack gap-4" role="tabpanel" aria-labelledby="status-tab" data-training-panel="status">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted"><span></span> Live-Status</p>
                        <h2>Fahrerstatus</h2>
                    </div>
                    <p>Die Anzeige entspricht dem zuletzt gespeicherten Status der Zeitnahme.</p>
                </div>

                <div class="row row-cols-1 row-cols-md-2 g-3">
                    <?php foreach ($status['stations'] as $stationIndex => $station): ?>
                        <?php if ($stationIndex === 0 || $status['has_second_station']): ?>
                            <section class="card card-body card card-body $stationIndex + 1 ?>">
                                <span><?= escape($station['name']) ?></span>
                                <div><small>Fährt gerade</small><strong><?= escape($station['current']['name'] ?? 'Kein Fahrer aktiv') ?></strong></div>
                                <div><small>Als Nächstes</small><strong><?= escape($station['next']['name'] ?? 'Kein nächster Fahrer') ?></strong></div>
                            </section>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <div class="row g-4">
                    <section class="card card-body border-0 shadow-sm col-lg-6">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div><p class="text-muted"><span></span> Startreihenfolge</p><h2>Fahrerliste</h2></div>
                            <span class="badge text-bg-secondary"><?= count($status['drivers']) ?></span>
                        </div>
                        <?php if ($status['drivers'] === []): ?>
                            <div class="alert alert-info small"><span>Noch keine Fahrer zugeordnet.</span></div>
                        <?php else: ?>
                            <ol class="list-group">
                                <?php foreach ($status['drivers'] as $driver): ?>
                                    <li class="list-group-item escape($driver['status']) ?>">
                                        <span><?= (int) $driver['position'] ?></span>
                                        <div><strong><?= escape($driver['name']) ?></strong><small><?= escape($driver['club']) ?></small></div>
                                        <b><?= $driver['status'] === 'active-first' ? 'FÄHRT ZN 1' : ($driver['status'] === 'active-second' ? 'FÄHRT ZN 2' : ($driver['status'] === 'next-first' ? 'NÄCHSTE ZN 1' : ($driver['status'] === 'next-second' ? 'NÄCHSTE ZN 2' : ($driver['status'] === 'inactive' ? 'PAUSIERT' : escape($driver['class']))))) ?></b>
                                    </li>
                                <?php endforeach; ?>
                            </ol>
                        <?php endif; ?>
                    </section>

                    <section class="card card-body border-0 shadow-sm col-lg-6">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div><p class="text-muted"><span></span> Zuletzt gespeichert</p><h2>Letzte zehn Stints</h2></div>
                        </div>
                        <?php if ($status['recent_stints'] === []): ?>
                            <div class="alert alert-info small"><span>Noch keine Stints gespeichert.</span></div>
                        <?php else: ?>
                            <div class="vstack gap-2">
                                <?php foreach ($status['recent_stints'] as $stint): ?>
                                    <details class="card card-body" data-detail-id="status-stint-<?= (int) $stint['id'] ?>">
                                        <summary>
                                            <span><strong><?= escape($stint['driver']) ?></strong><small>Stint vom <?= escape(format_date($stint['datum'], 'd.m.Y · H:i:s')) ?> · <?= escape($stint['kart']) ?> · <?= escape($stint['class']) ?></small></span>
                                            <span class="d-flex flex-wrap gap-3">
                                                <span><small>Bestzeit</small><strong><?= escape(format_training_time($stint['best_lap'])) ?></strong></span>
                                                <span><small>Δ Bestzeit</small><strong><?= $stint['best_lap_difference'] === null ? '-' : '+' . escape(format_training_time($stint['best_lap_difference'])) ?></strong></span>
                                                <span><small>PF</small><strong><?= (int) $stint['pf'] ?></strong></span>
                                                <span><small>TF</small><strong><?= (int) $stint['tf'] ?></strong></span>
                                                <span><small>Gesamt</small><strong><?= escape(format_training_time($stint['total'])) ?></strong></span>
                                                <span><small>Δ Gesamt</small><strong><?= $stint['total_difference'] === null ? '-' : '+' . escape(format_training_time($stint['total_difference'])) ?></strong></span>
                                            </span>
                                        </summary>
                                        <div class="d-flex flex-wrap gap-3">
                                            <span>Gültige Runden <strong><?= (int) $stint['valid_laps'] ?></strong></span>
                                            <span>Durchschnitt <strong><?= escape(format_training_time($stint['average'])) ?></strong></span>
                                        </div>
                                        <div class="table-responsive table table-striped">
                                            <table>
                                                <thead><tr><th>Runde</th><th>Zeit</th><th>Strafe</th><th>PF</th><th>TF</th><th>Status</th></tr></thead>
                                                <tbody>
                                                <?php foreach ($stint['laps'] as $lap): ?>
                                                    <tr class="<?= $lap['invalid'] ? 'invalid-lap' : '' ?>">
                                                        <td data-label="Runde"><?= (int) $lap['number'] ?></td>
                                                        <td data-label="Zeit"><strong><?= escape(format_training_time($lap['time'])) ?></strong></td>
                                                        <td data-label="Strafe"><?= escape(format_penalty($lap['penalty'])) ?></td>
                                                        <td data-label="PF"><?= (int) $lap['pf'] ?></td>
                                                        <td data-label="TF"><?= (int) $lap['tf'] ?></td>
                                                        <td data-label="Status"><span class="badge <?= $lap['invalid'] ? 'invalid' : '' ?>"><?= $lap['invalid'] ? 'Ungültig' : 'Gewertet' ?></span></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </details>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </section>
                </div>
            </section>
        <?php endif; ?>

        <div id="results-panel" role="tabpanel" aria-labelledby="results-tab" data-training-panel="results"<?= $training['is_finished'] ? '' : ' hidden' ?>>
        <div class="row row-cols-2 row-cols-md-4 g-3" aria-label="Trainingsübersicht">
            <div><strong><?= (int) $summary['participants'] ?></strong><span>Fahrer mit Stint</span></div>
            <div><strong><?= (int) $summary['stints'] ?></strong><span>Gespeicherte Stints</span></div>
            <div><strong><?= (int) $summary['laps'] ?></strong><span>Erfasste Runden</span></div>
            <div><strong><?= escape(format_date($summary['started_at'], 'H:i:s')) ?></strong><span>Erster Start</span></div>
        </div>

        <section class="card card-body border-0 shadow-sm card card-body border-0 shadow-sm">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted"><span></span> Zwischenstand</p>
                    <h2>Schnellste Runden</h2>
                </div>
                <div class="text-muted">
                    <span>PF <b><?= escape(format_penalty($view['penalties']['pf'])) ?></b></span>
                    <span>TF <b><?= escape(format_penalty($view['penalties']['tf'])) ?></b></span>
                </div>
            </div>

            <?php if ($leaderboard === []): ?>
                <div class="alert alert-info"><strong>Noch keine gewertete Runde.</strong><span>Die Rangliste erscheint, sobald eine gültige Rundenzeit gespeichert wurde.</span></div>
            <?php else: ?>
                <div class="table-responsive table-responsive">
                    <table>
                        <thead><tr><th>Pos.</th><th>Fahrer</th><th>Klasse</th><th>Kart</th><th>Bestzeit</th><th>Abstand</th><th>Ø-Zeit</th><th>Runden</th><th>Zuletzt</th></tr></thead>
                        <tbody>
                        <?php foreach ($leaderboard as $row): ?>
                            <tr class="position-<?= (int) $row['position'] ?>">
                                <td data-label="Position"><span class="fw-bold"><?= (int) $row['position'] ?></span></td>
                                <td data-label="Fahrer"><strong><?= escape($row['driver']) ?></strong></td>
                                <td data-label="Klasse"><?= escape($row['class']) ?></td>
                                <td data-label="Kart"><?= escape($row['kart']) ?></td>
                                <td data-label="Bestzeit"><strong class="font-monospace"><?= escape(format_training_time($row['best'])) ?></strong></td>
                                <td data-label="Abstand"><?= (int) $row['position'] === 1 ? '-' : '+' . escape(format_training_time($row['difference'])) ?></td>
                                <td data-label="Durchschnitt"><?= escape(format_training_time($row['average'])) ?></td>
                                <td data-label="Runden"><?= (int) $row['laps'] ?></td>
                                <td data-label="Zuletzt"><?= escape(format_date($row['last_drive'], 'H:i:s')) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </section>

        <div class="row g-4">
            <section class="card card-body border-0 shadow-sm col-lg-6">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div><p class="text-muted"><span></span> Teilnehmer</p><h2>Starterliste</h2></div>
                    <span class="badge text-bg-secondary"><?= (int) $summary['registered'] ?></span>
                </div>
                <?php if ($view['starters'] === []): ?>
                    <div class="alert alert-info small"><span>Noch keine Fahrer zugeordnet.</span></div>
                <?php else: ?>
                    <ol class="list-group">
                        <?php foreach ($view['starters'] as $starter): ?>
                            <li><span><?= (int) $starter['position'] ?></span><div><strong><?= escape($starter['name']) ?></strong><small><?= escape($starter['club']) ?></small></div><b><?= escape($starter['class']) ?></b></li>
                        <?php endforeach; ?>
                    </ol>
                <?php endif; ?>
            </section>

            <section class="card card-body border-0 shadow-sm col-lg-6">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div><p class="text-muted"><span></span> Verlauf</p><h2>Stints und Runden</h2></div>
                </div>
                <?php if ($view['drivers'] === []): ?>
                    <div class="alert alert-info small"><span>Noch keine Stints gespeichert.</span></div>
                <?php else: ?>
                    <div class="vstack gap-3">
                        <?php foreach ($view['drivers'] as $driver): ?>
                            <details class="card card-body" data-detail-id="driver-<?= (int) $driver['id'] ?>">
                                <summary>
                                    <span class="badge text-bg-primary"><?= escape(display_initial($driver['name'])) ?></span>
                                    <span><strong><?= escape($driver['name']) ?></strong><small><?= count($driver['stints']) ?> Stint<?= count($driver['stints']) === 1 ? '' : 's' ?></small></span>
                                    <i></i>
                                </summary>
                                <div class="vstack gap-2">
                                    <?php foreach ($driver['stints'] as $stint): ?>
                                        <details class="card card-body" data-detail-id="stint-<?= (int) $stint['id'] ?>">
                                            <summary>
                                                <span><strong>Stint vom <?= escape(format_date($stint['datum'], 'd.m.Y · H:i:s')) ?></strong><small><?= escape($stint['kart']) ?> · <?= escape($stint['class']) ?></small></span>
                                                <span class="d-flex flex-column"><small>Gesamt</small><strong><?= escape(format_training_time($stint['total'])) ?></strong></span>
                                            </summary>
                                            <div class="d-flex flex-wrap gap-3">
                                                <span>Gültige Runden <strong><?= (int) $stint['valid_laps'] ?></strong></span>
                                                <span>Durchschnitt <strong><?= escape(format_training_time($stint['average'])) ?></strong></span>
                                            </div>
                                            <div class="table-responsive table table-striped">
                                                <table>
                                                    <thead><tr><th>Runde</th><th>Zeit</th><th>Strafe</th><th>PF</th><th>TF</th><th>Status</th></tr></thead>
                                                    <tbody>
                                                    <?php foreach ($stint['laps'] as $lap): ?>
                                                        <tr class="<?= $lap['invalid'] ? 'invalid-lap' : '' ?>">
                                                            <td data-label="Runde"><?= (int) $lap['number'] ?></td>
                                                            <td data-label="Zeit"><strong><?= escape(format_training_time($lap['time'])) ?></strong></td>
                                                            <td data-label="Strafe"><?= escape(format_penalty($lap['penalty'])) ?></td>
                                                            <td data-label="PF"><?= (int) $lap['pf'] ?></td>
                                                            <td data-label="TF"><?= (int) $lap['tf'] ?></td>
                                                            <td data-label="Status"><span class="badge <?= $lap['invalid'] ? 'invalid' : '' ?>"><?= $lap['invalid'] ? 'Ungültig' : 'Gewertet' ?></span></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </details>
                                    <?php endforeach; ?>
                                </div>
                            </details>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </section>
        </div>
        </div>

        <section id="statistics-panel" class="vstack gap-4" role="tabpanel" aria-labelledby="statistics-tab" data-training-panel="statistics" hidden>
            <div class="d-flex justify-content-between align-items-start d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted"><span></span> Trainingsauswertung</p>
                    <h2>Statistik</h2>
                </div>
                <p>Nur Runden und Stints dieses Trainings. Die Fahrzeit enthält keine Strafsekunden.</p>
            </div>

            <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3" aria-label="Trainingskennzahlen">
                <div><strong><?= (int) $summary['registered'] ?></strong><span>Registrierte Fahrer</span></div>
                <div><strong><?= (int) $summary['participants'] ?></strong><span>Fahrer mit Stint</span></div>
                <div><strong><?= (int) $summary['stints'] ?></strong><span>Stints</span></div>
                <div><strong><?= (int) $statistics['total_rounds'] ?></strong><span>Zeitgemessene Runden</span></div>
                <div><strong><?= escape(format_duration($statistics['total_seconds'])) ?></strong><span>Gesamte Fahrzeit</span></div>
                <div><strong><?= (int) $statistics['total_pf'] ?></strong><span>Pylonenfehler</span></div>
                <div><strong><?= (int) $statistics['total_tf'] ?></strong><span>Torfehler</span></div>
                <div><strong><?= escape(number_format($statistics['average_pf'], 2, '.', '')) ?></strong><span>PF pro Runde</span></div>
                <div><strong><?= escape(number_format($statistics['average_tf'], 2, '.', '')) ?></strong><span>TF pro Runde</span></div>
                <div><strong><?= escape(number_format($statistics['error_free_percent'], 2, '.', '')) ?>%</strong><span>Fehlerfreie Runden</span></div>
            </div>

            <section class="card card-body border-0 shadow-sm">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div><p class="text-muted"><span></span> Fahrerübersicht</p><h2>Fahrerdaten</h2></div>
                    <span class="badge text-bg-secondary"><?= count($statistics['drivers']) ?></span>
                </div>
                <?php if ($statistics['drivers'] === []): ?>
                    <div class="alert alert-info"><strong>Noch keine Trainingsdaten.</strong><span>Die Statistik erscheint, sobald Fahrer einem Training zugeordnet oder Stints gespeichert wurden.</span></div>
                <?php else: ?>
                    <div class="table-responsive table-responsive">
                        <table>
                            <thead><tr><th>Fahrer</th><th>Fahrzeit</th><th>Runden</th><th>Fehlerfreie Runden</th><th>Stints</th><th>PF</th><th>TF</th><th>PF / Runde</th><th>TF / Runde</th></tr></thead>
                            <tbody>
                            <?php foreach ($statistics['drivers'] as $driver): ?>
                                <tr>
                                    <td data-label="Fahrer"><strong><?= escape($driver['name']) ?></strong></td>
                                    <td data-label="Fahrzeit"><strong class="font-monospace duration-value"><?= escape(format_duration($driver['raw_seconds'])) ?></strong></td>
                                    <td data-label="Runden"><?= (int) $driver['rounds'] ?></td>
                                    <td data-label="Fehlerfreie Runden"><?= (int) $driver['error_free_rounds'] ?> <span class="text-muted">(<?= escape(number_format($driver['error_free_percent'], 2, '.', '')) ?>%)</span></td>
                                    <td data-label="Stints"><?= (int) $driver['stints'] ?></td>
                                    <td data-label="PF"><?= (int) $driver['pf'] ?></td>
                                    <td data-label="TF"><?= (int) $driver['tf'] ?></td>
                                    <td data-label="PF / Runde"><?= escape(number_format($driver['average_pf'], 2, '.', '')) ?></td>
                                    <td data-label="TF / Runde"><?= escape(number_format($driver['average_tf'], 2, '.', '')) ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </section>

            <section class="card card-body border-0 shadow-sm">
                <div class="d-flex justify-content-between align-items-start mb-3"><div><p class="text-muted"><span></span> Karts</p><h2>Kart-Auswertung</h2></div><span class="badge text-bg-secondary"><?= count($view['karts']) ?></span></div>
                <?php if ($view['karts'] === []): ?>
                    <div class="alert alert-info"><strong>Keine Kartdaten für dieses Training.</strong><span>Kartdaten erscheinen, sobald gespeicherte Stints einem Kart zugeordnet sind.</span></div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table>
                            <thead><tr><th>Kart</th><th>Fahrzeit</th><th>Runden</th><th>Stints</th><th>Fahrer</th><th>PF</th><th>TF</th><th>PF / Runde</th><th>TF / Runde</th></tr></thead>
                            <tbody>
                            <?php foreach ($view['karts'] as $kartIndex => $kart): ?>
                                <tr  data-kart-summary tabindex="0" role="button" aria-expanded="false" aria-controls="training-kart-driver-details-<?= $kartIndex ?>">
                                    <td data-label="Kart"><strong><?= escape($kart['name']) ?></strong></td>
                                    <td data-label="Fahrzeit"><strong class="font-monospace duration-value"><?= escape(format_duration($kart['seconds'])) ?></strong></td>
                                    <td data-label="Runden"><?= (int) $kart['rounds'] ?></td>
                                    <td data-label="Stints"><?= (int) $kart['stints'] ?></td>
                                    <td data-label="Fahrer"><span ><?= count($kart['drivers']) ?> Fahrer</span></td>
                                    <td data-label="PF"><?= (int) $kart['pf'] ?></td>
                                    <td data-label="TF"><?= (int) $kart['tf'] ?></td>
                                    <td data-label="PF / Runde"><?= escape(number_format($kart['average_pf'], 2, '.', '')) ?></td>
                                    <td data-label="TF / Runde"><?= escape(number_format($kart['average_tf'], 2, '.', '')) ?></td>
                                </tr>
                                <tr id="training-kart-driver-details-<?= $kartIndex ?>"  data-kart-details hidden>
                                    <td colspan="9"><div ><span class="text-muted">Fahrerbezogene Auswertung</span><div class="table-responsive table-responsive"><table><thead><tr><th>Fahrer</th><th>Fahrzeit</th><th>Runden</th><th>Stints</th><th>PF</th><th>TF</th><th>PF / Runde</th><th>TF / Runde</th></tr></thead><tbody>
                                    <?php foreach ($kart['drivers'] as $driver): ?>
                                        <tr><td data-label="Fahrer"><strong><?= escape($driver['name']) ?></strong></td><td data-label="Fahrzeit"><strong class="font-monospace duration-value"><?= escape(format_duration($driver['seconds'])) ?></strong></td><td data-label="Runden"><?= (int) $driver['rounds'] ?></td><td data-label="Stints"><?= (int) $driver['stints'] ?></td><td data-label="PF"><?= (int) $driver['pf'] ?></td><td data-label="TF"><?= (int) $driver['tf'] ?></td><td data-label="PF / Runde"><?= escape(number_format($driver['average_pf'], 2, '.', '')) ?></td><td data-label="TF / Runde"><?= escape(number_format($driver['average_tf'], 2, '.', '')) ?></td></tr>
                                    <?php endforeach; ?>
                                    </tbody></table></div></div></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </section>
        </section>
    </section>
</div>
<script src="<?= escape(base_url('assets/js/training.js?v=' . $trainingScriptVersion)) ?>" defer></script>
<script src="<?= escape(base_url('assets/js/statistics.js')) ?>" defer></script>
