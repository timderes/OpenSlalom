<?php
declare(strict_types=1);

$stylesheetVersion = (string) filemtime(dirname(__DIR__) . '/assets/css/bootstrap.min.css');
?>
<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= escape($pageDescription ?? '') ?>">
    <meta name="theme-color" content="#1f84de">
    <title><?= escape($pageTitle ?? 'openSlalom') ?></title>
    <link rel="icon" href="<?= escape(base_url('assets/img/logo.svg')) ?>" type="image/svg+xml">
    <link rel="stylesheet" href="<?= escape(base_url('assets/css/bootstrap.min.css?v=' . $stylesheetVersion)) ?>">
</head>
<body class="<?= escape($pageClass ?? '') ?>" data-bs-theme="auto">
    <a class="visually-hidden-focusable" href="#content">Zum Inhalt springen</a>

<nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm sticky-top" aria-label="Navigation">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= escape(base_url()) ?>" aria-label="openSlalom Startseite">
            <img src="<?= escape(base_url('assets/img/logo.svg')) ?>" alt="" width="38" height="38">
            <span class="ms-1">openSlalom</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!--
                TODO: add nav items here, when the db connection works,
                so we can see the items in the nav bar
                -->
            </ul>
        
        <?php if ($currentUser === null): ?>
            <a class="btn btn-primary" href="<?= escape(base_url('login')) ?>">
                <symbol aria-hidden="true">&#8594;</symbol>
                Anmelden

            </a>
            
            <?php else: ?>
                <a href="<?= escape(base_url('konto')) ?>"><?= escape($currentUser['username']) ?></a>
                    <form action="<?= escape(base_url('logout')) ?>" method="post">
                        <input type="hidden" name="csrf_token" value="<?= escape(csrf_token()) ?>">
                        <button class="btn btn-primary" type="submit">Abmelden</button>
                    </form>
            <?php endif; ?>
        </div>
    </div>
</nav>

    <?php if ($currentUser !== null && ($pageClass ?? '') !== 'home-page'): ?>
        <?php $currentPath = request_path(); ?>
        <nav class="navbar navbar-expand-lg bg-body border-bottom" aria-label="Interner Bereich">
            <div class="container-fluid">
                <div class="navbar-nav flex-wrap gap-2">
                <a class="nav-link <?= str_starts_with($currentPath, '/training') ? 'active' : '' ?>" href="<?= escape(base_url('trainings')) ?>">Trainings</a>
                <?php if (Auth::canManageMasterData($currentUser)): ?>
                    <a class="nav-link <?= str_starts_with($currentPath, '/statistiken') ? 'active' : '' ?>" href="<?= escape(base_url('statistiken')) ?>">Statistiken</a>
                    <a class="nav-link <?= str_starts_with($currentPath, '/verwaltung/vereine') ? 'active' : '' ?>" href="<?= escape(base_url('verwaltung/vereine')) ?>">Vereine</a>
                    <a class="nav-link <?= str_starts_with($currentPath, '/verwaltung/fahrer') ? 'active' : '' ?>" href="<?= escape(base_url('verwaltung/fahrer')) ?>">Fahrer</a>
                    <a class="nav-link <?= str_starts_with($currentPath, '/verwaltung/disziplinen') ? 'active' : '' ?>" href="<?= escape(base_url('verwaltung/disziplinen')) ?>">Disziplinen</a>
                    <a class="nav-link <?= str_starts_with($currentPath, '/verwaltung/karts') ? 'active' : '' ?>" href="<?= escape(base_url('verwaltung/karts')) ?>">Karts</a>
                    <a class="nav-link <?= str_starts_with($currentPath, '/verwaltung/wetter') ? 'active' : '' ?>" href="<?= escape(base_url('verwaltung/wetter')) ?>">Wetter</a>
                <?php endif; ?>
                <?php if (Auth::hasRole($currentUser, 'Administrator')): ?>
                    <a class="nav-link <?= str_starts_with($currentPath, '/admin/benutzer') ? 'active' : '' ?>" href="<?= escape(base_url('admin/benutzer')) ?>">Benutzer</a>
                <?php endif; ?>
                <a class="nav-link <?= str_starts_with($currentPath, '/konto') ? 'active' : '' ?>" href="<?= escape(base_url('konto')) ?>">Eigenes Konto</a>
                </div>
            </div>
        </nav>
    <?php endif; ?>

    <main class="my-5">

        <?php require_once $contentTemplate; ?>
  
    </main>

    <footer class="text-bg-primary">
        <div class="container p-5 text-center text-sm-start">
            <div class="row g-4">

                <div class="col-12 col-lg-6">
                    <strong class="d-block fs-1 fw-bold mb-3 mb-sm-1">openSlalom</strong>
                    <span>Digitale Trainingsorganisation für den Kart-Slalom.</span>
                </div>
           
                <div class="col-12 col-lg-6">

                    <ul class="nav flex-column flex-sm-row gap-3 justify-content-lg-end align-items-lg-center h-100" aria-label="Rechtliche Informationen">
                        <li class="nav-item">
                            <a class="link-light link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="<?= escape(base_url('impressum')) ?>">Impressum</a>
                        </li>
                        <li class="nav-item">
                            <a class="link-light link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="<?= escape(base_url('datenschutz')) ?>">Datenschutz</a>
                        </li>
                    </ul>

                </div>

            </div>
        </div>
    </footer>

    <script src="<?= escape(base_url('assets/js/bootstrap.bundle.min.js')) ?>"></script>
</body>
</html>
