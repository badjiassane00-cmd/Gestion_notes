<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail de la copie</title>
</head>
<body>
    <h1>Copie n° <?= htmlspecialchars((string) $copie->getId()) ?></h1>

    <ul>
        <li>Note brute : <?= htmlspecialchars((string) $copie->getNoteBrute()) ?></li>
        <li>Note finale : <?= htmlspecialchars((string) $copie->getNoteFinale()) ?></li>
        <li>Pénalité appliquée : <?= $copie->isPenaliteAppliquee() ? 'Oui' : 'Non' ?></li>
        <li>Date de dépôt : <?= htmlspecialchars($copie->getDateDepot()) ?></li>
        <li>Date limite : <?= htmlspecialchars($copie->getDateLimite()) ?></li>
    </ul>

    <a href="/copies">Retour à la liste</a>
</body>
</html>