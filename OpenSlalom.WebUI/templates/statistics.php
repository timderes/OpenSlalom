<?php declare(strict_types=1); ?>
<?php $summary = $statistics['summary']; ?>
<section class="container vstack gap-4">
    <div class="d-flex justify-content-between align-items-start">
        <div><p class="text-muted"><span></span> Auswertung</p><h1>Statistiken</h1></div>
    </div>
    <div class="card card-body border-0 shadow-sm">
        <form class="row row-cols-1 row-cols-md-3 g-3 align-items-end" action="<?= escape(base_url('statistiken')) ?>" method="get">
            <label><span>Auswertung von</span><input type="date" name="from" value="<?= escape($period['from']) ?>" required></label>
            <label><span>Auswertung bis</span><input type="date" name="to" value="<?= escape($period['to']) ?>" required></label>
            <button class="btn btn-primary" type="submit">Auswerten</button>
        </form>
        <p>Es werden ausschließlich Trainings berücksichtigt, deren Trainingsdatum im gewählten Zeitraum liegt.</p>
    </div>
    <?php if (isset($statisticsError)): ?><div class="alert error" role="alert"><?= escape($statisticsError) ?></div><?php endif; ?>

    <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3">
        <div><strong><?= (int) ($summary['drivers'] ?? 0) ?></strong><span>Aktive Fahrer</span></div>
        <div><strong><?= (int) ($summary['karts'] ?? 0) ?></strong><span>Eingesetzte Karts</span></div>
        <div><strong><?= (int) ($summary['trainings'] ?? 0) ?></strong><span>Trainings</span></div>
        <div><strong><?= (int) ($summary['rounds'] ?? 0) ?></strong><span>Zeitgemessene Runden</span></div>
        <div><strong><?= (int) ($summary['stints'] ?? 0) ?></strong><span>Stints</span></div>
        <div><strong><?= escape(format_duration((float) ($summary['seconds'] ?? 0))) ?></strong><span>Gesamte Fahrzeit</span></div>
        <div><strong><?= (int) ($summary['pf'] ?? 0) ?></strong><span>Pylonenfehler</span></div>
        <div><strong><?= (int) ($summary['tf'] ?? 0) ?></strong><span>Torfehler</span></div>
        <div><strong><?= escape(number_format((float) ($summary['average_pf'] ?? 0), 2, '.', '')) ?></strong><span>PF pro Runde</span></div>
        <div><strong><?= escape(number_format((float) ($summary['average_tf'] ?? 0), 2, '.', '')) ?></strong><span>TF pro Runde</span></div>
        <div><strong><?= escape(number_format((float) ($summary['error_free_percent'] ?? 0), 2, '.', '')) ?>%</strong><span>Fehlerfreie Runden</span></div>
    </div>

    <section class="card card-body border-0 shadow-sm">
        <div class="d-flex justify-content-between align-items-start mb-3"><div><p class="text-muted"><span></span> Fahrerübersicht</p><h2>Fahrerstatistik</h2></div><span class="badge text-bg-secondary"><?= count($statistics['drivers']) ?></span></div>
        <?php if ($statistics['drivers'] === []): ?>
            <div class="alert alert-info"><strong>Keine Daten im gewählten Zeitraum.</strong><span>Wähle einen anderen Zeitraum oder erfasse Trainingsrunden.</span></div>
        <?php else: ?>
            <div class="table-responsive">
                <table>
                    <thead><tr><th>Fahrer</th><th>Fahrzeit</th><th>Trainings</th><th>Runden</th><th>Fehlerfreie Runden</th><th>Stints</th><th>PF</th><th>TF</th><th>PF / Runde</th><th>TF / Runde</th></tr></thead>
                    <tbody>
                    <?php foreach ($statistics['drivers'] as $driver): ?>
                        <tr>
                            <td data-label="Fahrer"><strong><?= escape($driver['name']) ?></strong></td>
                            <td data-label="Fahrzeit"><strong class="font-monospace duration-value"><?= escape(format_duration($driver['seconds'])) ?></strong></td>
                            <td data-label="Trainings"><?= (int) $driver['trainings'] ?></td>
                            <td data-label="Runden"><?= (int) $driver['rounds'] ?></td>
                            <td data-label="Fehlerfreie Runden"><?= (int) $driver['error_free'] ?> <span class="text-muted">(<?= escape(number_format($driver['error_free_percent'], 2, '.', '')) ?>%)</span></td>
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
        <div class="d-flex justify-content-between align-items-start mb-3"><div><p class="text-muted"><span></span> Karts</p><h2>Kart-Auswertung</h2></div><span class="badge text-bg-secondary"><?= count($statistics['karts']) ?></span></div>
        <?php if ($statistics['karts'] === []): ?>
            <div class="alert alert-info"><strong>Keine Kartdaten im gewählten Zeitraum.</strong><span>Kartdaten erscheinen, sobald gespeicherte Stints einem Kart zugeordnet sind.</span></div>
        <?php else: ?>
            <div class="table-responsive">
                <table>
                    <thead><tr><th>Kart</th><th>Fahrzeit</th><th>Runden</th><th>Stints</th><th>Fahrer</th><th>PF</th><th>TF</th><th>PF / Runde</th><th>TF / Runde</th></tr></thead>
                    <tbody>
                    <?php foreach ($statistics['karts'] as $kartIndex => $kart): ?>
                        <tr  data-kart-summary tabindex="0" role="button" aria-expanded="false" aria-controls="kart-driver-details-<?= $kartIndex ?>">
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
                        <tr id="kart-driver-details-<?= $kartIndex ?>"  data-kart-details hidden>
                            <td colspan="9">
                                <div >
                                    <span class="text-muted">Fahrerbezogene Auswertung</span>
                                    <div class="table-responsive table-responsive">
                                        <table>
                                            <thead><tr><th>Fahrer</th><th>Fahrzeit</th><th>Runden</th><th>Stints</th><th>PF</th><th>TF</th><th>PF / Runde</th><th>TF / Runde</th></tr></thead>
                                            <tbody>
                                            <?php foreach ($kart['drivers'] as $driver): ?>
                                                <tr>
                                                    <td data-label="Fahrer"><strong><?= escape($driver['name']) ?></strong></td>
                                                    <td data-label="Fahrzeit"><strong class="font-monospace duration-value"><?= escape(format_duration($driver['seconds'])) ?></strong></td>
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
