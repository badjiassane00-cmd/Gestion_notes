<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des copies</title>
</head>
<body>
    <h1>Copies enregistrées</h1>

    <?php if (empty($copies)): ?>
        <p>Aucune copie enregistrée pour le moment.</p>
    <?php else: ?>
        <table border="1" cellpadding="8">
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
                        <td><?= htmlspecialchars((string) $copie->getNoteFinale()) ?></td>
                        <td><?= $copie->isPenaliteAppliquee() ? 'Oui' : 'Non' ?></td>
                        <td><?= htmlspecialchars($copie->getDateDepot()) ?></td>
                        <td>
                            <a href="/copies/<?= htmlspecialchars((string) $copie->getId()) ?>">Voir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>