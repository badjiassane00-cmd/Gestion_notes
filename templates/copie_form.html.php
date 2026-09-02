<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Soumettre une copie</title>
</head>
<body>
    <h1>Soumettre une copie</h1>

    <?php if (!empty($erreurs)): ?>
        <?php require __DIR__ . '/erreur.php'; ?>
    <?php endif; ?>

    <form method="post" action="/copies">
        <label for="note_brute">Note brute (0 à 20) :</label>
        <input type="number" step="0.01" min="0" max="20" name="note_brute" id="note_brute" required>
        <br><br>

        <label for="date_depot">Date de dépôt :</label>
        <input type="date" name="date_depot" id="date_depot" required>
        <br><br>

        <label for="date_limite">Date limite :</label>
        <input type="date" name="date_limite" id="date_limite" required>
        <br><br>

        <button type="submit">Soumettre</button>
    </form>
</body>
</html>