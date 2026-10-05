<?php

declare(strict_types=1); ?>
<?php $summary = $statistics['summary']; ?>
<section class="py-2">
    <div class="page-header">
        <div>
            <p class="eyebrow mb-2">Auswertung</p>
            <h1 class="display-6 fw-bold">Statistiken</h1>
        </div>
    </div>
    <div class="surface-card rounded-4 p-4 mb-4">
        <form class="row g-3 align-items-end" action="<?= escape(base_url('statistiken')) ?>" method="get">
            <label class="col-12 col-md-4 form-label">Auswertung von<input class="form-control" type="date" name="from" value="<?= escape($period['from']) ?>" required></label>
            <label class="col-12 col-md-4 form-label">Auswertung bis<input class="form-control" type="date" name="to" value="<?= escape($period['to']) ?>" required></label>
            <button class="btn btn-primary col-auto" type="submit">Auswerten</button>
        </form>
        <p class="form-text mb-0">Es werden ausschließlich Trainings berücksichtigt, deren Trainingsdatum im gewählten Zeitraum liegt.</p>
    </div>
    <?php if (isset($statisticsError)): ?><div class="alert alert-danger" role="alert"><?= escape($statisticsError) ?></div><?php endif; ?>

    <div class="row row-cols-2 row-cols-md-4 row-cols-xl-6 g-3 mb-4">
        <?php $metrics = [
            ['drivers', 'Aktive Fahrer'], ['karts', 'Eingesetzte Karts'], ['trainings', 'Trainings'],
            ['rounds', 'Zeitgemessene Runden'], ['stints', 'Stints'],
        ]; ?>
        <?php foreach ($metrics as [$key, $label]): ?>
            <div class="col"><div class="surface-card rounded-4 p-3 h-100"><strong class="d-block fs-3 text-primary"><?= (int) ($summary[$key] ?? 0) ?></strong><span class="small text-body-secondary"><?= escape($label) ?></span></div></div>
        <?php endforeach; ?>
        <div class="col"><div class="surface-card rounded-4 p-3 h-100"><strong class="d-block fs-3 timing-value"><?= escape(format_duration((float) ($summary['seconds'] ?? 0))) ?></strong><span class="small text-body-secondary">Gesamte Fahrzeit</span></div></div>
        <?php foreach ([['pf', 'Pylonenfehler'], ['tf', 'Torfehler']] as [$key, $label]): ?>
            <div class="col"><div class="surface-card rounded-4 p-3 h-100"><strong class="d-block fs-3"><?= (int) ($summary[$key] ?? 0) ?></strong><span class="small text-body-secondary"><?= escape($label) ?></span></div></div>
        <?php endforeach; ?>
        <?php foreach ([['average_pf', 'PF pro Runde'], ['average_tf', 'TF pro Runde']] as [$key, $label]): ?>
            <div class="col"><div class="surface-card rounded-4 p-3 h-100"><strong class="d-block fs-3"><?= escape(number_format((float) ($summary[$key] ?? 0), 2, '.', '')) ?></strong><span class="small text-body-secondary"><?= escape($label) ?></span></div></div>
        <?php endforeach; ?>
        <div class="col"><div class="surface-card rounded-4 p-3 h-100"><strong class="d-block fs-3 text-success"><?= escape(number_format((float) ($summary['error_free_percent'] ?? 0), 2, '.', '')) ?>%</strong><span class="small text-body-secondary">Fehlerfreie Runden</span></div></div>
    </div>

    <section class="surface-card rounded-4 p-4 mb-4 global-driver-statistics">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <p class="text-primary fw-semibold mb-2">Fahrerübersicht</p>
                <h2>Fahrerstatistik</h2>
            </div><span class="badge text-bg-secondary"><?= count($statistics['drivers']) ?></span>
        </div>
        <?php if ($statistics['drivers'] === []): ?>
            <div class="alert alert-info"><strong>Keine Daten im gewählten Zeitraum.</strong> Wähle einen anderen Zeitraum oder erfasse Trainingsrunden.</div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Fahrer</th>
                            <th>Fahrzeit</th>
                            <th>Trainings</th>
                            <th>Runden</th>
                            <th>Fehlerfreie Runden</th>
                            <th>Stints</th>
                            <th>PF</th>
                            <th>TF</th>
                            <th>PF / Runde</th>
                            <th>TF / Runde</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($statistics['drivers'] as $driver): ?>
                            <tr>
                                <td data-label="Fahrer"><strong><?= escape($driver['name']) ?></strong></td>
                                <td data-label="Fahrzeit"><strong class="time-value duration-value"><?= escape(format_duration($driver['seconds'])) ?></strong></td>
                                <td data-label="Trainings"><?= (int) $driver['trainings'] ?></td>
                                <td data-label="Runden"><?= (int) $driver['rounds'] ?></td>
                                <td data-label="Fehlerfreie Runden"><?= (int) $driver['error_free'] ?> <span class="percentage">(<?= escape(number_format($driver['error_free_percent'], 2, '.', '')) ?>%)</span></td>
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

    <section class="surface-card rounded-4 p-4 mb-4 global-kart-statistics">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <p class="text-primary fw-semibold mb-2">Karts</p>
                <h2>Kart-Auswertung</h2>
            </div><span class="badge text-bg-secondary"><?= count($statistics['karts']) ?></span>
        </div>
        <?php if ($statistics['karts'] === []): ?>
            <div class="alert alert-info"><strong>Keine Kartdaten im gewählten Zeitraum.</strong> Kartdaten erscheinen, sobald gespeicherte Stints einem Kart zugeordnet sind.</div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Kart</th>
                            <th>Fahrzeit</th>
                            <th>Runden</th>
                            <th>Stints</th>
                            <th>Fahrer</th>
                            <th>PF</th>
                            <th>TF</th>
                            <th>PF / Runde</th>
                            <th>TF / Runde</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($statistics['karts'] as $kartIndex => $kart): ?>
                            <tr class="kart-summary-row" data-kart-summary tabindex="0" role="button" aria-expanded="false" aria-controls="kart-driver-details-<?= $kartIndex ?>">
                                <td data-label="Kart"><strong><?= escape($kart['name']) ?></strong></td>
                                <td data-label="Fahrzeit"><strong class="time-value duration-value"><?= escape(format_duration($kart['seconds'])) ?></strong></td>
                                <td data-label="Runden"><?= (int) $kart['rounds'] ?></td>
                                <td data-label="Stints"><?= (int) $kart['stints'] ?></td>
                                <td data-label="Fahrer"><span class="kart-driver-list"><?= count($kart['drivers']) ?> Fahrer</span></td>
                                <td data-label="PF"><?= (int) $kart['pf'] ?></td>
                                <td data-label="TF"><?= (int) $kart['tf'] ?></td>
                                <td data-label="PF / Runde"><?= escape(number_format($kart['average_pf'], 2, '.', '')) ?></td>
                                <td data-label="TF / Runde"><?= escape(number_format($kart['average_tf'], 2, '.', '')) ?></td>
                            </tr>
                            <tr id="kart-driver-details-<?= $kartIndex ?>" class="kart-driver-expansion" data-kart-details hidden>
                                <td colspan="9">
                                    <div class="kart-driver-expansion-content">
                                        <span class="kart-driver-expansion-label">Fahrerbezogene Auswertung</span>
                                        <div class="table-responsive kart-driver-table">
                                            <table class="table table-striped table-hover align-middle">
                                                <thead>
                                                    <tr>
                                                        <th>Fahrer</th>
                                                        <th>Fahrzeit</th>
                                                        <th>Runden</th>
                                                        <th>Stints</th>
                                                        <th>PF</th>
                                                        <th>TF</th>
                                                        <th>PF / Runde</th>
                                                        <th>TF / Runde</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($kart['drivers'] as $driver): ?>
                                                        <tr>
                                                            <td data-label="Fahrer"><strong><?= escape($driver['name']) ?></strong></td>
                                                            <td data-label="Fahrzeit"><strong class="time-value duration-value"><?= escape(format_duration($driver['seconds'])) ?></strong></td>
                                                            <td data-label="Runden"><?= (int) $driver['rounds'] ?></td>
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
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </section>
</section>
<script src="<?= escape(base_url('assets/js/statistics.js')) ?>" defer></script>
