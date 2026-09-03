<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/style.css">
    <title>Copie n° <?= htmlspecialchars((string) $copie->getId()) ?> | Gestion des notes</title>
</head>
<body>
    <header class="site-header"><nav class="navbar" aria-label="Navigation principale"><a class="brand" href="/"><span class="brand-mark">GN</span><span class="brand-name">Gestion des notes</span></a><div class="nav-links"><a class="active" href="/copies">Les copies</a><a href="/copies/create">Nouvelle copie</a></div></nav></header>

    <main class="page"><a href="/copies">← Retour à la liste</a><div class="detail-card"><div class="eyebrow">Fiche de résultat</div><h1>Copie n° <?= htmlspecialchars((string) $copie->getId()) ?></h1><div class="detail-grid"><div class="detail-item"><small>Note brute</small><strong><?= htmlspecialchars((string) $copie->getNoteBrute()) ?>/20</strong></div><div class="detail-item"><small>Note finale</small><strong class="score"><?= htmlspecialchars((string) $copie->getNoteFinale()) ?>/20</strong></div><div class="detail-item"><small>Statut</small><span class="badge <?= $copie->isPenaliteAppliquee() ? 'late' : '' ?>"><?= $copie->isPenaliteAppliquee() ? 'Dépôt en retard' : 'Dépôt à temps' ?></span></div><div class="detail-item"><small>Date de dépôt</small><strong><?= htmlspecialchars($copie->getDateDepot()) ?></strong></div><div class="detail-item"><small>Date limite</small><strong><?= htmlspecialchars($copie->getDateLimite()) ?></strong></div></div><a class="button secondary" href="/copies/create">Enregistrer une autre copie</a></div></main>
</body>
</html>