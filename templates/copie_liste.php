<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/style.css">
    <title>Copies enregistrées | Gestion des notes</title>
</head>
<body>
    <header class="site-header">
        <nav class="navbar" aria-label="Navigation principale">
            <a class="brand" href="/"><span class="brand-mark">GN</span><span class="brand-name">Gestion des notes</span></a>
            <div class="nav-links"><a class="active" href="/copies">Les copies</a><a href="/copies/create">Nouvelle copie</a></div>
        </nav>
    </header>

    <main class="page">
        <div class="hero-row">
            <div><div class="eyebrow">Vue d'ensemble</div><h1>Vos copies, en un coup d'œil.</h1><p class="subtitle">Retrouvez les notes calculées et identifiez rapidement les dépôts pénalisés.</p></div>
            <a class="button" href="/copies/create">+ Nouvelle copie</a>
        </div>
        <div class="stats">
            <div class="stat"><strong><?= count($copies) ?></strong><span>copies enregistrées</span></div>
            <div class="stat"><strong><?= count(array_filter($copies, fn($copie) => $copie->isPenaliteAppliquee())) ?></strong><span>avec pénalité</span></div>
            <div class="stat"><strong><?= count($copies) ? number_format(array_sum(array_map(fn($copie) => (float) $copie->getNoteFinale(), $copies)) / count($copies), 2, ',', ' ') : '—' ?></strong><span>moyenne finale</span></div>
        </div>
        <div class="section-heading"><h2>Dernières copies</h2><span class="subtitle">Total : <?= count($copies) ?></span></div>
        <?php if (empty($copies)): ?>
            <div class="empty-state table-wrap">Aucune copie enregistrée pour le moment.<br><br><a href="/copies/create">Commencer une nouvelle saisie</a></div>
        <?php else: ?>
        <div class="table-wrap"><table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Note brute</th>
                    <th>Note finale</th>
                    <th>Pénalité</th>
                    <th>Date de dépôt</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($copies as $copie): ?>
                    <tr>
                        <td><?= htmlspecialchars((string) $copie->getId()) ?></td>
                        <td><?= htmlspecialchars((string) $copie->getNoteBrute()) ?></td>
                        <td class="score"><?= htmlspecialchars((string) $copie->getNoteFinale()) ?>/20</td>
                        <td><span class="badge <?= $copie->isPenaliteAppliquee() ? 'late' : '' ?>"><?= $copie->isPenaliteAppliquee() ? 'En retard' : 'À temps' ?></span></td>
                        <td><?= htmlspecialchars($copie->getDateDepot()) ?></td>
                        <td>
                            <a href="/copies/<?= htmlspecialchars((string) $copie->getId()) ?>">Voir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table></div>
        <?php endif; ?>
    </main>
</body>
</html>